<?php

//Installation of plugin
function aal_install($network_wide) {
	
	
	
	    if ( is_multisite() && $network_wide ) { 

        foreach (get_sites(['fields'=>'ids']) as $blog_id) {
            switch_to_blog($blog_id);
            
            
 				global $wpdb; 
				$table_name = $wpdb->prefix . "automated_links";
				
				//TODO: Instead of deleting, check if it is already added;
				if(!get_option('aal_target')) add_option( 'aal_target', '_blank');
				if(!get_option('aal_notimes')) add_option( 'aal_notimes', '3');
				if(!get_option('aal_showhome')) add_option( 'aal_showhome', 'true');
				if(!get_option('aal_showlist')) add_option( 'aal_showlist', 'true');
				
				update_option( 'aal_pluginstatus', 'active');  
				$displayc[] = 'post';
				$displayc[] = 'page';
				$dc = json_encode($displayc); 
				if(!get_option('aal_displayc')) add_option( 'aal_displayc', $dc);
				
				
			
				//if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			
				$sql = "CREATE TABLE " . $table_name . " (
				  id mediumint(9) NOT NULL AUTO_INCREMENT,
				  link text NOT NULL,
				  keywords text,
				  meta text,
				  medium varchar(255),
				  grup int(5),
				  grup_desc varchar(255),
				  stats text,
				  PRIMARY KEY  (id)
				  ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
			    
			        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			        dbDelta($sql);
			        
			        
				  
				 $sql2 = "CREATE TABLE " . $wpdb->prefix . "aal_statistics (
				  id int(9) NOT NULL AUTO_INCREMENT,
				  link varchar(1000),
				  time int(50),
				  linkid int(9),
				  keyword varchar(200),
				  loccat varchar(50),
				  loctype varchar(50),
				  locid int(9),
				  locurl varchar(1000),
				  ip varchar(30),
				  PRIMARY KEY  (id)
				  ) CHARACTER SET utf8 COLLATE utf8_general_ci;";	        
			        
			    dbDelta($sql2);  			        
			        
			        
			        
			        
			       // $wpdb->last_error;
       // die();           
            
            
            restore_current_blog();
        } 

    } else {
        	global $wpdb; 
				$table_name = $wpdb->prefix . "automated_links";
				
				
				if(!get_option('aal_target')) add_option( 'aal_target', '_blank');
				if(!get_option('aal_notimes')) add_option( 'aal_notimes', '3');
				if(!get_option('aal_showhome')) add_option( 'aal_showhome', 'true');
				if(!get_option('aal_showlist')) add_option( 'aal_showlist', 'true');
				
				update_option( 'aal_pluginstatus', 'active');  
				$displayc[] = 'post';
				$displayc[] = 'page';
				$dc = json_encode($displayc); 
				if(!get_option('aal_displayc')) add_option( 'aal_displayc', $dc);
				
				
			
				//if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			
				$sql = "CREATE TABLE " . $table_name . " (
				  id mediumint(9) NOT NULL AUTO_INCREMENT,
				  link text NOT NULL,
				  keywords text,
				  meta text,
				  medium varchar(255),
				  grup int(5),
				  grup_desc varchar(255),
				  stats text,
				  PRIMARY KEY  (id)
				  ) CHARACTER SET utf8 COLLATE utf8_general_ci;";	
			    
			        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			        dbDelta($sql);
			        
			        
	
				  
				  
				 $sql2 = "CREATE TABLE " . $wpdb->prefix . "aal_statistics (
				  id int(9) NOT NULL AUTO_INCREMENT,
				  link varchar(1000),
				  time int(50),
				  linkid int(9),
				  keyword varchar(200),
				  loccat varchar(50),
				  loctype varchar(50),
				  locid int(9),
				  locurl varchar(1000),
				  ip varchar(30),
				  PRIMARY KEY  (id)
				  ) CHARACTER SET utf8 COLLATE utf8_general_ci;";	        
			        
			    dbDelta($sql2);    
			        
			        
			    //    $wpdb->last_error;
       // die();
    }
    
    

	
}


function aal_setup_new_blog($blog_id) {

    //replace with your base plugin path E.g. dirname/filename.php
    if ( is_plugin_active_for_network( 'wp-auto-affiliate-links/WP-auto-affiliate-links.php' ) ) {
        switch_to_blog($blog_id);
       
       global $wpdb; 
				$table_name = $wpdb->prefix . "automated_links";
				
				//TODO: Instead of deleting, check if it is already added;
				if(!get_option('aal_target')) add_option( 'aal_target', '_blank');
				if(!get_option('aal_notimes')) add_option( 'aal_notimes', '3');
				if(!get_option('aal_showhome')) add_option( 'aal_showhome', 'true');
				if(!get_option('aal_showlist')) add_option( 'aal_showlist', 'true');
				
				update_option( 'aal_pluginstatus', 'active');  
				$displayc[] = 'post';
				$displayc[] = 'page';
				$dc = json_encode($displayc); 
				if(!get_option('aal_displayc')) add_option( 'aal_displayc', $dc);
				
				
			
				//if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			
				$sql = "CREATE TABLE " . $table_name . " (
				  id mediumint(9) NOT NULL AUTO_INCREMENT,
				  link text NOT NULL,
				  keywords text,
				  meta text,
				  medium varchar(255),
				  grup int(5),
				  grup_desc varchar(255),
				  stats text,
				  PRIMARY KEY  (id)
				  ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
			    
			        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			        dbDelta($sql);
			        
			        
				  
				 $sql2 = "CREATE TABLE " . $wpdb->prefix . "aal_statistics (
				  id int(9) NOT NULL AUTO_INCREMENT,
				  link varchar(1000),
				  time int(50),
				  linkid int(9),
				  keyword varchar(200),
				  loccat varchar(50),
				  loctype varchar(50),
				  locid int(9),
				  locurl varchar(1000),
				  ip varchar(30),
				  PRIMARY KEY  (id)
				  ) CHARACTER SET utf8 COLLATE utf8_general_ci;";	        
			        
			    dbDelta($sql2);  			        
			        
			        
			        
			        
			       // $wpdb->last_error;
       // die();
       
       
       
       
        restore_current_blog();
    } 

}

