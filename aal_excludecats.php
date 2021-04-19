<?php


add_action('admin_init', 'aal_exclude_cats_actions');

	function aal_exclude_cats_actions() {
		
		
		aal_exclude_terms_actions('category','aal_excludecats', 'aal_add_exclude_cat');
		
		
		aal_exclude_terms_actions('post_tag','aal_excludetags', 'aal_add_exclude_tag');
		
		
		
	}
 

 function aal_exclude_terms_actions($taxon, $toption, $tpost) {
	global $wpdb;
	
		if(isset($_POST['aal_add_exclude_'. $taxon .'_check'])) if($_POST['aal_add_exclude_'. $taxon .'_check']=='ok') {
			

			$word = filter_input(INPUT_POST, $tpost, FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['id'];


			if(get_option($toption)) {
				$old = get_option($toption); 
				update_option($toption,$old . ',' . $word);
			}
			else {
				add_option($toption, $word);
			} 
		//	wp_redirect("admin.php?page=aal_topmenu");
	
			
	}
	
		if(isset($_POST['aal_exclude'. $taxon .'deletecheck'])) if($_POST['aal_exclude'. $taxon .'deletecheck']=='ok') {
			

			$word = filter_input(INPUT_POST, 'aal_exclude'. $taxon .'deletecat', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['id'];


			if(get_option($toption)) {
				$old = get_option($toption);
				$olda = explode(",",$old);
				if(($key = array_search($word, $olda)) !== false) {
   					 unset($olda[$key]);
				}
				$old = implode(",",$olda);
				if($old) update_option($toption,$old);
				else delete_option($toption);
			}
			else {
				// add_option('aal_excludewords', $word);
			} 
		//	wp_redirect("admin.php?page=aal_topmenu");
	
			
	}
	
	
} 


function wpaal_exclude_cats() {
	
?>	
<div class="wrap">  
        <div class="icon32" id="icon-options-general"></div>  
 
        
        
                <h2>Exclude Categories and Tags</h2>
                <br /><br /><br />
                

   

<?php


	wpaal_exclude_terms('category','categories','aal_excludecats','aal_add_exclude_cat');




	wpaal_exclude_terms('post_tag','tags','aal_excludetags','aal_add_exclude_tag');
	
?>


	<br /><br />
	<hr />
  <p>If you have problems or questions about the plugin, or if you just want to send a suggestion or request to our team, you can use the <a href="https://wordpress.org/support/plugin/wp-auto-affiliate-links">support forum</a>. Make sure that you consult our <a href="https://wordpress.org/plugins/wp-auto-affiliate-links/faq/">FAQ section</a> first. </p>
  
  </div>


<?php

}


function wpaal_exclude_terms($taxon, $tname, $toption, $tpost) {
	global $wpdb;
	
		//get excluded categories

		
     	$words = get_option($toption); 
     	if($words) {
     			$words = explode(',', $words);	
     		}
     		else $words = array();
	
$args = array(
	'type'                     => 'post',
	'child_of'                 => '',
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 0,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => $taxon,
	'pad_counts'               => false 

); 

$categories = get_terms( $args );

//print_r($categories);


?>

	<h3>Manually exclude <?php echo $tname; ?></h3> 

            
                
                 <form name="aal_add_exclude_<?php echo $taxon; ?>_form" id="aal_add_exclude_cats_form" method="post">
                    <b>Select <?php echo $taxon; ?> to exclude </b>:
                    <select name="<?php echo $tpost; ?>" id="aal_add_exclude_cat" >
						<option value="">-Select a <?php echo $taxon; ?>-</option>
						<?php foreach($categories as $cat) if(is_array($words) && !in_array($cat->term_id,$words)) { ?>
						<option value="<?php echo $cat->term_id; ?>"><?php echo $cat->name .' ('. $cat->count .')'; ?></option>	
						<?php } ?>                 
                    
                    </select>
                    <input type="hidden" name="aal_add_exclude_<?php echo $taxon; ?>_check" value="ok" />
                    <input  class="button-primary"  type="submit" value="Exclude Category"/>
                </form>
                
                
                
               <br />
               <br /
     <h4>Excluded <?php echo $tname; ?>:</h4><br /><br />
	<table class="widefat fixed" > 
	<thead>
		<th>Excluded <?php echo $taxon; ?></th>
		<th>Actions</th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
	</thead>
     <?php 

     	
     if(is_array($words)) foreach ($words as $word) { ?>
     	
     	
	<tr>
		<td><?php echo get_the_category_by_ID($word); ?></td>
		<td><form name="aal_exclude<?php echo $taxon; ?>delete" method="post" ><input type="hidden" name="aal_exclude<?php echo $taxon; ?>deletecheck" value="ok" /><input type="hidden" name="aal_exclude<?php echo $taxon; ?>deletecat" value="<?php echo $word; ?>" /><input class="button-primary" type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this item?');" /></form></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
     		
 
     	
     	
     	<?php 	
     	}
     
     
     
     
     ?>
       </table>        
 
                
                
    <br />
    <br /><br />
    <hr />














<?php



}