<?php global $wp_sign_up_option,$WC_myaccount_page_url; ?>
<script type="text/javascript">
var siteurl='<?php echo  get_option('siteurl'); ?>';
var WC_myaccount_page_url='<?php echo  get_permalink($WC_myaccount_page_url); ?>';
</script>
<div id="signup-popup" style="display:none;">

<div class="signup-content">

	<div class="popup-ragister-form">

	<div class="filde-row titledive">

	<div class="sign-title">	<h2>Sign Up</h2></div><div class="alread-ragister">Already Registered? <a href="<?php echo get_permalink($WC_myaccount_page_url); ?>">Login Here..</a></div>

		<div style="clear:both"></div>

	</div>

<div class="filde-row" id="resorce-info"></div>
<div class="filde-row" id="resorce-error"></div>
		<form action="<?php  echo get_option('siteurl')?><?php echo $_SERVER['REDIRECT_URL']; ?>" method="post">

		<input type="hidden" name="popupsignup" value="1" />

		

			<div class="filde-row">

			<div class="lable">Name</div><div class="text-field"><input  value="" type="text" name="user-first-name" id="user-first-name" placeholder="First Name" />&nbsp;<input type="text" id="user-last-name" value="" name="user-last-name" placeholder="Last Name" /></div>

			</div>

			<div class="filde-row"><div class="lable">Email</div><div class="text-field"><input value="" placeholder="example@example.com" type="text" name="user-email" id="user-email" /></div></div>

			<div class="filde-row"><div class="lable"> Mobile</div><div class="text-field"><input value="" type="text" placeholder="mobile" name="user-mobile" id="user-mobile" /></div></div>

			<div class="filde-row"><div class="lable">Password</div><div class="text-field"><input value="" type="password" placeholder="Enter Password" name="user-password" id="user-password" />&nbsp;<input type="password" value="" placeholder="Confirm Password" id="confirem-user-password" name="confirem-user-password" /></div></div>

			<div style="clear:both"></div>

			

			<div class="filde-row"><div class="button-signup-div"><input  type="button" id="submit-f" value="signup"  class="button-signup" /></div></div>

			

			

		</form>

		<a id="popupBoxClose"></a> 

</div>

<div class="offer-div">

	<?php echo '<img width="100%;" src="' .$wp_sign_up_option['popup_image']. '" title="" alt="" > '; ?>

	

</div>

</div>

	   

</div>

<div class="shield"></div>

