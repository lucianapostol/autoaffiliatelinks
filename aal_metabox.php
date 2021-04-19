<?php 


function aal_add_meta_box() {

	$screens = array( 'post', 'page' );

//	foreach ( $screens as $screen ) {

		if(current_user_can( 'publish_pages' )) {
			add_meta_box(
				'aal_sectionid',
				__( 'Auto Affiliate Links', 'aal_textdomain' ),
				'aal_meta_box_callback',
				$screens
			);
		}
//	}
}
add_action( 'add_meta_boxes', 'aal_add_meta_box' );


function aal_check_list_value($post_id,$optionname) {
	$value = get_option($optionname);
	$old = explode(',',$value);
	$checked = '';
	if(in_array($post_id,$old)) { $checked = 'checked'; }

	return $checked;
}

function aal_get_meta_value($post_id,$optionname) {
	$json = get_option($optionname);
	if(isset($json)) $array = json_decode($json);
	//print_r($array);
	if(isset($array) && isset($array->$post_id) ) $obj = $array->$post_id;
	if(isset($obj->value) && is_numeric($obj->value)) return $obj->value;	
	else return '';
}

function aal_update_meta_value($post_id,$optionname,$value) {
	if(get_option($optionname)) {
		$array = json_decode(get_option($optionname));
	}
	else $array = new stdClass();
	$obj = new stdClass();
	$obj->id = $post_id;
	$obj->value = $value;
	
	$array->{$post_id} = $obj;
	
	update_option($optionname,json_encode($array));

}


function aal_meta_box_callback( $post ) {


	wp_nonce_field( 'aal_meta_box', 'aal_meta_box_nonce' );

	echo '<label for="aal_meta_exclude">';
	echo '<input type="checkbox" name="aal_meta_exclude" value="1" '. aal_check_list_value($post->ID,'aal_exclude') .'>';
	_e( ' Exclude this post from affiliate linking. ', 'myplugin_textdomain' );
	echo '</label><br /><br /> ';
	echo '<label for="aal_meta_postnotimes">';
	_e( 'Maximum links added in this post: . ', 'myplugin_textdomain' );
	echo '<input type="text" name="aal_meta_postnotimes" value="'. aal_get_meta_value($post->ID,'aal_meta_postnotimes') .'" />';
	echo '</label> ';
	//echo $value . '<br>';
}


function aal_save_meta_box_data( $post_id ) {




	if ( ! isset( $_POST['aal_meta_box_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['aal_meta_box_nonce'], 'aal_meta_box' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}


	if ( ! isset( $_POST['aal_meta_exclude'] ) ) {
		// return;
	}

	// Sanitize user input.
	if(isset($_POST['aal_meta_exclude'])) $my_data = sanitize_text_field( $_POST['aal_meta_exclude'] );
	else $my_data = '';
	if(isset($_POST['aal_meta_postnotimes'])) $postnotimes = sanitize_text_field( $_POST['aal_meta_postnotimes'] );
	else $postnotimes = '';

	
	$old = get_option('aal_exclude');
	$ids = explode(',',$old);
	if($my_data) { if(!in_array($post_id,$ids)) { $checked = 'checked'; } $ids[] = $post_id; }
	else { $ids = array_diff($ids, array(1 => $post_id));   }
	
	$new = implode(',', $ids);
	update_option('aal_exclude', $new);
	
	if(isset($postnotimes) && (is_numeric($postnotimes) || ''==$postnotimes)) aal_update_meta_value($post_id,'aal_meta_postnotimes',$postnotimes);
	
	
}


add_action( 'save_post', 'aal_save_meta_box_data' );


?>