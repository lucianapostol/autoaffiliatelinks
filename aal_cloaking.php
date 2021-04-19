<?php

// Contribution of Jos Steenbergen
// Rewrite engine for links

function wpaal_rewrite_rules() {
		$cloakurl = get_option('aal_cloakurl');
		if(!$cloakurl || !is_string($cloakurl)) $cloakurl = 'goto';
		add_rewrite_tag('%'. $cloakurl .'%','([^&]+)');
                add_rewrite_rule( $cloakurl .'/?([^/]*)', 'index.php?'. $cloakurl .'=$matches[1]', 'top');
       }
       
function wpaal_add_query_var($vars)  { 
		 $cloakurl = get_option('aal_cloakurl');
		 if(!$cloakurl || !is_string($cloakurl)) $cloakurl = 'goto';
       $vars[] = $cloakurl;
       return $vars;
       }
       
       
       

function wpaal_generateSlug($phrase)
{
       $maxLength = 45;
       $result = strtolower($phrase);

       $result = preg_replace("/[^a-z0-9\s-]/", "", $result);
       $result = trim(preg_replace("/[\s-]+/", " ", $result));
       $result = trim(substr($result, 0, $maxLength));
       $result = preg_replace("/\s/", "-", $result);

       return $result;
}


function wpaal_check_for_goto() { 
		 $cloakurl = get_option('aal_cloakurl');
		 if(!$cloakurl || !is_string($cloakurl)) $cloakurl = 'goto';
       global $wpdb;
       global $wp_query;
       
       if(isset($wp_query->query_vars[$cloakurl])) {


       $table_name = $wpdb->prefix . "automated_links";
              // $myrows = $wpdb->get_results( "SELECT id,link,keywords FROM ". $table_name );
 			
				global $wp_rewrite;
				if($wp_query->query_vars[$cloakurl] && is_numeric($wp_query->query_vars[$cloakurl])) { 

					$rerow = $wpdb->get_results( "SELECT id,link,keywords FROM ". $table_name ." WHERE id='". $wp_query->query_vars[$cloakurl] ."'  ");
					if($rerow[0]->link) wp_redirect( aal_add_http(html_entity_decode($rerow[0]->link)), 303 );
					exit;
				}

               }


}

?>