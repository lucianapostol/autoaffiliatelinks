<?php
/*
Plugin Name: Auto Affiliate Links
Plugin URI: https://autoaffiliatelinks.com
Description: Auto add affiliate links to your blog content
Author: Lucian Apostol
Version: 6.0.5
Author URI: https://autoaffiliatelinks.com
*/

//Load css stylesheets
function aal_load_css() {
	
        //load css styles
        wp_register_style( 'aal_style', plugins_url('css/style.css', __FILE__) );
        wp_enqueue_style( 'aal_style' );
}

//Load javascript files used both for front and back end
function aal_load_js() {
	
        // load our jquery file that sends the $.post request1
		wp_enqueue_script( "aal_js", plugin_dir_url( __FILE__ ) . 'js/js.js', array( 'jquery' ), false, true);
        $aal_plugin_url = plugin_dir_url(__FILE__);
        // make the ajaxurl var available to the above script
		wp_localize_script( 'aal_js', 'ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php'),'aal_plugin_url' => $aal_plugin_url  ) );	     
		

		
		
}

//Function to include js script to be used only on front-end
function aal_load_front_scripts() {
	
	//if( get_option( 'aal_apikey' ) ) { 
		wp_register_script( 'aal_apijs', plugin_dir_url( __FILE__ ) . 'js/api.js', array( 'jquery' ), false, true );
		
	 $local_arr = array();	
	 if( get_option( 'aal_apikey' ) ) { 
    	$local_arr = array(
    	    'ajaxurl'   => admin_url( 'admin-ajax.php' ),
     	   'security'  => wp_create_nonce( 'aalamazonnonce' )
    	);
    }
    
    wp_localize_script( 'aal_apijs', 'aal_amazon_obj', $local_arr );
    
		wp_enqueue_script( 'aal_apijs' );
	//}
	
}


//Include all subfiles of the plugin
include(plugin_dir_path(__FILE__) . 'aal_install.php');
include(plugin_dir_path(__FILE__) . 'aal_cloaking.php');
include(plugin_dir_path(__FILE__) . 'aal_functions.php');
include(plugin_dir_path(__FILE__) . 'aal_ajax.php');
include(plugin_dir_path(__FILE__) . 'aal_engine.php');
include(plugin_dir_path(__FILE__) . 'aal_settings.php');
include(plugin_dir_path(__FILE__) . 'aal_exclude.php');
include(plugin_dir_path(__FILE__) . 'aal_modules.php');
include(plugin_dir_path(__FILE__) . 'aal_importexport.php');
include(plugin_dir_path(__FILE__) . 'aal_apimanagement.php');
include(plugin_dir_path(__FILE__) . 'aal_generatedlinks.php');
include(plugin_dir_path(__FILE__) . 'aal_metabox.php');
include(plugin_dir_path(__FILE__) . 'aal_getstarted.php');
include(plugin_dir_path(__FILE__) . 'aal_stats.php');
include(plugin_dir_path(__FILE__) . 'aal_excludewords.php');
include(plugin_dir_path(__FILE__) . 'aal_excludecats.php');
include(plugin_dir_path(__FILE__) . 'aal_urlcheck.php');
include(plugin_dir_path(__FILE__) . 'classes/link.php');
include(plugin_dir_path(__FILE__) . 'aal_widget.php');


//Workaround for WpAdverts
add_action( "init", function() {
  if(function_exists('adverts_the_content'))  { 
  		remove_filter('the_content', 'adverts_the_content', 9999 );
 		 add_filter('the_content', 'adverts_the_content', 3 );
 	}
}, 200 );

//Support for tablepress
add_filter( 'tablepress_table_output', 'wpaal_add_affiliate_links' );

//Support for budypress. TODO: limit usage, checkbox in settings  
add_filter( 'bp_get_the_profile_field_value', 'wpaal_add_affiliate_links' );
add_filter( 'bp_get_activity_content_body', 'wpaal_add_affiliate_links' );

//Support for Wp ecommerce plugin
add_filter( 'wpsc_the_product_description', 'wpaal_add_affiliate_links' );


