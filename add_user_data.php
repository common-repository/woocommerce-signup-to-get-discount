<?php 

global $wp_sign_up_option,$WC_myaccount_page_url;

$user_name=$_POST['userfirstname'];
$email=$_POST['email']; 
$lname=$_POST['lastname'];
$passw=$_POST['userpassword']; 
$usermobile=$_POST['usermobile']; 
$mass="sign up ";
require_once(ABSPATH . WPINC . '/pluggable.php' );
$useremail = get_user_by('email', $email);
$username = get_user_by('login', $user_name);
if($useremail != NULL){	$mass="This email address is already registered";}
elseif($username != NULL){

		$mass="This user name is already registered";

}else{

		$userdata = array('user_login' => $user_name,'first_name' => $fname,'last_name' => $lname,'user_pass' => $passw,'user_email' => $email,'user_url' => $user_url,'role' => $role);
		$user_id = wp_insert_user($userdata);
		add_user_meta( $user_id, 'get_off','1',$unique );		
		$mass="sign up successfully, check your mail box or click <a href='".get_permalink($WC_myaccount_page_url)."'><b>here</b> </a>to  login";
		$to=$email;
		$from=get_settings('admin_email') or die('test tets admin mail');
		$subject=$wp_sign_up_option['email_subject'];
		$message = '<html><head>
							<title>'.$subject.'</title>
							</head>
							<body style="margin: 0; padding: 0;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">	
								<tr>
									<td style="padding: 10px 0 30px 0;">
										<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
											<tr>
												<td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
													<img src="'.$wp_sign_up_option['header_image'].'" alt="woocommerce sign up  &  get-discount" width="100%"  style="display: block;" />
												</td>
											</tr>
											
											<tr>
												<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
													'.$wp_sign_up_option['mailbody'].'<br>
													<b>When you place an order just use the coupon code `<h3>'.$wp_sign_up_option['Coupon_Name'].'</h3>`</b>
												</td>
											</tr>
											<tr>
												<td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">'.$wp_sign_up_option['mailfooter'].'</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							</body>
							</html>';			

							// Always set content-type when sending HTML email
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";							
							// More headers
							$headers .= 'From:'.$from. "\r\n";
							//$headers .= 'Cc:'.$from. "\r\n";
							if(mail($to,$subject,$message,$headers)){//echo $mass1= "Your Massage has been successfully send";
									}



}echo $mass; exit; ?>