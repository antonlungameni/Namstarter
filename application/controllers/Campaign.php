<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Campaign
 *
 * @author Green Lenovo
 */
class Campaign extends CI_Controller {
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model("campaign_model");
        $this->load->model('project_model');
    }
    
    public function index ($projectId = "") {
        $data['is_loggedin'] = $this->ion_auth->logged_in();
        $data["projectId"] = $projectId;
        $data["projects"] = $this->project_model->get_projects();
        $data['campaigns'] = $this->campaign_model->get_all_campaigns();
        $this->load->view("campaign/index" , $data);
    }
    
    public function create ($projectId) {
        $data['is_loggedin'] = $this->ion_auth->logged_in();
        $data["projectId"] = $projectId;
        
        if($this->input->post()){
            //print_r();
        //die();
            $StartDate = date('Y-m-d', strtotime($this->input->post("StartDate")));
            $EndDate = date('Y-m-d', strtotime($this->input->post("EndDate")));       
           
            $campaignId = $this->campaign_model->create_campaign($projectId, $StartDate, $EndDate, $this->input->post('description'), 1, $this->input->post('Amount'));
//            print_r($campaignId);
//            die();
            redirect();
        }
         $path = '/YouthFund/js/ckfinder';
        $width = '850px';
        $this->editor($path, $width);
        $this->load->view("campaign/create" , $data);
    }
      /**
     * Sets up the CkEditior
     * @param type $path Relative path to the ckeditor files
     * @param type $width Width of the editor o view
     */
    function editor($path, $width) {
        //Loading Library For Ckeditor
        $this->load->library('ckeditor');
        $this->load->library('ckFinder');
        //configure base path of ckeditor folder 
        $this->ckeditor->basePath = base_url() . 'js/ckeditor/';
        $this->ckeditor->config['toolbar'] = 'Full';
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = $width;
        //configure ckfinder with ckeditor config 
        $this->ckfinder->SetupCKEditor($this->ckeditor, $path);
        
    }

}
