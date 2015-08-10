<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
function df_customFShare() {
	$link = $_POST['link'];
    $like_array = json_response('http://graph.facebook.com/fql?q=SELECT%20url,%20share_count%20FROM%20link_stat%20WHERE%20url="'. $link .'"');
    if($like_array!=false) {
		if(isset($like_array->data[0]->share_count)) {
			$like_count =  intval($like_array->data[0]->share_count);
		} else {
			$like_count = 0;
		}
		
		if(is_int($like_count)) {
			echo $like_count;
		} else {
			echo 0;
		}
	}
	die();
}

/* -------------------------------------------------------------------------*
 * 							RATING SYSTEM									*
 * -------------------------------------------------------------------------*/
 
function rating_system() {
	$value = $_POST['value'];
	$postID = $_POST['post_id'];
	
	$totalVotesOld = get_post_meta( $postID, THEME_NAME."_total_votes", true );
	if(!$totalVotesOld) $totalVotesOld = 0;
	$votes = $totalVotesOld + 1;
	update_post_meta( $postID, THEME_NAME."_total_votes", $votes, $totalVotesOld ); 

	$totalRatingOld = get_post_meta( $postID, THEME_NAME."_total_rating", true );
	if(!$totalRatingOld) $totalRatingOld = 0;
	$rating = $totalRatingOld + $value;
	update_post_meta( $postID, THEME_NAME."_total_rating", $rating, $totalRatingOld ); 

	echo round($rating/$votes);

	die();

}


/* -------------------------------------------------------------------------*
 * 							DYNAMIC CSS LOAD								*
 * -------------------------------------------------------------------------*/
 
function df_dynamic_css() {
  	require_once(get_template_directory().'/lib/css/dynamic-css.php');
  	require_once(get_template_directory().'/lib/css/fonts.php');
  	die();
}
/* -------------------------------------------------------------------------*
 * 							DYNAMIC JS LOAD								*
 * -------------------------------------------------------------------------*/
 
function df_dynamic_js() {
  	require_once(get_template_directory().'/lib/js/scripts.php');
  	die();
}

/* -------------------------------------------------------------------------*
 * 					HOMEPAGE SAVE DRAG&DROP OPTIONS							*
 * -------------------------------------------------------------------------*/
 
function df_save_options() {
	$fields = $_REQUEST;
	if (current_user_can('edit_pages', get_current_user_id())) {
		foreach($fields as $key => $field) {
			if($key!="action") {
				//echo $key."-".$field;
				update_option($key,$field);
			}
		}
	}


	die();

}

/* -------------------------------------------------------------------------*
 * 					MANAGEMENT PANEL OPTION SAVE							*
 * -------------------------------------------------------------------------*/
 
function df_management_save() {
	global $different_themes_managment;
	$options = $different_themes_managment->get_options();

	$nonsavable_types = array(
		'navigation', 
		'tab',
		'sub_navigation',
		'meta_sub_navigation',
		'sub_tab',
		'meta_sub_tab',
		'homepage_set_test',
		'save',
		'closesubtab',
		'closetab',
		'row',
		'close'
	);

	//insert the default values if the fields are empty
	foreach ($options as $value) {
		if( isset( $value['id'] ) && get_option($value['id'])=='' && isset($value['std']) && !in_array($value['type'], $nonsavable_types)){
			update_option( $value['id'], $value['std']);
		}
	}

	//save the field's values if the Save action is present
	if ( isset( $_REQUEST['action'] ) && 'df_management_save' == $_REQUEST['action'] ) {
		//verify the nonce
		if ( empty($_POST) || !wp_verify_nonce($_POST['different-theme-options'],'different-theme-update-options') )
		{
		   __e('Sorry, your nonce did not verify.', THEME_NAME);
		   exit;
		}else{
			if(get_option('different_themes_first_save')==''){
				update_option('different_themes_first_save', 'saved');
			}
			foreach ($options as $value) {
				if(isset($value['id']) && isset($_REQUEST[$value['id']]) && !in_array($value['type'],$nonsavable_types)) {
					
					if($value['type']=="checkbox" && $_REQUEST[$value['id']]=="on"){
						update_option($value['id'],$_REQUEST[$value['id']]); 
					}
					if($value['type']=="aweber_input") {
						$arrayAweber = get_option(THEME_NAME."_aweber_keys");
						 
						if(empty($arrayAweber) || $_REQUEST[$value['id']] != get_option($value['id'])) {
							$oauth_id = $_REQUEST[$value['id']];
							
							if($oauth_id) {
								try {
									list($consumerKey, $consumerSecret, $accessKey, $accessSecret) = AWeberAPI::getDataFromAweberID($oauth_id);
								} catch (AWeberAPIException $exc) {
									list($consumerKey, $consumerSecret, $accessKey, $accessSecret) = null;
									# make error messages customer friendly.
									$descr = $exc->description;
									$descr = preg_replace('/http.*$/i', '', $descr);     # strip labs.aweber.com documentation url from error message
									$descr = preg_replace('/[\.\!:]+.*$/i', '', $descr); # strip anything following a . : or ! character
									$error_code = " ($descr)";
								} catch (AWeberOAuthDataMissing $exc) {
									list($consumerKey, $consumerSecret, $accessKey, $accessSecret) = null;
								} catch (AWeberException $exc) {
									list($consumerKey, $consumerSecret, $accessKey, $accessSecret) = null;
								}
							}
							
							$keys = array(
								'consumer_key' => $consumerKey,
								'consumer_secret' => $consumerSecret,
								'access_key' => $accessKey,
								'access_secret' => $accessSecret,
							);
							
							update_option(THEME_NAME."_aweber_keys", $keys);
							update_option($value['id'], $_REQUEST[$value['id']]);
						}

					}
					
					if($value['type']!="checkbox" && $value['type']!="aweber_input") {
						update_option($value['id'],$_REQUEST[$value['id']]); 
					}
				} elseif(!in_array($value['type'], $nonsavable_types) && isset($value['id'])){
					if($value['type']!="aweber_input") {
						delete_option( $value['id'] ); 
					}
				}

				if($value['type']=='add_text') {
					$old_val = $_REQUEST[ $value['id'].'s' ];
					$old_val = explode( "|*|", $old_val );
					
					if (!in_array($_REQUEST[ $value['id'] ], $old_val)) {
						update_option( $value['id'].'s', $_REQUEST[ $value['id'].'s' ].sanitize_title($_REQUEST[ $value['id'] ])."|*|" ); 
					}
					
				}
			}

		}		
	} 
 


	theme_configuration();

	die();
}

