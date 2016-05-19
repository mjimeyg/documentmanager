<?php
/**
*
* @package Document Manager Extension
* @copyright (c) 2016 mjimeyg
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mjimeyg\documentmanager\controller;


//use \phpbb\config;

use \Symfony\Component\DependencyInjection\ContainerInterface;
use \mjimeyg\documentmanager\core;

/**
* Interface for our admin controller
*
* This describes all of the methods we'll use for the admin front-end of this extension
*/
class manage_categories_controller
{
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
    
    protected $request;
    
    protected $categories;


    private $form_key = 'dm_manage_categories';
    
    private $u_action;
    
    protected $phpbb_container;


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
    public function __construct(ContainerInterface $container,
            \phpbb\config\config $config, 
            \phpbb\controller\helper $helper, 
            \phpbb\template\template $template, 
            \phpbb\user $user, 
            \phpbb\request\request $request, 
            \phpbb\db\driver\driver_interface $db)
    {
        $this->config = $config;
        $this->helper = $helper;
        $this->template = $template;
        $this->user = $user;
        $this->request = $request;
        $this->db = $db;
        $this->phpbb_container = $container;
        
        $this->categories = $this->phpbb_container->get('mjimeyg.documentmanager.core.categories');
        //$this->categories->load_set();
        //$this->side_menu = $side_menu;
        
        $this->u_action = $this->helper->route('mjimeyg_documentmanager_manage_categories');
        
        $this->template->assign_vars(array(
            'U_ACTION'      => $this->u_action,
        ));
        
        $user->add_lang_ext('mjimeyg/documentmanager', 'main');
    }
	
    /**
    * Display the output for this extension
    *
    * @return null
    * @access public
    */
    public function handle() {
        add_form_key($this->form_key);
        $submit = $this->request->variable('submit', FALSE);
        $this->categories->load_set();
        //print_r($this->categories->toArray());
        if(!$submit) {
            
        } else {
            if(!check_form_key($this->form_key)) {
                trigger_error('bad form');
            } else {
                trigger_error($this->request->variable('title', ''));
            }
        }
        $extension_path_add = $this->helper->route("mjimeyg_documentmanager_ajax_manage_categories_add");
        $extension_path_delete = $this->helper->route("mjimeyg_documentmanager_ajax_manage_categories_delete");
        $this->template->assign_var('EXTENSION_PATH_ADD', $extension_path_add);
        $this->template->assign_var('EXTENSION_PATH_DELETE', $extension_path_delete);
        $this->template->assign_var('categories', $this->categories->toArray());
        $this->template->assign_var('MODAL_TITLE_CAT_DELETE', $this->user->lang('MODAL_TITLE_CAT_DELETE'));
        $this->template->assign_var('MODAL_TEXT_CAT_DELETE', $this->user->lang('MODAL_TEXT_CAT_DELETE'));
        return $this->helper->render('manage_categories.html');
    }
}
