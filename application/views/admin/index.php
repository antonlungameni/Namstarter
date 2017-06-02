<?php
//Loading header
$data['title'] = 'Login';
$data['javascript'] = 'app.js';
$this->load->view('shared/header', $data);

?>


<?php $this->load->view('shared/menu'); 
	
?>
  <div class="medium-6 medium-centered large-6 large-centered small-6 small-centered">
        <h1>Namstarter Administration</h1> 
    </div>
<div class="row collapse">
  <div class="medium-3 columns">
    <ul class="tabs vertical" id="example-vert-tabs" data-tabs>
      <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true">Projects Overview</a></li>
      <li class="tabs-title"><a href="#panel2v">Funders Overview</a></li>
	  <li class="tabs-title"><a href="#panel3v">Pledges Overview</a></li>
        <li ><a class="button" href="<?=base_url()?>auth/">User Management</a></li>
    </ul>
    </div>
    <div class="medium-9 columns">
    <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
      <div class="tabs-panel is-active" id="panel1v">
<input class="search" placeholder="Search" />
<button class="sort" data-sort="name">
    Sort by title
  </button>
        <table>
		  <thead>
			<tr>
			  <th width="200">Title</th>
			  <th>Current Campaign Amount</th>
			  <th width="150">Pledged</th>
			  <th width="150">Start Date</th>
			  <th width="150">End Date</th>
			  <th></th>
			</tr>
		  </thead>
		  <tbody class="list">
		  <?php 
		  
			if(isset($projects))foreach($projects as $project){
        $total_pledge = 0;
		$campaign = $this->campaign_model->get_project_campaigns_current($project->ProjectId);
		//print_r($campaign);print_r($project);
		//print_r($pledges);
		if(isset($campaign)){
		$total_pledge = 0;
		$pledge = $this->pledge_model->get_pledges_campaign($campaign->CampaignId);
		//print_r($pledge);
		foreach($pledge as $x){
			//print_r($x->Amount);
			$total_pledge = $total_pledge  + $x->Amount;
			
		}
		//print_r($total_pledge);
		}
		?>
	
		<tr>
			  <td class="name"><?= $project->Title ?></td>
			  <td><?= isset($campaign->Amount)? 'N$ ' . $campaign->Amount : 'No Campaign Running' ?></td>
			  <td><?= $total_pledge > 0 && $total_pledge != null ? 'N$ ' . $total_pledge: 'No Pledges' ?></td>
			  <td><?= isset($campaign->StartDate)? date("d F Y", strtotime($campaign->StartDate)) : 'No Campaign Running' ?></td>
			  <td><?= isset($campaign->EndDate)? date("d F Y",strtotime($campaign->EndDate)): 'No Campaign Running' ?></td>
			  <td>
                  <?php if($project->Active == 1){ ?>
                  <form method="post" action="<?=base_url()?>Project/delete/<?=$project->ProjectId?>">
                  <button class="button default" type="submit">Delete</button>
                  </form>
            <?php }else{ ?>
            
            <form method="post" action="<?=base_url()?>Project/activate/<?=$project->ProjectId?>">
                  <button class="button warning" type="submit">Restore</button>
            </form>
       <?php }?>
                  
            </td>
		</tr>
		<?php
			}
		  ?>
			
			
		  </tbody>
		</table>
          <ul class="pagination"></ul>
      </div>
      <div class="tabs-panel" id="panel2v">
          <input class="search" placeholder="Search" />
<button class="sort" data-sort="name">
    Sort by name
  </button>
	  <table>
	 
	  <thead>
	  <tr>
	  <th>Name</th>
	  <th>Email</th>
	  <th>Phone</th>
	  <th>Address</th>
	   <!--<th></th>-->
	  </tr>
	  </thead>
	  <?php if(isset($funders))foreach($funders as $funder){
			//print_r($funder);
			//print_r($funders);
			$user = $this->ion_auth->user($funder->UserId)->row();
			//print_r($user);
    
			
	  ?>
	  <tbody class="list">
	  <tr>
	  <td class="name"><?=$user->first_name . ' ' . $user->last_name?></td>
          <td><a style="color:black;" href="mailto:<?= $user->email ?>"><?= $user->email ?></a></td>
	  <td><?= $user->phone ?></td>
	  <td><?= $funder->Address ?></td>
	  <!--<td><button class="button default">Delete</button></td>-->
	  </tr>
	  <tbody>
	  <?php }  ?>
	  </table>
       <ul class="pagination"></ul>
      </div>
        <div class="tabs-panel" id="panel3v">
            <input class="search" placeholder="Search" />
<button class="sort" data-sort="name">
    Sort by Ref
  </button>
	  <table>
	 
	  <thead>
	  <tr>
          <th>Ref</th>
	  <th>Project</th>
	  <th>Funder</th>
	  <th>Amount</th>
	  <th>Date</th>
      <th>Paid</th>
	   <th></th>
	  </tr>
	  </thead>
	  <?php 
          $pledges = $this->pledge_model->get_pledges();
         // print_r($pledges);
          foreach($pledges as $pledge){
              
			//print_r($this->funder_model->get_funder($pledge->FunderId));
              
              $p_funder = $this->funder_model->get_funder($pledge->FunderId);
              
			//print_r($this->ion_auth->user($this->funder_model->get_funder($pledge->FunderId)->UserId)->row());
              
              $p_user = $this->ion_auth->user($this->funder_model->get_funder($pledge->FunderId)->UserId)->row();
              
			//print_r($this->campaign_model->get_campaign($pledge->CampaignId));
              
              $p_campaign = $this->campaign_model->get_campaign($pledge->CampaignId);
              
              
			//print_r($this->project_model->get_project($this->campaign_model->get_campaign($pledge->CampaignId)->ProjectId));
              
              $p_project = $this->project_model->get_project($this->campaign_model->get_campaign($pledge->CampaignId)->ProjectId);
    
			
	  ?>
	  <tbody class="list">
	  <tr>
          <!-- <?=$pledge->Id?>/<?=$p_project->ProjectId?>/<?=$p_campaign->CampaignId?>/<?=$p_funder->Id?> -->
          <td class="name">S090-7216/<?=$p_project->ProjectId?>/<?=$p_campaign->CampaignId?>/<?=$p_funder->Id?></td>
	  <td><?=$p_project->Title?></td>
	  <td><?= $p_user->first_name ?> <?=$p_user->last_name ?></td>
	  <td>N$ <?= $pledge->Amount ?></td>
	  <td><?= $pledge->DateCreated ?></td>
        <td><?=$pledge->Paid>0? 'Paid' : 'Not Paid'?></td>
	  <td>
          <?php if($pledge->Paid < 1){ ?>
          <form method="post" action="<?=base_url()?>funder/pay_pledge/<?=$pledge->Id?>"><button type="submit" class="button warning">Pay</button></form>
          <?php } else { ?>
          <button class="button success">Paid</button>
          <?php } ?></td>
	  </tr>
	  <tbody>
	  <?php }  ?>
	  </table>
       <ul class="pagination"></ul>
      </div>
      
    </div>
  </div>
</div>
		
		
<div>
    <br>
    <br>
</div>
<script>
    var options = {
  valueNames: [ 'name', 'born' ],
        page: 3,
                    pagination: true
};

var userList = new List('panel1v', options);
    

var userList = new List('panel2v', options);


var userList = new List('panel3v', options);
</script>


<?php
//Loading footer
$this->load->view('shared/footer');
?>