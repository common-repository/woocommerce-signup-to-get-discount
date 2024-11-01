<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/*-----------------------------------------------------------------------------------
Signup Discount Plugin Uploader
TABLE OF CONTENTS
- var signup_discount_admin_uploader_url
- __construct()
- signup_discount_admin_uploader_url()
- signup_discount_uploader_js()
- signup_discount_uploader_style()
- signup_discount_uploader_init()
- signup_discount_get_silentpost()
- signup_discount_upload_input()
- signup_discount_change_button_text()
- signup_discount_modify_tabs()
- signup_discount_inside_popup()

-----------------------------------------------------------------------------------*/

class Woocommerce_Signup_Discount_Template_Uploader 

{

	public $plugin_name = 'woocommerce_signup_discount';

	/**

	 * @var string

	 */

	private $signup_discount_admin_uploader_url;

	

	/**

	 * @var string

	 */

	private $custom_post_type_image = 'wp_email_images';

	

	/**

	 * @var string

	 */

	private $custom_post_type_name = 'Custom Image Type For Uploader';

	

	/*-----------------------------------------------------------------------------------*/

	/* Admin Uploader Constructor */

	/*-----------------------------------------------------------------------------------*/

	public function __construct() {

		if ( is_admin() ){

			add_action( 'init', array( $this, 'signup_discount_uploader_init' ) );

			add_action( 'admin_print_scripts', array( $this, 'signup_discount_inside_popup' ) );

			add_filter( 'gettext', array( $this, 'signup_discount_change_button_text' ), null, 3 );

			

			// include scripts to Admin UI Interface

			

			add_action( 'init', array( $this, 'signup_discount_uploader_js' ) );

			

			// include styles to Admin UI Interface

			add_action( 'init', array( $this, 'signup_discount_uploader_style' ) );

		

			

		}		

	}

	

	/*-----------------------------------------------------------------------------------*/

	/* signup_discount_admin_uploader_url */

	/*-----------------------------------------------------------------------------------*/

	

	public function signup_discount_admin_uploader_url() {

		return $this->signup_discount_admin_uploader_url = untrailingslashit( plugins_url( '/', __FILE__ ) );

	}

	

	/*-----------------------------------------------------------------------------------*/

	/* Include Uploader Script */

	/*-----------------------------------------------------------------------------------*/

	public function signup_discount_uploader_js () {

		wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'thickbox' );

		wp_enqueue_script( 'wsd-uploader-script',plugins_url( "uploader-script.js",__FILE__));