/* -------------------------------------------------------------------------*
 * 							SLIDER ORDER									*
 * -------------------------------------------------------------------------*/
 
function update_slider() {
	$updateRecordsArray = $_POST['recordsArray'];
	
	if ( !get_option(THEME_NAME."-slide-order-set" ) ) {
		add_option(THEME_NAME."-slide-order-set", "1" );
	}
	
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {
		global $wpdb;

		$wpdb->query( $wpdb->prepare("UPDATE $wpdb->posts SET menu_order = ".$listingCounter." WHERE ID = " . $recordIDValue  ) ); 

		$listingCounter = $listingCounter + 1;

	}

}

/* -------------------------------------------------------------------------*
 * 							HOMEPAGE ORDER									*
 * -------------------------------------------------------------------------*/
 
function update_homepage() {
	$updateRecordsArray = $_POST['recordsArray'];
	$array = explode(',', $_POST['count']);
	$type = explode(',', $_POST['type']);
	$string = explode(',', $_POST['inputType']);
	$postID = explode(',', $_POST['post_id']);

	$strings = array();
	$array_count = sizeof($array);
	$e = 0;
	for($c = 0; $c < $array_count; $c++) {
		$items = array();
		for($i = 0; $i < $array[$c]; $i++) {
			array_push($items, $string[$e]);
			$e++;
		}
		
		if($array[$c] == 0) {
			$e++;
		}
		array_push($strings, $items);
		
		$items = "";
	}
	
	$homepage_layout = array();
	
	$a=0;
	
	if(!empty($updateRecordsArray)) {
		foreach($updateRecordsArray as $recordIDValue)  {
			$homepage_layout[$a]['type'] = $type[$a];
			$homepage_layout[$a]['inputType'] = $strings[$a];
			$homepage_layout[$a]['id'] = $recordIDValue;
			
			$a++;
		}
	}


	
	update_option(THEME_NAME."_homepage_layout_order_".$postID[0], $homepage_layout );

	die();

}

/* -------------------------------------------------------------------------*
 * 						LOAD NEXT IMAGE IN GALLERY							*
 * -------------------------------------------------------------------------*/
 
function load_next_image(){
	$g = $_POST['gallery_id'];
	$next_image = $_POST['next_image'];

	$galleryImages = get_post_meta ( $g, "_".THEME_NAME."_gallery_images", true ); 
	$imageIDs = explode(",",$galleryImages);


	$c=0;
	$images = array();
	
	foreach($imageIDs as $id) {
		$file = wp_get_attachment_url($id);
		$image = get_post_thumb(false, 1200, 0, false, $file);
		$images[] = $image['src'];
		$c++;
	}
						
				
	echo $images[$next_image-1];
	die();
}

/* -------------------------------------------------------------------------*
 * 							SIDEBAR GENERATOR								*
 * -------------------------------------------------------------------------*/
 
