<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mjimeyg\documentmanager\core;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Document {
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
    
    private $_document_id;
    private $_document_title;
    private $_document_complete;
    private $_document_uploaded;
    private $_document_updated;
    
    
    
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
    
    public function load($document_id) {
        return $this->_load_from_db($document_id);
    }
    
    public function clear() {
        $this->_clear_data();
    }
    
    /* Start Getters and Setters */
    
    public function get_document_id() {
        return $this->_document_id;
    }
    
    public function set_document_title($title) {
        $this->_document_title = $title;
    }
    
    public function get_document_title() {
        return $this->_document_title;
    }
    
    public function set_document_complete($complete) {
        $this->_document_complete = $complete;
    }
    
    public function get_document_complete() {
        return $this->_document_complete;
    }
    
    public function set_document_uploaded($uploaded) {
        $this->_document_uploaded = $uploaded;
    }
    
    public function get_document_uploaded() {
        return $this->_document_uploaded;
    }
    
    public function set_document_updated($updated) {
        $this->_document_updated = $updated;
    }
    
    public function get_document_updated() {
        return $this->_document_updated;
    }
    
    private function _load_from_db($document_id, $load_chapters = false, $load_authors = false) {
        $sql = "SELECT * FROM {$this->tables['documents']} WHERE document_id = $document_id";
        
        $result = $this->db->sql_query();
        
        if(!($row = $this->db->sql_fetchrow())) {
            return false;
        } else {
            
            $this->_document_id = $row['document_id'];
            $this->_document_title = $row['document_title'];
            $this->_document_complete = $row['document_complete'];
            $this->_document_uploaded = $row['document_uploaded'];
            $this->_document_updated = $row['document_updated'];
            
            return true;
        }
    }
    
    private function _write_to_db() {
        
        $this->_document_updated = time();
        
        if(isset($this->_document_id)) {
            $sql = "UPDATE {$this->tables['documents']} SET "
            . "document_title = '{$this->_document_title}', "
            . "document_complete = {$this->_document_complete}, "
            . "document_uploaded = {$this->_document_uploaded}, "
            . "document_updated = {$this->_document_updated} "
            . "WHERE document_id = {$this->_document_id}";
        } else {
            $this->_document_uploaded = $this->_document_updated;
            $sql = "INSERT INTO {$this->tables['documents']}(document_title, document_complete, document_uploaded, document_updated) "
            . "VALUES('{$this->_document_title}', "
            . "{$this->_document_complete}, "
            . "{$this->_document_uploaded}, "
            . "{$this->_document_updated})";
        }
        
        $result = $this->db->sql_query($sql);
        if($result == 1) {
            if(!isset($this->_document_id)) {
                $this->_document_id = $this->db->sql_nextid();
            }
            return true;
        } else {
            
            return false;
        }
    }
    
    private function _clear_data() {
        
        $this->_document_complete = 0;
        $this->_document_id = null;
        $this->_document_title = "";
        $this->_document_updated = 0;
        $this->_document_uploaded = 0;
    }
    
    private function _validate_data($param) {
        $error = array();
        if(isset($param['title'])) {
            if(gettype($param['title']) != "string") {
                $error[] = $this->user->lang['ERROR_FORM_INVALID_TITLE'];
            }
        }
        
        /*if(isset($param['complete'])) {
            if(gettype($param['complete']) != "integer") {
                $error[] = $this->user->lang['INVALID_TITILE'];
            }
        }*/
    }

    private function _load_categories_from_db($document_id) {
        
    }
    
    public function toArray() {
        $values = array(
            'document_id'           => $this->_document_id,
            'document_title'        => $this->_document_title,
            'document_complete'     => $this->_document_complete,
            'document_uploaded'     => $this->_document_uploaded,
            'document_updated'      => $this->_document_updated,
        );
        
        return $values;
    }
    
    public function toJSON() {
        return json_encode($this->toArray());
    }
}
