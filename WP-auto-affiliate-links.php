<?php
/*
Plugin Name: WP Auto Affiliate Links
Plugin URI: http://autoaffiliatelinks.com
Description: Auto add affiliate links to your blog content
Author: Lucian Apostol
Version: 3.6.2.7
Author URI: http://autoaffiliatelinks.com
*/






//functions used in plugin



//Load css stylesheets
function aal_load_css() {
	
        //load css styles
        wp_register_style( 'tabs', plugins_url('css/tabs.css', __FILE__) );
        wp_enqueue_style('tabs');


}

//load javascript files
function aal_load_js() {
	
        // load our jquery file that sends the $.post request
	wp_enqueue_script( "js", plugin_dir_url( __FILE__ ) . 'js/js.js', array( 'jquery' ) );
	//wp_enqueue_script( "tabs", plugin_dir_url( __FILE__ ) . 'js/jquery.tools.min.js', array( 'jquery' ) );
        
        $aal_plugin_url=plugin_dir_url(__FILE__);
        
        // make the ajaxurl var available to the above script
	wp_localize_script( 'js', 'ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php'),'aal_plugin_url' =>$aal_plugin_url  ) );	
        
}

//Get list of link showed on Add Affiliate Links tab

function aalGetLinks($myrows){
         foreach($myrows as $row) {

                                    $aal_id = $row->id;
                                    $aal_link = $row->link;
                                    $aal_keywords = $row->keywords;

                                    ?>
                                        <form name="edit-link-<?php echo $aal_id; ?>" method="post">
                                        <input value="<?php echo $aal_id; ?>" name="edit_id" type="hidden" />
                                        <input type="hidden" name="aal_edit" value="ok" />
                                                
                                        <?php
                                        if ( function_exists('wp_nonce_field') )
                                                wp_nonce_field('WP-auto-affiliate-links_edit_link');
                                        ?>
                                            <li style="" class="aal_links_box">
                                                Link: <input style="margin: 5px 10px;width: 250px;" type="text" name="aal_link" value="<?php echo $aal_link; ?>" />
                                                Keywords: <input style="margin: 5px 10px;width: 110px;" type="text" name="aal_keywords" value="<?php echo $aal_keywords; ?>" />
                                                <input style="margin: 5px 2px;" type="submit" name="ed" value="Edit" />
                                                <a href="#" id="<?php echo $aal_id; ?>" class="aalDeleteLink"><img src="<?php echo plugin_dir_url(__FILE__);?>images/delete.png"/></a>
                                            </li>    
                                        </form>

                                            
                          <?php } 
}



include(plugin_dir_path(__FILE__) . 'aal_install.php');
include(plugin_dir_path(__FILE__) . 'aal_cloaking.php');
include(plugin_dir_path(__FILE__) . 'aal_functions.php');
include(plugin_dir_path(__FILE__) . 'aal_ajax.php');
include(plugin_dir_path(__FILE__) . 'aal_engine.php');
include(plugin_dir_path(__FILE__) . 'aal_settings.php');
include(plugin_dir_path(__FILE__) . 'aal_exclude.php');
include(plugin_dir_path(__FILE__) . 'aal_modules.php');
include(plugin_dir_path(__FILE__) . 'aal_importexport.php');

add_action('admin_init', 'wpaal_actions');
add_action('admin_menu', 'wpaal_create_menu');
add_filter('the_content', 'wpaal_add_affiliate_links');
add_action('init', 'wpaal_rewrite_rules');
add_action('query_vars', 'wpaal_add_query_var');
add_action('wp','wpaal_check_for_goto');
add_action('wp_print_scripts', 'aal_load_css');
add_action('wp_print_scripts', 'aal_load_js');
add_action('wp_ajax_aal_delete_link', 'aalDeleteLink');
add_action('wp_ajax_aal_add_link', 'aalAddLink');
add_action('wp_ajax_aal_change_options', 'aalChangeOptions');
add_action('wp_ajax_aal_add_exclude_posts', 'aalAddExcludePost');
add_action('wp_ajax_aal_update_exclude_posts', 'aalUpdateExcludePosts');

//add_action('wp_ajax_exclude_posts', 'aalExcludePosts');





// Add Wp Auto Affiliate Links to Wordpress Admnistration panel menu
function wpaal_create_menu() {

add_menu_page( 'Auto Affiliate Links', 'Wp Auto Affiliate Links', 'publish_pages', 'aal_topmenu', 'wpaal_manage_affiliates', $icon_url, $position );	
add_submenu_page( 'aal_topmenu', 'General Settings', 'General Settings', 'publish_pages', 'aal_general_settings', 'wpaal_general_settings' );
add_submenu_page( 'aal_topmenu', 'Modules', 'Modules', 'publish_pages', 'aal_modules', 'wpaal_modules' );
add_submenu_page( 'aal_topmenu', 'Exclude Posts', 'Exclude Posts', 'publish_pages', 'aal_exclude_posts', 'wpaal_exclude_posts' );
add_submenu_page( 'aal_topmenu', 'Import/Export', 'Import/Export', 'publish_pages', 'aal_import_export', 'wpaal_import_export' );

}

