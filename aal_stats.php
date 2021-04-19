<?php


	
add_action( 'admin_init', 'aal_stats_register_settings' );


function aal_stats_register_settings() { 
   register_setting( 'aal_stats_settings', 'aal_statsactive' );
 
}	


function wpaal_stats() {
	global $wpdb;
	$myrows = $wpdb->get_results( "SELECT id,link,keywords,meta FROM ". $wpdb->prefix ."automated_links"  );
	//$clicks = $wpdb->get_results( "SELECT * FROM ". $wpdb->prefix ."aal_statistics"  ." ORDER BY accesed DESC");
	//$stats = $wpdb->get_results( "SELECT link,COUNT(*) as clicks FROM ". $wpdb->prefix ."aal_statistics"  ." GROUP BY link ORDER BY clicks DESC");
	
	//print_r($stats);
	
	
	
		settings_fields( 'aal_stats_settings' );
		do_settings_sections('aal_stats_settings_display');
		$aal_statsactive = esc_attr( get_option( 'aal_statsactive' ) );
?>

<div class="wrap" >  
    <div class="icon32" id="icon-options-general"></div>  
    <div class="aal_leftadmin">	
		<h2>Statistics</h2>
		
		Activate click statistics:<br /><br />
        <form action="options.php" method="POST">
            <?php settings_fields( 'aal_stats_settings' ); ?>
   		 
    <select  name="aal_statsactive" />
    		<option value="active" <?php if($aal_statsactive=='active') echo 'SELECTED'; ?>>Active</option>
    		<option value="inactive" <?php if($aal_statsactive!='active') echo 'SELECTED'; ?>>Inactive</option>
    </select>
            <?php submit_button(); ?>
        </form>
		  <br />If the click count does not appear below after activation, please deactivate and reactivate the plugin again.
		<?php
		
		if($aal_statsactive=='active') {				
					
			aal_display_stats('link'); 
		
			aal_display_stats('keyword'); 
		
		
			aal_display_clicks(); 
		}
		
		?>
		
	</div>
</div>	
	

<?php
}


function aal_display_stats($type) {
	global $wpdb;
	if($wpdb->get_var("SHOW TABLES LIKE '" . $wpdb->prefix . "aal_statistics'") != $wpdb->prefix . "aal_statistics") return;
	$stats = $wpdb->get_results( "SELECT ". $type ." as col,COUNT(*) as clicks FROM ". $wpdb->prefix ."aal_statistics"  ." GROUP BY ". $type ." ORDER BY clicks DESC");
	
	$alternate = 0;
?>

      <br /><br />
      <h3>Clicks by <?php echo $type; ?></h3>
      <br /><br />
		<table id="aal_glmanual" class="widefat fixed aal_table" >
			<thead>
				<tr>
					<th><?php echo ucfirst($type); ?></th>
					<th>Clicks</th>
				</tr>
			</thead>
			
			<tfoot>
				<tr>
					<th><?php echo ucfirst($type); ?></th>
					<th>Clicks</th>
				</tr>
			</tfoot>
			
			<tbody>
			
<?php 

	foreach($stats as $st) {
	?>
	<tr class="<?php if($alternate % 2 == 0) echo 'alternate'; ?>" >
		<td>
			<?php if($type == 'link') { ?>
			<a href="<?php echo $st->col; ?>"><?php echo $st->col; ?></a>
			<?php } else { ?>
				<?php echo $st->col; ?>
			<?php } ?>
		</td>
		<td>
			<?php 
				echo $st->clicks;
			 ?>
		</td>
	</tr>
<?php 
	$alternate++;
	
}
 ?>     

       
             
                
     </tbody>
 </table>			
			
			
				


<?php

}