//Support for BBpress
add_filter('bbp_get_topic_content', 'wpaal_add_affiliate_links');
add_filter('bbp_get_reply_content', 'wpaal_add_affiliate_links');

//Support for wpforo
//add_filter('wpforo_get_post', 'wpaal_add_affiliate_links', 15);
if (function_exists('wpaal_add_affiliate_links')) {
    add_filter('wpforo_content_after', 'wpaal_add_affiliate_links', 15);
}

//Support for Advanced custom fields
//acf/prepare_field
//add_filter('acf/prepare_field', 'wpaal_add_affiliate_links_acf');

function wpaal_add_affiliate_links_acf($field) { 
	die();
	if (get_option('aal_showacf')) {
				if( $field['value'] ) {
		
					$field['value'] = wpaal_add_affiliate_links($field['value']);
				
				}			
			}
	else return $field;
}

//end acf



//Support for asgarosforum
add_filter('asgarosforum_filter_post_content', 'wpaal_add_affiliate_links',20);

//support for peepso
add_filter('peepso_activity_content_before', 'wpaal_add_affiliate_links');

//support for wp recipe maker
add_filter('wprm_get_template', 'wpaal_add_affiliate_links');

//Support for events-manager
add_filter('em_event_output', 'wpaal_add_affiliate_links');

//Support for Elementor
add_filter('elementor/frontend/the_content', 'wpaal_add_affiliate_links');

//general function
add_filter('the_content', 'wpaal_add_affiliate_links',5);

add_filter('wps_forum_item_content_filter', 'wpaal_add_affiliate_links',15);

//the excerpt
if(get_option('aal_showexcerpt') == 'true') {
	add_filter('get_the_excerpt', 'wpaal_add_affiliate_links',15);
}

if(get_option('aal_showcatdesc') == 'true') {
	add_filter('category_description', 'wpaal_add_affiliate_links',15);
}


//support for widgets
//echo get_option('aal_showwidget');
if(get_option('aal_showwidget') == 'true') {
	add_filter('widget_text', 'wpaal_add_affiliate_links_widget',15);
}
function wpaal_add_affiliate_links_widget($content) {
	global $aaliswidget;
	$aaliswidget = 1;
	return wpaal_add_affiliate_links($content);
	$aaliswidget = 0;
}  


add_action('admin_init', 'wpaal_actions');
add_action('admin_init', 'aalChangeOptions');
add_action('admin_menu', 'wpaal_create_menu');
add_action('init', 'wpaal_rewrite_rules');
add_action('query_vars', 'wpaal_add_query_var');
add_action('wp','wpaal_check_for_goto');
add_action('wp_print_scripts', 'aal_load_css');
//add_action('wp_print_scripts', 'aal_load_js');  
add_action('admin_footer', 'aal_load_js'); 
add_action('wp_ajax_aal_delete_link', 'aalDeleteLink');
add_action('wp_ajax_aal_add_link', 'aalAddLink');
add_action('wp_ajax_aal_change_options', 'aalChangeOptions');
add_action('wp_ajax_aal_add_exclude_posts', 'aalAddExcludePost');
add_action('wp_ajax_aal_update_exclude_posts', 'aalUpdateExcludePosts');
add_action('wp_enqueue_scripts', 'aal_load_front_scripts');

register_activation_hook(__FILE__,'aal_install');

//add_action('wp_ajax_exclude_posts', 'aalExcludePosts');