function wpaal_actions() {
    
        global $wpdb;
        $table_name = $wpdb->prefix . "automated_links";
                

	//Check if a keyword was edited
	if($_POST['aal_edit']=='ok') {
			
		//Security and input check
		check_admin_referer('WP-auto-affiliate-links_edit_link');		
		$id = filter_input(INPUT_POST, 'edit_id', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['id'];
		$link = filter_input(INPUT_POST, 'aal_link', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['link'];
		$keywords = filter_input(INPUT_POST, 'aal_keywords', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['keywords'];

		//Update the database and redirect
		$rows_affected = $wpdb->update( $table_name, array( 'link' => $link, 'keywords' => $keywords ), array( 'id' => $id ));
		wp_redirect("admin.php?page=aal_topmenu");

			
	}
	
	

	
	
	
	if($_POST['aal_export_check']) {				
		
		$myrows = $wpdb->get_results( "SELECT id,link,keywords FROM ". $table_name );
		$separator = $_POST['aal_export_separator'];
		if($separator=='tab') $separator = "\t";
		if(!$separator) $separator = "|";
		//$separator = "|";
		
		$File = 'aal_export.txt';
header("Content-Disposition: attachment; filename=\"" . basename($File) . "\"");
header('Content-type: text/plain');
header("Connection: close");
		
foreach($myrows as $row) {

	echo $row->keywords . $separator . $row->link . "\n";

}
		
		die();
		
		wp_redirect("admin.php?page=aal_topmenu");	
	}
	
	

}  // wpaal_actions end







//Function that will render the administration page
function wpaal_manage_affiliates() {
	global $wpdb;
	$table_name = $wpdb->prefix . "automated_links";


	//Load the keywords and options
	$myrows = $wpdb->get_results( "SELECT id,link,keywords FROM ". $table_name );
	
        
        $excludeposts = get_option('aal_exclude');
        
	
	//Render the page
        ?>
        <h1>Manage Affiliate Links</h1>
	<br /><br />
	<div class="updated" style="text-align:center;padding: 10px;"><a href="http://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">Wp Auto Affiliate Links PRO 2.0 </a> has been released. The PRO version will automatically display links from amazon, clickbank, shareasale and comission junction. Yout only have to setup and activate your prefered networks and links will be extracted automatically. <a href="http://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">Find out more</a>.</div>
	<br /><br />
	<!-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<!-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="RGNWD2T23VX2J">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	<br /><br /> -->
        

<script type="text/javascript">
function hideAllTabs(panelName) {

	 jQuery('.aal_panes').children().hide();
	 jQuery("div#" + panelName).show();
	document.location.hash = '#' + panelName;


}
</script>
        	
        <ul class="aal_tabs" id="aal_tabs">
   <li><a href="javascript:;" title="Add Affiliate Links" onclick="hideAllTabs('aal_panel3');" >Add Affiliate Links</a></li>

		<?php global $aalModules;
		foreach($aalModules as $aalMod) {
		
			?>
				<li><a href="javascript:;" title="<?php echo $aalMod->nicename; ?>" onclick="hideAllTabs('<?php echo $aalMod->shortname; ?>Tab');" ><?php echo $aalMod->nicename; ?></a></li>


			<?php
		

		}

		?>
                                            
        </ul>

        <!-- tab "panes" -->
        <div class="aal_panes">



		<?php global $aalModules;
		foreach($aalModules as $aalMod) {
		
			?>

			<div id="<?php echo $aalMod->shortname; ?>Tab">
				<br />
                <h3><?php echo $aalMod->nicename; ?></h3>
				<br />
				<br />
				<?php echo call_user_func($aalMod->hooks['content']); ?>



			</div>

			<?php
		

		}

		?>






            <div id="aal_panel1">

            </div>
            
            <div id="aal_panel2">
                
           
            </div>
            
            <div id="aal_panel3">
                    <p>After you add the affiliate links, make sure you write keywords in the respective field, separated by comma. If you don\'t enter any keyword, that link won\'t be displayed.</p>
                    <p>After you hit save, all keywords entered found in the content will be replaced with the links to the affiliate page</p>


                    <form name="add-link" method="post" action="<?php echo admin_url( "admin-ajax.php");?>" id="aal_add_new_link_form">
                        <input type="hidden" name="action" value="add_link" />
                        Affiliate link: <input type="text" name="link" value="http://" id="aal_formlink" />
                        Keywords: <input type="text" name="aal_keywords" id="aal_formkeywords" />
                        <input type="submit" name="Save" />
                    </form>
                    
                    <br/>Here is a list with most used keywords in all your blog. Click on each and it will be added in the form above so you can assign a link for it.<br />
                                <?php aalGetSugestions($myrows);?>
                    
                    <h3>Affiliate Links:</h3>

                    <ul class="aal_links">

                         <?php aalGetLinks($myrows); // Showing existent affiliate links with edit and delete options ?>


                    </ul>
            </div>

	 <div id="aal_panel31">


	</div>
			
			
			<div id="aal_panel4">
		
			</div>
			
			
			
			
			<div id="aal_panel5">
	
				
			</div>
            
     </div>
        


 <?php  }  // manage_affliates end





?>