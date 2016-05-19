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
class ajax_manage_categories_controller
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
        $this->categories->load_set();
        //$this->side_menu = $side_menu;
        
        $this->u_action = $this->helper->route('mjimeyg_documentmanager_ajax_manage_categories');
        
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
    public function add_category() {
        $category_title = $this->request->variable("category_title", "");
        $category_parent = $this->request->variable("category_parent", 0);
        $category_selectable = $this->request->variable("category_selectable", 0);
        $category = $this->categories->add_category($category_title, $category_parent, $category_selectable);
        $ret = $this->categories->write_to_db($category);
        if($ret == -1) {
            $ret = ["response" => "-1"];
        } else {
            $ret['response'] = 1; 
        }
        $this->template->assign_var('response', json_encode($ret));
        return $this->helper->render('ajax_json_response.html');
    }
    
    /**
    * Display the output for this extension
    *
    * @return null
    * @access public
    */
    public function delete_category() {
        try {
        $response = array();
        if($this->request->is_set('category_id')) {
            
            $category_id = $this->request->variable("category_id", 0);
            
            
            
            if(!$this->categories->delete_from_db($category_id)) {
                $response['response'] = "0";
                $response['message'] = "Could not find category with id: $category_id";
                
            } else {
                
                //$this->categories->delete_category($category_id);
                $category = $this->categories->get_last_modified_category();
                
                $response['response'] = "1";
                
                if(is_array($category) && is_array($response)) {
                    $response = array_merge($response, $category);
                }
            }
            
            
        } else {
            
            $response = ['response' => '0', 'error' => 'Category ID not set.'];
        }
        
        $this->template->assign_var('response', json_encode($response));
        } catch (Exception $ex) {
            $response = array(
                'response' => 0,
                'exception_message' => $ex->getMessage(),
                'exception_code' => $ex->getCode(),
                'exception_file' => $ex->getFile(),
                'exception_line' => $ex->getLine(),
                'exception_trace' => $ex->getTrace(),
            );
        } finally {
            return $this->helper->render('ajax_json_response.html');
        }
        
        
    }
    
    /**
    * Display the output for this extension
    *
    * @return null
    * @access public
    */
    public function handle() {
        //$response = $this->request->variable("category_name", "");
        
        //$this->template->assign_var('response', $response);
        return $this->helper->render('ajax_json_response.html');
    }
}