function aal_display_clicks() {

	global $wpdb;
	
	if($wpdb->get_var("SHOW TABLES LIKE '" . $wpdb->prefix . "aal_statistics'") != $wpdb->prefix . "aal_statistics") return;
	
	$clicks = $wpdb->get_results( "SELECT * FROM ". $wpdb->prefix ."aal_statistics"  ." ORDER BY time DESC LIMIT 100");
	
	$alternate = 0;
?>

      <br /><br />
      <h3>Latest clicks</h3>
      <br /><br />
		<table id="aal_glmanual" class="widefat fixed aal_table" >
			<thead>
				<tr>
					<th>Link</th>
					<th>Keyword</th>
					<th>Page</th>
					<th>Time</th>
					<th>IP</th>
				</tr>
			</thead>
			
			<tfoot>
				<tr>
					<th>Link</th>
					<th>Keyword</th>
					<th>Page</th>
					<th>Time</th>
					<th>IP</th>
				</tr>
			</tfoot>
			
			<tbody>
			
<?php 

	foreach($clicks as $st) {
	?>
	<tr class="<?php if($alternate % 2 == 0) echo 'alternate'; ?>" >
		<td>
			<a href="<?php echo $st->link; ?>"><?php echo $st->link; ?></a>			
		</td>
		<td>
			<?php echo $st->keyword; ?>
		</td>
		<td>
			<a href="<?php echo $st->locurl; ?>"><?php echo $st->locurl; ?></a>	
		</td>
		<td>
			<?php echo date("m/d/Y H:i:s",$st->time);   ; ?>
		</td>
		<td>
			<?php echo $st->ip; ?>
		</td>
	</tr>
<?php 
	$alternate++;
	
}
 ?>     

       
             
                
     </tbody>
 </table>			
			
			
				


<?php


}




//add_action( 'admin_footer', 'aal_stats_enqueue' );
add_action('wp_enqueue_scripts', 'aal_stats_enqueue');

function aal_stats_enqueue($hook) { 
	global $post;

		$aal_statsactive = esc_attr( get_option( 'aal_statsactive' ) );
		if($aal_statsactive=='active') {
		
			$postid = 'notinpost'; 
			if(isset($post) && is_object($post) && $post->ID) { 
				$postid = $post->ID;
			}

	    	$local_arr = array(
    	   'ajaxstatsurl'   => admin_url( 'admin-ajax.php' ),
     	   'security'  => wp_create_nonce( 'aalstatssavenonce' ),
     	   'postid' => $postid
     	   
    	);

		wp_enqueue_script( 'aal_statsjs', plugins_url( '/js/aalstats.js', __FILE__ ), array('jquery') );
	
		// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
		wp_localize_script( 'aal_statsjs', 'aal_stats_ajax', $local_arr );		
	}
}

// Same handler function...
add_action( 'wp_ajax_aal_stats_save', 'aal_url_stats_save_action' );


function aal_url_stats_save_action() {
	global $wpdb;
	$table_name = $wpdb->prefix . "automated_links";
	check_ajax_referer( 'aalstatssavenonce', 'security' ); 
	
	$link = sanitize_text_field($_POST['link']);	
	$keyword = sanitize_text_field($_POST['keyword']);	
	$tip = sanitize_text_field($_POST['tip']);	
	$locid = sanitize_text_field($_POST['postid']);	
	$url = sanitize_text_field($_POST['url']);	
	$time = time();
	
	if(get_option('aal_iscloacked'))
		{
			
			$cu = get_option('aal_cloakurl');
			$preg = preg_match('/\/'. $cu .'\/([0-9]+)\//',$link,$matches);
			$linkid = $matches[1];
		
		}
	
	$ip = sanitize_text_field($_SERVER['REMOTE_ADDR']);
	
	
	if($link && !$wpdb->get_var("SHOW TABLES LIKE '" . $wpdb->prefix . "aal_statistics'") != $wpdb->prefix . "aal_statistics'") {	
		//Save to DB
		
			if(get_option('aal_iscloacked')) {
				$myrows = $wpdb->get_results( "SELECT id,link,keywords,meta,stats FROM ". $table_name  ." WHERE `id` =  '" . $linkid ."' ");
				$link = $myrows[0]->link;
			}
			else {
				$myrows = $wpdb->get_results( "SELECT id,link,keywords,meta,stats FROM ". $table_name  ." WHERE `link` =  '" . $link ."' ");
			}
		
		
		if($myrows[0]->id) { 
		   if(is_numeric($locid)) {
		   		$loccat = 'post';
		   		$post = get_post($locid);
		   		$loctype = $post->post_type;
		   		$locid = $locid;
		   }
		   else {
				$loccat =  '';
				$loctype = '';
				$locid = 0;  
		   }
		   
		   $linkid = $myrows[0]->id;
		   
		   $insertdata = array(
		   	'linkid' => $linkid,
		   	'link' => $link,
		   	'keyword' => $keyword,
		   	'time' => $time,
		   	'loccat' => $loccat,
		   	'loctype' => $loctype,
		   	'locurl' => $url,
		   	'locid' => $locid,
		   	'ip' => $ip
		   );
		   $rows_affected =  $wpdb->insert( $wpdb->prefix ."aal_statistics", $insertdata );
	
		
			
			
			//print_r($insertdata);
			//print_r($rows_affected );		
		}
	}


	wp_die();
}
