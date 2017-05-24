<?php
//Loading header
$data['title'] = 'Login';
$data['javascript'] = 'app.js';
$data['user'] = $this->ion_auth->user()->row();
$this->load->view('shared/header', $data);
?>


<?php
$this->load->view('shared/menu');
echo validation_errors('<span class="error">', '</span>');
?>

<div class="columns" >
    <div class="medium-8 medium-centered large-8 large-centered small-8 small-centered">
        <h1>Campaign Create</h1> 
        <?= form_open(base_url() . 'campaign/create/'. $projectId) ?>
        <?= form_hidden('projectId', $projectId) ?>
        <?= form_label('Campaign Description', 'description') ?>               
        <?php echo $this->ckeditor->editor('description', isset($project->Description) ? $project->Description : ""); ?> <?php echo form_error('description', '<p class="error">'); ?>
        <br>
        <?= form_label('Target Amount', 'Amount') ?>  
        <div class="row">
            <div class="small-8 columns">
                <div class="slider" data-slider data-start="500" data-initial-start="500" data-step="100" data-end="10000">
                    <span class="slider-handle"  data-slider-handle role="slider" tabindex="1" aria-controls="Amount"></span>
                    <span class="slider-fill" data-slider-fill></span>
                </div>
            </div>
            <div class="small-4 columns">
                <div class="input-group">
                    <span class="input-group-label">N$</span>
                    <input type="number" class="input-group-field" name="Amount" id="Amount">
                </div>
            </div>
        </div>

        <?= form_label('Campaign Start Date', 'StartDate') ?>
        <?= form_input('StartDate', '', array("id" => "dpd1", "required" => "required", "data-min-view" => "month", "class" => "date")) ?>
        <?= form_label('Campaign End Date', 'EndDate') ?>
        <?= form_input('EndDate', '', array("id" => "dpd2", "required" => "required" , "data-min-view" => "month", "class" => "date")) ?>
        <script>
            // implementation of disabled form fields
            var nowTemp = new Date();
            var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
            var checkin = $('#dpd1').fdatepicker({
                onRender: function (date) {
                    return date.valueOf() < now.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                if (ev.date.valueOf() > checkout.date.valueOf()) {
                    var newDate = new Date(ev.date)
                    newDate.setDate(newDate.getDate() + 1);
                    checkout.update(newDate);
                }
                checkin.hide();
                $('#dpd2')[0].focus();
            }).data('datepicker');
            var checkout = $('#dpd2').fdatepicker({
                onRender: function (date) {
                    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                }
            }).on('changeDate', function (ev) {
                checkout.hide();
            }).data('datepicker');
        </script>

        <?= form_fieldset_close() ?>
        <?= form_submit('submit', 'Create Campaign', array("class" => "button")) ?>
        <?= form_close() ?>
    </div>
</div>

<?php
//Loading footer
$this->load->view('shared/footer');
?>
<script>
    $(function () {
        $('#dpMonths').fdatepicker();
    });
</script>