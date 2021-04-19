<?php 
	 global $wpdb;
	 $table_name = $wpdb->prefix . "automated_links";
	 
	 delete_option('aal_showhome');
	 delete_option('aal_exclude');
	 delete_option('aal_notimes');
	 delete_option('aal_iscloacked');
	 delete_option('aal_target');
	 delete_option('aal_relation');
	 delete_option('aal_showlist');
	 delete_option('aal_notimescustom');
	 delete_option('aal_cssclass');
	 delete_option('aal_langsupport');
	 delete_option('aal_display');
	 delete_option('aal_samekeyword');
	 delete_option('aal_samelink');
	 delete_option('aal_linkdistribution');
	 delete_option('aal_displayc');
	 delete_option('aal_pluginstatus');
	 
	 
	 
	 delete_option('aal_apikey');
     delete_option('aal_amazonactive' );
     delete_option('aal_clickbankactive' );
     delete_option('aal_shareasaleactive' );
     delete_option('aal_cjactive' );
     delete_option('aal_ebayactive' );
     delete_option('aal_bestbuyactive' );
     delete_option('aal_walmartactive' );
     delete_option('aal_envatoactive' );
	 
	
	
	$wpdb->query('DROP TABLE '.  $table_name .'');
	$wpdb->query('DROP TABLE ' . $wpdb->prefix . 'aal_statistics');
	
?>