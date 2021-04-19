<?php




function wpaal_urlcheck() {








}


add_action( 'admin_footer', 'aal_urlcheck_enqueue' );
function aal_urlcheck_enqueue($hook) { 
   // if( 'index.php' != $hook ) {
	// Only applies to dashboard panel
	//return;
 //   }
	    	$local_arr = array(
    	    'ajaxcheckurl'   => admin_url( 'admin-ajax.php' ),
     	   'security'  => wp_create_nonce( 'aalurlchecknonce' )
    	);

	wp_enqueue_script( 'aal_urlcheck', plugins_url( '/js/urlcheck.js', __FILE__ ), array('jquery') );

	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'aal_urlcheck', 'aal_urlcheck_ajax', $local_arr );		
}

// Same handler function...
add_action( 'wp_ajax_aal_url_check', 'aal_url_check_action' );


function aal_url_check_action() {
	//global $wpdb;
		  check_ajax_referer( 'aalurlchecknonce', 'security' ); 
		  if(aal_url_exists(sanitize_text_field($_POST['url']))) {
		  		echo 'valid';
		  }
        else {
        	  echo 'broken';
        }
	wp_die();
}



function aal_url_exists($url){
	
    $handle = @fopen($url,'r');
    if($handle !== false){
       return true;
    }else{
       return false;
    }
}
