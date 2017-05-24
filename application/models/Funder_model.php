<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of funder_model
 *
 * @author Green Lenovo
 */
class funder_model extends CI_Model{
    //put your code here
    public $Id;
    public $UserId;
    public $Id_number;
    public $Address;
    public $Description;
    public $Profile_Pic;
    public $DateCreated;
    public $DateModified;
    
    public function get_funders() {
        $query = $this->db->get('funders');
        return $query->result();
    }
    
    public function get_funder($id){
        $query = $this->db->get_where('funders', array('Id' => $id));
        return $query->row();
    }
    
    public function get_funder_user($id){
        $query = $this->db->get_where('funders', array('UserId' => $id));
        return $query->row();
    }
    
    public function create_funder($userId, $id_number, $address = NULL, $description = NULL, $pic = NULL){
        $this->UserId = $userId;
        $this->Id_number = $id_number;
        $this->Address = $address;
        $this->Description = $description;
        $this->Profile_Pic = $pic;
        $this->DateCreated = new DateTime();
        $this->DateModified = new DateTime();
        
        $this->db->insert('funders', $this);
        return $this->db->insert_id();
    }
    
    public function edit_funder($id, $id_number, $address = NULL, $description, $pic) {
        $this->DateModified = new DateTime();
        $this->Description = $description;
        $this->Address = $address;
        $this->Id_number = $id_number;
        $this->Profile_Pic = $pic;
        $this->db->update('funders', $this);
    }
    
       /**
     * Counts all funders
     * @return int 
     */
    public function count_funders() {
        return $this->db->count_all('funders');   
    }

}
