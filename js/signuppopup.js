jQuery(document).ready( function() {
	 // When site loaded, load the Popupbox First
	 jQuery('.checkout_coupon .button').click( function(){     
	var myintVar =setInterval(function(){
		 		var wccoupancode = jQuery("#coupon_code").val();
				jQuery.ajax({
						type: "POST",
						url: siteurl+"/wp-admin/admin-ajax.php",
						data: { action:"apply_matched_coupons",wccoupancode:wccoupancode}						
				}).done(function(msg) {
					clearInterval(myintVar);
					msg =jQuery.trim(msg);
					//alert(msg);
					if(msg == 'removecoupan'){ 
						//alert('test');
					}else{
						window.location.href = msg; 
					}
						
				});
		},3000);
				
	 });
	jQuery('.signup-popup-link').click( function(){           
            loadPopupBox();
        });		
		jQuery('#submit-f').click( function(){

					var firstname = jQuery( "#user-first-name" ).val();
					var email=jQuery( "#user-email" ).val();
					var lastname=jQuery( "#user-last-name" ).val();
					var usermobile=jQuery( "#user-mobile" ).val();
					var userpassword=jQuery( "#user-password" ).val();
					var confiremuserpassword=jQuery( "#confirem-user-password" ).val();		
					//alert(document.getElementById("user-first-name").value);					

if(document.getElementById("user-first-name").value == "" || email == null || email == "" || lastname == null || lastname == " " || userpassword == "" || confiremuserpassword == "" || !validateEmail(email) ){				
				if(document.getElementById("user-first-name").value == ""){
							jQuery('#resorce-error').html("name is required ");
							jQuery("#resorce-error").css("display","block" );
							jQuery('html, body').animate({scrollTop: "0px"}, 800);
							setTimeout(function () {
								jQuery("#resorce-error").fadeOut('slow');
							}, 3000);
							return false;
				}
				if(lastname == ""){
							jQuery('#resorce-error').html("Last Name is required ");
							jQuery("#resorce-error").css("display","block" );
							jQuery('html, body').animate({scrollTop: "0px"}, 800);
							setTimeout(function () {
								jQuery("#resorce-error").fadeOut('slow');
							}, 3000);
							return false;
				}
				if(email == ""){
							jQuery('#resorce-error').html("Email is required ");
							jQuery("#resorce-error").css("display","block" );
							jQuery('html, body').animate({scrollTop: "0px"}, 800);
							setTimeout(function () {
								jQuery("#resorce-error").fadeOut('slow');
							}, 3000);
							return false;
				}
				if(!validateEmail(email)){
							jQuery('#resorce-error').html("This  email address is not valid.");
							jQuery("#resorce-error").css("display","block" );
							jQuery('html, body').animate({scrollTop: "0px"}, 800);
							setTimeout(function () {
								jQuery("#resorce-error").fadeOut('slow');
							}, 3000);
							return false;
				}
				if(userpassword == ""){
							jQuery('#resorce-error').html("Password is required");
							jQuery("#resorce-error").css("display","block" );
							jQuery('html, body').animate({scrollTop: "0px"}, 800);
							setTimeout(function () {
								jQuery("#resorce-error").fadeOut('slow');
							}, 3000);
							return false;
				}
				if(confiremuserpassword != userpassword){
							jQuery('#resorce-error').html("Password Confirmation Does not Match");
							jQuery("#resorce-error").css("display","block" );
							jQuery('html, body').animate({scrollTop: "0px"}, 800);
							setTimeout(function () {
								jQuery("#resorce-error").fadeOut('slow');
							}, 3000);
							return false;
				}											

}else{
	
		jQuery.ajax({
				  		type: "POST",
						url: siteurl+"/wp-admin/admin-ajax.php",
						data: { action:"ak_attach",userfirstname:firstname,email:email,lastname:lastname,usermobile:usermobile,userpassword:userpassword}					
				})
				.done(function(msg){
									var n=msg.indexOf("successfully");		
									//alert(n);							
									if(n != '-1'){
											
											jQuery('.popup-ragister-form  form').html("");	
											jQuery('#resorce-info').html(msg);		
											jQuery("#resorce-info").css("display","block" );	
											setTimeout(function(){window.location.href=WC_myaccount_page_url;},5000);							
									}
							       var username=msg.indexOf("user");
         						   if(username != '-1'){
												jQuery('#resorce-error').html(msg);
												jQuery("#resorce-error").css("display","block" );
												jQuery('html, body').animate({scrollTop: "0px"}, 800);
												setTimeout(function () {
													jQuery("#resorce-error").fadeOut('slow')
												}, 3000);
									}
									var emailal=msg.indexOf("email");
									if(emailal != '-1'){
												jQuery('#resorce-error').html(msg);
												jQuery("#resorce-error").css("display","block");
												jQuery('html, body').animate({scrollTop: "0px"}, 800);
												setTimeout(function () {
													jQuery("#resorce-error").fadeOut('slow')
												}, 3000);
									}
						});
					}
});
jQuery('#popupBoxClose').click(function(){
            unloadPopupBox();
});
jQuery('.shield').click( function(){
          unloadPopupBox();
});
function unloadPopupBox() {    // TO Unload the Popupbox

           jQuery('#signup-popup').fadeOut("slow");
           jQuery(".shield").css({ // this is just for style       
                "opacity": "1" 
            });
		   jQuery(".shield").css({ // this is just for style       
               "display": "none"
            });
}   
function loadPopupBox() {  // To Load the Popupbox
            jQuery('#signup-popup').fadeIn("slow");
            jQuery(".shield").css({ // this is just for style
                "opacity": "0.59" 
            });   
        	 jQuery(".shield").css({ // this is just for style       
               "position": "fixed"
            });	
        	 jQuery(".shield").css({ // this is just for style       
               "display": "block"
            });	

      }     
function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( $email ) ) {
    return false;
  } else {
    return true;
  }
}  

});

