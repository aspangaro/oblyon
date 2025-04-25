<?php
	/************************************************
	* Copyright (C) 2016-2025	Sylvain Legrand - <contact@infras.fr>	InfraS - <https://www.infras.fr>
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
	*	Return a Dolibarr global constant float value.
	*	The constants $conf->global->xxx are loaded by the script master.inc.php included at begin of any PHP page.
	*
	*	@param string		$key 		Key to return value, return $default if not set
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
	*	The constants $conf->global->xxx are loaded by the script master.inc.php included at begin of any PHP page.
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

