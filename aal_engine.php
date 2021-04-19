<?php

// The function that will actually add links when the post content is rendered
function wpaal_add_affiliate_links($content) {  


		do_action( 'aal_before_content_display' );

		global $wpdb;
		global $post;
		global $wp;
		if(!is_main_query()) return $content;		
		
		//$content = $post->ID . 'aal_pluginstatus' . $content;
		
		$timecounter = microtime(true);
		//echo $timecounter . "<br/>";
		
		
		$pluginstatus = get_option('aal_pluginstatus');
		if($pluginstatus=='inactive') return $content;		
		
		
		//Getting the keywords and options
		$showhome = get_option('aal_showhome');
		$showlist = get_option('aal_showlist');
		$showhtags = get_option('aal_showhtags');
		$showacf = get_option('aal_showacf');
		$notimes = get_option('aal_notimes'); if(!$notimes) $notimes = -1;
		$notimescustom = trim(get_option('aal_notimescustom'));
		if($notimes=='custom') if(is_numeric($notimescustom) && $notimescustom>=0) { $notimes = $notimescustom; $notimesc = 'on'; } else $notimes = 3;
		//echo $notimes;
		
		
		//Custom set of notimes
		if($post && is_object($post)) {
			$postnotimes = aal_get_meta_value($post->ID,'aal_meta_postnotimes');
			if(isset($postnotimes) && is_numeric($postnotimes) && $postnotimes>-1) $notimes = $postnotimes;	
		}
		
		
		
		
		$aal_exclude = get_option('aal_exclude');
		$iscloacked = get_option('aal_iscloacked');
		$cloakurl = get_option('aal_cloakurl');
		if(!$cloakurl || !is_string($cloakurl)) $cloakurl = 'goto';
		$cssclass = get_option('aal_cssclass');
		$skipadd = get_option('aal_skipadd');
		$disclosure = get_option('aal_disclosure');
		$ildisclosure = get_option('aal_il_disclosure');
		if($cssclass) $lclass = $cssclass . " aalmanual";
		else $lclass = 'aalmanual';
		
		
		$querylimit = get_option('aal_querylimit');
		
		$displayo = get_option('aal_display');
		$displayc = get_option('aal_displayc');
		$displayc =json_decode(stripslashes($displayc));
			
		$samekeyword = get_option('aal_samekeyword'); 
		if(!$samekeyword) $samekeyword = 3;
		if($samekeyword=='nolimit') $samekeyword = $notimes;
		$samelink = get_option('aal_samelink');
		if(!$samelink) $samelink = 'nolimit';
		if($samelink =='nolimit') $samelink = 100;
		if($samekeyword > $samelink) $samekeyword = $samelink;
		$linkdistribution = get_option('aal_linkdistribution');
		
		$targeto = get_option('aal_target');
		$relationo = get_option('aal_relation');

		$iltargeto = get_option('aal_il_target');
		$ilrelationo = get_option('aal_il_relation');	
		
		$priority = get_option('aal_priority');	
		if(!$priority) $priority = 'length';	
		
		
		$langsupport = get_option('aal_langsupport');
		if($langsupport=='true') $langsupport = 'u'; else $langsupport = '';
		$casesensitive = get_option('aal_casesensitive');
		$excludearray = explode(',',$aal_exclude);
		$table_name = $wpdb->prefix . "automated_links";


		
		$excludewords = get_option('aal_excludewords');
		$excludecats = get_option('aal_excludecats');
		$excludetags = get_option('aal_excludetags');
		if($excludecats) $ecats = explode(',',$excludecats);
		if($excludetags) $etags = explode(',',$excludetags);
		
		
		$spoption = get_option('aal_spoption');
		$wordreplace = get_option('aal_wordreplace');	
		$wrse = '\b';
		if($wordreplace=='true') $wrse = ''; else $wrse = '\b';
		
		
		
		
		$pmgen = array();
		
		
		// Exclusion by date
		if(isset($post)) $pdate = get_the_date('Y-m-d',$post->ID); else $pdate = '';
		$edate = get_option('aal_excluderulesdatebefore');
		
		if($pdate<$edate && $edate && $pdate) return $content;
		
		//Exclusion by cat
		if(isset($ecats) && is_object($post)) if(is_array($ecats)) {
			$pcats = wp_get_post_categories( $post->ID);
			if(is_array($pcats)) foreach($pcats as $pcat) {
				if(in_array($pcat,$ecats)) return $content;
			}
		}
		
		if(isset($etags) && is_object($post)) if(is_array($etags)) {
			$pcats = wp_get_post_tags( $post->ID );
			if(is_array($pcats)) foreach($pcats as $pcat) {
				if(in_array($pcat->term_id,$etags)) return $content;
			}
		}


		//Check if is feed and exit
		//TODO: Add option either to display on feed or not
		if(is_feed()) return $content;
		
		//set priority

		$myrows = $wpdb->get_results( "SELECT id,link,keywords,meta FROM ". $table_name );
		
		
		//Priority defaults
		
		/* for($i=0;$i<count($myrows);$i++) {
			$meta = new StdClass();
			$meta = json_decode($myrows[$i]->meta);
			if(!$meta->priority) 
				$meta->priority = $myrows[$i]->id;
			$myrows[$i]->meta = $meta;
		}  */
		
		//print_r($myrows);
		
		$apikey = trim(get_option('aal_apikey'));

		
		
		if($apikey) {
				
		
		$clickbankid = get_option('aal_clickbankid');
		$clickbankcat = get_option('aal_clickbankcat');
		$clickbankgravity = get_option('aal_clickbankgravity'); if(!$clickbankgravity) $clickbankgravity = 0;
		$clickbankactive = get_option('aal_clickbankactive');
		$amazonlocal = get_option('aal_amazonlocal');
		
		$amazonid = get_option('aal_amazonid');
		$amazonapikey = get_option('aal_amazonapikey'); 
		$amazonsecret = get_option('aal_amazonsecret'); 
		$amazoncat = get_option('aal_amazoncat');
		$amazonactive = get_option('aal_amazonactive');
		
		$amazondisplaylinks = get_option('aal_amazondisplaylinks');
		$amazondisplaywidget = get_option('aal_amazondisplaywidget');
		//do not display amazon bottom links in widget
		global $aaliswidget;
		if($aaliswidget) $amazondisplaywidget = '';
		
		$shareasaleid = get_option('aal_shareasaleid');
		$shareasaleactive = get_option('aal_shareasaleactive');

		$cjactive = get_option('aal_cjactive');
		
		$ebayactive = get_option('aal_ebayactive');
		$ebayid = get_option('aal_ebayid');
		
		$bestbuyactive = get_option('aal_bestbuyactive');
		$bestbuyid = get_option('aal_bestbuyid');
		
		$walmartactive = get_option('aal_walmartactive');
		$walmartid = get_option('aal_walmartid');
		
		$envatoactive = get_option('aal_envatoactive');
		$envatosite = get_option('aal_envatosite');
		$envatoid = get_option('aal_envatoid');
		
		$rakutenactive = get_option('aal_rakutenactive');
		$rakutenid = get_option('aal_rakutenid');
		
		}
		
		
		if($relationo=='nofollow') $relo = ' rel="nofollow" ';
		elseif($relationo == 'sponsored') $relo = ' rel="sponsored" ';
		else $relo = '';
		
		//regular expression setup
		$reg_post		=	 '/(?!(?:[^<\[]+[>\]]|[^>\]]+<\/a>))($name)/ims'. $langsupport .'U';		
		if('true' == get_option('aal_showhtags') || true == get_option('aal_showhtags')) { $reghtags = ''; }  else { $reghtags = '+<\/h.>|[^>]+><\/h.>|[^>]'; }
			// reghtags = '+<\/h.>|[^>\]]+><\/h.>|[^>\]]';
		if(true == $casesensitive) $csi = ""; else $csi = 'i';
		$reg			=	 '/(?!(?:[^<]+[>]|[^\[]+[\]]|[^>]+<\/[^>]+><\/a>|[^>]+<\/a>|[^>]'. $reghtags .'+<\/script*>|[^>]+<\/code*>))'. $wrse .'($name)'. $wrse .'/'. $csi .'ms'. $langsupport .'U';
		//$reg			=	 '/(?!(?:[^<\[]+[>\]]|[^>]+<\/[^>]+><\/a>|[^>\]]+<\/a>|[^>\]]'. $reghtags .'+<\/script*>|[^>\]]+<\/code*>))'. $wrse .'($name)'. $wrse .'/'. $csi .'ms'. $langsupport .'U';
		//else $reg	=	 '/(?!(?:[^<\[]+[>\]]|[^>]+<\/[^>]+><\/a>|[^>\]]+<\/a>|[^>\]]'. $reghtags .'+<\/script*>|[^>\]]+<\/code*>))\b($name)\b/ims'. $langsupport .'U';
		$strpos_fnc		=	 'strpos';		
		global $wp_rewrite; 

		
		$sofar = 0;
		

		$patterns = array();
		$addedlinks = array();
		$addedkeys = array();
		
		//If the post is set for exclusion, exit
		if(isset($post->ID) && $post->ID && in_array($post->ID, $excludearray)) return $content;

		
		//Check the display settings
		if($displayc[0]) {
			if(isset($post->post_type) && !in_array($post->post_type,$displayc)) return $content;
		}
		else {

			if($post->post_type != 'post' && $post->post_type != 'page') return $content;
			if($displayo && $post->post_type!=$displayo) return $content;			
			
		}	
		
			
		
		//if notimes equals 0, then exit
		if($notimes <= 0 ) return $content;	
		

		
		//Adjust the number of links added based on the post content length, unless notimes is set to custom
		if(isset($notimesc)) if($notimesc != 'on') {
			if(strlen($post->post_content)>8000) $notimes = $notimes * 4;
			else if(strlen($post->post_content)>4000) $notimes = $notimes * 3;
			else if(strlen($post->post_content)>2000) $notimes = $notimes * 2;		
		}
		
		//echo $notimes;
		
			//Check to see if it is the homepage
			if($_SERVER['REQUEST_URI']=='/' || $_SERVER['REQUEST_URI']=='/index.php') $ishome = 1; else $ishome=0;	
			$issingular = is_singular();
			//If it is home and ishome is set do none, then exit the function
			if($ishome && $showhome!='true') return $content;
			if(!$issingular && !$ishome && $showlist != 'true' ) return $content;
		
		


		//wpforo gives args as array with content in body member
	//	if(is_array($content)) {
	//				$content = $content['body'];
	//	}

		

		//If no keywords are set, exit the function
		if(!is_null($myrows)) {
			

			
		$allkeys = array();
		$alllinks = array();
		$allids = array();
		$allmeta = array();
		
		
		
		//get the website host with parseurl
		$ownparse = parse_url(get_site_url());
		$ownhost = $ownparse['host'];

		
		foreach($myrows as $row) {
				
				$link = $row->link;
				if($spoption) { 
					$keywords = str_replace("&#38;", "&", $row->keywords);
				}
				else $keywords = $row->keywords;
				$meta = json_decode($row->meta);
				if(is_array($meta) || is_object($meta) ) $title = $meta->title;
				
				$link = trim($link);
				
				if($post) {
					$striplink = ''; $ownlink = '';
					$ownlink = get_permalink($post->ID);
					if('http://' == substr($link, 0, 7)) $striplink = substr($link, 7);
					if('https://' == substr($link, 0, 8)) $striplink = substr($link, 8);					
					if('//' == substr($link, 0, 2)) $striplink = substr($link, 2);
					
					if('http://' == substr($ownlink, 0, 7)) $stripperma = substr($ownlink, 7);
					if('https://' == substr($ownlink, 0, 8)) $stripperma = substr($ownlink, 8);					
					if('//' == substr($ownlink, 0, 2)) $stripperma = substr($ownlink, 2);
					
					if(!$striplink) $striplink = $link;
					if(!$stripperma) $stripperma = $ownlink;					
					
					
					if($striplink == $stripperma ) { 
						//if link is the same with post url
						continue;
					}
				}
				else if(home_url( $wp->request )) {
					if($link == home_url( $wp->request ) ) continue;
				}
	
				
				
				
				if(!$keywords) continue;

				if(!is_null($keywords)) {
					//$keys = explode(',',$keywords);
					$keys = str_getcsv(html_entity_decode($keywords,ENT_QUOTES),',');

					foreach($keys as $key) {
		
						$key = trim($key);
						$key = htmlspecialchars($key,ENT_QUOTES);
						$allkeys[] = $key;
						$alllinks[] = $link;
						$addedlinks[$link] = 0;
						$addedkeys[$key] = 0;
						$allids[] = $row->id;
						$allmeta[] = $row->meta;
						
						
					}
			
			}
		
		}



		
	
		
		
		//sort by keyword length
		if($priority=='length') uasort($allkeys, 'aal_keyscmp');
		
		
		foreach($allkeys as $ident => $key) { { {  
		
		
					$link = $alllinks[$ident];
					
					
					$meta = json_decode($allmeta[$ident]);
					$samelinkvalue = '';
					if(is_array($meta) || is_object($meta) ) 
							if(isset($meta->samelink) && is_numeric($meta->samelink) && $meta->samelink > 0 ) 
								$samelinkvalue = $meta->samelink;
							else 
								$samelinkvalue = $samelink;
					
					if( ($samelinkvalue > $addedlinks[$link]) && $samekeyword > $addedkeys[$key] ) {
					
						
						
						
					  if(is_string($content)) if(stripos($content, $key) !== false) {	
 						if($key) if(!in_array('/'. $key .'/', $patterns)) { 
 						
 							
								
							$redid = $allids[$ident];
							
							if(!$addedlinks[$link]) $addedlinks[$link] = 1;
							else $addedlinks[$link] = $addedlinks[$link] + 1;			
							
							if(!$addedkeys[$key]) $addedkeys[$key] = 1;
							else $addedkeys[$key] = $addedkeys[$key] + 1;		
							
							//get the domain-subdomain of link
							//$linkparse = parse_url($link);
							//if(isset($linkparse['host'])) 
							//	 $linkhost = $linkparse['host'];		
							//else $linkhost = '';	
							$linkhost = aal_get_host_from_parse($link);
							
							
							//check if cloaking is activated and it is not internal linking
							if($iscloacked=='true')  {
								
								
								//if it is the same domain, prevent cloaking
								
								if($ownhost != $linkhost) {
																
								
								
									// echo $wp_rewrite->permalink_structure;
									if($wp_rewrite->permalink_structure) $link = get_option( 'home' ) . "/". $cloakurl ."/" . $redid . "/" . wpaal_generateSlug($key);
									else $link = get_option( 'home' ) . "/?". $cloakurl ."=" . $redid;	
									
								}
								
								
							} //$link = get_option( 'home' ) . "/". $cloakurl ."/" . wpaal_generateSlug($key);
							$url = $link;
							$name = $key;
							
							$meta = json_decode($allmeta[$ident]);
							$title = '';
							if(is_array($meta) || is_object($meta) ) $title = $meta->title;
							
							
							
							
							$keys2[] = $name;
							$links2[] = $url;
							
							//if it is interna link, remove target and relation
							if($ownhost == $linkhost) { 
								if($iltargeto == '_blank' ) $iltgo = " target=\"_blank\" "; else $iltgo = '';
								if($ilrelationo == 'nofollow' ) $ilrlo = " rel=\"nofollow\" "; else $ilrlo = '';
								$replace[] = "<a title=\"$title\" class=\"". $lclass . "\"" . $iltgo . $ilrlo ." href=\"$url\">$1</a>". $ildisclosure;
							}
							else {
								$replace[] = "<a title=\"$title\" class=\"". $lclass ."\" target=\"". $targeto ."\" ". $relo ." href=\"$url\">$1</a>". $disclosure;
							}
							$name = preg_quote($name, '/');
							$regexp[] = str_replace('$name', $name, $reg);	


						}
					  }
						
						}
					}
			}
		} //endforeach
		
		} //endif
		
		//print_r($replace);

				//Split first n paragraphs	
				//echo $skipadd; echo "--";
				if($skipadd >= substr_count ($content,	"</p>")) $skipadd = substr_count ($content,	"</p>");
				//echo $skipadd;
				if(isset($skipadd) && $skipadd && is_numeric($skipadd) && $skipadd >= 1 && $skipadd == round($skipadd)) {		
					$paracontent = explode("</p>", $content, $skipadd + 1);
					if(isset($paracontent[$skipadd])) $content = $paracontent[$skipadd];
				}
				//print_r($paracontent);
				
			
				if(isset($regexp) && is_array($regexp)) { 
				
				
					$sofar = 0;
					foreach($regexp as $regnumber => $reg1) {
						
						
						$replace[$regnumber] = apply_filters( 'aal_link_display', $replace[$regnumber] );
						
						
						$count = 0;
						if(is_string($content)) if(stripos($content, $keys2[$regnumber]) !== false) {
														
							
							//Block to randomize keyword replacement 
							if($linkdistribution == "random" && strlen($content)<100000 ) {						
								
								
								/*$cnts = preg_split($reg1,$content,-1,PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
								if(count($cnts) > ($samekeyword+1) ) {
									
									foreach($cnts as $id => $cnt) {
										if($id>0) {
											//$cnts[$id] = $keys2[$regnumber] . $cnt;
											$cnts[$id] = $cnt;
										}
									}
									
									$randomnumber = rand(1,count($cnts)-1);
									$cnts[$randomnumber] = preg_replace($reg1, $replace[$regnumber], $cnts[$randomnumber],$samekeyword,$countrandom); 
									if($countrandom > 0) {
										
										$randomnumber2 = '';
										if($samekeyword == 2) {
											do {
 												$randomnumber2 = rand(1,count($cnts)-1);
											} while ($randomnumber == $randomnumber2);
										

											$cnts[$randomnumber2] = preg_replace($reg1, $replace[$regnumber], $cnts[$randomnumber2],$samekeyword,$countrandom2); 
										
											$content = '';
											$count = $countrandom + $countrandom2;
											foreach($cnts as $id => $cnt) {
												$content = $content . $cnt;
											}
										}
										
									}
									else $content = preg_replace($reg1, $replace[$regnumber], $content,$samekeyword,$count);
								
								
								
								} */
								
								
								
								$p = $content;
								$matches = '';
								$initp = '';
								$endingp = $content; 
								preg_match_all($reg1, $endingp, $matches);
								
			
								if ($samekeyword < count($matches[0])) {
									$randmatch = array_rand($matches[0], $samekeyword);
									if(is_array($randmatch)) {
										$rand = $randmatch;
									}
									else {
										$rand[0] = $randmatch;
									}
									
									
									foreach($matches[0] as $km => $match) {
									
										if(in_array($km, $rand)) {
											$endingp = preg_replace($reg1, $replace[$regnumber], $endingp,1);
											$count++;										
										}
										else {
											$pieces = '';
											$pieces = preg_split($reg1,$endingp,2,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
											$initp .= $pieces[0] . $pieces[1];
											//if(isset($pieces[2])) $endingp = $pieces[2]; 
											//	else $endingp = '';
											$endingp = '';
											
											foreach($pieces as $i => $piece) {
												if($i > 1) $endingp = $endingp . $piece;
											
											}
										
										}
										
										
									}
									$content = $initp . $endingp;

								}
								else $content = preg_replace($reg1, $replace[$regnumber], $content,$samekeyword,$count);
								
								
							} //end random replacement
							else {
								//if content is too big split it
								if(is_string($content)) if(strlen($content)>100000) {
									$count = 0;
									$conar = str_split($content,100000);
									foreach($conar as $k => $con) {
										$conar[$k] = preg_replace($reg1, $replace[$regnumber], $conar[$k],$samekeyword,$countar);
										$count = $count + $countar;
										if($countar>0) break;
									}
									
									$content = ''; $count = 0;
									foreach($conar as $con) {
										$content .= $con;
										
									}
								
								}
								else $content = preg_replace($reg1, $replace[$regnumber], $content,$samekeyword,$count);
								
							}
							
							//END - Block to randomize keyword replacement
												
							
							//$content = preg_replace($reg1, $replace[$regnumber], $content,$samekeyword,$count);  
						} 
						if($count>0) { 
							 $sofar = $sofar + $count;
							 $mal = new StdClass();
							 $mal->keyword = $keys2[$regnumber];	 
							 $mal->url = $links2[$regnumber];
							 $pmgen[] = $mal;
						}
						if($sofar >= $notimes) break;
						
					
					}				
				
				}
				
			 
				//Rebuild excluded paragraphs
				if(isset($skipadd) && $skipadd && is_numeric($skipadd) && $skipadd >= 1 && $skipadd == round($skipadd)) {	
					$newcon = '';
					for($i=0;$i<count($paracontent)-1;$i++) {
						$newcon .= $paracontent[$i] . '</p>';
					}
					$content = $newcon . $content;
				}
				unset($paracontent);
				
				
				global $aal_apirequestno;
				if(!$aal_apirequestno) $aal_apirequestno = 0;
				//If the manual replacement did not found enough links		
				if($aal_apirequestno < 5 ) if($apikey && ($sofar<$notimes || $amazondisplaywidget) && $querylimit!='overquota' &&($clickbankactive || $amazonactive || $shareasaleactive || $cjactive || $ebayactive || $bestbuyactive || $walmartactive || $envatoactive || $rakutenactive)) {

					$aal_apirequestno = $aal_apirequestno + 1;
					
					if(!$clickbankactive) { $clickbankid = ''; }
					if(!$amazonactive) { $amazonid = ''; }
					if(!$shareasaleactive) { $shareasaleid = ''; }
					if(!$ebayactive) { $ebayid = ''; }
					if(!$bestbuyactive) { $bestbuyid = ''; }
					if(!$walmartactive) { $walmartid = ''; }
					if(!$envatoactive) { $envatoid = ''; }
					if(!$envatosite) { $envatosite = ''; }
					if(!$rakutenactive) { $rakutenid = ''; }

					
		$aaldivnumber = rand(1,10000);			
					
		$left = $notimes - $sofar;		

		
if($post && $post->ID) $aurl = get_permalink($post->ID);
	else $aurl = '';
if($post && $post->ID) $aal_postid = $post->ID;
	else $aal_postid = '';


		
$aalprovars = '

<div id="aal_api_data" data-divnumber="'. $aaldivnumber .'" data-target="'. $targeto .'" data-relation="'. $relationo .'" data-postid="post-'. $aal_postid .'" data-apikey="'. $apikey .'" data-clickbankid="'. $clickbankid .'" data-clickbankcat="'. $clickbankcat .'" data-clickbankgravity="'. $clickbankgravity .'"  data-amazonid="'. $amazonid .'" data-amazoncat="'. $amazoncat .'" data-amazonlocal="'. $amazonlocal .'" data-amazondisplaylinks="'. $amazondisplaylinks .'" data-amazondisplaywidget="'. $amazondisplaywidget .'" data-amazonactive="'. $amazonactive .'" data-clickbankactive="'. $clickbankactive .'"  data-shareasaleid="'. $shareasaleid .'"   data-shareasaleactive="'. $shareasaleactive .'" data-cjactive="'. $cjactive .'"  data-ebayactive="'. $ebayactive .'"  data-ebayid="'. $ebayid .'"   data-bestbuyactive="'. $bestbuyactive .'"  data-bestbuyid="'. $bestbuyid .'" data-walmartactive="'. $walmartactive .'"  data-walmartid="'. $walmartid .'" data-envatoid="'. $envatoid .'" data-envatosite="'. $envatosite .'" data-envatoactive="'. $envatoactive .'" data-rakutenactive="'. $rakutenactive .'"  data-rakutenid="'. $rakutenid .'" data-aurl="'. $aurl .'" data-notimes="'. $left .'" data-excludewords="'. $excludewords .'" data-cssclass="'. $cssclass .'" data-disclosure="'. $disclosure .'" data-apidata=\'\' ></div>

		
		';	
		
		

		
		
		$aalprodivcontent = '<div id="aalcontent_'. $aaldivnumber .'"></div> ';
			
		
		if(is_string($content)) $content = $content . $aalprovars . $aalprodivcontent;
		
		if($post && $post->post_type == 'wpsc-product') 
			echo $aalprovars . $aalprodivcontent;
					
		
			}
		

	
		if($post) update_post_meta( $post->ID, 'aal_manualgenerated', $pmgen );
	
		//print_r( get_post_meta( $post->ID, 'aal_manualgenerated', true ));
		return $content; 


}  // add_affiliate_links end



//Function to send and receive POST data
function aal_post($requestJson,$postUrl) {
	
	parse_str($requestJson, $aalPostBody);
	
	
	$response = wp_remote_post( $postUrl, array(
		'method' => 'POST',
		'timeout' => 15,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(),
		'body' => $aalPostBody,
		'cookies' => array()
	    )
	);

	if ( is_wp_error( $response ) ) {
	    $error_message = $response->get_error_message();
	   	$response =  "Something went wrong: $error_message";
	} else {
		$postReturn = $response['body'];
	}	
	


    return $postReturn;
}