function update_sidebar() {
	$updateRecordsArray = $_POST['recordsArray'];
	$last = array_pop($updateRecordsArray);
	$updateRecordsArray = implode ("|*|", $updateRecordsArray)."|*|".$last."|*|";
	update_option( THEME_NAME."_sidebar_names", $updateRecordsArray);
	echo $updateRecordsArray;
}
function delete_sidebar() {
	$sidebar_name = $_POST['sidebar_name']."|*|";
	$sidebar_names = get_option( THEME_NAME."_sidebar_names" );
	$sidebar_names = explode( "|*|", $sidebar_names );
	$sidebar_name = explode( "|*|", $sidebar_name );
	$result = array_diff($sidebar_names, $sidebar_name);
	$last = array_pop($result);
	$update_sidebar = implode ("|*|", $result)."|*|".$last."|*|";
	if(empty($result) || count($result)<=1){
		$update_sidebar = $last;
		if($last) {
			$update_sidebar.= "|*|";	
		}
	} else {
		$update_sidebar = implode ("|*|", $result)."|*|".$last."|*|";	
	}
	update_option( THEME_NAME."_sidebar_names", $update_sidebar);
	echo $update_sidebar;
}
function edit_sidebar() {
	$new_sidebar_name = sanitize_title($_POST['sidebar_name']);
	$old_name = $_POST['old_name'];

	$sidebar_names = get_option( THEME_NAME."_sidebar_names" );
	$sidebar_names = explode( "|*|", $sidebar_names );
	$new_sidebar_names=array();
	foreach ($sidebar_names as $sidebar_name) {
		if($sidebar_name!="") {
			if ($sidebar_name==$old_name) {
				$new_sidebar_names[]=$new_sidebar_name;
			} else {
				$new_sidebar_names[]=$sidebar_name;
			}
		}
	}
	$last = array_pop($new_sidebar_names);

	if(empty($new_sidebar_names)){
		$update_sidebar =  $last."|*|";
	} else {
		$update_sidebar = implode ("|*|", $new_sidebar_names)."|*|".$last."|*|";
	}
	
	
	update_option( THEME_NAME."_sidebar_names", $update_sidebar);
	echo $update_sidebar;
}



/* -------------------------------------------------------------------------*
 * 								 CONTACT FORM								*
 * -------------------------------------------------------------------------*/
 
 
function contact_form() {
	$contactID = $_POST["contact_id"];
	$mail_to = get_post_meta ($contactID, "_".THEME_NAME."_contact_mail", true );
	

	if(isset($_POST["email"]) && is_email($_POST["email"])){
		$email = is_email($_POST["email"]);
	}
	if(isset($_POST["name"])){
		$u_name = esc_textarea($_POST["name"]);
	}

	if(isset($_POST["comments"])){
		$message = stripslashes(esc_textarea($_POST["comments"]));
	}

	
	$ip = $_SERVER['REMOTE_ADDR'];

	
	if(isset($_POST["form_type"])) {	

		$subject = ( __( 'From' , THEME_NAME ))." ".get_bloginfo('name')." ".( __( 'Contact Page' , THEME_NAME ));
		$subject = html_entity_decode (  $subject, ENT_QUOTES, 'UTF-8' );
				
		$eol="\n";
		$mime_boundary=md5(time());
		$headers = "From: ".$email." <".$email.">".$eol;
		//$headers .= "Reply-To: ".$email."<".$email.">".$eol;
		$headers .= "Message-ID: <".time()."-".$email.">".$eol;
		$headers .= "X-Mailer: PHP v".phpversion().$eol;
		$headers .= 'MIME-Version: 1.0'.$eol;
		$headers .= "Content-Type: text/html; charset=UTF-8; boundary=\"".$mime_boundary."\"".$eol.$eol;

		ob_start(); 
		?>
<?php printf ( __( 'Message:' , THEME_NAME ));?> <?php echo nl2br($message);?>
<div style="padding-top:100px;">
<?php _e( 'Name:' , THEME_NAME );?> <?php echo $u_name;?><br/>
<?php _e( 'E-mail:' , THEME_NAME );?> <?php echo $email;?><br/>
<?php _e( 'IP Address:' , THEME_NAME );?> <?php echo $ip;?><br/>
</div>
<?php
		$message = ob_get_clean();
		wp_mail($mail_to,$subject,$message,$headers);
			
	}
	 
	die();

}

add_action('wp_ajax_df_dynamic_js', 'df_dynamic_js');
add_action('wp_ajax_nopriv_df_dynamic_js', 'df_dynamic_js'); 

add_action('wp_ajax_df_dynamic_css', 'df_dynamic_css');
add_action('wp_ajax_nopriv_df_dynamic_css', 'df_dynamic_css'); 

add_action('wp_ajax_update_slider', 'update_slider');
add_action('wp_ajax_update_homepage', 'update_homepage');

add_action('wp_ajax_update_sidebar', 'update_sidebar');
add_action('wp_ajax_delete_sidebar', 'delete_sidebar');
add_action('wp_ajax_edit_sidebar', 'edit_sidebar');


add_action('wp_ajax_nopriv_contact_form', 'contact_form');
add_action('wp_ajax_contact_form', 'contact_form');

add_action('wp_ajax_df_management_save', 'df_management_save');
add_action('wp_ajax_df_save_options', 'df_save_options');

add_action('wp_ajax_load_next_image', 'load_next_image');
add_action('wp_ajax_nopriv_load_next_image', 'load_next_image');

add_action('wp_ajax_df_customFShare', 'df_customFShare');
add_action('wp_ajax_nopriv_df_customFShare', 'df_customFShare');
?>
