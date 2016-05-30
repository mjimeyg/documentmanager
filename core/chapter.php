<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mjimeyg\documentmanager\core;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Chapter {
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
    
    private $_chapter_id;
    private $_chapter_title;
    private $_document_id;
    private $_document_index;
    private $_chapter_text;
    private $_chapter_uploaded;
    private $_chapter_updated;


    
    
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
        $this->tables = $this->phpbb_container->getParameter('mjimeyg.documentmanager.dbtables');
        
        $user->add_lang_ext('mjimeyg/documentmanager', 'main');
        
        $language_path = $this->helper->route('mjimeyg_documentmanager_ajax_load_language');
        
        $this->template->assign_var('EXTENSION_PATH_LANG', $language_path);
        
        $this->template->assign_var('lang', $user->lang);
    }
    
    public function save() {
        return $this->_write_to_db();
    }
    
    public function load($chapter_id) {
        return $this->_load_from_db($chapter_id);
    }
    
    public function clear() {
        $this->_clear_data();
    }
    
    /* Start Getters and Setters */
    public function set_chapter_title($title) {
        $this->_chapter_title = $title;
    }
    
    public function get_chapter_title() {
        return $this->_chapter_title;
    }
    
    public function set_document_id($id) {
        $this->$_document_id = $id;
    }
    
    public function get_document_id() {
        return $this->$_document_id;
    }
    
    public function set_document_index($index) {
        $this->$_document_index = $index;
    }
    
    public function get_document_index() {
        return $this->$_document_index;
    }
    
    public function set_chapter_text($text) {
        $this->_chapter_text = $text;
    }
    
    public function get_chapter_text() {
        return $this->_chapter_text;
    }
    
    public function get_chapter_uploaded() {
        return $this->_chapter_uploaded;
    }
    
    public function get_chapter_updated() {
        return $this->_chapter_updated;
    }
    /* End Getters and Setters */
    
    private function _write_to_db() {
        $this->_chapter_updated = time();
        if(isset($this->_chapter_id)) {
            $sql = "UPDATE " . $this->tables['chapters'] . " SET "
                    . "document_id = {$this->_document_id}, "
                    . "document_index = {$this->_document_id}, "
                    . "chapter_title = {$this->_chapter_title}, "
                    . "chapter_updated = {$this->_chapter_updated}, "
                    . "chapter_text = '{$this->_chapter_text}'"
            . " WHERE chapter_id = " . $this->_chapter_id;
            
            
            
            
        } else {
            $this->_chapter_uploaded = time();
            
            $sql = "INSERT INTO " . $this->tables['chapters'] . "(document_id, document_index, chapter_title, chapter_uploaded, chapter_updated) "
                    . " VALUES({$this->_document_id}, "
                    . "{$this->_document_index}, "
                    . "'{$this->_chapter_title}', "
                    . "{$this->_chapter_uploaded}, "
                    . "{$this->_chapter_updated}, "
                    . "'{$this->_chapter_text}')";
                    
            
        }
        
        $result = $this->db->sql_query($sql);
        
        if($result == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    private function _load_from_db($chapter_id) {
        $sql = "SELECT * FROM {$this->tables['chapters']} WHERE chpater_id = $chapter_id";
        
        $result = $this->db->sql_query($sql);
        
        if(!($row = $this->db->sql_fetchrow())) {
            return false;
        } else {
            $this->_chapter_id = $row['chapter_id'];
            $this->_chapter_text = $row['chapter_text'];
            $this->_chapter_title = $row['chapter_title'];
            $this->_chapter_updated = $row['chapter_updated'];
            $this->_chapter_uploaded = $row['chapter_uploaded'];
            
            $this->_document_id = $row['document_id'];
            $this->_document_index = $row['document_index'];
            
            return true;
        }
    }
    
    private function _clear_data() {
        $this->_chapter_id = 0;
        $this->_chapter_text = "";
        $this->_chapter_title = "";
        $this->_chapter_updated = 0;
        $this->_chapter_uploaded = 0;
        
        $this->_document_id = 0;
        $this->_document_index = 0;
        
    }

}
