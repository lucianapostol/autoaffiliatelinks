<?php


class AalLink
{
	var $id;
    var $link;
    var $keywords;
    var $medium;
    var $meta;
    var $hooks = array();


	function __construct($id,$link,$keywords,$medium,$meta) {
		
		$this->id = $id;
		$this->link = $link;
		$this->keywords = $keywords;
		$this->medium = $medium;
		$this->meta = $meta;

	}
	
	static function showAll($medium = '') {
			global $wpdb;
			$table_name = $wpdb->prefix . "automated_links";	
			$orderby = filter_input(INPUT_GET, 'aalorder', FILTER_SANITIZE_SPECIAL_CHARS); // $_GET['aalorder'];
			$ordersql = '';
			if($orderby) $ordersql = " ORDER BY ". $orderby; 		
			else 	$ordersql = " ORDER BY id"; 
			
			
			$myrows = $wpdb->get_results( "SELECT * FROM ". $table_name . $ordersql);

			if($myrows) {
        	 foreach($myrows as $row) {

				$link = new AalLink($row->id,$row->link,$row->keywords,$row->medium,$row->meta);
				$link->display();
            
             } 	
            }
          else {
          
          	echo '<div>Add some links using the form above</div>';
          
          }
		
	}	
	
	

	function display() {
		$meta = json_decode($this->meta);
		if(!is_object($meta)) {
			$meta = new StdClass();
			$meta->title = '';		
			$meta->samelink = '';
		
		}
		else {
			if(!isset($meta->samelink) || !is_numeric($meta->samelink) ) $meta->samelink = '';		
		}
		
		if(get_option('aal_iscloacked') ) {
					global $wp_rewrite; 
					$keys = explode(',',$this->keywords);
					$cloakurl = get_option('aal_cloakurl');
					if(!$cloakurl || !is_string($cloakurl)) $cloakurl = 'goto';
						if($wp_rewrite->permalink_structure) 
							$link = get_option( 'home' ) . "/". $cloakurl ."/" . $this->id . "/" . wpaal_generateSlug($keys[0]);
						else $link = get_option( 'home' ) . "/?". $cloakurl ."=" . $this->id;						
		
		
		}
		
		
 		?>
 		

 		
            <form name="edit-link-<?php echo $this->id; ?>" method="post">
                  <input value="<?php echo $this->id; ?>" name="edit_id" type="hidden" />
                  
                  <input type="hidden" name="aal_edit" value="ok" />
                                                
                  <?php
                  if (function_exists('wp_nonce_field')) wp_nonce_field('WP-auto-affiliate-links_edit_link');
                  ?>
                  <li style="" class="aal_links_box">
                  <input type="checkbox" name="aal_massids[]" value="<?php echo $this->id; ?>" />
                       Link: <input style="margin: 5px 10px;width: 32%;" type="text" name="aal_link" value="<?php echo $this->link; ?>" />
                       Keywords: <input style="margin: 5px 10px;width: 15%;" type="text" name="aal_keywords" value="<?php echo $this->keywords; ?>" />
							<a href="javascript:;" class="aal_edit_show_advanced" >Show advanced options</a>			
							<a href="javascript:;" class="aal_edit_hide_advanced" style="display: none;">Hide advanced options</a>					
							 <input  class="button-primary" style="margin: 5px 2px;" type="submit" name="ed" value="Update" />
                        <a href="#" id="<?php echo $this->id; ?>" class="aalDeleteLink button-primary">Delete</a>
                        <?php if(get_option('aal_iscloacked') ) { ?>
                        	<a href="javascript:;" class="aal-copy-cloak button-primary" data-id="<?php echo $this->id; ?>" onclick="aalCopyCloak(this);">Copy link</a>
                        <?php } ?>
                        <div class="aal_edit_advanced" id="edit_advanced_<?php echo $this->id; ?>" style="display:none; margin-left: 25px;">                       
                      	 Title: <input style="margin: 5px 10px;width: 10%;" type="text" name="aal_title" value="<?php echo $meta->title; ?>" />
                      	 Custom same link limit: <input style="margin: 5px 10px;width: 10%;" type="text" name="aal_samelinkmeta" value="<?php echo $meta->samelink; ?>" />
                      	 <span id="urlcheck_<?php echo $this->id; ?>" class="aal_urlvalid"></span>
                      	 <a href="javascript:;" class="aalCheckURL button-primary" style="margin: 5px 12px;" type="button" name="aal_checkurl"  />Check URL</a>
								<?php if(get_option('aal_iscloacked') ) { ?>								 
								 <br /><br />
								 Cloaked link: <input type="text" id="aal-cloak-<?php echo $this->id; ?>" style="width: 50%" readonly value="<?php echo $link; ?>" />								
								<?php } ?>
								<hr /><hr />               
                     </div>
                      
                  </li>    
</form>

                                            
         <?php		
		
		
	}

}


function aalGetLink($id) {
	
		if(!$id) return false;	
		global $wpdb;
		$table_name = $wpdb->prefix . "automated_links";	
		$myrows = $wpdb->get_results( "SELECT * FROM ". $table_name ." WHERE id='". $id ."' ");
		
		$link = AalLink($id,$link,$keyword,$medium);
	
	
}

function aalGetLinkByUrl($url) {
		
		if(!$url) return false;
		global $wpdb;
		$table_name = $wpdb->prefix . "automated_links";	
		$myrows = $wpdb->get_results( "SELECT * FROM ". $table_name ." WHERE link='". $url ."' ");
		
		$link = AalLink($id,$link,$keyword,$medium);
	
	
}


?>