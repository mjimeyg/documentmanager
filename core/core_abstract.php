<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mjimeyg\documentmanager\core;

use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class Core_Abstract{
    
    protected $_series;
            
    private $_authors;
    private $_categories;
    
    private $_documents;
    private $_chapters;
    
    protected $config;
    protected $db;
    protected $tables;
    
    protected $container;
    
    //private $_last_modified_category = null;


    public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, ContainerInterface $phpbb_container) {
        $this->config = $config;
        $this->db = $db;
        
        $this->container = $phpbb_container;
        
        $this->tables = $this->container->getParameter('mjimeyg.documentmanager.dbtables');
        
        $this->_series = $this->container->get('mjimeyg.documentmanager.core.series');
        $this->_authors = $this->container->get('mjimeyg.documentmanager.core.authors');
        $this->_categories = $this->container->get('mjimeyg.documentmanager.core.categories');
        $this->_documents = $this->container->get('mjimeyg.documentmanager.core.documents');
        $this->_chapters = $this->container->get('mjimeyg.documentmanager.core.chapters');
    }
    
}
