<?php
/**
*
* @package Site Logo Extension
* @copyright (c) 2014 mjimeyg
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mjimeyg\documentmanager\controller;

use phpbb\config\config;
use phpbb\controller\helper;
use phpbb\template\template;
use phpbb\user;
use phpbb\db\driver\driver_interface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
* Admin controller
*/
class main_controller
{
	/* @var config */
    protected $config;

    /* @var helper */
    protected $helper;

    /* @var template */
    protected $template;

    /* @var user */
    protected $user;
    
    /* @var db */
    protected $db;
    
    /* @var \mjimeyg.documentmanager.dbtables */
    protected $tables;
    
    /**
    * Constructor for admin controller
    *
    * @param \phpbb\config\config				$config		Config object
    * @param \phpbb\request\request				$request	Request object
    * @param \phpbb\template\template			$template	Template object
    * @param \phpbb\user						$user		User object
    * @param ContainerInterface					$container	Service container interface
    *
    * @return \phpbb\boardrules\controller\admin_controller
    * @access public
    */
    public function __construct(config $config, helper $helper, template $template, user $user, driver_interface $db, $documents_table)
    {
        $this->config = $config;
        $this->helper = $helper;
        $this->template = $template;
        $this->user = $user;
        $this->db = $db;
        $this->tables = $documents_table;
        
        //$this->side_menu = $side_menu;
        
        $user->add_lang_ext('mjimeyg/documentmanager', 'main');
    }

    /**
    * View the document
    *
    * @return null
    * @access public
    */
    public function handle()
    {
        
        /*while($chapters_row = $this->db->sql_fetchrow($result)) {
            $this->template->assign_block_vars('chapters', array(
                'id'        => $chapters_row['chapter_id'],
                'title'     => $chapters_row['chapter_title'],
                'number'    => $chapters_row['chapter_number'],
            ));
            if($chapter == $chapters_row['chapter_number']) {
                $current_chapter = $chapters_row;
            }
        }*/
        
        return $this->helper->render('main.html');
    }

}