add_action('wpmu_new_blog', 'aal_setup_new_blog');


function aal_admin_notice() {  
	
	$aal_notice_dismissed = get_option('aal_option_dismissed73'); 
	if(!$aal_notice_dismissed && !get_option('aal_apikey'))
	{  if(current_user_can('activate_plugins')) {
    ?>
    <div id="aal_notice_div" class="updated">
     <div style="float: right;padding-top: 10px;margin-left: 100px;"><a id="aal_dismiss_link" href="javascript:;" >Dismiss this notice</a></div>
      <p><?php    // _e( 'Amazon, Clickbank and Shareasale, Ebay, Walmart, Commission Junction, Bestbuy and Envato Marketplace  links can be automatically added into your content , you only have to <a href="https://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">get your API key</a>, add your affiliate ID and start earning. ', 'wp-auto-affiliate-links' ); 
      
		// _e( 'Amazon, Clickbank, Ebay, Walmart, Shareasale, Commission Junction, Bestbuy and Envato Marketplace  links can be automatically added into your content. Learn more about <a href="https://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">Auto Affiliate Links PRO</a>. ', 'wp-auto-affiliate-links' ); 
      // _e( 'Thank you for using Auto Affiliate Links. Help us improve the plugin by filling this  <a href="https://docs.google.com/forms/d/e/1FAIpQLSccthcBd0L36H-9ueyZKXIjvRAvY0z3jM2QChLISGWNh1KDjQ/viewform?usp=sf_link">Feedback Form</a>. ', 'wp-auto-affiliate-links' ); 
         
     //   _e( 'Thank you for using Auto Affiliate Links. Get started by adding some links <a href="'. admin_url('admin.php?page=aal_topmenu') .'">here</a>. Please support Auto Affiliate Links development by upgrading to  <a href="https://autoaffiliatelinks.com/auto-affiliate-links-payment-plans/">Auto Affiliate Links PRO</a>.', 'wp-auto-affiliate-links' ); 
           
       //    _e( 'Thank you for using Auto Affiliate Links. Get started by adding some links <a href="'. admin_url('admin.php?page=aal_topmenu') .'">here</a>.', 'wp-auto-affiliate-links' ); 
            
       //     _e( 'Link click statistics is now available in Auto Affiliate Links. Please activate click tracking on <a href="'. admin_url('admin.php?page=aal_stats') .'">Statistics page</a>.', 'wp-auto-affiliate-links' ); 
                      
                 
     //   _e( 'Please support Auto Affiliate Links development by upgrading to  <a href="https://autoaffiliatelinks.com/auto-affiliate-links-payment-plans/">Auto Affiliate Links PRO</a>.', 'wp-auto-affiliate-links' ); 
           
    //	 _e( 'Thank you for using Auto Affiliate Links. Upgrade to PRO to have links from Amazon, Clickbank, Shareasale, Walmart, Ebay, Best Buy, Envato, extracted and added automatically to your content.  Learn more about <a href="https://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">Auto Affiliate Links PRO</a>. ', 'wp-auto-affiliate-links' ); 
    	 
    	  _e( 'Thank you for using Auto Affiliate Links. Get access to premium features and support plugin development by upgrading to <a href="https://autoaffiliatelinks.com/auto-affiliate-links-payment-plans/">Auto Affiliate Links PRO</a>. ', 'wp-auto-affiliate-links' ); 
    	 
    	 
      ?></p>
     
    </div>  
    
    
    <?php
    	}
    
	}
	
	if(get_option('aal_apistatus') == 'expired' && current_user_can('activate_plugins') && get_option('aal_apikey')) {
		echo '<div id="aal_notice_div" class="updated"><p>';
		_e( 'Your Auto Affiliate Links PRO subscription is expired. Please <a href="https://autoaffiliatelinks.com/auto-affiliate-links-payment-plans/">renew your subscription</a> or <a href="https://autoaffiliatelinks.com/auto-affiliate-links-payment-plans/">create a new API key</a>  ', 'wp-auto-affiliate-links' ); 
      
		echo '</p></div>';
	}
	
	if(get_option('aal_apistatus') == 'invalid' && current_user_can('activate_plugins') && get_option('aal_apikey')) {
		echo '<div id="aal_notice_div" class="updated"><p>';
		_e( 'The API key you entered is invalid. You have to <a href="https://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">register on our website</a> to get a valid API key ', 'wp-auto-affiliate-links' ); 
      
		echo '</p></div>';
	}
	
}


function aalDismissNotice() {
	
		delete_option('aal_option_dismissed72');
		add_option('aal_option_dismissed73',true);
	
	
}


add_action( 'admin_notices', 'aal_admin_notice' );
add_action('wp_ajax_aal_dismiss_notice', 'aalDismissNotice');






?>
