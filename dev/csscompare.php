<?php
	/************************************************
	* Copyright (C) 2026   Sylvain Legrand   <contact@infras.fr>   InfraS - <https://www.infras.fr>
	*
	* This program is free software: you can redistribute it and/or modify
	* it under the terms of the GNU General Public License as published by
	* the Free Software Foundation, either version 3 of the License, or
	* (at your option) any later version.
	*
	* This program is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	* GNU General Public License for more details.
	*
	* You should have received a copy of the GNU General Public License
	* along with this program.  If not, see <https://www.gnu.org/licenses/>.
	************************************************/

	/************************************************
	* 	\file		./oblyon/dev/csscompare.php
	* 	\ingroup	oblyon
	* 	\brief		Non-regression check of the generated stylesheet (CLI) : semantic comparison of two saved CSS files
	*
	*	Usage :
	*		curl -s -o /tmp/before.css "https://<instance>/theme/oblyon/style.css.php?lang=fr_FR&theme=oblyon&revision=<n>"
	*		... change the theme files, bump MAIN_IHM_PARAMS_REV ...
	*		curl -s -o /tmp/after.css  "https://<instance>/theme/oblyon/style.css.php?lang=fr_FR&theme=oblyon&revision=<n+1>"
	*		php dev/csscompare.php /tmp/before.css /tmp/after.css
	*
	*	For every (media query, selector) the final value of each property after the cascade by order is computed
	*	(a later declaration wins, an !important one wins over a normal one). rgb(r,g,b) and #rrggbb are normalized.
	*	Exit code 0 when no difference, 1 otherwise. Comments and whitespace are ignored ; a removed duplicate or an
	*	emptied rule gives no difference, a changed value or a lost rule does.
	************************************************/

	if (php_sapi_name() !== 'cli') {
		die('CLI only');
	}
	if ($argc < 3) {
		fwrite(STDERR, "Usage : php dev/csscompare.php before.css after.css\n");
		exit(2);
	}

	/**
	*	Final declarations of a stylesheet : array[(media|selector)][property] = array(value, important)
	*
	*	@param		string	$css	Stylesheet
	*	@return		array
	**/
	function csscompare_final_map($css)
	{
		$css	= preg_replace('#/\*.*?\*/#s', '', $css);
		$out	= array();
		$stack	= array();
		$last	= 0;
		$len	= strlen($css);
		for ($i = 0; $i < $len; $i++) {
			$c	= $css[$i];
			if ($c == '{') {
				$sel	= preg_replace('/\s+/', ' ', trim(substr($css, $last, $i - $last)));
				if ($sel !== '' && $sel[0] == '@' && strpos($sel, '@font-face') !== 0) {
					$stack[]	= $sel;
					$last		= $i + 1;
					continue;
				}
				$e	= strpos($css, '}', $i);
				if ($e === false) {
					break;
				}
				$key	= implode(' > ', $stack).'|'.$sel;
				foreach (explode(';', substr($css, $i + 1, $e - $i - 1)) as $d) {
					if (strpos($d, ':') === false) {
						continue;
					}
					list($p, $v)	= explode(':', $d, 2);
					$p		= strtolower(trim($p));
					$imp	= (stripos($v, '!important') !== false);
					$v		= trim(preg_replace('/\s*!important/i', '', $v));
					$v		= preg_replace_callback('/rgb\((\d+),\s*(\d+),\s*(\d+)\)/', function ($m) { return sprintf('#%02X%02X%02X', $m[1], $m[2], $m[3]); }, $v);
					$v		= preg_replace_callback('/#([0-9a-f]{6})\b/i', function ($m) { return '#'.strtoupper($m[1]); }, $v);
					$v		= preg_replace('/\s+/', '', $v);
					if (! isset($out[$key][$p]) || $imp || ! $out[$key][$p][1]) {
						$out[$key][$p]	= array($v, $imp);
					}
				}
				$i		= $e;
				$last	= $e + 1;
				continue;
			}
			if ($c == '}') {
				array_pop($stack);
				$last	= $i + 1;
				continue;
			}
			if ($c == ';' && empty($stack) && substr(ltrim(substr($css, $last, $i - $last)), 0, 1) == '@') {
				$last	= $i + 1;
			}
		}
		return $out;
	}

	$a		= csscompare_final_map(file_get_contents($argv[1]));
	$b		= csscompare_final_map(file_get_contents($argv[2]));
	$diffs	= array();
	foreach (array_unique(array_merge(array_keys($a), array_keys($b))) as $key) {
		$da	= isset($a[$key]) ? $a[$key] : array();
		$db	= isset($b[$key]) ? $b[$key] : array();
		foreach (array_unique(array_merge(array_keys($da), array_keys($db))) as $p) {
			$va	= isset($da[$p]) ? $da[$p] : null;
			$vb	= isset($db[$p]) ? $db[$p] : null;
			if ($va !== $vb) {
				$diffs[]	= $key.' { '.$p.' : '.($va === null ? '(absent)' : $va[0].($va[1] ? ' !important' : '')).'  ->  '.($vb === null ? '(absent)' : $vb[0].($vb[1] ? ' !important' : '')).' }';
			}
		}
	}
	sort($diffs);
	print count($a).' regles avant, '.count($b).' regles apres, '.count($diffs)." difference(s)\n";
	foreach ($diffs as $d) {
		print '  '.$d."\n";
	}
	exit(count($diffs) ? 1 : 0);
