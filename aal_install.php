<?php

//Installation of plugin
function aal_install() {
	global $wpdb; 
	$table_name = $wpdb->prefix . "automated_links";
	
	delete_option('aal_target'); add_option( 'aal_target', '_blank');
	

	//if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

	$sql = "CREATE TABLE " . $table_name . " (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  link text NOT NULL,
	  keywords text,
	  meta text,
	  medium varchar(255),
	  grup int(5),
	  grup_desc varchar(255),
	  PRIMARY KEY (id)
	  );";
    
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        $wpdb->last_error;
       // die();
	
}


function aal_admin_notice() {
	
	$aal_notice_dismissed = get_option('aal_option_dismissed9'); 
	if(!$aal_notice_dismissed)
	{ 
    ?>
    <div id="aal_notice_div" class="updated">
       <!--  <p align="center"><?php _e( 'Amazon, Clickbank and Shareasale links can be automatically added into your content , you only have to <a href="http://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">get your API key</a> and then activate each module on their menu pages. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="return aalDismiss();" >Dismiss this notice</a>', 'wp-auto-affiliate-links' ); ?></p> -->
		<p align="center"><?php _e( 'WP Auto Affiliate Links update: Ebay, Walmart, Best Buy and Commission Junction links automation have been added in the latest version of the plugin. You only have to <a href="http://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">get your API key</a> and then activate each module on their menu pages. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="return aalDismiss();" >Dismiss this notice</a>', 'wp-auto-affiliate-links' ); ?></p>
    </div>
    
<script type="text/javascript">
	function aalDismiss() {


        var data = {action: 'aal_dismiss_notice'};
        
            jQuery.ajax({
                    type: "POST",
                    url: ajax_script.ajaxurl,
                    data: data,
                    cache: false,
                    success: function(){
                    jQuery("#aal_notice_div").slideUp('slow', function() {jQuery("#aal_notice_div").remove();});
                                        }
                });
        	
		
		
	}

</script>    
    
    
    <?php
    
	}
	
}


function aalDismissNotice() {
	
	
		delete_option('aal_option_dismissed1');
		delete_option('aal_option_dismissed2');
		delete_option('aal_option_dismissed3');
		delete_option('aal_option_dismissed4');
		delete_option('aal_option_dismissed5');
		delete_option('aal_option_dismissed6');
		delete_option('aal_option_dismissed7');
		delete_option('aal_option_dismissed8');
		add_option('aal_option_dismissed9',true);
	
	
}


add_action( 'admin_notices', 'aal_admin_notice' );
add_action('wp_ajax_aal_dismiss_notice', 'aalDismissNotice');






?>