<?php
//Loading header
$data['title'] = 'Funder Register';
$data['javascript'] = 'app.js';
$data['user'] = $this->ion_auth->user()->row();
$this->load->view('shared/header', $data);
?>


<?php $this->load->view('shared/menu');
echo validation_errors('<span class="error">', '</span>');
?>

<div class="columns" >
    <div class="medium-8 medium-centered large-8 large-centered small-8 small-centered">
        <h1>Funder Profile</h1> 
        <?= form_open_multipart(base_url() . 'Funder/create') ?>
        <?= form_hidden('userId', $user->id) ?>
        <?= form_fieldset("Funder Details", array("class" => "fieldset")) ?>
        <?= form_label('ID/Passport Number', 'title') ?>
        <?= form_input('id_number', '', array("id" => "title", "required" => "required")) ?>
        <?= form_label('Tell us about yourself', 'description') ?>
        <?php echo $this->ckeditor->editor('description', isset($project->Description) ? $project->Description : ""); ?> <?php echo form_error('description', '<p class="error">'); ?>
        <!-- <?= form_textarea('description', '', array("id" => "description", "rows" => 2, "cols" => 2)) ?> -->
        <?= form_label('Physical Address', 'address') ?>
        <?= form_textarea('address', '', array("id" => "address", "rows" => "2", "cols" => "2")) ?>
        <?= form_label('Country', 'country') ?>
         <?= form_dropdown('country', array('namibia' => 'Namibia', 'other' => 'Other'), array('namibia'))?>
        <?= form_fieldset_close() ?>
        <?= form_fieldset("Project Profile", array("class" => "fieldset")) ?>    
       


        <div class="media-object">
            <div class="media-object-section main-section">
                <?= form_label('Upload Profile Picture', 'pro_pic', array('class' => 'button')) ?>
                <?= form_upload('Profile Picture', 'pro_pic', array('id' => 'pro_pic', 'class' => 'show-for-sr', 'accept' => 'image/*', 'onchange' => 'previewFile()')) ?>

                <img id="Pro_prev" src="" height="150" width="150" alt="Image preview..." class="hide thumbnail">

            </div>           
        </div>

        <?= form_fieldset_close() ?>
        <?= form_submit('submit', 'Register', array("class" => "button")) ?>
        <?= form_close() ?>
    </div>
</div>

<?php
//Loading footer
$this->load->view('shared/footer');
?>