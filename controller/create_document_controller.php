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
class create_document_controller
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
    
    protected $authors;
    protected $categories;
    protected $document;
    

    private $form_key = 'dm_create_document';
    
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
        
        $this->authors = $this->phpbb_container->get('mjimeyg.documentmanager.core.authors');
        
        $this->authors->load_set();
        
        $this->categories = $this->phpbb_container->get('mjimeyg.documentmanager.core.categories');
        
        $this->categories->load_set();
        
        $this->document = $this->phpbb_container->get('mjimeyg.documentmanager.core.document');
        
        $this->u_action = $this->helper->route('mjimeyg_documentmanager_create_document');
        
        $this->template->assign_vars(array(
            'CREATE_DOCUMENT_AJAX_URL'      => $this->helper->route('mjimeyg_documentmanager_ajax_create_document'),
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
        $error = array();
        if($this->request->is_set('submit') && check_form_key($this->form_key)) {
            $this->document->clear();
            
            $title = $this->request->variable("title", "");
            if($title == "") {
                $error[] = $this->user->lang('ERROR_CREATE_DOCUMENT_INVALID_TITLE');
            } else {
                $this->document->set_title($title);
            }
            
            $complete = $this->request->variable("complete", 0);
            $this->document->set_complete($complete);
            
            /*$categories = $this->request->variable("categories", 0);
            $this->document->set_categories($categories);*/
            
            $chapter_title = $this->request->variable("chapter_title", "");
            $this->chapter->set_title($chapter_title);
            
        }
        
        $sql = "SELECT * FROM {$this->phpbb_container->getParameter("tables.users")} WHERE group_id = 2 ORDER BY username";
        
        $result = $this->db->sql_query($sql);
        
        $user_list = array();
        
        while($row = $this->db->sql_fetchrow($result)) {
            $user_list[] = $row;
        }
        
        
        
        $this->template->assign_var('categories', $this->categories->toArray());
        $this->template->assign_var('authors', $user_list);
        return $this->helper->render('create_document.html');
    }
}
