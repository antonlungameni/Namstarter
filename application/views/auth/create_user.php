
<?php
//Loading header
$data['title'] = 'Register';
$data['javascript'] = 'app.js';
$this->load->view('shared/header', $data);
?>


<?php $this->load->view('shared/menu'); ?>
<div class="columns" >
    <div class="medium-6 medium-centered large-6 large-centered small-6 small-centered">
        <h1><?php echo lang('create_user_heading'); ?></h1>
        <p><?php echo lang('create_user_subheading'); ?></p>

        <div id="infoMessage"><?php echo $message; ?></div>

        <?php echo form_open("auth/create_user"); ?>

        <p>
            <?php echo lang('create_user_fname_label', 'first_name'); ?> <br />
            <?php echo form_input($first_name, '' , array('required' => 'required')); ?>
        </p>

        <p>
            <?php echo lang('create_user_lname_label', 'last_name'); ?> <br />
            <?php echo form_input($last_name, '' , array('required' => 'required')); ?>
        </p>

        <?php
        if ($identity_column !== 'email') {
            echo '<p>';
            echo lang('create_user_identity_label', 'identity');
            echo '<br />';
            echo form_error('identity');
            echo form_input($identity);
            echo '</p>';
        }
        ?>

        <p>
            <?php echo lang('create_user_company_label', 'company'); ?> <br />
            <?php echo form_input($company); ?>
        </p>

        <p>
            <?php echo lang('create_user_email_label', 'email'); ?> <br />
            <?php echo form_input($email, '',array('required' => 'required')); ?>
        </p>

        <p>
            <?php echo lang('create_user_phone_label', 'phone'); ?> <br />
            <?php echo form_input($phone); ?>
        </p>

        <p>
            <?php echo lang('create_user_password_label', 'password'); ?> <br />
            <?php echo form_input($password, '', array('required' => 'required')); ?>
        </p>

        <p>
            <?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?> <br />
            <?php echo form_input($password_confirm, '' , array('required' => 'required')); ?>
        </p>


        <p><?php echo form_submit('submit', lang('create_user_submit_btn') , array("class" => "button")); ?></p>

        <?php echo form_close(); ?>
    </div>
</div>
<?php
//Loading footer
$this->load->view('shared/footer');
?>