<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mjimeyg\documentmanager\core;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Manager {
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
    protected $_series;
    protected $_manager;





    private $u_action;
    
    protected $phpbb_container;

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
        
        $this->_series = $this->phpbb_container->get('mjimeyg.documentmanager.core.series');
        
        $this->tables = $this->phpbb_container->getParameter('mjimeyg.documentmanager.dbtables');
        $user->add_lang_ext('mjimeyg/documentmanager', 'main');
        
        $language_path = $this->helper->route('mjimeyg_documentmanager_ajax_load_language');
        
        $this->template->assign_var('EXTENSION_PATH_LANG', $language_path);
        
        $this->template->assign_var('lang', $user->lang);
    }
    
    public function clear($class = null) {
        switch ($class) {
            case 'series':
                $this->_series->clear();
                break;
            case 'document':
                $this->_document->clear();
                break;
            case 'chapter':
                $this->_chapter->clear();
                break;
            case 'authors':
                $this->_authors->clear();
                break;
            case 'categories':
                $this->_categories->clear();
                break;
            case null:
            default:
                $this->_series->clear();
                $this->_document->clear();
                $this->_chapters->clear();
                $this->_authors->clear();
                $this->_categories->clear();
                break;
        }
    }
    
    
    public function add_document($data) {
        
        $this->_document->set_document_title($data['document_title']);
        $this->_document->set_document_complete($data['document_complete']);
        
        return $this->_document->save();
    }
    
    public function add_authors($data) {
        foreach($data as $a) {
            $this->_authors->add_author($a);
        }
        
        return $this->_authors->save();
    }
    public function toString() {
        //$ret = $this->
    }


}
