<?php
//Loading header
$data['title'] = 'Project Create';
$data['javascript'] = 'app.js';
$data['user'] = $this->ion_auth->user()->row();
$this->load->view('shared/header', $data);
 $categories = $this->project_category_model->getCategories();

?>


<?php $this->load->view('shared/menu');echo validation_errors('<span class="error">', '</span>');
?>

<div class="columns" >
    <div class="medium-8 medium-centered large-8 large-centered small-8 small-centered">
        <h1>Project Create</h1> 
        <?= form_open_multipart(base_url() . 'project/create') ?>
        <?= form_hidden('userId', $user->id) ?>
        
        <?= form_fieldset("Project Profile", array("class" => "fieldset")) ?>
        <?= form_label('Project Title', 'title') ?>
        <?= form_input('title', '', array("id" => "title", "required" => "required")) ?>
        <?= form_label('Project Description', 'description') ?>
        <?php echo $this->ckeditor->editor('description',isset($project->Description) ?$project->Description : "");?> <?php echo form_error('description','<p class="error">'); ?>
        <small>Please think about the following, so that it is clear for others to understand and that they feel motivated to donate and contribute to your project's success: 
Why are you doing the project? What needs or challenges are you trying to address? Why is it important?
Who are you and what motivates you? What qualifications or special skills do you have that will convince people that you can do it?
How are you going to achieve your project goals?
What exactly do you need that you are asking money for? Be as clear and specific, so people will know what their money will be spent for.
How will the success of your project change people's lives and/or positively impact your community?
Please note that these are only some guiding questions. Feel free to add whatever you think is important for you to share about your project.
</small>
        <!-- <?= form_textarea('description', '', array("id" => "description", "rows" => 2, "cols" => 2)) ?> -->
        <?= form_label('Physical Address', 'address') ?>
        <?= form_textarea('address', '', array("id" => "address", "rows" => "2", "cols" => "2")) ?>
        <!--<?= form_label('Project Category', 'category') ?>-->
        <!--<?= form_dropdown('category', $categories, "", array("id" => "category")) ?> -->
      <fieldset class="fieldset">
  <legend>Project Category</legend>
            <?php foreach ($categories as $cat) {?>           
            
            <?= form_radio('category', $cat->CategoryId, FALSE); ?><?= form_label($cat->Title, $cat->Title) ?>
            <?php } ?>
        </fieldset>


        <div class="media-object">
            <div class="media-object-section main-section">
                <?= form_label('Upload Picture', 'pro_pic', array('class' => 'button')) ?>
                <?= form_upload('Upload Picture', 'pro_pic', array('id' => 'pro_pic', 'class' => 'show-for-sr', 'accept' => 'image/*', 'onchange' => 'previewFile()')) ?>
  
                    <img id="Pro_prev" src="" height="150" width="150" alt="Image preview..." class="hide thumbnail">
  
            </div>           
        </div>


        
<div class="media-object">
            <div class="media-object-section main-section">
                <?= form_label('Upload Video', 'pro_vid', array('class' => 'button')) ?>
                <?= form_upload('Upload Video', 'pro_vid', array('id' => 'pro_vid', 'class' => 'show-for-sr', 'accept' => 'video/*', 'onchange' => 'previewVideoFile()')) ?>
                <span id="video_name"><i class="fa fa-video-camera" aria-hidden="true"></i> No video added</span>
<!--                <div class="thumbnail">
                    <video id="Pro_vid" controls autoplay>
                        <source id="Pro_prev_vid" src="" height="150" width="150">
                    </video>  
                </div>-->
            </div>           
        </div>
        
        <?= form_fieldset_close() ?>
       <?= form_fieldset("Contact Person Details", array("class" => "fieldset")) ?>
        
        <?= form_label('Full Name', 'title') ?>
        <?= form_input('title', '', array("id" => "title", "required" => "required")) ?>
        <?= form_label('Phone Number', 'contact') ?>
        <?= form_input('telephone', '', array("id" => "contact", "required" => "required")) ?>
        <?= form_label('Email Address', 'contact') ?>
        <?= form_input('email', '', array("id" => "email", "required" => "required", "type" => "email")) ?>
        <?= form_fieldset_close() ?>
        
        
        
         <?= form_submit('submit', 'Create Project', array("class" => "button")) ?>
        <?= form_close() ?>
        
        
        
    </div>
</div>

<?php
//Loading footer
$this->load->view('shared/footer');
?>