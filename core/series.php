<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mjimeyg\documentmanager\core;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Series {
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
    
    protected $_categories;
    protected $_authors;
    protected $_chapter;
    protected $_document;
    protected $_manager;





    private $u_action;
    
    protected $phpbb_container;
    
    //private $_last_modified_category = null;


    public function __construct(ContainerInterface $container,
            \phpbb\config\config $config, 
            \phpbb\controller\helper $helper, 
            \phpbb\template\template $template, 
            \phpbb\user $user, 
            \phpbb\request\request $request, 
            \phpbb\db\driver\driver_interface $db) {
        $this->config = $config;
        $this->helper = $helper;
        $this->template = $template;
        $this->user = $user;
        $this->request = $request;
        $this->db = $db;
        $this->phpbb_container = $container;
        
        $this->_categories = $this->phpbb_container->get('mjimeyg.documentmanager.core.categories');
        $this->_categories->load_set();
        
        $this->_authors = $this->phpbb_container->get('mjimeyg.documentmanager.core.authors');
        
        $this->_chapters = $this->phpbb_container->get('mjimeyg.documentmanager.core.chapter');
        
        $this->_document = $this->phpbb_container->get('mjimeyg.documentmanager.core.document');
        $this->_manager = $this->phpbb_container->get('mjimeyg.documentmanager.core.manager');
        
        
        $user->add_lang_ext('mjimeyg/documentmanager', 'main');
        
        $language_path = $this->helper->route('mjimeyg_documentmanager_ajax_load_language');
        
        $this->template->assign_var('EXTENSION_PATH_LANG', $language_path);
        
        $this->template->assign_var('lang', $user->lang);
    }
    
    public function clear() {
        $this->_clear_data();
    }

        public function get_documents() {
        return $this->documents;
    }

    public function get_document($id) {
        return $this->documents[$id];
    }
    
    public function get_document_ids() {
        return array_keys($this->documents);
    }
    
    private function _clear_data() {
        
        $this->title = "";
        $this->complete = 0;
    }
}
