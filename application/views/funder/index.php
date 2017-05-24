<?php
//Loading header
$data['title'] = 'Login';
$data['javascript'] = 'app.js';
$this->load->view('shared/header', $data);
?>


<?php $this->load->view('shared/menu'); ?>

<div class="columns" >
    <div class="medium-6 medium-centered large-6 large-centered small-6 small-centered">
        <h1>Funder Index</h1> 
    </div>
</div>
<?php
//Loading footer
$this->load->view('shared/footer');
?>