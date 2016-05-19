<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mjimeyg\documentmanager\core;

use \mjimeyg\documentmanager\core;

class CategoryIterator extends ArrayIterator implements RecursiveIterator {
    private $position = 0;
    private $data;
    
    public function __construct($category) {
        $this->data = $category;
    }
    
    public function current() {
        return $this->data;
    }

    public function key() {
        $this->data->category_id;
    }

    public function next() {
        
    }

    public function rewind() {
        
    }

    public function valid() {
        
    }

}