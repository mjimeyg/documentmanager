<?php
/**
*
* @package Document Manager Extension
* @copyright (c) 2016 mjimeyg
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mjimeyg\documentmanager\acp;

class settings_module
{
	public $u_action;

	function main($id, $mode)
	{
		global $phpbb_container, $user;

                $user->add_lang_ext('mjimeyg/documentmanager', 'info_acp_documentmanager');
		$this->tpl_name		= 'settings_module';
		$this->page_title	= $user->lang('DOCUMENTMANAGER');
                
		// Get an instance of the admin controller
		$admin_controller = $phpbb_container->get('mjimeyg.documentmanager.admin.controller');

		$admin_controller->display_options();
	}
}