		wp_enqueue_script( 'media-upload' );

	}

	

	/*-----------------------------------------------------------------------------------*/

	/* Include Uploader Style */

	/*-----------------------------------------------------------------------------------*/

	public function signup_discount_uploader_style () {

		wp_enqueue_style( 'thickbox' );

		wp_enqueue_style( 'wsd-uploader-style', plugins_url( "uploader.css",__FILE__));

	}



	

	/*-----------------------------------------------------------------------------------*/

	/* Uploader Init : Create Custom Post for Image */

	/*-----------------------------------------------------------------------------------*/

	public function signup_discount_uploader_init () {

		register_post_type( $this->custom_post_type_image, array(

			'labels' => array(

				'name' => $this->custom_post_type_name,

			),

			'public' => true,

			'show_ui' => false,

			'capability_type' => 'post',

			'hierarchical' => false,

			'rewrite' => false,

			'supports' => array( 'title', 'editor' ),

			'query_var' => false,

			'can_export' => true,

			'show_in_nav_menus' => false

		) );

	}

	

	/*-----------------------------------------------------------------------------------*/

	/* Get Post Id of Custom Post for Image */

	/*-----------------------------------------------------------------------------------*/

	public function signup_discount_get_silentpost ( $option_key = '' ) {

		global $wpdb;

		$post_id = 1;

		if ( $option_key != '' ) {

			$args = array( 

				'post_parent' => '0', 

				'post_type' => $this->custom_post_type_image, 

				'post_name' => $option_key, 

				'post_status' => 'draft', 

				'comment_status' => 'closed', 

				'ping_status' => 'closed'

			);

			$my_posts = get_posts( $args );

			if ( $my_posts ) {

				foreach ($my_posts as $my_post) {

					$post_id = $my_post->ID;

					break;

				}

			} else {

				$args['post_title'] = str_replace('_', ' ', $option_key);

				$post_id = wp_insert_post( $args );

			}

		}

		return $post_id;

	}

	

	/*-----------------------------------------------------------------------------------*/

	/* Get Upload Signup Discount_ Input Field */

	/*-----------------------------------------------------------------------------------*/

	public function signup_discount_upload_input( $name_attribute, $id_attribute = '', $value = '', $default_value = '', $field_name = '', $class = '', $css = '', $description = '', $post_id = 0 ) {

		$output = '';

		

		if ( $post_id == 0 ) {

			$post_id = $this->signup_discount_get_silentpost( $id_attribute );

		}

		

		if ( trim( $value ) == '' ) $value = trim( $default_value );

		

		$output .= '<input type="text" name="'.$name_attribute.'" id="'.$id_attribute.'" value="'.esc_attr( $value ).'" class="'.$id_attribute. ' ' .$class.' signup_discount_upload" style="'.$css.'" rel="'.$field_name.'" /> ';

		$output .= '<input id="upload_'.$id_attribute.'" class="wsdrev-ui-upload-button wsd_upload_button button" type="button" value="'.__( 'Upload', 'wp_email_template' ).'" rel="'.$post_id.'" /> '.$description;

		

		$output .= '<div style="clear:both;"></div><div class="wsd_screenshot" id="'.$id_attribute.'_image" style="'.( ( $value == '' ) ? 'display:none;' : 'display:block;' ).'">';



		if ( $value != '' ) {

			$remove = '<a href="javascript:(void);" class="wsd_uploader_remove wsd-plugin-ui-delete-icon">&nbsp;</a>';



			$image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value );



			if ( $image ) {

				$output .= '<img class="wsd_uploader_image" src="' . esc_url( $value ) . '" alt="" />'.$remove.'';

			} else {

				$parts = explode( "/", $value );



				for( $i = 0; $i < sizeof( $parts ); ++$i ) {

					$title = $parts[$i];

				}



				$output .= '';



				$title = __( 'View File', 'wp_email_template' );



				$output .= '<div class="wsd_no_image"><span class="wsd_file_link"><a href="'.esc_url( $value ).'" target="_blank" rel="wsd_external">'.$title.'</a></span>'.$remove.'</div>';



			}

		}



		$output .= '</div>';



		return $output;

	}

	

	/*-----------------------------------------------------------------------------------*/

	/* Change the Button text on image popup */

	/*-----------------------------------------------------------------------------------*/

	public function signup_discount_change_button_text( $translation, $original, $domain ) {

	    if ( isset( $_REQUEST['type'] ) ) { return $translation; }

	    

	    if ( is_admin() && $original === 'Insert into Post' ) {

	    	$translation = __( 'Use this Image', 'wp_email_template' );

			if ( isset( $_REQUEST['title'] ) && $_REQUEST['title'] != '' ) { $translation =__( 'Use as', 'wp_email_template' ).' '.esc_attr( $_REQUEST['title'] ); }

	    }

	

	    return $translation;

	}

	

	/*-----------------------------------------------------------------------------------*/

	/* signup_discount_modify_tabs */

	/*-----------------------------------------------------------------------------------*/

	public function signup_discount_modify_tabs ( $tabs ) {

		if ( isset( $tabs['gallery'] ) ) { $tabs['gallery'] = str_replace( 'Gallery', __( 'Previously Uploaded', 'wp_email_template' ), $tabs['gallery'] ); }

		return $tabs;

	}

	

	/*-----------------------------------------------------------------------------------*/

	/* signup_discount_inside_popup */

	/*-----------------------------------------------------------------------------------*/

	public function signup_discount_inside_popup () {

		if ( isset( $_REQUEST['signup_discount_uploader'] ) && $_REQUEST['signup_discount_uploader'] == 'yes' ) {

			add_filter( 'signup_discount_media_upload_tabs', array( $this, 'signup_discount_media_upload_tabs' ) );

		}

	}

	

}
global $Woocommerce_Signup_Discount_template_uploader;
$Woocommerce_Signup_Discount_template_uploader = new Woocommerce_Signup_Discount_Template_Uploader();