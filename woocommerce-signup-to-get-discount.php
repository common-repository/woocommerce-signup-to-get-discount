<?php 

/*

Plugin Name: Woocommerce Signup To Get Discount

Plugin URI: http://3starinfo.com/

Description: Signup To get discount coupon code using woocommerce

Author: kirtikanani

Version: 1.0

Author URI: http://kananikirti.wordpress.com/

*/



/********

Global

********/

global $wp_sign_up_option,$WC_myaccount_page_url;

$wp_sign_up_option=get_option("signup_discount_setting");
$WC_myaccount_page_url=get_option("woocommerce_myaccount_page_id");


//**orignal article



//admin setting

include('admin/admin-interface.php');

//set default  Admin option 
$defaultmailbody='<table border="0" width="100%" cellspacing="0" cellpadding="0"><tbody>
				<tr><td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;"><b>Lorem ipsum dolor sit amet!</b></td></tr>
				<tr><td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tempus adipiscing felis, sit amet blandit ipsum volutpat sed. Morbi porttitor, eget accumsan dictum, nisi libero ultricies ipsum, in posuere mauris neque at erat.</td></tr>
				</tbody>
				</table>';
$defaultmailfooter='<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="color: #ffffff; font-size: 14px;" width="75%">© Copyright 2014 By 3starinfo.com</td>
<td align="right" width="25%">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-size: 12px; font-weight: bold;"><a style="color: #ffffff;" href="http://www.twitter.com/">
<img style="display: block;" src="'.plugins_url( "/images/tw.png",__FILE__).'" alt="Twitter" width="38" height="38" border="0" />
</a></td>
<td style="font-size: 0; line-height: 0;" width="20"></td>
<td style=" font-size: 12px; font-weight: bold;"><a style="color: #ffffff;" href="http://facebook.com/">
<img style="display: block;" src="'.plugins_url( "/images/fb.png",__FILE__).'" alt="Facebook" width="38" height="38" border="0" />
</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>';


function my_plugin_init() {	
 	$default=array(
	'email_subject'=>'Signup To Get Discount',
	'header_image'=>plugins_url( "/images/wcemailhd.png",__FILE__),
	'mailbody'=>$defaultmailbody,
	'mailfooter'=>$defaultmailfooter,
	'Coupon_Name'=>"",
	'link_text'=>"SIGN UP & GET 00.00 USD",
	'popup_image'=>plugins_url( "/images/signup.png",__FILE__));
  add_option('signup_discount_setting',$default); 
}
add_action( 'plugins_loaded', 'my_plugin_init' );
// short code for popup link
include 'shortcode.php';
function ajaxResponse(){
	include 'add_user_data.php';		
}
add_action('wp_ajax_ak_attach', 'ajaxResponse');
add_action('wp_ajax_nopriv_ak_attach', 'ajaxResponse');
if(!is_admin()){
	if(!function_exists('WC_Signuptoget_Discount')){
		function WC_Signuptoget_Discount_loader()
		{
				global $wpdb;			
				wp_enqueue_script('signuppopup-prototype');		
				wp_enqueue_script('signuppopup', plugins_url( "/js/signuppopup.js",__FILE__));			
				wp_enqueue_style( 'style-signuppopup', plugins_url( "/css/signuppopup.css",__FILE__) );				
		}
	add_action('wp_head', 'WC_Signuptoget_Discount_loader');
}}
if(!is_admin()){
	if(!function_exists('WC_Signuptoget_Discount_loader_html')){
	function WC_Signuptoget_Discount_loader_html()
	{
		include 'popuphtml.php';		
	}
	add_action('wp_footer', 'WC_Signuptoget_Discount_loader_html');
}}
function WC_apply_coupons(){
	global $woocommerce,$wp_sign_up_option;
	$user_ID = get_current_user_id();	
	$coupon_code = $wp_sign_up_option['Coupon_Name'];
    $getoff=get_user_meta($user_ID,'get_off',true);
	if($_POST['wccoupancode']==$coupon_code){
		if ($getoff != '1'){
			$woocommerce->cart->remove_coupons($coupon_code);	
			echo $_SERVER['HTTP_REFERER'];
		
		}else{
			echo 'removecoupan';	
		}
	}
	exit;
}
add_action('wp_ajax_apply_matched_coupons', 'WC_apply_coupons');
add_action('wp_ajax_nopriv_apply_matched_coupons', 'WC_apply_coupons');