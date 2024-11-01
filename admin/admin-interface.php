<?php 

//**admin page
include_once( 'uploader/class-coupan-images-uploader.php' );
function wp_signup_discount_page(){
ob_start();
global $wp_sign_up_option,$Woocommerce_Signup_Discount_template_uploader;
$name_attribute=""; $id_attribute="";$default=""; $option_value=""; $class=""; $value['css']=""; $value['name']="";		
$settings = array('teeny'=>'true','textarea_rows'=>50); 					
  ?>

<div class="signup-wrap">



  <form action="options.php" method="post">
    <?php settings_fields('signup_discount_group'); ?>
    <?php do_settings_sections('signup_discount_group'); ?>
    <h1>Signup To Get Discount Settings </h1>
    
    <h2 class="nav-tab-wrapper"> <a class="nav-tab nav-tab-active" id="tab-1" href="javascript:(void);" >General</a> <a class="nav-tab" id="tab-2"  href="javascript:(void);">Popup</a> </h2>
    <?php if($wp_sign_up_option['verification_code'] != "XXYYMMKKCOOL4568"){ ?>
    <div class="shield" style="opacity: 0.59; position: fixed; display: block;  background: none repeat scroll 0 0 #333333; height: 100%; left: 0; top: 0;  width: 100%; z-index: 1000;"></div>
<div style="z-index:12000;  left: 15%; width:400px; min-height:200px; margin:auto; position:absolute; background: none repeat scroll 0 0 #ffffff;  border: 1px solid #ffffff; border-radius: 12px;  box-shadow: 0 0 19px #474747; padding:10px;">

		hello <br /><br />
        Welcome To WooCommerce Signup To Get Discounts<br /><br />
        A big HEARTY Thank you for your Download <br /><br />
        
        I want to build more plugin for help. i hope you help me <br /><br />
        
        so please give good Rating   to this plugin. click  <a href="https://wordpress.org/support/view/plugin-reviews/woocommerce-signup-to-get-discount"> here </a><br /><br /> if you give good Rating  to this plugin then send mail on "kirtikanani9@gmail.com" and  get  Verification Code  Within 2 to 10 hour on  email address  <br /><br />
        
        Verification Code  <input  type="text" placeholder="Enter Verification Code"  name="signup_discount_setting[verification_code]" />
        <?php submit_button(); ?>
         
</div>
<?php } ?>
    <table class="widefat importers " style="width: 98%;">
      <tbody>
        <tr>
          <td><table class="widefat importers general" style="width: 98%;">
              <tbody>
                <tr class="alternate">
                  <td colspan="2"><h2>Email Setting </h2></td>
                </tr>
                <tr class="alternate">
                  <td class="import-system row-title">Email Subject</td>
                  <td class="desc"><h6 style="padding:0; margin:0px;">Use this for mail Subject</h6>
		 <input type="text" size="75" value="<?php echo $wp_sign_up_option['email_subject']; ?>" name="signup_discount_setting[email_subject]" />
 				</td>
                </tr>
                <tr class="alternate">
                  <td class="import-system row-title">Header image: </td>
                  <td class="desc" style="width: 80%;"><h6 style="padding:0; margin:0px;"> The image you want to show in the email's header</h6>
                    <?php
                            $name_attribute="signup_discount_setting[header_image]";
                            $id_attribute="header_image";	
                         
                            echo $Woocommerce_Signup_Discount_template_uploader->signup_discount_upload_input( $name_attribute, $id_attribute, $option_value,$wp_sign_up_option['header_image'], esc_html( $value['name'] ), $class, esc_attr( $value['css'] ) , '' );
                     ?>
                     </td>
                </tr>
                <tr class="alternate">
                  <td class="import-system row-title" valign="middle">Mail Body :</td>
                  <td class="desc"><?php
						$content = $wp_sign_up_option['mailbody'];
						$editor_id   = 'mailbody_editor_1';
						$editor_name = 'signup_discount_setting[mailbody]';
						$settings    = array ('tabindex'=> FALSE,'editor_height' => 150,'resize'=> TRUE,'textarea_name' => $editor_name);
						wp_editor($content,$editor_id,$settings);
				 ?></td>
                </tr>
                <tr class="alternate">
                  <td class="import-system row-title">Mail Footer: </td>
                  <td class="desc"><?php					
						$content = $wp_sign_up_option['mailfooter'];
						$editor_id   = 'mailfooter_editor_1';
						$editor_name = 'signup_discount_setting[mailfooter]';
						$settings    = array('tabindex' => FALSE,'editor_height' => 150,'resize' => TRUE,'textarea_name' => $editor_name);						
						wp_editor( $content, $editor_id,$settings);
				 ?></td>
                </tr>
              </tbody>
            </table>
            <?php /* Table Popup Setting */?>
            <table class="widefat importers popup" style="width: 98%; display:none">
              <tbody>
                <tr>
                  <td colspan="2"><h2>WooCommerce Setting </h2></td>
                </tr>
                <tr class="alternate">
                  <td class="import-system row-title">Coupon Name
                    <h6 style="padding:0; margin:0px;">(Use here  Woocommerce Coupon )</h6></td>
                  <td class="desc"><h6 style="padding:0; margin:0px;"> Click <a href="edit.php?post_type=shop_coupon">Here</a> To Create Coupon</h6>
                    <input type="text" size="75" value="<?php echo $wp_sign_up_option['Coupon_Name']; ?>" name="signup_discount_setting[Coupon_Name]" /></td>
                </tr>
                <tr>
                  <td colspan="2"><h2>Popup Setting </h2></td>
                </tr>
                <tr>
                  <td colspan="2"></td>
                </tr>
                <tr class="alternate">
                  <td class="import-system row-title">Link Text: </td>
                  <td class="desc"  style="width: 696px;"><h6 style="padding:0px; margin:0px;">Enter here Text  Like SIGN UP & GET 25.50 USD &nbsp;&nbsp; Use Shortcode [WC_Signuptoget_Discount_Popup]</h6>
                    <input type="text" size="75" value="<?php echo $wp_sign_up_option['link_text']; ?>" name="signup_discount_setting[link_text]" /></td>
                </tr>
                <tr class="alternate">
                  <td class="import-system row-title">Left Image: </td>
                  <td class="desc" style="width: 80%;"><h6 style="padding:0; margin:0px;"> The image you want to show in the Popup</h6>
                    <?php
                            $name_attribute="signup_discount_setting[popup_image]";
                            $id_attribute="popup_image";	
                            $default="";
                            echo $Woocommerce_Signup_Discount_template_uploader->signup_discount_upload_input( $name_attribute, $id_attribute, $option_value,$wp_sign_up_option['popup_image'], esc_html( $value['name'] ), $class, esc_attr( $value['css'] ) , '' );
                     ?></td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        <tr class="alternate">
          <td colspan="2" ><?php submit_button(); ?></td>
        </tr>
      </tbody>
    </table>
  </form>
</div>
<?php 
echo ob_get_clean();
}

//**admin tab
function wp_signup_discount_tab(){
	add_options_page("Signup To Get Discount","Signup To Get Discount","manage_options","wp_signup_discount","wp_signup_discount_page");
}
add_action('admin_menu','wp_signup_discount_tab');

//**ragister setting 
function wp_signup_discount_setting(){
	register_setting('signup_discount_group','signup_discount_setting'); 
} 
add_action( 'admin_init','wp_signup_discount_setting');

