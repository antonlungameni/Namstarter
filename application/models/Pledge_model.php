<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pledge_model
 *
 * @author Green Lenovo
 */
class pledge_model extends CI_Model{
    //put your code here
    public $Id;
    public $CampaignId;
    public $FunderId;
    public $Amount;
    public $Paid;
    public $DateCreated;
    public $DateModified;
    
    public function get_pledge($id) {
        $query = $this->db->get_where('pledges', array('Id'=>$id));
        return $query->row();
    }
    
    public function get_pledges() {
        $query = $this->db->get('pledges');
        return $query->result();
    }
    
    public function get_pledges_funder($id){
        $query = $this->db->get_where('pledges', array('funderId'=>$id));
        return $query->result();
    }
    
    public function get_pledges_campaign($id) {
        $query = $this->db->get_where('pledges', array('campaignId'=>$id));
        return $query->result();
    }
    
    public function get_pledges_project($id) {
        $this->db->select('campaignId');
        $query = $this->db->get('campaigns', array('projectId'=>$id));
        $campaignIds = $query->result_array();
        $query = $this->db->select('*')->where_in('campaignId', $campaignIds)->get('pledges');
        return $query->result();        
    }
    
    public function create_pledge($campaign, $funder, $amount){
        $this->Paid = FALSE;
        $this->FunderId = $funder;
        $this->CampaignId = $campaign;
        $this->Amount = $amount;
        $this->DateCreated = new DateTime();
        $this->DateModified = new DateTime();
        
        $this->db->insert('pledges', $this);
        
        return $this->db->insert_id();
    }
    
    public function pay_pledge($id){
        $this->db->set('Paid', TRUE);
        $this->db->where('Id', $id);
        $this->db->update('pledges');
    }
    
       /**
     * Counts all pledges
     * @return int 
     */
    public function count_pledges() {
        return $this->db->count_all('pledges');   
    }
    
      /**
     * Counts all pledges per campaign
     * @return int 
     */
    public function count_camp_pledges($id) {
        
        $this->db->where('CampaignId', $id);
        $query = $this->db->from('pledges');       
        return $this->db->count_all_results();   
    }
}
