<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of project_model
 *
 * @author Green Lenovo
 */
class project_model extends CI_Model{
  
    public $projectId;
    public $userId;
    public $title;
    public $description;
    public $profilePic;
    public $categoryId;
    public $video;
    public $business_plan;
    public $address;
    public $telephone;
    public $email;
    public $facebook;
    public $active;
    public $dateCreated;
    public $dateModified;
    
    
    public function __construct() {
        parent::__construct();
        
    }
    
    /**
     * Gets a project from db
     * @param int $id ProjectId
     * @return object
     */
    public function get_project($id){
        $query = $this->db->get_where("projects" ,array("projectId" => $id, 'Active' => true));
        return $query->row();
    }
    
    /**
     * Gets a project from db
     * @param int $id ProjectId
     * @return object
     */
    public function get_any_project($id){
        $query = $this->db->get_where("projects" ,array("projectId" => $id));
        return $query->row();
    }
    
    
    /**
     * Gets a all project from db
     * @param int $id ProjectId
     * @return object
     */
    public function get_all_projects(){
        $query = $this->db->get("projects");
        return $query->result();
    }
    
    /**
     * Gets a project based on userid
     * @param type $id UserId
     */
    public function get_user_project($id){
        $query = $this->db->get_where('projects', array('UserId' => $id, 'Active' => true));
        return $query->row();
    }
    
    /**
     * Gets all projects from db
     * @return array
     */
    public function get_projects() {
        $query = $this->db->get_where('projects', array('Active' => true));
        return $query->result();
    }
    
    /**
     * Updates project details
     * @param object $project
     * @return object
     */
    public function update_project($id, $project, $pro_pic = NULL, $video = NULL) {
        $curr = $this->get_project($id);
        $this->projectId = $curr->ProjectId;
        $this->title = $project["title"];
        $this->description = $project["description"];
        $this->email = $project["email"];
        $this->address = $project["address"];
        $this->telephone = $project["telephone"];
        $this->userId = $project["userId"];
        $this->categoryId = $project["category"];
        $this->active = $curr->Active;
        $this->profilePic = $curr->ProfilePic;
        $this->video = $curr->Video;
        $this->dateCreated = $curr->DateCreated;
        $this->dateModified = new DateTime();
        if ($pro_pic != null) {
            $this->profilePic = $pro_pic;
        } 
        if ($video != null){
            $this->video = $video;
        }
        return $this->db->update("projects", $this, array("projectId" => $id));
    }
    
    /**
     * Creates a new project
     * @param string $title Project Title
     * @param string $description Project Description
     * @param int $userId Project owner user id
     * @param string $address Project Address
     * @param string $email Project Email Address
     * @param string $profilePic Project profile picture path
     * @param string $video Project profile video path
     * @param int $category Category Id
     * @return int Inserted Id
     */
    public function create_project($title, $description, $userId, $address,$email, $telephone ,$profilePic, $video, $category) {
        $this->active = TRUE;
        $this->dateCreated = new DateTime();
        $this->dateModified = new DateTime();
        $this->title = $title;
        $this->description = $description;
        $this->userId = $userId;
        $this->address = $address;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->profilePic = $profilePic;
        $this->video = $video;
        $this->categoryId = $category;
        $this->db->insert('projects', $this);
        return $this->db->insert_id();
        
    }
    
    /**
     * Deletes a project
     * @param int $id
     * @return boolean
     */
    public function delete_project($id) {
        $this->db->set('Active', FALSE);
        $this->db->where('ProjectId', $id);
        $this->db->update('projects');
    }
    
    /**
     * Activates a project
     * @param int $id
     * @return boolean
     */
    public function activate_project($id) {
        $this->db->set('Active', TRUE);
        $this->db->where('ProjectId', $id);
        $this->db->update('projects');
    }

    /**
     * Counts all projects
     * @return int 
     */
    public function count_projects() {
        return $this->db->count_all('projects');   
    }
   
            
}
