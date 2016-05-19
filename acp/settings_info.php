<?php
/**
*
* Board Rules extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/
namespace mjimeyg\documentmanager\acp;
class settings_info
{
	public function module()
	{
		return array(
			'filename'	=> '\mjimeyg\documentmanager\acp\settings_module',
			'title'		=> 'ACP_DOCUMENTMANAGER_SETTINGS',
			'modes'		=> array(
				'settings'	=> array('title' => 'ACP_DOCUMENTMANAGER_SETTINGS', 'auth' => 'ext_mjimeyg/documentmanager', 'cat' => array('ACP_DOCUMENTMANAGER')),
			),
		);
	}
}