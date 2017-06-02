<?php
//Loading header
$data['title'] = 'Home';
$data['javascript'] = 'app.js';
$this->load->view('shared/header', $data);
?>


    <?php $this->load->view('shared/menu'); ?>
    <style>
        h2 {
            font-family: sans-serif;
        }
        
        .list {
            font-family: sans-serif;
            margin: 0;
            padding: 20px 0 0;
        }
        
        .list>li {
            display: block;
            background-color: #eee;
            padding: 10px;
            box-shadow: inset 0 1px 0 #fff;
        }
        
        .avatar {
            max-width: 150px;
        }
        
        img {
            max-width: 100%;
        }
        
        li>a {
            font-size: 16px;
            margin: 0 0 0.3rem;
            font-weight: normal;
            font-weight: bold;
            color: #111;
        }
        
        p {
            margin: 0;
        }
        
        input {
            border: solid 1px #ccc;
            border-radius: 5px;
            padding: 7px 14px;
            margin-bottom: 10px
        }
        
        input:focus {
            outline: none;
            border-color: #aaa;
        }
        
        .sort {
            padding: 8px 30px;
            border-radius: 6px;
            border: none;
            display: inline-block;
            color: #fff;
            text-decoration: none;
            background-color: #28a8e0;
            height: 30px;
        }
        
        .sort:hover {
            text-decoration: none;
            background-color: #1b8aba;
        }
        
        .sort:focus {
            outline: none;
        }
        
        .sort:after {
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-bottom: 5px solid transparent;
            content: "";
            position: relative;
            top: -10px;
            right: -5px;
        }
        
        .sort.asc:after {
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #fff;
            content: "";
            position: relative;
            top: 13px;
            right: -5px;
        }
        
        .sort.desc:after {
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-bottom: 5px solid #fff;
            content: "";
            position: relative;
            top: -10px;
            right: -5px;
        }
        
        .pagination li {
            display: inline-block;
            padding: 5px;
        }
        
        .active {
            background-color: darkgray;
        }

    </style>
    <br>
    <div class="row expanded  ">
        <div class="">

            <div class="medium-7 large-6 columns">
                <h1>Namstarter</h1>
                <p class="subheader"> A proudly Namibian Crowdfunding platform, fresh from the heart of Katutura</p>
                <?php if($this->session->flashdata('message') != '') {?>
                <div class="callout secondary" data-closable>

                    <p>
                        <?php echo $this->session->flashdata('message'); ?>
                    </p>
                    <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
    <span aria-hidden="true">&times;</span>
  </button>
                </div>
                <?php } ?>
                <?php if (!$this->ion_auth->logged_in()) { ?>
                <a href="<?= base_url() ?>auth/create_user"><button class="button large">Register Now</button></a>
                <?php } ?>
                <?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('Project')) { ?>
                <a href="<?= base_url() ?>Project/details/<?= $project->ProjectId ?>"><button class="button large">Manage Project: <?= $project->Title ?></button></a>
                <?php } else if ($this->ion_auth->logged_in() && !$this->ion_auth->in_group('Project')) { ?>
                <a href="<?= base_url() ?>Project/create"><button class="button large">Start a Project</button></a>
                <?php } ?>

                <?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('Funders')) { ?>
                <a href="<?= base_url() ?>Funder/details"><button class="button primary large" >Manage Funder Profile</button></a>
                <?php } else if ($this->ion_auth->logged_in() && !$this->ion_auth->in_group('Funders')) { ?>
                <a href="<?= base_url() ?>Funder/create"><button class="button primary large" >Become a Funder</button></a>
                <?php } ?>
            </div>
            <div class="show-for-large large-4 columns" style="margin-right: 20px;">
                <img src="<?= base_url() ?>assets/images/Crowdfunding-7601.gif" alt="picture of space" data-src="<?= base_url() ?>assets/images/Crowdfunding-7601.gif" style="height:100px !important">Crowdfunding is an innovative way of raising money, awareness and support for new ideas. It turns the conventional way of getting large amounts of money from just a few donors around, by enabling lots of people (= a 'crowd') to each contribute a bit of money towards specific projects. This means, that no matter how big or small your wallet, you can support innovative ideas and help them become a reality.
                <p class="subheader"> <br> Projects: <?=$project_count?> 
                <br> Total Pledged: N$ <?=$total_pledged?> 
                <br> Total Raised: N$ <?=$total_paid?> 
                <br> Total Funders: <?=$funder_count?>
                <br> Pledge Count: <?=$total_pledge_count?>
                </p>
            </div>

            <!--<div data-equalizer style="padding-bottom: 50px;">
            <div class="show-for-large large-3 columns"  data-equalizer-watch>

                <img src="<?= base_url() ?>assets/images/Crowdfunding-7601.gif" alt="picture of space">            


            </div>

            <div class="medium-5 large-3 columns"  data-equalizer-watch>
                <div class="callout secondary hide-for-small-only">   
                    <h3>Some Stats</h3> 
                    <ul>
                        <li>
                            Menu? Management? Advert?
                        </li>
                        <li>
                            <p>20 Projects funded</p> 
                        </li>
                        <li>
                            <p>50 Funders</p> 
                        </li>
                        <li>
                            <p>N$ 25 000 raised</p> 
                        </li>
                    </ul>

                </div>
            </div>
        </div>-->

        </div>
        <br>
        <br>
        <br>

        <br>
      
        <div class="row" id="users">

            <h2 class="text-center">&nbsp;</h2>

            <div class="column large-4 medium-4 small-5">

                <input class="search" placeholder="Search" />

                <button type="button" class="sort" data-sort="name">Sort by name</button>

            </div>
            <div class=" column expanded large-12 medium-12 small-12">

                <ul class="list">
                    <?php $count = 1;$this->load->model("campaign_model"); foreach ($projects as $project) {
            
            $campaign = $this->campaign_model->get_project_campaigns_current($project->ProjectId);
     if(isset($campaign) && $campaign->EndDate < now()){
            ?>
                    <li data-id="<?=$count?>" class="card callout">
                        <h1 class="link name">
                            <?= $project->Title ?>
                        </h1>
                        <hr>
                        <div class="column small-centered" style="height: 300;">
                            <p class="text-center image"><img class="thumbnail center centered small-centered" src="<?= base_url() ?>/uploads/Projects/Profile/<?= $project->ProfilePic ?>" height="300" width="300" alt="<?= $project->Title ?>" data-src="<?= base_url() ?>/uploads/Projects/Profile/<?= $project->ProfilePic ?>"></p>
                            <!--                        <a class="project-img" href="<?= base_url() ?>Funder/fund_Project/"></a>-->
                        </div>
                        <?php if ($campaign != null) { 
                     $current = $this->campaign_model->get_all_pledges($campaign->CampaignId);
                     //print_r( $current);
                     //print_r($campaign);
                    ?>

                        <!-- <img class="image" src="http://placehold.it/400x370&text=Pegasi B" data-src="http://placehold.it/400x370&text=Pegasi B">-->


                        <h4>Current Campaign</h4>
                        <p class="lead"><small>N$ <?= $campaign->Amount ?></small></p>
                        <p class="subheader">End date is
                            <?= date('d M Y', strtotime($campaign->EndDate)) ?>.</p>
                        <p class="subheader">Time Remaining is
                            <?= timespan(now(), human_to_unix($campaign->EndDate), 3) ?>.</p>
                        <p class="subheader">Remaining Amount: N$
                            <?= $campaign->Amount - $current->Funds ?>
                        </p>
                        <div class="columns">
                            <div class="progress" role="progressbar" tabindex="0" aria-valuenow="<?= $campaign->Amount - $current->Funds ?>" aria-valuemin="0" aria-valuetext="N$ <?= $campaign->Amount - $current->Funds ?>" aria-valuemax="<?= $campaign->Amount ?>">
                                <div class="progress-meter" style="width: <?= (1 - (($campaign->Amount - $current->Funds) / $campaign->Amount)) * 100 ?>%"></div>
                            </div>
                            <p class="subheader">
                                <?= round((1 - (($campaign->Amount - $current->Funds) / $campaign->Amount)) * 100, 1) ?>% Funded</p>
                        </div>

                        <?php } else { ?>
                        <div>
                            <h4>No Current Campaign</h4>
                        </div>
                        <?php } ?>
                        <div class="columns">
                            <p><a href="<?= base_url() ?>Project/details_public/<?= $project->ProjectId ?>"><button class="button ">More Info</button></a> &nbsp;
                                <?php
                        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('Funders')) {
                            if ($this->campaign_model->get_project_campaigns($project->ProjectId) != NULL) {
                                ?>
                                    <form action="<?= base_url() ?>funder/pledge" method="post">
                                         <input type="hidden" name="projectId" value="<?= $project->ProjectId ?>" />
                                        <div class="row">
                                            <div class="medium-4 columns">

                                               
                                                <div class="input-group">
                                                    <span class="input-group-label">N$</span>
                                                    <input class="input-group-field" type="number" name="amount" min="10">
                                                    <div class="input-group-button">
                                                        <input type="submit" value="Fund Us" class="button success" />
                                                    </div>
                                                </div>
                                              <!--  <label>Amount
                                           
                                        </label>-->
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="medium-8 columns">
                                                <!--<input type="submit" value="Fund Us" class="button success" />-->
                                            </div>
                                        </div>
                                    </form>

                                    <?php } else { ?>
                                    <p>No campaign running</p>
                                    <?= $project->Description ?>
                                        <?php } ?>
                                        <!--<a href="<?= base_url() ?>Funder/fund_Project/"><button class="button success">Fund Us</button></a></p>-->
                                        <?php
                    } else {
                        if ($this->ion_auth->logged_in()) {
                            ?>
                                            <a href="<?= base_url() ?>Funder/create"><button class="button primary">Become a Funder</button></a>
                                            <?php } else if ($campaign != null) { ?>
                                            <a href="<?= base_url() ?>auth/login"><button class="button success">Login to Fund this Project</button></a>
                                            <?php
                        }
                    }
                    ?>
                        </div>
                        <div>
                            <?= $project->Description ?>
                        </div>
                        <div style="float: bottom;">
                            <button class="button primary">Share <i class="fa fa-facebook-official"></i></button>
                            <button class="button primary">Share <i class="fa fa-twitter"></i></button>

                        </div>
                    </li>
                    <?php $count++; }} ?>
                </ul>
                <ul class="pagination"></ul>
            </div>
        </div>


        <script>
            $(document).ready(function() {

                var options = {
                    valueNames: [
                        'name',

                        {
                            data: ['id']
                        },
                        {
                            attr: 'src',
                            name: 'image'
                        },
                        {
                            attr: 'href',
                            name: 'link'
                        },
                        {
                            attr: 'data-timestamp',
                            name: 'timestamp'
                        }
                    ],
                    page: 3,
                    pagination: true
                };
                var userList = new List('users', options);
                /* userList.add({
                     name: 'Leia',
                     born: '1954',
                     image: 'http://placehold.it/400x370&text=Pegasi B',
                     id: 5,
                     timestamp: '67893'
                 });*/
            });

        </script>


        <?php
//Loading footer
$this->load->view('shared/footer');
?>
