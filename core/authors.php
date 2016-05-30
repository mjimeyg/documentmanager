<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mjimeyg\documentmanager\core;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Authors {
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
    
    private $_values;
    
    private $_last_modified_author = null;

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
    
    public function clear() {
        
    }
    
    private function _db_to_array(\Iterator $iterator) {
        
        while($iterator-valid()) {
            if($iterator->hasChildren()) {
                $this->_db_to_array($iterator->getChildren());
            } else {
                $this->_values[$iterator->key()] = $iterator->current();
            }
            $iterator->next();
        }
    }
    
    public function commit_to_db() {
         
    }
    
    /*private function _db_to_array(\Iterator $iterator) {
        
        while($iterator-valid()) {
            if($iterator->hasChildren()) {
                $this->_db_to_array($iterator->getChildren());
            } else {
                $this->_values[$iterator->key()] = $iterator->current();
            }
            $iterator->next();
        }
    }*/
    
    private function _load_set() {
        $sql = "SELECT * FROM " . $this->tables['documents_authors_link'] . " AS a INNER JOIN " . $this->phpbb_container->getParameter("tables.users") . " AS b ON a.user_id = b.user_id";
        $result = $this->db->sql_query($sql);
        
        //print_r($result);
        while($row = $this->db->sql_fetchrow($result)) {
            $this->_values[$row['user_id']] = $row;
            
        }
        
        return $this->_values;
    }
    
    public function add_author($data) {
        if(!isset($data['user_id'])) {
            return false;
        }
        
        if(!isset($data['document_id'])) {
            return false;
        }
        
        $sql = "SELECT COUNT(*) AS rows FROM {$this->tables['documents_authors_link']} WHERE user_id = {$data['user_id']} AND document_id = {$data['document_id']}";
        
        $result = $this->db->sql_query($sql);
        
        $row = $this->db->sql_fetchrow($result);
        
        if($row['row']) {
            return false;
        }
        
        $this->_values[] = $data;
    }
    
    public function update_author($data) {
        
    }


    
    public function load_set() {
        return $this->_load_set();
    }
    
    public function toArray() {
        return $this->_values;
    }
    
    
    public function save() {
        return $this->_write_to_db();
    }
    
    public function delete_from_db($category_id) {
        return $this->_delete_from_db($category_id);
    }


    
    private function _write_to_db() {
        //echo $sql . "<br />";
        $result = $this->db->sql_multi_insert($this->tables['categories'], $this->_values);
        
        if(!$result) {
            return false;
        } else {
            
            return true;
        }
    }
    
    private function _delete_from_db($category_id) {
        $category = $this->get_category($category_id);
        $sql = "DELETE FROM " . $this->tables['categories'] . " WHERE category_id = " . $category_id . " OR category_parent = " . $category_id;
        $parent_category = $this->get_category($category['category_parent']);
        if(isset($category['category_id'])) {
            $this->db->sql_query($sql);
            $this->_set_last_modified_category($category);
            
            if(sizeof($parent_category['children']) == 1) {
                $this->_set_has_children($category['category_parent'], 0);
            }
            return true;
        } else {
            
            return false;
        }
    }
    
    public function toString() {
        //$ret = $this->
    }


}
