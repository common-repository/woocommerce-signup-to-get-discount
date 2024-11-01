(function ($) {
	$(document).on( 'click', '#tab-1', function(){		
			$(".popup").css("display","none");
			$(".general").css("display","block");	
			$("#tab-2").removeClass("nav-tab-active");
			$(this).addClass("nav-tab-active");	
	});
	$(document).on( 'click', '#tab-2', function (){
			$(".popup").css("display","block");
			$(".general").css("display","none");	
			$(this).addClass("nav-tab-active");
			$("#tab-1").removeClass("nav-tab-active");	
	});
wsdUploader = {
	removeFile: function () {
		$(document).on( 'click', '.wsd_uploader_remove', function(event) { 
			$(this).hide();
			$(this).parents().parents().children( '.wsd_upload').attr( 'value', '' );
			$(this).parents( '.wsd_screenshot').slideUp();
			
			return false;
		});
	},
	
	mediaUpload: function () {
		jQuery.noConflict();
		
		var formfield, formID, upload_title, btnContent = true;
	
		$(document).on( 'click', 'input.wsd_upload_button', function () {
			formfield = $(this).prev( 'input').attr( 'id' );
			formID = $(this).attr( 'rel' );
			upload_title =  $(this).prev( 'input').attr( 'rel' );
								   
			tb_show( upload_title, 'media-upload.php?post_id='+formID+'&amp;title=' + upload_title + '&amp;wsd_uploader=yes&amp;TB_iframe=1' );
			return false;
		});
				
		window.original_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html) {
			if (formfield) {
				if ( $(html).html(html).find( 'img').length > 0 ) {
					itemurl = $(html).html(html).find( 'img').attr( 'src' );
				} else {
					var htmlBits = html.split( "'" );
					itemurl = htmlBits[1]; 
					var itemtitle = htmlBits[2];
					itemtitle = itemtitle.replace( '>', '' );
					itemtitle = itemtitle.replace( '</a>', '' );
				}
				var image = /(^.*\.jpg|jpeg|png|gif|ico*)/gi;
				var document = /(^.*\.pdf|doc|docx|ppt|pptx|odt*)/gi;
				var audio = /(^.*\.mp3|m4a|ogg|wav*)/gi;
				var video = /(^.*\.mp4|m4v|mov|wmv|avi|mpg|ogv|3gp|3g2*)/gi;
			  
				if (itemurl.match(image)) {
					btnContent = '<img class="wsd_uploader_image" src="'+itemurl+'" alt="" /><a href="#" class="wsd_uploader_remove wsd-plugin-ui-delete-icon">&nbsp;</a>';
				} else {
					html = '<a href="'+itemurl+'" target="_blank" rel="wsd_external">View File</a>';
					btnContent = '<div class="wsd_no_image"><span class="wsd_file_link">'+html+'</span><a href="#" class="wsd_uploader_remove wsd-plugin-ui-delete-icon">&nbsp;</a></div>';
				}
				$( '#' + formfield).val(itemurl);
				$( '#' + formfield).siblings( '.wsd_screenshot').slideDown().html(btnContent);
				tb_remove();
			} else {
				window.original_send_to_editor(html);
			}
			formfield = '';
		}
	}
};
	
	$(document).ready(function () {

		wsdUploader.removeFile();
		wsdUploader.mediaUpload();
	
	});

})(jQuery);
