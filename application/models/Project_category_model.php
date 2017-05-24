<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Projects Category Model
 *
 * @author Anton Lungameni
 */
class Project_category_model extends CI_Model {
    //put your code here
    public $categoryId;
    public $title;
    public $dateCreated;
    public $dateModified;
    
    /**
     * Gets all project categories in db 
     * @return type
     */
    public function getCategories() {
        $query = $this->db->get('categories');
        return $query->result();
    }
}
