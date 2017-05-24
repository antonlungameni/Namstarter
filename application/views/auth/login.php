<?php
//Loading header
$data['title'] = 'Login';
$data['javascript'] = 'app.js';
$this->load->view('shared/header', $data);
?>


<?php $this->load->view('shared/menu'); ?>

<div class="columns" >
    <div class="medium-6 medium-centered large-6 large-centered small-6 small-centered">
        <h1><?php echo lang('login_heading'); ?></h1>
        <p><?php echo lang('login_subheading'); ?></p>
     


        <?php echo form_open("auth/login"); ?>

        <p>
            <?php echo lang('login_identity_label', 'identity'); ?>
            <?php echo form_input(isset($identity)? $identity : ""); ?>
        </p>

        <p>
            <?php echo lang('login_password_label', 'password'); ?>
            <?php echo form_input(isset($password)? $password : ""); ?>
        </p>

        <p>
            <?php echo lang('login_remember_label', 'remember'); ?>
            
        <div class="switch">            
            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember" class="switch-input"'); ?>            
            <label class="switch-paddle" for="remember">
                <span class="show-for-sr">Remember me</span>
            </label>
        </div>
        </p>


        <p><?php echo form_submit('submit', lang('login_submit_btn'), array("class" => "button")); ?></p>

        <?php echo form_close(); ?>

        <p><a href="forgot_password" class="button"><?php echo lang('login_forgot_password'); ?></a></p>
    </div>
</div>
<?php
//Loading footer
$this->load->view('shared/footer');
?>