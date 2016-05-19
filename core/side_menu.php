<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mjimeyg\documentmanager\core;

use phpbb\config\config;
use phpbb\controller\helper;
use phpbb\template\template;

class side_menu {
    protected $config;

    /* @var helper */
    protected $helper;

    /* @var template */
    protected $template;


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
    public function __construct(config $config, helper $helper, template $template)
    {
        $this->config = $config;
        $this->helper = $helper;
        $this->template = $template;
        
        $user->add_lang_ext('mjimeyg/documentmanager', 'side_menu');
    }
}