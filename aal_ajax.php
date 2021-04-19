<?php



//Delete link button (called by ajax)
function aalDeleteLink(){
    
            if(isset($_POST['id'])){
                global $wpdb;
                $table_name = $wpdb->prefix . "automated_links";
                
                //Security check and input sanitize
		$id = intval(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS)); // $_GET['id'];
		
		//Add to database and redirect to the plugin default page
		$wpdb->query("DELETE FROM ". $table_name ." WHERE id = '". $id ."' LIMIT 1");
                
                die();
            }
}



//Add link form (called by ajax)
function aalAddLink(){
    
            	global $wpdb;
                $table_name = $wpdb->prefix . "automated_links";



     	
		// Security check and sanitize	
		$aal_link = filter_input(INPUT_POST, 'aal_link', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['link'];
		$aal_keywords = filter_input(INPUT_POST, 'aal_keywords', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['keywords'];
		$aal_title = filter_input(INPUT_POST, 'aal_title', FILTER_SANITIZE_SPECIAL_CHARS); // $_POST['title'];
		
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
		
        
                
                
                $aal_json=array( 'aal_delete_id' => $aal_delete_id, 'aal_new_url' => $aal_link );
                
                echo json_encode($aal_json);
                
                die();
}






?>