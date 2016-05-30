<?php

namespace mjimeyg\documentmanager\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements \Symfony\Component\EventDispatcher\EventSubscriberInterface {
    
    static public function getSubscribedEvents() {
        return array(
            'core.user_setup'   => 'load_documentmanager_language_files'
        );
    }
    
    /* @var \phpbb\controller\helper */
    protected $helper;

    /* @var \phpbb\template\template */
    protected $template;

    /**
    * Constructor
    *
    * @param \phpbb\controller\helper	$helper		Controller helper object
    * @param \phpbb\template\template	$template	Template object
    */
    public function __construct(\phpbb\controller\helper $helper, \phpbb\template\template $template)
    {
            $this->helper = $helper;
            $this->template = $template;
    }
    
    public function load_documentmanager_language_files($event) {
        $lang_set_ext = $event['lang_set_ext'];
        $lang_set_ext[] = array(
                'ext_name' => 'mjimeyg/documentmanager',
                'lang_set' => 'main',
        );
        $event['lang_set_ext'] = $lang_set_ext;
    }
}