// Add Wp Auto Affiliate Links to Wordpress Admnistration panel menu
function wpaal_create_menu() {
	global $aalModules;
	
		
	//if(get_option('aal_apikey')) 
	$proname = 'API Management';
	//else $proname = 'Upgrade to PRO';

	add_menu_page( 'Auto Affiliate Links', 'Auto Affiliate Links', 'publish_pages', 'aal_topmenu', 'wpaal_manage_affiliates');	
	add_submenu_page( 'aal_topmenu', 'Getting Started', 'Getting Started', 'publish_pages', 'aal_gettingstarted', 'wpaal_gettingstarted' );
	add_submenu_page( 'aal_topmenu', 'General Settings', 'General Settings', 'activate_plugins', 'aal_general_settings', 'wpaal_general_settings' );
	//add_submenu_page( 'aal_topmenu', 'Modules', 'Modules', 'publish_pages', 'aal_modules', 'wpaal_modules' );
	add_submenu_page( 'aal_topmenu', $proname, $proname, 'publish_pages', 'aal_apimanagement', 'wpaal_apimanagement' );
	add_submenu_page( 'aal_topmenu', 'Generated Links', 'Generated Links', 'publish_pages', 'aal_generatedlinks', 'wpaal_generatedlinks' );
	add_submenu_page( 'aal_topmenu', 'Statistics', 'Statistics', 'publish_pages', 'aal_stats', 'wpaal_stats' );
	
	//Load submenu items for activated modules
	/* if ( get_option( 'aal_apikey' ) ) {		
	  
		
	} */
	
	//without option check
	//add subpages that are not displayed in main menu
	foreach( $aalModules as $aalMod ) {
		add_submenu_page( null, $aalMod->nicename, $aalMod->nicename, 'publish_pages', 'aal_module_'. $aalMod->shortname, $aalMod->hooks['content'] );		
	}	
	
	
	add_submenu_page( 'aal_topmenu', 'Exclude Words', 'Exclude Words', 'publish_pages', 'aal_exclude_words', 'wpaal_exclude_words' );
	

	add_submenu_page( 'aal_topmenu', 'Exclude Posts/Pages', 'Exclude Posts/Pages', 'publish_pages', 'aal_exclude_posts', 'wpaal_exclude_posts' );
	add_submenu_page( 'aal_topmenu', 'Exclude Categories', 'Exclude Categories', 'publish_pages', 'aal_exclude_cats', 'wpaal_exclude_cats' );
	add_submenu_page( 'aal_topmenu', 'Import/Export', 'Import/Export', 'activate_plugins', 'aal_import_export', 'wpaal_import_export' );
	
	add_submenu_page( null, 'Auto Affiliate Links - Check urls', 'Auto Affiliate Links - Check urls', 'publish_pages', 'aal_urlcheck', 'wpaal_urlcheck' );	

}


//AAL Add plugin list links

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'aal_action_links' );
 
