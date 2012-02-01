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
 * Table tl_translation
 */
$GLOBALS['TL_DCA']['tl_translation'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'onload_callback' => array
		(
			array('tl_translation', 'loadTranslation')
		),
		'onsubmit_callback' => array
		(
			array('tl_translation', 'updateTranslations')
		),
		'ondelete_callback' => array
		(
			array('tl_translation', 'updateTranslations')
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('langvar'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;search,limit',
		),
		'label' => array
		(
			'fields'                  => array('language'),
			'format'                  => '[%s]',
			'label_callback'          => array('tl_translation', 'getLabel')
		),
		'global_operations' => array
		(
			'search' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_translation']['search'],
				'href'                => 'key=search',
				'class'               => 'header_language_editor_search',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="s"'
			),
			'build' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_translation']['build'],
				'href'                => 'key=build',
				'class'               => 'header_language_editor_build',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="b"'
			),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_translation']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_translation']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_translation']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_translation']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'metapalettes' => array
	(
		'default'                     => array(
			'translation' => array('langgroup', 'langvar', 'language', 'backend', 'frontend', 'default', 'content')
		)
	),


	// Fields
	'fields' => array
	(
		'langgroup' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_translation']['langgroup'],
			'filter'                  => true,
			'inputType'               => 'hidden',
			'eval'                    => array('alwaysSave'=>true),
			'save_callback'           => array('tl_translation', 'saveLangGroup')
		),
		'langvar' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_translation']['langvar'],
			'search'                  => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_translation', 'getLanguageVariablesOptions'),
			'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50')
		),
		'language' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_translation']['language'],
			'default'                 => $GLOBALS['TL_LANGUAGE'],
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => $this->getLanguages(),
			'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50')
		),
		'backend' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_translation']['backend'],
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50')
		),
		'frontend' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_translation']['frontend'],
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50')
		),
		'default' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_translation']['default'],
			'inputType'               => 'langplain',
			'eval'                    => array('tl_class'=>'clr long'),
			'load_callback'           => array(
				array('tl_translation', 'loadDefault')
			)
		),
		'content' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_translation']['content'],
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('tl_class'=>'clr long', 'includeBlankOption'=>true, 'allowHtml'=>true, 'preserveTags'=>true, 'mandatory'=>true),
			'load_callback'           => array(
				array('tl_translation', 'loadContent')
			)
		)
	)
);


/**
 * Class tl_translation
 *
 * @copyright  InfinitySoft 2012
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    Language Editor
 */
class tl_translation extends Backend
{
	/**
	 * @var Config
	 */
	protected $Config;

	/**
	 * @var Session
	 */
	protected $Session;

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');

		// get translation keys found by the TranslationSearch::buildTranslationKeys method
		$objDir = new RegexIterator(new DirectoryIterator(TL_ROOT . '/system/languages/'), '#^langkeys\..*\.php$#');
		/** @var SplFileInfo $objFile */
		foreach ($objDir as $objFile) {
			require_once($objFile->getPathname());
		}

