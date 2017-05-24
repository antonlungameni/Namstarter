<?php
//Loading header
$data['title'] = 'Funder Details';
$data['javascript'] = 'app.js';
$this->load->view('shared/header', $data);
?>


<?php $this->load->view('shared/menu'); ?>

<div class="columns" >
    <div class="medium-6 medium-centered large-6 large-centered small-6 small-centered">
        <h1>Funder Details</h1> 
        <?php if(isset($pledges) && $pledges != NULL){ 
            foreach ($pledges as $pledge) { 
                //print_r($this->funder_model->get_funder($pledge->FunderId));
              
              $p_funder = $this->funder_model->get_funder($pledge->FunderId);
              
			//print_r($this->ion_auth->user($this->funder_model->get_funder($pledge->FunderId)->UserId)->row());
              
              $p_user = $this->ion_auth->user($this->funder_model->get_funder($pledge->FunderId)->UserId)->row();
              
			//print_r($this->campaign_model->get_campaign($pledge->CampaignId));
              
              $p_campaign = $this->campaign_model->get_campaign($pledge->CampaignId);
              
              
			//print_r($this->project_model->get_project($this->campaign_model->get_campaign($pledge->CampaignId)->ProjectId));
              
              $p_project = $this->project_model->get_project($this->campaign_model->get_campaign($pledge->CampaignId)->ProjectId);
    
			
	  ?>
	 
          <!--<p><?=$pledge->Id?>/<?=$p_project->ProjectId?>/<?=$p_campaign->CampaignId?>/<?=$p_funder->Id?></p>-->
            <?php $campaign = $this->campaign_model->get_campaign($pledge->CampaignId);
            $project = $this->project_model->get_project($campaign->ProjectId);
            //print_r($project);
            
			//print_r($campaign);
            //print_r($pledge);
                    ?>
        <div class="callout">
        <ul>
            <li>Ref: <?=$pledge->Id?>/<?=$p_project->ProjectId?>/<?=$p_campaign->CampaignId?>/<?=$p_funder->Id?></li>
            <li>Project: <?=$project->Title?></li>
            <li>Amount: N$<?=$pledge->Amount?></li>
            <li>Date: <?=$pledge->DateCreated?></li>
            <li>Paid: <?=$pledge->Paid > 0 ? 'Paid': 'Not Paid'?></li>
        </ul>
        </div>
        <hr>
            <?php }} else{ ?>
        <div class="callout">
        <h3>No Donations Made yet</h3>
        </div>
            <?php }?>
    </div>
</div>
<?php
//Loading footer
$this->load->view('shared/footer');
?>