function aal_action_links( $actions ) {
   $actions[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=aal_topmenu') ) .'">Add Links</a>';
   $actions[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=aal_general_settings') ) .'">Settings</a>';
   return $actions;
}


function wpaal_actions() {
	global $wpdb;
    $table_name = $wpdb->prefix . "automated_links";
	
	if ( !current_user_can("publish_pages") ) return;


	//Check if a new link is added
	if(isset($_POST['aal_add_link'])) if($_POST['aal_add_link']=='1') {
			
		//Security and input check
		check_admin_referer('WP-auto-affiliate-links_add_link');		
			
		$aal_link = filter_input(INPUT_POST, 'aal_link', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['link'];
		$aal_keywords = filter_input(INPUT_POST, 'aal_keywords', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['keywords'];
		$aal_title = filter_input(INPUT_POST, 'aal_title', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['title'];
				
		if($aal_link && $aal_keywords) {	
			$aal_link = aal_add_http($aal_link);		
			
						
			
			$meta = new StdClass();
			$meta->title = $aal_title;
			$jmeta = json_encode($meta);
			
			$check = $wpdb->get_results( "SELECT * FROM ". $table_name ." WHERE link = '". $aal_link ."' " );		
			
			// Add to database 
			if($check) { 
					$wpdb->update( $table_name, array( 'keywords' => $check[0]->keywords .','. $aal_keywords), array( 'link' => $aal_link ) );
					$aal_delete_id=$check[0]->id;
				}
			else {
				$rows_affected = $wpdb->insert( $table_name, array( 'link' => $aal_link, 'keywords' => $aal_keywords, 'meta' => $jmeta ) );
				$aal_delete_id=$wpdb->insert_id;
			} 		
		}
		wp_redirect("admin.php?page=aal_topmenu");	
		
	}

	//Check if a keyword was edited
	if(isset($_POST['aal_edit'])) if($_POST['aal_edit']=='ok') {
			
		//Security and input check
		check_admin_referer('WP-auto-affiliate-links_edit_link');		
		$id = filter_input(INPUT_POST, 'edit_id', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['id'];
		$link = filter_input(INPUT_POST, 'aal_link', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['link'];
		$keywords = filter_input(INPUT_POST, 'aal_keywords', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['keywords'];
		$title = filter_input(INPUT_POST, 'aal_title', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['title'];
		$samelinkmeta = filter_input(INPUT_POST, 'aal_samelinkmeta', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['title'];
		
		$meta = new StdClass();
		$meta->title = $title;
		$meta->samelink = $samelinkmeta;

		//Update the database and redirect
		$rows_affected = $wpdb->update( $table_name, array( 'link' => $link, 'keywords' => $keywords, 'meta' => json_encode($meta) ), array( 'id' => $id ));
		wp_redirect("admin.php?page=aal_topmenu");	
	}
	
	//Check if multiple items are selected for deletion
	if(isset($_POST['aal_massactionscheck'])) {
	
		$massids = filter_input(INPUT_POST, 'aal_massstring', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['aal_massstring'];
		$wpdb->query("DELETE FROM ". $table_name ." WHERE id IN (". $massids .")");	

		wp_redirect("admin.php?page=aal_topmenu");	
	}
	
	//Perform export actions
	if(isset($_POST['aal_export_check'])) {				
		
		$myrows = $wpdb->get_results( "SELECT id,link,keywords,meta FROM ". $table_name );
		$separator = $_POST['aal_export_separator'];
		if($separator=='tab') $separator = "\t";
		if(!$separator) $separator = "|";
		//$separator = "|";
		
		$File = 'aal_export.txt';
		header("Content-Disposition: attachment; filename=\"" . basename($File) . "\"");
		header('Content-type: text/plain');
		header("Connection: close");
		
		foreach($myrows as $row) {
			$ltitle = '';
			if($row->meta)  {
				$lmeta = json_decode($row->meta);
				if($lmeta->title) $ltitle = $lmeta->title;
			}
			echo "\"" .  $row->keywords . "\"" . $separator . "\"" . $row->link ."\"" . $separator . "\"" . $ltitle . "\"" . "\n";

		}
		die();
		
		wp_redirect("admin.php?page=aal_topmenu");	
	}
	
	//Actions to run if exclude rule was set
	if(isset($_POST['aal_excluderulesaction'])) {		
	
		$date = $_POST['aal_excluderulesdatebefore'];
		//echo $date;
		delete_option('aal_excluderulesdatebefore');
		add_option('aal_excluderulesdatebefore', $date);
	
	}	
	
	
	
	//Append actions for any module activated.
	global $aalModules;
	foreach($aalModules as $aalMod) {
		
		if(isset($aalMod->hooks['actions'])) if(function_exists($aalMod->hooks['actions'])) call_user_func($aalMod->hooks['actions']);		
			
	}		
		
	//Actions to run if post is excluded by url
	if(isset($_POST['aal_exclude_post_byurl_check']) && isset($_POST['aal_exclude_post_url'])) {
			
		$url = esc_url($_POST['aal_exclude_post_url']);
		$postid = url_to_postid( $url );
			
		if($postid) {
				
			$aal_exclude_id = $postid;
			
			$aal_posts = get_option('aal_exclude');
			$post = get_post($aal_exclude_id);
            $data['post_title'] = $post->post_title;
            if(!$post->ID) {
            	die('nopost');
			}
					
			$aal_posts_array = explode(',',$aal_posts);
			if(in_array($post->ID,$aal_posts_array)) {
				return; 					
			}
               
                
            if($aal_posts=='') $aal_exclude=$aal_exclude_id;
            else $aal_exclude=$aal_posts.",".$aal_exclude_id;                  
                 
            delete_option('aal_exclude'); add_option( 'aal_exclude', $aal_exclude);
			 
		}
			
			
			
	}	
	//End actions to run when post is excluded by url
	
}  //End main plugin actions function


//Function that will render the administration page
function wpaal_manage_affiliates() {
	global $wpdb;
	$table_name = $wpdb->prefix . "automated_links";
	
	//Code that will count visits to this page, used to show notification only to those who really used the plugin. 
	if(get_option('aal_pagevisits')<4) {
		if(get_option('aal_pagevisits')) {
			$aalpagevisits = get_option('aal_pagevisits') + 1;
			update_option('aal_pagevisits', $aalpagevisits );
		}
		else {
			update_option('aal_pagevisits', 1);
		}
	}
	

	//Load the keywords and options
	$myrows = $wpdb->get_results( "SELECT id,link,keywords FROM ". $table_name );
	//Load excluded posts	
	$excludeposts = get_option('aal_exclude');
        
	$apikey = get_option('aal_apikey');	
	
	//Render the page
    ?>
	<div class="wrap">  
        <div class="icon32" id="icon-options-general"></div>  
        <h2>Auto Affiliate Links</h2>
		<br /><br />
        <div id="aal_panel3">
       

			Thank you for using Auto Affiliate Links. The plugin will display affiliate links to your visitors based on your chosen keywords. Add affiliate links that you want to be displayed, and the keywords or keyphrases where you want them to be displayed into your content. 
			<br /><br />
			
			<?php if(!$apikey) {
				
						//echo 'Please support Auto Affiliate Links development by upgrading to  <a href="https://autoaffiliatelinks.com/auto-affiliate-links-payment-plans/">Auto Affiliate Links PRO</a>.';					
				
				} ?>
                                
			<h4>Add your affiliate link and keywords to be displayed on:</h4>

            <form name="add-link" method="post" id="aal_add_new_link_form">
                <input type="hidden" name="action" value="add_link" />
                <input type="hidden" name="aal_add_link" value="1" />
                  <?php
                  if (function_exists('wp_nonce_field')) wp_nonce_field('WP-auto-affiliate-links_add_link');
                  ?>
                <span class="aal_label">Affiliate link:</span> <input class="aal_biginput" type="text" name="aal_link" value="" id="aal_formlink" placeholder="Affiliate Link, please include https:// or https://" /> <br /><br />
                <span class="aal_label">Keywords:</span> <input class="aal_biginput" type="text" name="aal_keywords" id="aal_formkeywords" placeholder="keyword1, keyword2" /> <br /><br />
                <div class="aal_form_advanced_options">	
                <span class="aal_label">Title:</span> <input class="aal_biginput_title" type="text" name="aal_title" id="aal_formtitle" placeholder="link title" /> ( optional )
					 </div>
					<a href="javascript:;" class="aal_form_toggle_advanced" onclick="" >Show advanced options</a>  <br /><br />
                <input type="submit" class="button-primary" name="Save" value="Add Link" />&nbsp;&nbsp;&nbsp; 
                
                <br /><br />
                <?php aalGetSugestions($myrows);?>
            </form>
                    
			<div>
			
			<br />	
			
			
				<div id="aal_addlink_confirmation" style="display: none;position: fixed;top:45%;left:45%;background-color: #fff;padding: 50px;font-size: 20px;z-index: 900;border: 1px solid;">
						Link added. <a href="javascript:;" onclick="document.getElementById('aal_addlink_confirmation').style.display = 'none';" >Close</a>			
				</div>		
				
	<?php
	
	
		
	if($apikey) {
		
		$validcheck = @file_get_contents('https://autoaffiliatelinks.com/api/apivalidate.php?apikey='. $apikey );
		if($validcheck === FALSE) {
			$valid = new StdClass();
			$valid->status = 'failed';
		}
		else $valid = json_decode($validcheck);
		
		
	
	
	if($valid->status == 'expired' && $apikey) { 
		echo 'Your Auto Affiliate Links PRO subscription is expired. Please <a href="https://autoaffiliatelinks.com/auto-affiliate-links-payment-plans/">renew your subscription</a> or <a href="https://autoaffiliatelinks.com/auto-affiliate-links-payment-plans/">create a new API key</a> <br /><br />';
		if(get_option('aal_apistatus')) {
			update_option('aal_apiexpired','expired');
		}
		else {
			add_option('aal_apistatus','expired','','yes');
		}	
	}  
	else 
	{
		delete_option('aal_apistatus');
		if($valid->status == 'invalid' && $apikey) { 
			echo 'The API key you entered is invalid. You have to <a href="https://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">register on our website</a> to get a valid API key. <br /><br />';
			if(get_option('aal_apiexpired')) {
				update_option('aal_apistatus','invalid');
			}
			else {
				add_option('aal_apistatus','invalid','','yes');
			}	
		}
		else 
		{
			delete_option('aal_apistatus');
		}
	}
	

		
	if(isset($valid->queries)) if($valid->queries == 'overquota') {
		echo 'Your API queries monthly limit has been reached. Go to <a href="https://autoaffiliatelinks.com/members-area/download-page/">our website</a> to upgrade your plan. <br /><br />';
		if(get_option('aal_querylimit')) {
			update_option('aal_querylimit','overquota');
		}
		else {
			add_option('aal_querylimit','overquota','','yes');
		}
		
	}
	else {
		delete_option('aal_querylimit');
	}
	
	
	
	}	
	
	else {
	
		//echo 'Please support Auto Affiliate Links development by upgrading to  <a href="https://autoaffiliatelinks.com/auto-affiliate-links-payment-plans/">Auto Affiliate Links PRO</a>.';	
			
	
		echo 'If you want links to be extracted and displayed automatically from Amazon, Clickbank, Shareasale, Ebay, Walmart, Commision Junction and Envato Marketplace, you only have to <a href="https://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">get your API key</a>.';	
		
		echo '<br /><br />You can bulk add multiple links using the <a href="'. admin_url('admin.php?page=aal_import_export') .'">"Import/Export"</a> page. ';
		
		//echo 'If you want links to be extracted and displayed automatically from Amazon, Clickbank, Shareasale, Ebay, Walmart, Commision Junction and Envato Marketplace try our new Automated Linking Service: <a href="http://azerna.com">Azerna</a>.';	
	
	
	
	}
	
	$aalorder = filter_input(INPUT_GET, 'aalorder', FILTER_SANITIZE_SPECIAL_CHARS); // $_GET['aalorder'];
	if('keywords' == $aalorder) $order_list = '<form name="aal_linksorderform" method="get">
							<br />
                    Order list by: 
                    
                    <a href="?page=aal_topmenu&aalorder=id" >Date added</a> | 
                    Name
							<input type="hidden" name="aal_linksorderinput" value="" />
							</form>';	
	else $order_list = '<form name="aal_linksorderform" method="get">
							<br />
                    Order list by: 
                    
                    Date added | 
                    <a href="?page=aal_topmenu&aalorder=keywords">Name</a>
							<input type="hidden" name="aal_linksorderinput" value="" />
							</form>';	
	
	
	
	  ?>				
				
			<br /><br />	
				
				
			</div>   
                                    
                    
                    <h3>Affiliate Links:</h3>
                    
							<?php echo $order_list; ?>
                    <ul class="aal_links">

                         <?php AalLink::showAll(); // Showing existent affiliate links with edit and delete options ?>


                    </ul>
                    
                    
                   <?php echo $order_list; ?>
                    <br />
                    <form name="aal_massactions" method="post" onsubmit="return aal_masscomplete(); " >
                    	<input class="button-primary" type="submit" name="aal_selectall" id="aal_selectall" value="Select all" onclick="return false"/>
							
							
							<input type="hidden" name="aal_massactionscheck" value="1" />
							<input type="hidden" name="aal_massstring" value="" id="aal_massstring" />
							<input type="submit"  class="button-primary"  value="Delete selected" onclick="" />
							</form>                    
            	<br />
            	<p>If you want to see a preview of links displayed by the plugin in your content, visit <a href="?page=aal_generatedlinks">Generated Links page</a></p> 
             
<br /><br />                    
<p>If you have problems or questions about the plugin, or if you just want to send a suggestion or request to our team, you can use the <a href="https://wordpress.org/support/plugin/wp-auto-affiliate-links">support forum</a>. Make sure that you consult our <a href="https://wordpress.org/plugins/wp-auto-affiliate-links/faq/">FAQ</a> first. </p>                    
                                     
                    
                    </div>
    </div>



 <?php  }  // manage_affliate links


?>
