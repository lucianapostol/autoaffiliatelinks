<?php

function wpaal_generatedlinks() {
	global $wpdb; 
	
	




		//$data = file_get_contents('http://autoaffiliatelinks.com/api/getlinks.php?apikey='. get_option('aal_apikey') );
		//echo $data;
		if(isset($data)) $data = json_decode($data);


		if(isset($data)) $links = $data->links;
		if(isset($data)) $number = $data->number;
		$exposts = get_option('aal_exclude');
		$exarray = explode(',',$exposts);
		
	
		wp_enqueue_script( "generatedlinksjs", plugin_dir_url( __FILE__ ) . 'js/generatedlinks.js' );

?>

					<div id="aal_apikey" data-apikey="<?php echo get_option('aal_apikey'); ?>" ></div>               
                
                
                <script type="text/javascript">
						function forceExclude(postid) { 
						
							//document.aal_add_exclude_posts_form.aal_exclude_post_id.value = postid;
						
						
						}               
                
                </script>


<div class="wrap">  
    <div class="icon32" id="icon-options-general"></div>  
        
        
                <h2>Generated Links</h2>

<?php 
		$apikey = get_option('aal_apikey');

		if($apikey) {   ?>

               <br /><br />
             <h3>Manual Generated Links. </h3>
             <br /><br />
             
             
<br />
<table id="aal_glmanual" class="widefat fixed aal_table" >
	<thead>
		<tr>
			<th>Post link</th>
			<th>Keywords</th>
			<th>Exclusion</th>
		</tr>
	</thead>
	
	<tfoot>
		<tr>
			<th>Post link</th>
			<th>Keywords</th>
			<th>Exclusion</th>
		</tr>
	</tfoot>
	
	<tbody>
	
	
<?php 

if(isset($_GET['pn']) && intval($_GET['pn'])) {
	$pn = intval( $_GET['pn'] );
}
else $pn = 0;

$allposts = new WP_Query( array(
	'post_status'=>'publish',
	'meta_query' => array(
		 'aal_manualgenerated' => array(
			'key' => 'aal_manualgenerated',
			'compare' => 'EXISTS',
		)
	)
) );
$pno = $allposts->post_count; 



$rdl = 20; 
$rof = $rdl * $pn ;

//	'offset' => 1,
$rd_args = array(
	'post_status'=>'publish',
	'numberposts' => $rdl,
	'offset' => $rof,
	'meta_query' => array(
		 'aal_manualgenerated' => array(
			'key' => 'aal_manualgenerated',
			'compare' => 'EXISTS',
		)
	)
);
 
$rd_query = new WP_Query( $rd_args );

$manualgenerated = get_posts($rd_args);


$alternate = 0;
if(isset($manualgenerated)) if(is_array($manualgenerated)) foreach($manualgenerated as $post) { 

	
	$mlinks = get_post_meta( $post->ID, 'aal_manualgenerated', true );

?>

	
	<tr class="<?php if($alternate % 2 == 0) echo 'alternate'; ?>" >
		<td>
			<a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_permalink($post->ID); ?></a>
		</td>
		<td>
			<?php 
				if(is_array($mlinks)) foreach($mlinks as $l) {
						echo '<a href="'. $l->url .'">'. $l->keyword .'</a>, '; 
						
						
						
						
				}
				else echo 'No links';			
			
			 ?>
		</td>
		<td>
				<?php /*   <form action="admin.php?page=aal_exclude_posts" method="post">
                    <input type="hidden" name="aal_exclude_post_id" id="aal_add_exclude_post_id" value="<?php echo $post->ID; ?>" />
                    <input  class="button-primary"  type="submit" value="Exclude this post from showing links"/>
                </form> */ ?>
		</td>
	</tr>
<?php 
	$alternate++;
	

} ?>     

       
             
                
     </tbody>
 </table>



			<?php
		
		if($pno > $rdl || $pn) {
			
			$uparams = $_GET;
			unset($uparams["pn"]);
			
			
			if($pn>0) { $uparams['pn'] = 0; echo '&nbsp;&nbsp;<a href="?'. http_build_query($uparams) .'"><< First</a>&nbsp;&nbsp;'; }		
			if($pn>0) { $uparams['pn'] = $pn - 1; echo '&nbsp;&nbsp;<a href="?'. http_build_query($uparams) .'">< Previous</a>&nbsp;&nbsp;'; }		
			
			echo '&nbsp;&nbsp;Page&nbsp;&nbsp;' . ($pn + 1) .'&nbsp; of &nbsp;'. ceil($pno / $rdl);			
			
			if($pno > $rof + $rdl ) { $uparams['pn'] = $pn + 1; echo '&nbsp;&nbsp;<a href="?'. http_build_query($uparams) .'">Next ></a>&nbsp;&nbsp;'; }
			if($pno > $rof + $rdl ) { $uparams['pn'] = floor($pno / $rdl); echo '&nbsp;&nbsp;<a href="?'. http_build_query($uparams) .'">Last >></a>'; }
			
		}	
			?>			









                <br /><br />
             <h3>Automated Generated Links. </h3>
             <br /><br />
             
             
<?php







             
?>             
<br /><br /><br />
<table id="aal_gltable" class="widefat fixed aal_table" >
	<thead>
		<tr>
			<th>Post link</th>
			<th>Keywords</th>
			<th>Exclusion</th>
		</tr>
	</thead>
	
	<tfoot>
		<tr>
			<th>Post link</th>
			<th>Keywords</th>
			<th>Exclusion</th>
		</tr>
	</tfoot>
	
	<tbody>
	
	
<?php 


$alternate = 0;
$postsadd = array();
if(isset($links)) if(is_array($links)) foreach($links as $link) { 

		$keywords = json_decode($link->keywords);
		//print_r($keys);
		$kwlist = '';
		foreach($keywords as $keyword) {
			
			$kwlist .= '<a href="'. $keyword->url .'">'. $keyword->key .'</a> ';		
		
		}
		
		$exclude = '';
		$exclude = url_to_postid( $link->url );

		if(!in_array($exclude,$postsadd)) { 		
		
		if(in_array($exclude,$exarray)) {
			
			$extext = "In this post links are not shown";		
		
		}
		else {
		
			$extext = "This posts show links";		
			
		}
		$postsadd[] = $exclude;

?>

	
	<tr class="<?php if($alternate % 2 == 0) echo 'alternate'; ?>" >
		<td>
			<a href="<?php echo $link->url; ?>"><?php echo $link->url; ?></a>
		</td>
		<td>
			<?php if(!$kwlist) echo 'No links generated for this post'; else echo $kwlist; ?>
		</td>
		<td>
			<?php echo $extext; ?><!-- <a href="javascript:;" onclick="return forceExclude(<?php echo $exclude; ?>)" >Exclude this post</a> -->
		</td>
	</tr>
<?php 
	$alternate++;
	}

} ?>             
             
                
     </tbody>
 </table>








	
<?php


			
			}
			
			else {				
				
				
					//_e( 'Amazon, Clickbank and Shareasale, Ebay, Walmart, Commission Junction, Bestbuy and Envato Marketplace  links can be automatically added into your content, you only have to <a href="https://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">get your API key</a>, add your affiliate ID and start earning. ', 'wp-auto-affiliate-links' );
			
			?> <br /><br /> <?php
				
			_e( 'Here you can see all links generated for your site. This feature is available only with <a href="https://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">Auto Affiliate Links PRO</a>. You can create a subscription on <a href="https://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">on our website</a>', 'wp-auto-affiliate-links' );
			
			
			}

}










?>