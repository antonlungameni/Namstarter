<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Funders
 *
 * @author Green Lenovo
 */
class Funder extends CI_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model("funder_model");
        $this->load->model("campaign_model");
    }
    
    /**
     * Sets up the CkEditior
     * @param type $path Relative path to the ckeditor files
     * @param type $width Width of the editor o view
     */
    function editor($path, $width) {
        //Loading Library For Ckeditor
        $this->load->library('Ckeditor');
        $this->load->library('Ckfinder');
        //configure base path of ckeditor folder 
        $this->ckeditor->basePath = base_url() . 'js/ckeditor/';
        $this->ckeditor->config['toolbar'] = 'Full';
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = $width;
        //configure ckfinder with ckeditor config 
        $this->ckfinder->SetupCKEditor($this->ckeditor, $path);
    }
    
    public function index() {
        $data['is_loggedin'] = $this->ion_auth->logged_in();
        $this->load->view('funder/index', $data);
    }
    
    public function details() {
        $funder = $this->funder_model->get_funder_user($this->ion_auth->user()->row()->id);
        if($funder != NULL){
         $data['pledges'] = $this->pledge_model->get_pledges_funder($funder->Id);
        $this->load->view('funder/details', $data);
        } else{
            redirect();
        }
    }
    
    public function pledge(){
        //print_r($this->input->post());
        //die();
        $data['is_loggedin'] = $this->ion_auth->logged_in();
        $funder = $this->funder_model->get_funder_user($this->ion_auth->user()->row()->id);
        //print_r($funder);
        //die();
        $campaign = $this->campaign_model->get_project_campaigns_current($this->input->post('projectId'));
        //print_r($campaign);
        $pledge_id = $this->pledge_model->create_pledge($campaign->CampaignId, $funder->Id, $this->input->post('amount'));
        //print_r($funder);
        $data['pledges'] = $this->pledge_model->get_pledges_funder($funder->Id);
         $p_funder = $this->funder_model->get_funder($funder->Id);
              
			//print_r($this->ion_auth->user($this->funder_model->get_funder($pledge->FunderId)->UserId)->row());
              
              $p_user = $this->ion_auth->user($this->funder_model->get_funder($funder->Id)->UserId)->row();
              
			
              
              $p_campaign = $this->campaign_model->get_campaign($campaign->CampaignId);
            
              
		
              
    $p_project = $this->project_model->get_project($this->input->post('projectId'));
       // print_r($p_project);
$ref = $pledge_id . '/'. $this->input->post('projectId') . '/'.$campaign->CampaignId.'/'.$funder->Id;                                                           
 $user = $this->ion_auth->user()->row();
            $this->load->library('email');
$config['mailtype'] = 'html';
$this->email->initialize($config);
$this->email->from('info@rlabsnamibia.org', 'NamStarter');
$this->email->to($user->email);


$this->email->subject('Namstarter Funder: ' .$user->first_name .' '. $user->last_name );
$this->email->message('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if !mso]><!-->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title></title>
<style type="text/css">
* {
	-webkit-font-smoothing: antialiased;
}
body {
	Margin: 0;
	padding: 0;
	min-width: 100%;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
	mso-line-height-rule: exactly;
}
table {
	border-spacing: 0;
	color: #333333;
	font-family: Arial, sans-serif;
}
img {
	border: 0;
}
.wrapper {
	width: 100%;
	table-layout: fixed;
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
}
.webkit {
	max-width: 600px;
}
.outer {
	Margin: 0 auto;
	width: 100%;
	max-width: 600px;
}
.full-width-image img {
	width: 100%;
	max-width: 600px;
	height: auto;
}
.inner {
	padding: 10px;
}
p {
	Margin: 0;
	padding-bottom: 10px;
}
.h1 {
	font-size: 21px;
	font-weight: bold;
	Margin-top: 15px;
	Margin-bottom: 5px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.h2 {
	font-size: 18px;
	font-weight: bold;
	Margin-top: 10px;
	Margin-bottom: 5px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.one-column .contents {
	text-align: left;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.one-column p {
	font-size: 14px;
	Margin-bottom: 10px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.two-column {
	text-align: center;
	font-size: 0;
}
.two-column .column {
	width: 100%;
	max-width: 300px;
	display: inline-block;
	vertical-align: top;
}
.contents {
	width: 100%;
}
.two-column .contents {
	font-size: 14px;
	text-align: left;
}
.two-column img {
	width: 100%;
	max-width: 280px;
	height: auto;
}
.two-column .text {
	padding-top: 10px;
}
.three-column {
	text-align: center;
	font-size: 0;
	padding-top: 10px;
	padding-bottom: 10px;
}
.three-column .column {
	width: 100%;
	max-width: 200px;
	display: inline-block;
	vertical-align: top;
}
.three-column .contents {
	font-size: 14px;
	text-align: center;
}
.three-column img {
	width: 100%;
	max-width: 180px;
	height: auto;
}
.three-column .text {
	padding-top: 10px;
}
.img-align-vertical img {
	display: inline-block;
	vertical-align: middle;
}
@media only screen and (max-device-width: 480px) {
table[class=hide], img[class=hide], td[class=hide] {
	display: none !important;
}
</style>
<!--[if (gte mso 9)|(IE)]>
	<style type="text/css">
		table {border-collapse: collapse !important;}
	</style>
	<![endif]-->
</head>

<body style="Margin:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;min-width:100%;background-color:#ececec;">
<center class="wrapper" style="width:100%;table-layout:fixed;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#ececec;">
  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#ececec;" bgcolor="#ececec;">
    <tr>
      <td width="100%"><div class="webkit" style="max-width:600px;Margin:0 auto;"> 
          
          <!--[if (gte mso 9)|(IE)]>

						<table width="600" align="center" cellpadding="0" cellspacing="0" border="0" style="border-spacing:0" >
							<tr>
								<td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
								<![endif]--> 
          
          <!-- ======= start main body ======= -->
          <table class="outer" align="center" cellpadding="0" cellspacing="0" border="0" style="border-spacing:0;Margin:0 auto;width:100%;max-width:600px;">
            <tr>
              <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><!-- ======= start header ======= -->
                
                <table border="0" width="100%" cellpadding="0" cellspacing="0"  >
                  <tr>
                    <td><table style="width:100%;" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                          <tr>
                            <td align="center"><center>
                                <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="Margin: 0 auto;">
                                  <tbody>
                                    <tr>
                                      <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0">
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td align="center"><font style="font-size:11px; text-decoration:none; color:#474b53; font-family: Verdana, Geneva, sans-serif; text-align:left"><a href="#" target="_blank" style="color:#474b53; text-decoration:none">View in browser</a> | <a href="#" target="_blank" style="color:#474b53; text-decoration:none">Send to a friend </a></font></td>
                                          </tr>
                                          <tr>
                                            <td align="center">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td height="6" bgcolor="#ce283d" class="contents" style="width:100%; border-top-left-radius:10px; border-top-right-radius:10px"></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </center></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </table>
                <table border="0" width="100%" cellpadding="0" cellspacing="0"  >
                  <tr>
                    <td><table style="width:100%;" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                          <tr>
                            <td align="center"><center>
                                <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="Margin: 0 auto;">
                                  <tbody>
                                    <tr>
                                      <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" bgcolor="#FFFFFF"><!-- ======= start header ======= -->
                                        
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                          <tr>
                                            <td class="two-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;font-size:0;"><!--[if (gte mso 9)|(IE)]>
													<table width="100%" style="border-spacing:0" >
													<tr>
													<td width="20%" valign="top" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
													<![endif]-->
                                              
                                              <div class="column" style="width:100%;max-width:110px;display:inline-block;vertical-align:top;">
                                                <table class="contents" style="border-spacing:0; width:100%"  bgcolor="#ffffff" >
                                                  <tr>
                                                    <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" align="left"><a href="#" target="_blank"><img src="'. base_url() .'assets/images/logo.png" width="94" alt="" style="border-width:0; max-width:94px;height:auto; display:block" /></a></td>
                                                  </tr>
                                                </table>
                                              </div>
                                              
                                              <!--[if (gte mso 9)|(IE)]>
													</td><td width="80%" valign="top" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
													<![endif]-->
                                              
                                              <div class="column" style="width:100%;max-width:415px;display:inline-block;vertical-align:top;">
                                                <table width="100%" style="border-spacing:0" bgcolor="#ffffff">
                                                  <tr>
                                                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="hide">
                                                        <tr>
                                                          <td height="60">&nbsp;</td>
                                                        </tr>
                                                      </table></td>
                                                  </tr>
                                                  <tr>
                                                    <td class="inner" style="padding-top:10px;padding-bottom:10px; padding-right:10px;padding-left:10px;"><table class="contents" style="border-spacing:0; width:100%" bgcolor="#FFFFFF">
                                                        <tr>
                                                          <td align="right" valign="bottom" class="text"><font style="font-size:14px; text-decoration:none; color:#5b5f65;font-family:Arial, Helvetica, sans-serif"><strong><a href="'.base_url().'Home/about" style="color:#5b5f65; text-decoration:none">ABOUT</a> | <a href="http://rlabsnamibia.org/" style="color:#5b5f65; text-decoration:none">RLABS WEBSITE</a></strong></font></td>
                                                        </tr>
                                                      </table></td>
                                                  </tr>
                                                </table>
                                              </div>
                                              
                                              <!--[if (gte mso 9)|(IE)]>
													</td>
													</tr>
													</table>
													<![endif]--></td>
                                          </tr>
                                          <tr>
                                            <td align="left" style="padding-left:40px"><table border="0" cellpadding="0" cellspacing="0" style="border-bottom:2px solid #ce283d" align="left">
                                                <tr>
                                                  <td height="20" width="30" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                                </tr>
                                              </table></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </center></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </table>
                
                <!-- ======= end header ======= --> 
                
                <!-- ======= start hero image ======= --><!-- ======= end hero image ======= --> 
                
                <!-- ======= start hero article ======= -->
                
                <table class="one-column" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0" bgcolor="#FFFFFF">
                  <tr>
                    <td align="left" style="padding:0px 40px 40px 40px"><p style="color:#5b5f65; font-size:28px; text-align:left; font-family: Verdana, Geneva, sans-serif">Hi '.$user->first_name.' '.$user->last_name.', </p>
                      <p style="color:#5b5f65; font-size:16px; text-align:left; font-family: Verdana, Geneva, sans-serif">Congratulations, you pledged a donation towards a project on Namstarter, Please find details below.
                      <br />
                        <br />
                        Project: '.$p_project->Title.'<br />
                        Reference number: '.$ref.'<br />
                        Amount Pledged: N$ '.$this->input->post('amount').'<br />
                        <br />
                        Please ensure that you add the reference number when paying the donation <br />
                        Bank details
                       
                        <br />
                        Kind Regards,
                        <br />
                        RLabs Namibia
                         </p>
                      
                      <!-- START BUTTON -->
                      
                      <center>
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td height="20" width="100%" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                </tr>
                              </table>
                              <table border="0" align="center" cellpadding="0" cellspacing="0" style="Margin:0 auto;">
                                <tbody>
                                  <tr>
                                    <td align="center"><table border="0" cellpadding="0" cellspacing="0" style="Margin:0 auto;">
                                        <tr>
                                          <td width="250" height="60" align="center" bgcolor="#ce283d"><a href="'.base_url().'" style="width:250; display:block; text-decoration:none; border:0; text-align:center; font-weight:bold;font-size:18px; font-family: Arial, sans-serif; color: #ffffff; background:#ce283d" class="button_link">Visit Namstarter</a></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                        </table>
                      </center>
                      
                      <!-- END BUTTON --></td>
                  </tr>
                </table>
                
                <!-- ======= end hero article ======= -->  
                
                 <!-- ======= start footer ======= -->
                
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0" border="0"  bgcolor="#ce283d">
      <tr>
        <td height="40" align="center" bgcolor="#ce283d" class="one-column">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;"><font style="font-size:13px; text-decoration:none; color:#ffffff; font-family: Verdana, Geneva, sans-serif; text-align:center">Head office, RLabs Namibia, 1-3 Gluck Street, Windhoek, Namibia</font></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><table width="150" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="33" align="center"><a href="https://www.facebook.com/RLabsNamibia/" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/237854a9-0a06-4f88-a9b8-c36e57e31083.png" alt="facebook" width="32" height="32" border="0"/></a></td>
            <td width="34" align="center"><a href="https://twitter.com/rlabsnam" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/2fb3f578-f70a-41b6-9bbc-f99a174d6456.png" alt="twitter" width="32" height="32" border="0"/></a></td>
            <!-- <td width="33" align="center"><a href="https://twitter.com/rlabsnam" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/17c02388-c25e-4eb5-a7cc-8f34458a50ad.png" alt="linkedin" width="32" height="32" border="0"/></a></td> -->
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;"><font style="font-size:13px; text-decoration:none; color:#ffffff; font-family: Verdana, Geneva, sans-serif; text-align:center">All rights reserved. <a href="http://www.rlabsnamibia.org/" target="_blank" style="color:#ffffff; text-decoration:underline">RLabs Namibia</a></font></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td height="6" bgcolor="#ce283d" class="contents1" style="width:100%; border-bottom-left-radius:10px; border-bottom-right-radius:10px"></td>
      </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0" border="0"> 
      <tr>
        <td height="6" bgcolor="#ce283d" class="contents" style="width:100%; border-bottom-left-radius:10px; border-bottom-right-radius:10px"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

               <!-- ======= end footer ======= --></td>
            </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
					</td>
				</tr>
			</table>
			<![endif]--> 
        </div></td>
    </tr>
  </table>
</center>
</body>
</html>');

$this->email->send();

        
        
        //Mail Project Owner
        $proj_user =  $this->ion_auth->user($p_project->UserId)->row();

        
        $this->email->from('info@rlabsnamibia.org', 'NamStarter');
$this->email->to(array($p_project->Email, $proj_user->email));


$this->email->subject('Namstarter Pledge: ' .$p_project->Title );
$this->email->message('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if !mso]><!-->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title></title>
<style type="text/css">
* {
	-webkit-font-smoothing: antialiased;
}
body {
	Margin: 0;
	padding: 0;
	min-width: 100%;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
	mso-line-height-rule: exactly;
}
table {
	border-spacing: 0;
	color: #333333;
	font-family: Arial, sans-serif;
}
img {
	border: 0;
}
.wrapper {
	width: 100%;
	table-layout: fixed;
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
}
.webkit {
	max-width: 600px;
}
.outer {
	Margin: 0 auto;
	width: 100%;
	max-width: 600px;
}
.full-width-image img {
	width: 100%;
	max-width: 600px;
	height: auto;
}
.inner {
	padding: 10px;
}
p {
	Margin: 0;
	padding-bottom: 10px;
}
.h1 {
	font-size: 21px;
	font-weight: bold;
	Margin-top: 15px;
	Margin-bottom: 5px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.h2 {
	font-size: 18px;
	font-weight: bold;
	Margin-top: 10px;
	Margin-bottom: 5px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.one-column .contents {
	text-align: left;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.one-column p {
	font-size: 14px;
	Margin-bottom: 10px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.two-column {
	text-align: center;
	font-size: 0;
}
.two-column .column {
	width: 100%;
	max-width: 300px;
	display: inline-block;
	vertical-align: top;
}
.contents {
	width: 100%;
}
.two-column .contents {
	font-size: 14px;
	text-align: left;
}
.two-column img {
	width: 100%;
	max-width: 280px;
	height: auto;
}
.two-column .text {
	padding-top: 10px;
}
.three-column {
	text-align: center;
	font-size: 0;
	padding-top: 10px;
	padding-bottom: 10px;
}
.three-column .column {
	width: 100%;
	max-width: 200px;
	display: inline-block;
	vertical-align: top;
}
.three-column .contents {
	font-size: 14px;
	text-align: center;
}
.three-column img {
	width: 100%;
	max-width: 180px;
	height: auto;
}
.three-column .text {
	padding-top: 10px;
}
.img-align-vertical img {
	display: inline-block;
	vertical-align: middle;
}
@media only screen and (max-device-width: 480px) {
table[class=hide], img[class=hide], td[class=hide] {
	display: none !important;
}
</style>
<!--[if (gte mso 9)|(IE)]>
	<style type="text/css">
		table {border-collapse: collapse !important;}
	</style>
	<![endif]-->
</head>

<body style="Margin:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;min-width:100%;background-color:#ececec;">
<center class="wrapper" style="width:100%;table-layout:fixed;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#ececec;">
  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#ececec;" bgcolor="#ececec;">
    <tr>
      <td width="100%"><div class="webkit" style="max-width:600px;Margin:0 auto;"> 
          
          <!--[if (gte mso 9)|(IE)]>

						<table width="600" align="center" cellpadding="0" cellspacing="0" border="0" style="border-spacing:0" >
							<tr>
								<td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
								<![endif]--> 
          
          <!-- ======= start main body ======= -->
          <table class="outer" align="center" cellpadding="0" cellspacing="0" border="0" style="border-spacing:0;Margin:0 auto;width:100%;max-width:600px;">
            <tr>
              <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><!-- ======= start header ======= -->
                
                <table border="0" width="100%" cellpadding="0" cellspacing="0"  >
                  <tr>
                    <td><table style="width:100%;" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                          <tr>
                            <td align="center"><center>
                                <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="Margin: 0 auto;">
                                  <tbody>
                                    <tr>
                                      <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0">
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td align="center"><font style="font-size:11px; text-decoration:none; color:#474b53; font-family: Verdana, Geneva, sans-serif; text-align:left"><a href="#" target="_blank" style="color:#474b53; text-decoration:none">View in browser</a> | <a href="#" target="_blank" style="color:#474b53; text-decoration:none">Send to a friend </a></font></td>
                                          </tr>
                                          <tr>
                                            <td align="center">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td height="6" bgcolor="#ce283d" class="contents" style="width:100%; border-top-left-radius:10px; border-top-right-radius:10px"></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </center></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </table>
                <table border="0" width="100%" cellpadding="0" cellspacing="0"  >
                  <tr>
                    <td><table style="width:100%;" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                          <tr>
                            <td align="center"><center>
                                <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="Margin: 0 auto;">
                                  <tbody>
                                    <tr>
                                      <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" bgcolor="#FFFFFF"><!-- ======= start header ======= -->
                                        
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                          <tr>
                                            <td class="two-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;font-size:0;"><!--[if (gte mso 9)|(IE)]>
													<table width="100%" style="border-spacing:0" >
													<tr>
													<td width="20%" valign="top" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
													<![endif]-->
                                              
                                              <div class="column" style="width:100%;max-width:110px;display:inline-block;vertical-align:top;">
                                                <table class="contents" style="border-spacing:0; width:100%"  bgcolor="#ffffff" >
                                                  <tr>
                                                    <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" align="left"><a href="#" target="_blank"><img src="'. base_url() .'assets/images/logo.png" width="94" alt="" style="border-width:0; max-width:94px;height:auto; display:block" /></a></td>
                                                  </tr>
                                                </table>
                                              </div>
                                              
                                              <!--[if (gte mso 9)|(IE)]>
													</td><td width="80%" valign="top" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
													<![endif]-->
                                              
                                              <div class="column" style="width:100%;max-width:415px;display:inline-block;vertical-align:top;">
                                                <table width="100%" style="border-spacing:0" bgcolor="#ffffff">
                                                  <tr>
                                                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="hide">
                                                        <tr>
                                                          <td height="60">&nbsp;</td>
                                                        </tr>
                                                      </table></td>
                                                  </tr>
                                                  <tr>
                                                    <td class="inner" style="padding-top:10px;padding-bottom:10px; padding-right:10px;padding-left:10px;"><table class="contents" style="border-spacing:0; width:100%" bgcolor="#FFFFFF">
                                                        <tr>
                                                          <td align="right" valign="bottom" class="text"><font style="font-size:14px; text-decoration:none; color:#5b5f65;font-family:Arial, Helvetica, sans-serif"><strong><a href="'.base_url().'Home/about" style="color:#5b5f65; text-decoration:none">ABOUT</a> | <a href="http://rlabsnamibia.org/" style="color:#5b5f65; text-decoration:none">RLABS WEBSITE</a></strong></font></td>
                                                        </tr>
                                                      </table></td>
                                                  </tr>
                                                </table>
                                              </div>
                                              
                                              <!--[if (gte mso 9)|(IE)]>
													</td>
													</tr>
													</table>
													<![endif]--></td>
                                          </tr>
                                          <tr>
                                            <td align="left" style="padding-left:40px"><table border="0" cellpadding="0" cellspacing="0" style="border-bottom:2px solid #ce283d" align="left">
                                                <tr>
                                                  <td height="20" width="30" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                                </tr>
                                              </table></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </center></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </table>
                
                <!-- ======= end header ======= --> 
                
                <!-- ======= start hero image ======= --><!-- ======= end hero image ======= --> 
                
                <!-- ======= start hero article ======= -->
                
                <table class="one-column" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0" bgcolor="#FFFFFF">
                  <tr>
                    <td align="left" style="padding:0px 40px 40px 40px"><p style="color:#5b5f65; font-size:28px; text-align:left; font-family: Verdana, Geneva, sans-serif">Hi, '.$p_project->Title.' , </p>
                      <p style="color:#5b5f65; font-size:16px; text-align:left; font-family: Verdana, Geneva, sans-serif">Congratulations, a pledge was made towards your project on Namstarter, Please find details below.
                      <br />
                        <br />
                        Project: '.$p_project->Title.'<br />
                        Reference number: '.$ref.'<br />
                        Amount Pledged: N$ '.$this->input->post('amount').'<br />
                        <br />
                        
                       
                        <br />
                        Kind Regards,
                        <br />
                        RLabs Namibia
                         </p>
                      
                      <!-- START BUTTON -->
                      
                      <center>
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td height="20" width="100%" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                </tr>
                              </table>
                              <table border="0" align="center" cellpadding="0" cellspacing="0" style="Margin:0 auto;">
                                <tbody>
                                  <tr>
                                    <td align="center"><table border="0" cellpadding="0" cellspacing="0" style="Margin:0 auto;">
                                        <tr>
                                          <td width="250" height="60" align="center" bgcolor="#ce283d"><a href="'.base_url().'" style="width:250; display:block; text-decoration:none; border:0; text-align:center; font-weight:bold;font-size:18px; font-family: Arial, sans-serif; color: #ffffff; background:#ce283d" class="button_link">Visit Namstarter</a></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                        </table>
                      </center>
                      
                      <!-- END BUTTON --></td>
                  </tr>
                </table>
                
                <!-- ======= end hero article ======= -->  
                
                 <!-- ======= start footer ======= -->
                
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0" border="0"  bgcolor="#ce283d">
      <tr>
        <td height="40" align="center" bgcolor="#ce283d" class="one-column">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;"><font style="font-size:13px; text-decoration:none; color:#ffffff; font-family: Verdana, Geneva, sans-serif; text-align:center">Head office, RLabs Namibia, 1-3 Gluck Street, Windhoek, Namibia</font></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><table width="150" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="33" align="center"><a href="https://www.facebook.com/RLabsNamibia/" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/237854a9-0a06-4f88-a9b8-c36e57e31083.png" alt="facebook" width="32" height="32" border="0"/></a></td>
            <td width="34" align="center"><a href="https://twitter.com/rlabsnam" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/2fb3f578-f70a-41b6-9bbc-f99a174d6456.png" alt="twitter" width="32" height="32" border="0"/></a></td>
            <!-- <td width="33" align="center"><a href="https://twitter.com/rlabsnam" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/17c02388-c25e-4eb5-a7cc-8f34458a50ad.png" alt="linkedin" width="32" height="32" border="0"/></a></td> -->
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;"><font style="font-size:13px; text-decoration:none; color:#ffffff; font-family: Verdana, Geneva, sans-serif; text-align:center">All rights reserved. <a href="http://www.rlabsnamibia.org/" target="_blank" style="color:#ffffff; text-decoration:underline">RLabs Namibia</a></font></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td height="6" bgcolor="#ce283d" class="contents1" style="width:100%; border-bottom-left-radius:10px; border-bottom-right-radius:10px"></td>
      </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0" border="0"> 
      <tr>
        <td height="6" bgcolor="#ce283d" class="contents" style="width:100%; border-bottom-left-radius:10px; border-bottom-right-radius:10px"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

               <!-- ======= end footer ======= --></td>
            </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
					</td>
				</tr>
			</table>
			<![endif]--> 
        </div></td>
    </tr>
  </table>
</center>
</body>
</html>');

$this->email->send();
        $this->load->view('funder/details', $data);
    }
    
    
    public function pay_pledge($id){
        
        $pledge = $this->pledge_model->get_pledge($id);
        /*print_r($pledge);
        print '<br>';
        print '--------------------------------------------------------';
        print '<br>';*/
        $funder = $this->funder_model->get_funder($pledge->FunderId);
       /* print_r($funder);
        print '<br>';
        print '--------------------------------------------------------';
        print '<br>';*/
        $user = $this->ion_auth->user($funder->UserId)->row();
       /* print_r($user);
        print '<br>';
        print '--------------------------------------------------------';
        print '<br>';*/
        $campaign = $this->campaign_model->get_campaign($pledge->CampaignId);
       /* print_r($campaign);
        print '<br>';
        print '--------------------------------------------------------';
        print '<br>';*/
        $project = $this->project_model->get_project($campaign->ProjectId);
       /* print_r($project);
         print '<br>';
        print '--------------------------------------------------------';
        print '<br>';*/
        $project_owner = $this->ion_auth->user($project->UserId)->row();
       /* print_r($user);
        die();*/
         
       // print_r($p_project);
$ref = $id . '/'. $campaign->ProjectId . '/'.$pledge->CampaignId.'/'.$pledge->FunderId;                                                           
 
            $this->load->library('email');
$config['mailtype'] = 'html';
$this->email->initialize($config);
$this->email->from('info@rlabsnamibia.org', 'NamStarter');
$this->email->to($user->email);


$this->email->subject('Namstarter Donation Payment: ' .$user->first_name .' '. $user->last_name );
$this->email->message('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if !mso]><!-->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title></title>
<style type="text/css">
* {
	-webkit-font-smoothing: antialiased;
}
body {
	Margin: 0;
	padding: 0;
	min-width: 100%;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
	mso-line-height-rule: exactly;
}
table {
	border-spacing: 0;
	color: #333333;
	font-family: Arial, sans-serif;
}
img {
	border: 0;
}
.wrapper {
	width: 100%;
	table-layout: fixed;
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
}
.webkit {
	max-width: 600px;
}
.outer {
	Margin: 0 auto;
	width: 100%;
	max-width: 600px;
}
.full-width-image img {
	width: 100%;
	max-width: 600px;
	height: auto;
}
.inner {
	padding: 10px;
}
p {
	Margin: 0;
	padding-bottom: 10px;
}
.h1 {
	font-size: 21px;
	font-weight: bold;
	Margin-top: 15px;
	Margin-bottom: 5px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.h2 {
	font-size: 18px;
	font-weight: bold;
	Margin-top: 10px;
	Margin-bottom: 5px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.one-column .contents {
	text-align: left;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.one-column p {
	font-size: 14px;
	Margin-bottom: 10px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.two-column {
	text-align: center;
	font-size: 0;
}
.two-column .column {
	width: 100%;
	max-width: 300px;
	display: inline-block;
	vertical-align: top;
}
.contents {
	width: 100%;
}
.two-column .contents {
	font-size: 14px;
	text-align: left;
}
.two-column img {
	width: 100%;
	max-width: 280px;
	height: auto;
}
.two-column .text {
	padding-top: 10px;
}
.three-column {
	text-align: center;
	font-size: 0;
	padding-top: 10px;
	padding-bottom: 10px;
}
.three-column .column {
	width: 100%;
	max-width: 200px;
	display: inline-block;
	vertical-align: top;
}
.three-column .contents {
	font-size: 14px;
	text-align: center;
}
.three-column img {
	width: 100%;
	max-width: 180px;
	height: auto;
}
.three-column .text {
	padding-top: 10px;
}
.img-align-vertical img {
	display: inline-block;
	vertical-align: middle;
}
@media only screen and (max-device-width: 480px) {
table[class=hide], img[class=hide], td[class=hide] {
	display: none !important;
}
</style>
<!--[if (gte mso 9)|(IE)]>
	<style type="text/css">
		table {border-collapse: collapse !important;}
	</style>
	<![endif]-->
</head>

<body style="Margin:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;min-width:100%;background-color:#ececec;">
<center class="wrapper" style="width:100%;table-layout:fixed;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#ececec;">
  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#ececec;" bgcolor="#ececec;">
    <tr>
      <td width="100%"><div class="webkit" style="max-width:600px;Margin:0 auto;"> 
          
          <!--[if (gte mso 9)|(IE)]>

						<table width="600" align="center" cellpadding="0" cellspacing="0" border="0" style="border-spacing:0" >
							<tr>
								<td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
								<![endif]--> 
          
          <!-- ======= start main body ======= -->
          <table class="outer" align="center" cellpadding="0" cellspacing="0" border="0" style="border-spacing:0;Margin:0 auto;width:100%;max-width:600px;">
            <tr>
              <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><!-- ======= start header ======= -->
                
                <table border="0" width="100%" cellpadding="0" cellspacing="0"  >
                  <tr>
                    <td><table style="width:100%;" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                          <tr>
                            <td align="center"><center>
                                <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="Margin: 0 auto;">
                                  <tbody>
                                    <tr>
                                      <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0">
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td align="center"><font style="font-size:11px; text-decoration:none; color:#474b53; font-family: Verdana, Geneva, sans-serif; text-align:left"><a href="#" target="_blank" style="color:#474b53; text-decoration:none">View in browser</a> | <a href="#" target="_blank" style="color:#474b53; text-decoration:none">Send to a friend </a></font></td>
                                          </tr>
                                          <tr>
                                            <td align="center">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td height="6" bgcolor="#ce283d" class="contents" style="width:100%; border-top-left-radius:10px; border-top-right-radius:10px"></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </center></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </table>
                <table border="0" width="100%" cellpadding="0" cellspacing="0"  >
                  <tr>
                    <td><table style="width:100%;" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                          <tr>
                            <td align="center"><center>
                                <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="Margin: 0 auto;">
                                  <tbody>
                                    <tr>
                                      <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" bgcolor="#FFFFFF"><!-- ======= start header ======= -->
                                        
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                          <tr>
                                            <td class="two-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;font-size:0;"><!--[if (gte mso 9)|(IE)]>
													<table width="100%" style="border-spacing:0" >
													<tr>
													<td width="20%" valign="top" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
													<![endif]-->
                                              
                                              <div class="column" style="width:100%;max-width:110px;display:inline-block;vertical-align:top;">
                                                <table class="contents" style="border-spacing:0; width:100%"  bgcolor="#ffffff" >
                                                  <tr>
                                                    <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" align="left"><a href="#" target="_blank"><img src="'. base_url() .'assets/images/logo.png" width="94" alt="" style="border-width:0; max-width:94px;height:auto; display:block" /></a></td>
                                                  </tr>
                                                </table>
                                              </div>
                                              
                                              <!--[if (gte mso 9)|(IE)]>
													</td><td width="80%" valign="top" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
													<![endif]-->
                                              
                                              <div class="column" style="width:100%;max-width:415px;display:inline-block;vertical-align:top;">
                                                <table width="100%" style="border-spacing:0" bgcolor="#ffffff">
                                                  <tr>
                                                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="hide">
                                                        <tr>
                                                          <td height="60">&nbsp;</td>
                                                        </tr>
                                                      </table></td>
                                                  </tr>
                                                  <tr>
                                                    <td class="inner" style="padding-top:10px;padding-bottom:10px; padding-right:10px;padding-left:10px;"><table class="contents" style="border-spacing:0; width:100%" bgcolor="#FFFFFF">
                                                        <tr>
                                                          <td align="right" valign="bottom" class="text"><font style="font-size:14px; text-decoration:none; color:#5b5f65;font-family:Arial, Helvetica, sans-serif"><strong><a href="'.base_url().'Home/about" style="color:#5b5f65; text-decoration:none">ABOUT</a> | <a href="http://rlabsnamibia.org/" style="color:#5b5f65; text-decoration:none">RLABS WEBSITE</a></strong></font></td>
                                                        </tr>
                                                      </table></td>
                                                  </tr>
                                                </table>
                                              </div>
                                              
                                              <!--[if (gte mso 9)|(IE)]>
													</td>
													</tr>
													</table>
													<![endif]--></td>
                                          </tr>
                                          <tr>
                                            <td align="left" style="padding-left:40px"><table border="0" cellpadding="0" cellspacing="0" style="border-bottom:2px solid #ce283d" align="left">
                                                <tr>
                                                  <td height="20" width="30" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                                </tr>
                                              </table></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </center></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </table>
                
                <!-- ======= end header ======= --> 
                
                <!-- ======= start hero image ======= --><!-- ======= end hero image ======= --> 
                
                <!-- ======= start hero article ======= -->
                
                <table class="one-column" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0" bgcolor="#FFFFFF">
                  <tr>
                    <td align="left" style="padding:0px 40px 40px 40px"><p style="color:#5b5f65; font-size:28px; text-align:left; font-family: Verdana, Geneva, sans-serif">Hi '.$user->first_name.' '.$user->last_name.', </p>
                      <p style="color:#5b5f65; font-size:16px; text-align:left; font-family: Verdana, Geneva, sans-serif">Congratulations, your donation towards a project on Namstarter has been paid, Please find details below.
                      <br />
                        <br />
                        Project: '.$project->Title.'<br />
                        Reference number: '.$ref.'<br />
                        Amount Paid: N$ '.$pledge->Amount.'<br />
                        <br />
                        Thank you so much for your support
                       
                        <br />
                        Kind Regards,
                        <br />
                        RLabs Namibia
                         </p>
                      
                      <!-- START BUTTON -->
                      
                      <center>
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td height="20" width="100%" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                </tr>
                              </table>
                              <table border="0" align="center" cellpadding="0" cellspacing="0" style="Margin:0 auto;">
                                <tbody>
                                  <tr>
                                    <td align="center"><table border="0" cellpadding="0" cellspacing="0" style="Margin:0 auto;">
                                        <tr>
                                          <td width="250" height="60" align="center" bgcolor="#ce283d"><a href="'.base_url().'" style="width:250; display:block; text-decoration:none; border:0; text-align:center; font-weight:bold;font-size:18px; font-family: Arial, sans-serif; color: #ffffff; background:#ce283d" class="button_link">Visit Namstarter</a></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                        </table>
                      </center>
                      
                      <!-- END BUTTON --></td>
                  </tr>
                </table>
                
                <!-- ======= end hero article ======= -->  
                
                 <!-- ======= start footer ======= -->
                
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0" border="0"  bgcolor="#ce283d">
      <tr>
        <td height="40" align="center" bgcolor="#ce283d" class="one-column">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;"><font style="font-size:13px; text-decoration:none; color:#ffffff; font-family: Verdana, Geneva, sans-serif; text-align:center">Head office, RLabs Namibia, 1-3 Gluck Street, Windhoek, Namibia</font></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><table width="150" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="33" align="center"><a href="https://www.facebook.com/RLabsNamibia/" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/237854a9-0a06-4f88-a9b8-c36e57e31083.png" alt="facebook" width="32" height="32" border="0"/></a></td>
            <td width="34" align="center"><a href="https://twitter.com/rlabsnam" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/2fb3f578-f70a-41b6-9bbc-f99a174d6456.png" alt="twitter" width="32" height="32" border="0"/></a></td>
            <!-- <td width="33" align="center"><a href="https://twitter.com/rlabsnam" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/17c02388-c25e-4eb5-a7cc-8f34458a50ad.png" alt="linkedin" width="32" height="32" border="0"/></a></td> -->
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;"><font style="font-size:13px; text-decoration:none; color:#ffffff; font-family: Verdana, Geneva, sans-serif; text-align:center">All rights reserved. <a href="http://www.rlabsnamibia.org/" target="_blank" style="color:#ffffff; text-decoration:underline">RLabs Namibia</a></font></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td height="6" bgcolor="#ce283d" class="contents1" style="width:100%; border-bottom-left-radius:10px; border-bottom-right-radius:10px"></td>
      </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0" border="0"> 
      <tr>
        <td height="6" bgcolor="#ce283d" class="contents" style="width:100%; border-bottom-left-radius:10px; border-bottom-right-radius:10px"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

               <!-- ======= end footer ======= --></td>
            </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
					</td>
				</tr>
			</table>
			<![endif]--> 
        </div></td>
    </tr>
  </table>
</center>
</body>
</html>');

$this->email->send();

        
        
        //Mail Project Owner
      
        $this->email->from('info@rlabsnamibia.org', 'NamStarter');
$this->email->to(array($project->Email, $project_owner->email));


$this->email->subject('Namstarter Donation Payment: ' .$project->Title );
$this->email->message('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if !mso]><!-->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title></title>
<style type="text/css">
* {
	-webkit-font-smoothing: antialiased;
}
body {
	Margin: 0;
	padding: 0;
	min-width: 100%;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
	mso-line-height-rule: exactly;
}
table {
	border-spacing: 0;
	color: #333333;
	font-family: Arial, sans-serif;
}
img {
	border: 0;
}
.wrapper {
	width: 100%;
	table-layout: fixed;
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
}
.webkit {
	max-width: 600px;
}
.outer {
	Margin: 0 auto;
	width: 100%;
	max-width: 600px;
}
.full-width-image img {
	width: 100%;
	max-width: 600px;
	height: auto;
}
.inner {
	padding: 10px;
}
p {
	Margin: 0;
	padding-bottom: 10px;
}
.h1 {
	font-size: 21px;
	font-weight: bold;
	Margin-top: 15px;
	Margin-bottom: 5px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.h2 {
	font-size: 18px;
	font-weight: bold;
	Margin-top: 10px;
	Margin-bottom: 5px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.one-column .contents {
	text-align: left;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.one-column p {
	font-size: 14px;
	Margin-bottom: 10px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.two-column {
	text-align: center;
	font-size: 0;
}
.two-column .column {
	width: 100%;
	max-width: 300px;
	display: inline-block;
	vertical-align: top;
}
.contents {
	width: 100%;
}
.two-column .contents {
	font-size: 14px;
	text-align: left;
}
.two-column img {
	width: 100%;
	max-width: 280px;
	height: auto;
}
.two-column .text {
	padding-top: 10px;
}
.three-column {
	text-align: center;
	font-size: 0;
	padding-top: 10px;
	padding-bottom: 10px;
}
.three-column .column {
	width: 100%;
	max-width: 200px;
	display: inline-block;
	vertical-align: top;
}
.three-column .contents {
	font-size: 14px;
	text-align: center;
}
.three-column img {
	width: 100%;
	max-width: 180px;
	height: auto;
}
.three-column .text {
	padding-top: 10px;
}
.img-align-vertical img {
	display: inline-block;
	vertical-align: middle;
}
@media only screen and (max-device-width: 480px) {
table[class=hide], img[class=hide], td[class=hide] {
	display: none !important;
}
</style>
<!--[if (gte mso 9)|(IE)]>
	<style type="text/css">
		table {border-collapse: collapse !important;}
	</style>
	<![endif]-->
</head>

<body style="Margin:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;min-width:100%;background-color:#ececec;">
<center class="wrapper" style="width:100%;table-layout:fixed;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#ececec;">
  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#ececec;" bgcolor="#ececec;">
    <tr>
      <td width="100%"><div class="webkit" style="max-width:600px;Margin:0 auto;"> 
          
          <!--[if (gte mso 9)|(IE)]>

						<table width="600" align="center" cellpadding="0" cellspacing="0" border="0" style="border-spacing:0" >
							<tr>
								<td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
								<![endif]--> 
          
          <!-- ======= start main body ======= -->
          <table class="outer" align="center" cellpadding="0" cellspacing="0" border="0" style="border-spacing:0;Margin:0 auto;width:100%;max-width:600px;">
            <tr>
              <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><!-- ======= start header ======= -->
                
                <table border="0" width="100%" cellpadding="0" cellspacing="0"  >
                  <tr>
                    <td><table style="width:100%;" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                          <tr>
                            <td align="center"><center>
                                <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="Margin: 0 auto;">
                                  <tbody>
                                    <tr>
                                      <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0">
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td align="center"><font style="font-size:11px; text-decoration:none; color:#474b53; font-family: Verdana, Geneva, sans-serif; text-align:left"><a href="#" target="_blank" style="color:#474b53; text-decoration:none">View in browser</a> | <a href="#" target="_blank" style="color:#474b53; text-decoration:none">Send to a friend </a></font></td>
                                          </tr>
                                          <tr>
                                            <td align="center">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td height="6" bgcolor="#ce283d" class="contents" style="width:100%; border-top-left-radius:10px; border-top-right-radius:10px"></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </center></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </table>
                <table border="0" width="100%" cellpadding="0" cellspacing="0"  >
                  <tr>
                    <td><table style="width:100%;" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                          <tr>
                            <td align="center"><center>
                                <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="Margin: 0 auto;">
                                  <tbody>
                                    <tr>
                                      <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" bgcolor="#FFFFFF"><!-- ======= start header ======= -->
                                        
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                          <tr>
                                            <td class="two-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;font-size:0;"><!--[if (gte mso 9)|(IE)]>
													<table width="100%" style="border-spacing:0" >
													<tr>
													<td width="20%" valign="top" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
													<![endif]-->
                                              
                                              <div class="column" style="width:100%;max-width:110px;display:inline-block;vertical-align:top;">
                                                <table class="contents" style="border-spacing:0; width:100%"  bgcolor="#ffffff" >
                                                  <tr>
                                                    <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" align="left"><a href="#" target="_blank"><img src="'. base_url() .'assets/images/logo.png" width="94" alt="" style="border-width:0; max-width:94px;height:auto; display:block" /></a></td>
                                                  </tr>
                                                </table>
                                              </div>
                                              
                                              <!--[if (gte mso 9)|(IE)]>
													</td><td width="80%" valign="top" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
													<![endif]-->
                                              
                                              <div class="column" style="width:100%;max-width:415px;display:inline-block;vertical-align:top;">
                                                <table width="100%" style="border-spacing:0" bgcolor="#ffffff">
                                                  <tr>
                                                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="hide">
                                                        <tr>
                                                          <td height="60">&nbsp;</td>
                                                        </tr>
                                                      </table></td>
                                                  </tr>
                                                  <tr>
                                                    <td class="inner" style="padding-top:10px;padding-bottom:10px; padding-right:10px;padding-left:10px;"><table class="contents" style="border-spacing:0; width:100%" bgcolor="#FFFFFF">
                                                        <tr>
                                                          <td align="right" valign="bottom" class="text"><font style="font-size:14px; text-decoration:none; color:#5b5f65;font-family:Arial, Helvetica, sans-serif"><strong><a href="'.base_url().'Home/about" style="color:#5b5f65; text-decoration:none">ABOUT</a> | <a href="http://rlabsnamibia.org/" style="color:#5b5f65; text-decoration:none">RLABS WEBSITE</a></strong></font></td>
                                                        </tr>
                                                      </table></td>
                                                  </tr>
                                                </table>
                                              </div>
                                              
                                              <!--[if (gte mso 9)|(IE)]>
													</td>
													</tr>
													</table>
													<![endif]--></td>
                                          </tr>
                                          <tr>
                                            <td align="left" style="padding-left:40px"><table border="0" cellpadding="0" cellspacing="0" style="border-bottom:2px solid #ce283d" align="left">
                                                <tr>
                                                  <td height="20" width="30" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                                </tr>
                                              </table></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </center></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </table>
                
                <!-- ======= end header ======= --> 
                
                <!-- ======= start hero image ======= --><!-- ======= end hero image ======= --> 
                
                <!-- ======= start hero article ======= -->
                
                <table class="one-column" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0" bgcolor="#FFFFFF">
                  <tr>
                    <td align="left" style="padding:0px 40px 40px 40px"><p style="color:#5b5f65; font-size:28px; text-align:left; font-family: Verdana, Geneva, sans-serif">Hi, '.$project->Title.' , </p>
                      <p style="color:#5b5f65; font-size:16px; text-align:left; font-family: Verdana, Geneva, sans-serif">Congratulations, a pledge was made towards your project on Namstarter, Please find details below.
                      <br />
                        <br />
                       Project: '.$project->Title.'<br />
                        Reference number: '.$ref.'<br />
                        Amount Paid: N$ '.$pledge->Amount.'<br />
                        <br />
                        
                       
                        <br />
                        Kind Regards,
                        <br />
                        RLabs Namibia
                         </p>
                      
                      <!-- START BUTTON -->
                      
                      <center>
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td height="20" width="100%" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                </tr>
                              </table>
                              <table border="0" align="center" cellpadding="0" cellspacing="0" style="Margin:0 auto;">
                                <tbody>
                                  <tr>
                                    <td align="center"><table border="0" cellpadding="0" cellspacing="0" style="Margin:0 auto;">
                                        <tr>
                                          <td width="250" height="60" align="center" bgcolor="#ce283d"><a href="'.base_url().'" style="width:250; display:block; text-decoration:none; border:0; text-align:center; font-weight:bold;font-size:18px; font-family: Arial, sans-serif; color: #ffffff; background:#ce283d" class="button_link">Visit Namstarter</a></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                        </table>
                      </center>
                      
                      <!-- END BUTTON --></td>
                  </tr>
                </table>
                
                <!-- ======= end hero article ======= -->  
                
                 <!-- ======= start footer ======= -->
                
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0" border="0"  bgcolor="#ce283d">
      <tr>
        <td height="40" align="center" bgcolor="#ce283d" class="one-column">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;"><font style="font-size:13px; text-decoration:none; color:#ffffff; font-family: Verdana, Geneva, sans-serif; text-align:center">Head office, RLabs Namibia, 1-3 Gluck Street, Windhoek, Namibia</font></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><table width="150" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="33" align="center"><a href="https://www.facebook.com/RLabsNamibia/" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/237854a9-0a06-4f88-a9b8-c36e57e31083.png" alt="facebook" width="32" height="32" border="0"/></a></td>
            <td width="34" align="center"><a href="https://twitter.com/rlabsnam" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/2fb3f578-f70a-41b6-9bbc-f99a174d6456.png" alt="twitter" width="32" height="32" border="0"/></a></td>
            <!-- <td width="33" align="center"><a href="https://twitter.com/rlabsnam" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/17c02388-c25e-4eb5-a7cc-8f34458a50ad.png" alt="linkedin" width="32" height="32" border="0"/></a></td> -->
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;"><font style="font-size:13px; text-decoration:none; color:#ffffff; font-family: Verdana, Geneva, sans-serif; text-align:center">All rights reserved. <a href="http://www.rlabsnamibia.org/" target="_blank" style="color:#ffffff; text-decoration:underline">RLabs Namibia</a></font></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td height="6" bgcolor="#ce283d" class="contents1" style="width:100%; border-bottom-left-radius:10px; border-bottom-right-radius:10px"></td>
      </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0" border="0"> 
      <tr>
        <td height="6" bgcolor="#ce283d" class="contents" style="width:100%; border-bottom-left-radius:10px; border-bottom-right-radius:10px"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

               <!-- ======= end footer ======= --></td>
            </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
					</td>
				</tr>
			</table>
			<![endif]--> 
        </div></td>
    </tr>
  </table>
</center>
</body>
</html>');

$this->email->send();
         $this->pledge_model->pay_pledge($id);
        redirect('admin/index');
    }
    
    public function create() {
        $data['is_loggedin'] = $this->ion_auth->logged_in();

        $path = '/YouthFund/js/ckfinder';
        $width = '850px';
        $this->editor($path, $width);
        //Setting validation rules
        $config = array(
            array(
                'field' => 'id_number',
                'label' => 'ID Number/Business Reg. No.',
                'rules' => 'required|is_unique[funders.Id_Number]|max_length[30]|min_length[5]|numeric',
                array(
                    'required' => 'You hav not entered %s',
                    'is_unique' => 'This %s already exists'
                )
            ),
            array(
                'field' => 'description',
                'label' => 'About',
                'rules' => 'required|min_length[1]|max_length[10000]'
            ),
            array(
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required|min_length[5]|max_length[100]'
            ),
            array(
                'field' => 'userId',                
                'rules' => 'required'
            ),
            
        );
        $this->form_validation->set_rules($config);
        $data['create_form'] = $config;
        $data['user'] = $this->ion_auth->user()->row();
        if ($this->input->post() != NULL && $this->form_validation->run()) {

//            print_r($this->input->post());
//            print_r($_FILES);
//            die();
            
            //Image upload
            $config['upload_path'] = './uploads/Projects/Profile/';
            $config['allowed_types'] = 'gif|jpg|png|mp4';
            $config['max_size'] = 20048; // Need to define properly           
            $this->load->library('upload', $config);
            // if
            $this->upload->do_upload('Profile_Picture');
            $pic = $this->upload->data();
            //if
            //$this->upload->do_upload('Profile_Video');
            //$vid = $this->upload->data();
            print_r($this->upload->display_errors());
            echo $this->funder_model->create_funder($this->input->post('userId'),$this->input->post('id_number'), $this->input->post('address'), $this->input->post('description'),  $this->input->post('address'), $pic['file_name']);
            // Adding user to Projects group.
            $this->ion_auth->add_to_group(4, $this->input->post('userId'));
            //$this->load->view("");
             $user = $this->ion_auth->user()->row();
            $this->load->library('email');
$config['mailtype'] = 'html';
$this->email->initialize($config);
$this->email->from('info@rlabsnamibia.org', 'NamStarter');
$this->email->to($user->email);


$this->email->subject('Namstarter Funder: ' .$user->first_name .' '. $user->last_name );
$this->email->message('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if !mso]><!-->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title></title>
<style type="text/css">
* {
	-webkit-font-smoothing: antialiased;
}
body {
	Margin: 0;
	padding: 0;
	min-width: 100%;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
	mso-line-height-rule: exactly;
}
table {
	border-spacing: 0;
	color: #333333;
	font-family: Arial, sans-serif;
}
img {
	border: 0;
}
.wrapper {
	width: 100%;
	table-layout: fixed;
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
}
.webkit {
	max-width: 600px;
}
.outer {
	Margin: 0 auto;
	width: 100%;
	max-width: 600px;
}
.full-width-image img {
	width: 100%;
	max-width: 600px;
	height: auto;
}
.inner {
	padding: 10px;
}
p {
	Margin: 0;
	padding-bottom: 10px;
}
.h1 {
	font-size: 21px;
	font-weight: bold;
	Margin-top: 15px;
	Margin-bottom: 5px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.h2 {
	font-size: 18px;
	font-weight: bold;
	Margin-top: 10px;
	Margin-bottom: 5px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.one-column .contents {
	text-align: left;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.one-column p {
	font-size: 14px;
	Margin-bottom: 10px;
	font-family: Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
}
.two-column {
	text-align: center;
	font-size: 0;
}
.two-column .column {
	width: 100%;
	max-width: 300px;
	display: inline-block;
	vertical-align: top;
}
.contents {
	width: 100%;
}
.two-column .contents {
	font-size: 14px;
	text-align: left;
}
.two-column img {
	width: 100%;
	max-width: 280px;
	height: auto;
}
.two-column .text {
	padding-top: 10px;
}
.three-column {
	text-align: center;
	font-size: 0;
	padding-top: 10px;
	padding-bottom: 10px;
}
.three-column .column {
	width: 100%;
	max-width: 200px;
	display: inline-block;
	vertical-align: top;
}
.three-column .contents {
	font-size: 14px;
	text-align: center;
}
.three-column img {
	width: 100%;
	max-width: 180px;
	height: auto;
}
.three-column .text {
	padding-top: 10px;
}
.img-align-vertical img {
	display: inline-block;
	vertical-align: middle;
}
@media only screen and (max-device-width: 480px) {
table[class=hide], img[class=hide], td[class=hide] {
	display: none !important;
}
</style>
<!--[if (gte mso 9)|(IE)]>
	<style type="text/css">
		table {border-collapse: collapse !important;}
	</style>
	<![endif]-->
</head>

<body style="Margin:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;min-width:100%;background-color:#ececec;">
<center class="wrapper" style="width:100%;table-layout:fixed;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#ececec;">
  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#ececec;" bgcolor="#ececec;">
    <tr>
      <td width="100%"><div class="webkit" style="max-width:600px;Margin:0 auto;"> 
          
          <!--[if (gte mso 9)|(IE)]>

						<table width="600" align="center" cellpadding="0" cellspacing="0" border="0" style="border-spacing:0" >
							<tr>
								<td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
								<![endif]--> 
          
          <!-- ======= start main body ======= -->
          <table class="outer" align="center" cellpadding="0" cellspacing="0" border="0" style="border-spacing:0;Margin:0 auto;width:100%;max-width:600px;">
            <tr>
              <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><!-- ======= start header ======= -->
                
                <table border="0" width="100%" cellpadding="0" cellspacing="0"  >
                  <tr>
                    <td><table style="width:100%;" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                          <tr>
                            <td align="center"><center>
                                <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="Margin: 0 auto;">
                                  <tbody>
                                    <tr>
                                      <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0">
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td align="center"><font style="font-size:11px; text-decoration:none; color:#474b53; font-family: Verdana, Geneva, sans-serif; text-align:left"><a href="#" target="_blank" style="color:#474b53; text-decoration:none">View in browser</a> | <a href="#" target="_blank" style="color:#474b53; text-decoration:none">Send to a friend </a></font></td>
                                          </tr>
                                          <tr>
                                            <td align="center">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td height="6" bgcolor="#ce283d" class="contents" style="width:100%; border-top-left-radius:10px; border-top-right-radius:10px"></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </center></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </table>
                <table border="0" width="100%" cellpadding="0" cellspacing="0"  >
                  <tr>
                    <td><table style="width:100%;" cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                          <tr>
                            <td align="center"><center>
                                <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="Margin: 0 auto;">
                                  <tbody>
                                    <tr>
                                      <td class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" bgcolor="#FFFFFF"><!-- ======= start header ======= -->
                                        
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                          <tr>
                                            <td class="two-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;text-align:center;font-size:0;"><!--[if (gte mso 9)|(IE)]>
													<table width="100%" style="border-spacing:0" >
													<tr>
													<td width="20%" valign="top" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
													<![endif]-->
                                              
                                              <div class="column" style="width:100%;max-width:110px;display:inline-block;vertical-align:top;">
                                                <table class="contents" style="border-spacing:0; width:100%"  bgcolor="#ffffff" >
                                                  <tr>
                                                    <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" align="left"><a href="#" target="_blank"><img src="'. base_url() .'assets/images/logo.png" width="94" alt="" style="border-width:0; max-width:94px;height:auto; display:block" /></a></td>
                                                  </tr>
                                                </table>
                                              </div>
                                              
                                              <!--[if (gte mso 9)|(IE)]>
													</td><td width="80%" valign="top" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;" >
													<![endif]-->
                                              
                                              <div class="column" style="width:100%;max-width:415px;display:inline-block;vertical-align:top;">
                                                <table width="100%" style="border-spacing:0" bgcolor="#ffffff">
                                                  <tr>
                                                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="hide">
                                                        <tr>
                                                          <td height="60">&nbsp;</td>
                                                        </tr>
                                                      </table></td>
                                                  </tr>
                                                  <tr>
                                                    <td class="inner" style="padding-top:10px;padding-bottom:10px; padding-right:10px;padding-left:10px;"><table class="contents" style="border-spacing:0; width:100%" bgcolor="#FFFFFF">
                                                        <tr>
                                                          <td align="right" valign="bottom" class="text"><font style="font-size:14px; text-decoration:none; color:#5b5f65;font-family:Arial, Helvetica, sans-serif"><strong><a href="'.base_url().'Home/about" style="color:#5b5f65; text-decoration:none">ABOUT</a> | <a href="http://rlabsnamibia.org/" style="color:#5b5f65; text-decoration:none">RLABS WEBSITE</a></strong></font></td>
                                                        </tr>
                                                      </table></td>
                                                  </tr>
                                                </table>
                                              </div>
                                              
                                              <!--[if (gte mso 9)|(IE)]>
													</td>
													</tr>
													</table>
													<![endif]--></td>
                                          </tr>
                                          <tr>
                                            <td align="left" style="padding-left:40px"><table border="0" cellpadding="0" cellspacing="0" style="border-bottom:2px solid #ce283d" align="left">
                                                <tr>
                                                  <td height="20" width="30" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                                </tr>
                                              </table></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </center></td>
                          </tr>
                        </tbody>
                      </table></td>
                  </tr>
                </table>
                
                <!-- ======= end header ======= --> 
                
                <!-- ======= start hero image ======= --><!-- ======= end hero image ======= --> 
                
                <!-- ======= start hero article ======= -->
                
                <table class="one-column" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing:0" bgcolor="#FFFFFF">
                  <tr>
                    <td align="left" style="padding:0px 40px 40px 40px"><p style="color:#5b5f65; font-size:28px; text-align:left; font-family: Verdana, Geneva, sans-serif">Hi '.$user->first_name.' '.$user->last_name.', </p>
                      <p style="color:#5b5f65; font-size:16px; text-align:left; font-family: Verdana, Geneva, sans-serif">Congratulations, you became a funder on Namstarter, visit Namstarter to start donating to projects and make a difference.
                      <br />
                        <br />
                       
                        <br />
                        Kind Regards,
                        <br />
                        RLabs Namibia
                         </p>
                      
                      <!-- START BUTTON -->
                      
                      <center>
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td height="20" width="100%" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                                </tr>
                              </table>
                              <table border="0" align="center" cellpadding="0" cellspacing="0" style="Margin:0 auto;">
                                <tbody>
                                  <tr>
                                    <td align="center"><table border="0" cellpadding="0" cellspacing="0" style="Margin:0 auto;">
                                        <tr>
                                          <td width="250" height="60" align="center" bgcolor="#ce283d"><a href="'.base_url().'" style="width:250; display:block; text-decoration:none; border:0; text-align:center; font-weight:bold;font-size:18px; font-family: Arial, sans-serif; color: #ffffff; background:#ce283d" class="button_link">Visit Namstarter</a></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </tbody>
                              </table></td>
                          </tr>
                        </table>
                      </center>
                      
                      <!-- END BUTTON --></td>
                  </tr>
                </table>
                
                <!-- ======= end hero article ======= -->  
                
                 <!-- ======= start footer ======= -->
                
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0" border="0"  bgcolor="#ce283d">
      <tr>
        <td height="40" align="center" bgcolor="#ce283d" class="one-column">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;"><font style="font-size:13px; text-decoration:none; color:#ffffff; font-family: Verdana, Geneva, sans-serif; text-align:center">Head office, RLabs Namibia, 1-3 Gluck Street, Windhoek, Namibia</font></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;"><table width="150" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="33" align="center"><a href="https://www.facebook.com/RLabsNamibia/" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/237854a9-0a06-4f88-a9b8-c36e57e31083.png" alt="facebook" width="32" height="32" border="0"/></a></td>
            <td width="34" align="center"><a href="https://twitter.com/rlabsnam" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/2fb3f578-f70a-41b6-9bbc-f99a174d6456.png" alt="twitter" width="32" height="32" border="0"/></a></td>
            <!-- <td width="33" align="center"><a href="https://twitter.com/rlabsnam" target="_blank"><img src="https://gallery.mailchimp.com/fdcaf86ecc5056741eb5cbc18/images/17c02388-c25e-4eb5-a7cc-8f34458a50ad.png" alt="linkedin" width="32" height="32" border="0"/></a></td> -->
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px;"><font style="font-size:13px; text-decoration:none; color:#ffffff; font-family: Verdana, Geneva, sans-serif; text-align:center">All rights reserved. <a href="http://www.rlabsnamibia.org/" target="_blank" style="color:#ffffff; text-decoration:underline">RLabs Namibia</a></font></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#ce283d" class="one-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">&nbsp;</td>
      </tr>
      <tr>
        <td height="6" bgcolor="#ce283d" class="contents1" style="width:100%; border-bottom-left-radius:10px; border-bottom-right-radius:10px"></td>
      </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellpadding="0" cellspacing="0" border="0"> 
      <tr>
        <td height="6" bgcolor="#ce283d" class="contents" style="width:100%; border-bottom-left-radius:10px; border-bottom-right-radius:10px"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

               <!-- ======= end footer ======= --></td>
            </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
					</td>
				</tr>
			</table>
			<![endif]--> 
        </div></td>
    </tr>
  </table>
</center>
</body>
</html>');

$this->email->send();
            redirect('Funder/details');
        } else {
            $this->load->view("funder/create", $data);
        }
    }
}
