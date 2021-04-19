jQuery(document).ready(function($) {



//Check URL button clicked
jQuery(".aalCheckURL").on('click', function() {
              
              var url = jQuery(this).parent().parent().find('input[type=text]').filter(':visible:first').val();
              var id = jQuery(this).parent().parent().parent().find('input[type=hidden]').filter(':first').val();
              
              //alert(id);
              //aal_urlExists(id,url);
              // alert(url);
   				//aal_urlExists(url);
   				
						var data = {
							'action': 'aal_url_check',
							'security': aal_urlcheck_ajax.security,
							'id': id,
							'url': url
						};
						// We can also pass the url value separately from ajaxurl for front end AJAX implementations
						jQuery.post(aal_urlcheck_ajax.ajaxcheckurl, data, function(response) {
							//alert('Got this from the server: ' + response);
							
							if(response == 'valid') {
							   $("#urlcheck_" + id).text("Link is Working");
							   $("#urlcheck_" + id).attr('class', 'aal_urlvalid');
							}
							else if(response == 'broken') {
							   $("#urlcheck_" + id).text("Link is Broken");
							   $("#urlcheck_" + id).attr('class', 'aal_urlbroken');
							}
							else {
								$("#urlcheck_" + id).text("Link check failed");
							   $("#urlcheck_" + id).attr('class', 'aal_urlbroken');							
							}
						});   				  
					        
    


                return false;
        }); 
        
});