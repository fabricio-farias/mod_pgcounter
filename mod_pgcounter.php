<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_custom
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

require_once dirname(__FILE__).'/helper.php';

if ($params->def('prepare_content', 1))
{
	JPluginHelper::importPlugin('content');
	$module->content = JHtml::_('content.prepare', $module->content, '', 'mod_pgcounter.content');
}


$count = new modPGCounterHelper($params);
$countObj = $count->getCount();

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$layoutModulePath = JModuleHelper::getLayoutPath('mod_pgcounter', $params->get('layout', 'default'));

require ($layoutModulePath);