<?php
//Loading header
$data['title'] = 'Project Details';
$data['javascript'] = 'app.js';
$this->load->view('shared/header', $data);
$project_user = $this->ion_auth->user($project->UserId)->row();
?>


    <?php $this->load->view('shared/menu'); ?>
    <br />
    <br />
    <h1 class="text-center">
        <?= $project->Title ?>
    </h1>
    <div class="medium-9 medium-centered small-9 small-centered large-9 large-centered">
        <ul class="tabs" data-tabs id="example-tabs">
            <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Project Details</a></li>
            <li class="tabs-title"><a href="#panel2">Campaigns</a></li>
        </ul>

        <div class="tabs-content" data-tabs-content="example-tabs">
            <div class="tabs-panel is-active" id="panel1">
                <div class="row">
                    <div class="medium-12 small-12 large-12 column">
                        <h1 class="text-center">
                            <?= $project->Title ?>
                        </h1>
                        <p class="text-center">by
                            <?= $project_user->first_name ?>&nbsp;
                                <?= $project_user->last_name ?>
                        </p>
                        <?php if ($this->ion_auth->logged_in() && sizeof($campaigns) < 1) { ?>
                        <div class="text-center">
                            <a href="<?= base_url() ?>Campaign/create/<?= $projectId ?>" class="button primary ">Create Funding Campaign</a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="small-6 small-centered mediuim-6 medium-centered large-6 large-centered">
                        <div class="flex-video widescreen hide-for-small-only">
                            <video height="800" width="800" class="center" controls="true" poster="<?= base_url() ?>/uploads/Projects/Profile/<?= $project->ProfilePic ?>">
                            <source src="<?= base_url() ?>uploads/Projects/Profile/<?= $project->Video ?>"/>
                        </video>
                        </div>
                        <?php if ($this->ion_auth->logged_in() && $project->UserId == $this->ion_auth->user()->row()->id) { ?>
                        <div class="text-center">
                            <a class="button info " href="<?= base_url() ?>Project/edit/<?= $project->ProjectId ?>">Edit Project Details</a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <hr>
                <div class="columns" data-equalizer>
                    <div class="column float-center large-8 meduim-8 small-8 callout" data-equalizer-watch>

                        <div class="media-object">
                            <p>
                                <?= $project->Description ?>
                            </p>
                        </div>
                    </div>
                    <div class="column small-4 meduim-4 large-4 callout" data-equalizer-watch>
                        <h3>Some Stats</h3>
                        <table class="stack">
                            <tr>
                                <td>Total Pledged</td>
                                <td>N$
                                    <?=$total_pledge_amount?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Paid</td>
                                <td>N$
                                    <?=$total_pledge_paid?>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Pledges</td>
                                <td>
                                    <?=$total_pledges?>
                                </td>
                            </tr>
                        </table>
                        <div>
                            <?php
                        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('Funders')) {
                            if ($this->campaign_model->get_project_campaigns($projectId) != NULL) {
                                ?>
                                <form action="<?= base_url() ?>funder/pledge" method="post">
                                    <input type="hidden" name="projectId" value="<?= $projectId ?>" />
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

                                <?php } } else { if ($this->ion_auth->logged_in()) { ?>
                                <a href="<?= base_url() ?>Funder/create"><button class="button primary">Become a Funder</button></a>
                                <?php } else if ($curr_camp != null) { ?>
                                <a href="<?= base_url() ?>auth/login"><button class="button success">Login to Fund this Project</button></a>
                                <?php
                        }?>
                                    <?php } ?>
                        </div>
                    </div>
                </div>
                <!--<div class="columns" >-->
                <!--<div class="medium-6 medium-centered large-6 large-centered small-6 small-centered">-->

                <!--<div class="column" >-->
                <!--            <div class="callout">-->

                <p class="show-for-small-only"><img class="thumbnail" src="<?= base_url() ?>/uploads/Projects/Profile/<?= $project->ProfilePic ?>" height="500" width="500" alt="Test"></p>

                <div class="flex-video widescreen hide-for-small-only">
                    <!--                    <video controls="true" poster="<?= base_url() ?>/uploads/Projects/Profile/<?= $project->ProfilePic ?>">
                    <source src="<?= base_url() ?>/uploads/Projects/Profile/<?= $project->Video ?>"/>
                </video>-->

                </div>

                <!--                <p class="lead"> <br><small>N$ 1000.00</small></p>
<p class="subheader">End date is 25 January 2017.</p>
<p class="subheader">Remaining Amount: N$ 200.00</p>
<p><a href="<?= base_url() ?>index.php/Project/get_project/"><button class="button">More Info</button></a> &nbsp; 
    <a href="<?= base_url() ?>Funder/fund_Project/"><button class="button success">Fund Us</button></a></p>
<p></p>

<div class="progress" role="progressbar" tabindex="0" aria-valuenow="800" aria-valuemin="0" aria-valuetext="N$ 200.00" aria-valuemax="1000">
    <div class="progress-meter" style="width: 70%"></div> 
</div>-->
                <!--            </div>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->
            </div>
            <div class="tabs-panel" id="panel2">
                <h2>Current Campaign</h2>

                <?php if ($this->ion_auth->logged_in() && !isset($campaigns)) { ?>
                <button class="button primary">Create Funding Campaign</button>

                <?php } ?>
                <?php if (!isset($campaigns) || $campaigns == NULL) { ?>
                <p>No Campaigns Running!</p>
                <?php } else { ?>
                <?php
                foreach ($campaigns as $campaign) {
                    $current = $this->campaign_model->get_all_pledges($campaign->CampaignId);
                    ?>
                    <div class="call-to-action">
                        <div class="callout">
                            <?= $campaign->Description ?>
                        </div>
                        <div>
                            <p class="lead"><small>N$ <?= $campaign->Amount ?></small></p>
                            <p class="subheader">End date is
                                <?= date('d M Y', strtotime($campaign->EndDate)) ?>.</p>
                            <p class="subheader">Time Remaining is
                                <?= timespan(now(), human_to_unix($campaign->EndDate), 3) ?>.</p>
                            <p class="subheader">Remaining Amount: N$
                                <?= $campaign->Amount - $current->Funds ?>
                            </p>
                            <div>
                                <div class="progress" role="progressbar" tabindex="0" aria-valuenow="<?= $campaign->Amount - $current->Funds ?>" aria-valuemin="0" aria-valuetext="N$ <?= $campaign->Amount - $current->Funds ?>" aria-valuemax="<?= $campaign->Amount ?>">
                                    <div class="progress-meter" style="width: <?= (1 - (($campaign->Amount - $current->Funds) / $campaign->Amount)) * 100 ?>%"></div>
                                </div>
                                <p class="subheader">
                                    <?= round((1 - (($campaign->Amount - $current->Funds) / $campaign->Amount)) * 100, 1) ?>% Funded</p>
                            </div>
                            <button class="button primary">Share <i class="fa fa-facebook-official"></i></button>
                            <button class="button primary">Share <i class="fa fa-twitter"></i></button>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>


            </div>
        </div>

    </div>

    <?php
//Loading footer
$this->load->view('shared/footer');
?>