		uksort($GLOBALS['TL_TRANSLATION'], 'strcasecmp');
	}

	public function getLabel($arrRow, $label)
	{
		if ($arrRow['backend'] && $arrRow['frontend']) {
			$label = 'BE+FE ' . $label;
		} else if ($arrRow['backend']) {
			$label = 'BE ' . $label;
		} else if ($arrRow['frontend']) {
			$label = 'FE ' . $label;
		}

		list($strGroup, $strPath) = explode('::', $arrRow['langvar'], 2);
		$strPath = (!preg_match('#^' . preg_quote($strGroup) . '|#', $strPath) ? $strGroup . '.' : '') . str_replace('|', '.', $strPath);

		if (empty($GLOBALS['TL_TRANSLATION'][$strGroup][$strPath]['label'])) {
			$label .= ' <strong>' . $strPath . '</strong>';
		} else {
			$label .= ' <strong>' . $GLOBALS['TL_TRANSLATION'][$strGroup][$strPath]['label'] . '</strong>';
		}

		$varContent = deserialize($arrRow['content']);
		if (!$varContent) {
			$varContent = $arrRow['content'];
		}

		if (is_array($varContent)) {
			$label .= '<pre>' . '&ndash; ' . implode('<br>&ndash; ', array_map(array($this, 'plainEncode'), $varContent)) . '</pre>';
		} else {
			$label .= '<pre>' . $this->plainEncode($varContent) . '</pre>';
		}

		return $label;
	}

	public function loadTranslation(DataContainer $dc)
	{
		$objTranslation = $this->Database
			->prepare("SELECT * FROM tl_translation WHERE id=?")
			->execute($dc->id);

		if ($objTranslation->next()) {
			list($strGroup, $strPath) = explode('::', $objTranslation->langvar, 2);

			$this->loadLanguageFile($strGroup, $objTranslation->language, true);

			if (isset($GLOBALS['TL_TRANSLATION'][$strGroup][$strPath])) {
				$arrConfig = $GLOBALS['TL_TRANSLATION'][$strGroup][$strPath];

				switch ($arrConfig['type']) {
					case 'legend':
						// do nothink, use default config
						break;

					case 'inputField':
						$GLOBALS['TL_DCA']['tl_translation']['fields']['content']['eval']['multiple'] = true;
						$GLOBALS['TL_DCA']['tl_translation']['fields']['content']['eval']['size'] = 2;
						break;

					case 'text':
						$GLOBALS['TL_DCA']['tl_translation']['fields']['content']['inputType'] = 'textarea';
						break;
				}
			}
		}
	}

	public function saveLangGroup($varValue, DataContainer $dc)
	{
		return preg_replace('#^([^:]+)::.*$#', '$1', $dc->activeRecord->langvar);
	}

	public function getLanguageVariablesOptions(DataContainer $dc)
	{
		$arrOptions = array();
		foreach ($GLOBALS['TL_TRANSLATION'] as $strGroup => $arrKeys) {
			$arrOptions[$strGroup] = array();
			foreach ($arrKeys as $strKey=>$arrKey) {
				if (!empty($arrKey['type'])) {
					$strPath = (!preg_match('#^' . preg_quote($strGroup) . '|#', $strKey) ? $strGroup . '.' : '') . str_replace('|', '.', $strKey);
					$arrOptions[$strGroup][$strGroup . '::' . $strKey] = '[' . $strPath . ']'
						. (isset($arrKey['label']) ? ' ' . $arrKey['label'] : '');
				}
			}
		}
		return $arrOptions;
	}

	public function loadDefault($varValue, DataContainer $dc)
	{
		return $this->getLangValue($GLOBALS['TL_LANG'], explode('|', preg_replace('#^[^:]+::#', '', $dc->activeRecord->langvar)));
	}

	protected function getLangValue(&$arrParent, $arrPath)
	{
		$strNext = array_shift($arrPath);

		// language path not found
		if (!isset($arrParent[$strNext])) {
			return 'not found!';
		}

		// walk deeper
		else if (count($arrPath)) {
			return $this->getLangValue($arrParent[$strNext], $arrPath);
		}

		// value is array (like label)
		else if (is_array($arrParent[$strNext])) {
			return '&ndash; ' . implode('<br>&ndash; ', array_map(array($this, 'plainEncode'), $arrParent[$strNext]));
		}

		// value is somethink else
		else {
			return $this->plainEncode($arrParent[$strNext]);
		}
	}

	protected function plainEncode($varValue)
	{
		return htmlentities($varValue, ENT_QUOTES | ENT_HTML401, 'UTF-8');
	}

	public function loadContent($varValue, DataContainer $dc)
	{
		if (empty($varValue)) {
			return $this->getLangValue($GLOBALS['TL_LANG'], explode('|', preg_replace('#^[^:]+::#', '', $dc->activeRecord->langvar)));
		} else {
			return $varValue;
		}
	}

	public function updateTranslations()
	{

	}
}
