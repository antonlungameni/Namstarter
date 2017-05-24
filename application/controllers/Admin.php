<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author Green Lenovo
 */
class Admin extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
		$this->load->model("funder_model");
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            $data['is_loggedin'] = $this->ion_auth->logged_in();
            $data['message'] = !$this->ion_auth->is_admin() ? "You must be an administrator to access dashboard":  "You must be logged in";
            !$this->ion_auth->is_admin() ? $this->load->view('Home/index', $data) : $this->load->view("auth/login", $data);
        }
    }

    public function index() {
		$this->load->model('project_model');
		 $data['projects'] = $this->project_model->get_all_projects();
		 $data['pledges'] = $this->pledge_model->get_pledges();
		 $data['funders'] =  $this->funder_model->get_funders();
		 //$data['campaign'] = $this->campaign_model->get_project_campaigns_current($project->ProjectId);
        $this->load->view("admin/index", $data);
    }

}
