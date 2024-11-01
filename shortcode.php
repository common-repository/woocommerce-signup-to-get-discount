<?php 

function WC_Signuptoget_Discount_Popup( $atts ){	

global $wp_sign_up_option;
$wp_sign_up_option['Coupon_Name'];
$user_ID = get_current_user_id();
if($user_ID==NULL){
	if($wp_sign_up_option['Coupon_Name'] != NULL){
 echo '<ul class="wc-signup-main"><li ><a id="signup-popup-link-1" class="signup-popup-link" href="javascript:void(0)"><span id="signup-text">'.$wp_sign_up_option['link_text'].'</span></a></li></ul>';
	}else{
		echo '<ul class="wc-signup-main"><li >Check Signup To Get Discount Setting And Set Coupon </li></ul>';
	}
}

}

add_shortcode( 'WC_Signuptoget_Discount_Popup', 'WC_Signuptoget_Discount_Popup' );

?>