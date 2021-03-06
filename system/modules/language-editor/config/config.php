<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Language editor
 * Copyright (C) 2010,2011 Tristan Lins
 *
 * Extension for:
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  InfinitySoft 2012
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    Language Editor
 * @license    LGPL
 * @filesource
 */



/**
 * Back end modules
 */
$GLOBALS['BE_MOD']['system']['language-editor'] = array
(
	'tables'     => array('tl_translation'),
	'icon'       => 'system/modules/language-editor/html/icon.png',
	'search'     => array('LanguageVariableSearch', 'searchLanguageVariable'),
	'build'      => array('LanguageVariableSearch', 'buildLanguageVariableKeys'),
	'stylesheet' => 'system/modules/language-editor/html/backend.css'
);


/**
 * Sprachvariablen
 */
$GLOBALS['TL_TRANSLATION']['tl_translation']['tl_translation|langgroup']   = array('type' => '');
$GLOBALS['TL_TRANSLATION']['tl_translation']['tl_translation|langvar']     = array('type' => 'inputField');
$GLOBALS['TL_TRANSLATION']['tl_translation']['tl_translation|language']    = array('type' => 'inputField');
$GLOBALS['TL_TRANSLATION']['tl_translation']['tl_translation|backend']     = array('type' => 'inputField');
$GLOBALS['TL_TRANSLATION']['tl_translation']['tl_translation|frontend']    = array('type' => 'inputField');
$GLOBALS['TL_TRANSLATION']['tl_translation']['tl_translation|default']     = array('type' => 'inputField');
$GLOBALS['TL_TRANSLATION']['tl_translation']['tl_translation|translation'] = array('type' => 'inputField');


/**
 * Form fields
 */
$GLOBALS['BE_FFL']['langplain'] = 'LangPlainWidget';
