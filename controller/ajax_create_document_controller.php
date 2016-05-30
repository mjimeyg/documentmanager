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
class ajax_create_document_controller extends base_controller
{
    


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
        parent::__construct($container, $config, $helper, $template, $user, $request, $db);
    }
	
    /**
    * Display the output for this extension
    *
    * @return null
    * @access public
    */
    public function handle() {
        $error = array();
        $this->_manager->clear();
        
        $document_values = array(
            'document_title'    => $this->request->variable("title", ""),
            'document_complete' => $this->request->variable("complete", 0),
        );
        $authors_values = explode(",", $this->request->variable("authors", ""));
        $categories_values = explode(",", $this->request->variable("categories", ""));
        $chapter_values = array(
            'chapter_title' => $this->request->variable("chapter_title", ""),
            'chapter_text'  => $this->request->variable("text", ""),
        );
        
        if($this->_manager->add_document($document_values)) {
            $return = array_merge_recursive($document_values, array('authors' => $authors_values, 'categories' => $categories_values), $chapter_values);
        } else {
            $return = error_get_last();
        }
        
        
        $return = array_merge_recursive($document_values, array('authors' => $authors_values, 'categories' => $categories_values), $chapter_values);
        
        $this->template->assign_var('response', json_encode($return));
        
        return $this->helper->render('ajax_json_response.html');
    }
}
