<?php
	/************************************************
	* Copyright (C) 2016-2026	Sylvain Legrand - <contact@infras.fr>	InfraS - <https://www.infras.fr>
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
	* along with this program.  If not, see <http://www.gnu.org/licenses/>.
	************************************************/

	/************************************************
	*	\file		../oblyon/backport/v21/core/lib/functions.lib.php
	*	\ingroup	InfraS
	*	\brief		about page
	************************************************/


	/**
	 * Return dolibarr global constant string value
	 *
	 * @param string $key		key to return value, return '' if not set
	 * @param string $default	value to return
	 * @return string
	 */
	if (!function_exists('getDolGlobalString')) {
		function getDolGlobalString($key, $default = '')
		{
			global $conf;
			// return $conf->global->$key ?? $default;
			return (string) (isset($conf->global->$key) ? $conf->global->$key : $default);
		}
	}

	/**
	 * Return dolibarr global constant int value
	 *
	 * @param string	$key		key to return value, return 0 if not set
	 * @param int		$default	value to return
	 * @return int
	 */
	if (!function_exists('getDolGlobalInt')) {
		function getDolGlobalInt($key, $default = 0)
		{
			global $conf;
			// return $conf->global->$key ?? $default;
			return (int) (isset($conf->global->$key) ? $conf->global->$key : $default);
		}
	}

	/**
	*	Return a Dolibarr global constant float value.
	*
	*	@param string		$key		Key to return value, return $default if not set
	*	@param float		$default	Value to return if not defined
	*	@return float					Value returned
	*	@see getDolUserInt()
	**/
	if (!function_exists('getDolGlobalFloat')) {
		function getDolGlobalFloat($key, $default = 0)
		{
			global $conf;
			return (float) (isset($conf->global->$key) ? $conf->global->$key : $default);
		}
	}

	/**
	*	Return a Dolibarr global constant boolean value.
	*
	*	@param string		$key		Key to return value, return $default if not set
	*	@param bool			$default	Value to return if not defined
	*	@return bool					Value returned
	**/
	if (!function_exists('getDolGlobalBool')) {
		function getDolGlobalBool($key, $default = false)
		{
			global $conf;
			return (bool) ($conf->global->$key ?? $default);
		}
	}

	/**
	 * Return Dolibarr user constant string value
	 *
	 * @param string $key		key to return value, return '' if not set
	 * @param string $default	value to return
	 * @param User   $tmpuser   To get another user than current user
	 * @return string
	 */
	if (!function_exists('getDolUserString')) {
		function getDolUserString($key, $default = '', $tmpuser = null)
		{
			if (empty($tmpuser)) {
				global $user;
				$tmpuser = $user;
			}
			// return $conf->global->$key ?? $default;
			return (string) (empty($tmpuser->conf->$key) ? $default : $tmpuser->conf->$key);
		}
	}

	/**
	 * Return Dolibarr user constant int value
	 *
	 * @param string	$key			key to return value, return 0 if not set
	 * @param int		$default		value to return
	 * @param User	$tmpuser		To get another user than current user
	 * @return int
	 */
	if (!function_exists('getDolUserInt')) {
		function getDolUserInt($key, $default = 0, $tmpuser = null)
		{
			if (empty($tmpuser)) {
				global $user;
				$tmpuser = $user;
			}
			// return $conf->global->$key ?? $default;
			return (int) (empty($tmpuser->conf->$key) ? $default : $tmpuser->conf->$key);
		}
	}
