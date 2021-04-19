jQuery(document).ready(function($) {



//Check URL button clicked
jQuery(".aalmanual").on('click', function() {
              
              
              var tip = 'manual';
				  var link =  jQuery(this).attr("href");
				  var keyword = jQuery(this).text();
				  var postid = aal_stats_ajax.postid;
				  var url = jQuery(location).attr('href');          
              
              	
              //alert(id);
              //aal_urlExists(id,url);
              // alert(url);
   				//aal_urlExists(url);
   				
						var data = {
							'action': 'aal_stats_save',
							'security': aal_stats_ajax.security,
							'tip': tip,
							'link': link,
							'keyword': keyword,
							'postid': postid,
							'url': url
						};
						
						
						
						jQuery.post(aal_stats_ajax.ajaxstatsurl, data, function(response) {
							//console.log('Got this from the server: ' + response);
							

						});   				  
					        
    


              
        }); 
        
});