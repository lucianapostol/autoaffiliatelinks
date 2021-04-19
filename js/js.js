(function($) {

$(document).ready(function() { 


	$('#aal_dismiss_link').click(function() {
	    aalDismiss();
	});


    function isValidURL(url){
    var RegExp = /(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

    if(RegExp.test(url)){
        return true;
    }else{
        return false;
    }

    }

//Show advanced options
$("a.aal_form_toggle_advanced").on('click', function() {
              

			$(".aal_form_advanced_options").toggle();
			$("a.aal_form_toggle_advanced").toggle();

                return false;
        }); 
        
        
$("a.aal_edit_show_advanced").on('click', function() {
              

			$(this).toggle();
			$(this).parent().find("a.aal_edit_hide_advanced").toggle();
			$(this).parent().find(".aal_edit_advanced").toggle();

                return false;
});  

$("a.aal_edit_hide_advanced").on('click', function() {
              

			$(this).toggle();
			$(this).parent().find("a.aal_edit_show_advanced").toggle();
			$(this).parent().find(".aal_edit_advanced").toggle();

                return false;
});           



//Delete Link called through AJAX
$(".aalDeleteLink").on('click', function() {
              
    var answer = confirm("Are you sure you want to delete this automated link?");
    
        if (answer){
        
        var linkContainer = $(this).parent().parent();
        var id = $(this).attr("id");
        var data = {action: 'aal_delete_link',id: id};
        
            $.ajax({
                    type: "POST",
                    url: ajax_script.ajaxurl,
                    data: data,
                    cache: false,
                    success: function(){
                    linkContainer.slideUp('slow', function() {$(this).remove();});
                                        }
                });
        }

                return false;
        }); 
        
        



        
        


// Add Link (Called through AJAX)

    $("#aal_add_new_link_form").submit(function() {
        
        var aal_keywords = $("#aal_formkeywords").val();
        var aal_link = $("#aal_formlink").val();
         var aal_title = $("#aal_formtitle").val();
        
        if(isValidURL(aal_link)){
        
        if(aal_keywords!=''){
        
				return true;        
        
        	
         /* $("#aal_formlink").val("");
            $("#aal_formkeywords").val("");
            $("#aal_formtitle").val("");
            
            

            var data = {
                        action: 'aal_add_link',
                        aal_link: aal_link,
                        aal_keywords:aal_keywords,
                        aal_title:aal_title
                       };

            $.ajax({
                    type: "POST",
                    url: ajax_script.ajaxurl,
                    data: data,
                    dataType: "json",
                    cache: false,
                    success: function(data){
                        
                    $(".aal_links").append('<li class="aal_links_box aal_new_link"><input type="checkbox" name="aal_massids[]" value="' + data['aal_delete_id'] + '" /> Link: <input style="margin: 5px 10px;width: 32%;" type="text" name="aal_link" value="'+ data['aal_new_url'] +'" />\
                                                  Keywords: <input style="margin: 5px 10px;width: 15%;" type="text" name="aal_keywords" value="'+aal_keywords+'" /> \
                                                   Title: <input style="margin: 5px 10px;width: 10%;" type="text" name="aal_title" value="'+aal_title+'" /> \
                       										<a href="javascript:;" id="' + data['aal_delete_id'] + '" class="aalDeleteLink button-primary" onclick="aalOnClickDeleteLink(this,' + data['aal_delete_id'] + ')" >Delete</a> \
                                                </li>');
                        //scrool to the added element
                    		// $('li.aal_new_link')[0].scrollIntoView( true );                        
                        //show pop-up with confirmation
                     	$("#aal_addlink_confirmation").show();

                    }

               }); */
            
            }else {
            	alert('Keyword must not be empty');
            	return false;
            }
       
        }else {
        		alert('Link entered is not valid, it should contain http:// or https:// and cannot be blank');
        		return false;
        	}
    
        return false;
     }); 
     
//General Options CHANGE

$("#aal_changeOptions").submit(function() {
        
      
        
            var aal_iscloacked = $("#aal_iscloacked").is(":checked");
            var aal_cloakurl = $("#aal_cloakurl").val();
            var aal_langsupport = $("#aal_langsupport").is(":checked");
            var aal_showhome= $("#aal_showhome").is(":checked");
            var aal_showlist= $("#aal_showlist").is(":checked");
            var aal_showwidget= $("#aal_showwidget").is(":checked");
            var aal_showexcerpt= $("#aal_showexcerpt").is(":checked");
            var aal_showhtags= $("#aal_showhtags").is(":checked");
            var aal_notimes= $("#aal_notimes").val();
            var aal_pluginstatus= $("#aal_pluginstatus").val();
            var aal_notimescustom= $("#aal_notimescustom").val();
            var aal_samekeyword= $("#aal_samekeyword").val();
            var aal_samelink= $("#aal_samelink").val();
            var aal_linkdistribution = $("#aal_linkdistribution").val();
            var aal_display= $("#aal_display").val();
            var aal_cssclass= $("#aal_cssclass").val();
            var aal_target= $('#aal_changeOptions input[type=radio][name=aal_target]:checked').val();
            var aal_relation= $('#aal_changeOptions input[type=radio][name=aal_relation]:checked').val();
            
 
        
            
            var aal_displayca = [];
            
            
           $("#aal_changeOptions input#aal_displayc:checkbox:checked").each(function(){
    			 aal_displayca.push($(this).val());
    			//return aal_displayca;
  			  });
  			  
  			 var aal_displayc = JSON.stringify(aal_displayca);
            
           // console.log(aal_displayc);
            //return false;
            
            var data = {
                        action: 'aal_change_options',
                        aal_iscloacked: aal_iscloacked,
                        aal_cloakurl: aal_cloakurl,
                        aal_langsupport: aal_langsupport,
                        aal_showhome:aal_showhome,
                        aal_showlist:aal_showlist,
                        aal_showwidget:aal_showwidget,
                        aal_showexcerpt:aal_showexcerpt,
                        aal_showhtags:aal_showhtags,
                        aal_notimes:aal_notimes,
                        aal_notimescustom:aal_notimescustom,
                        aal_samekeyword:aal_samekeyword,
                        aal_samelink:aal_samelink,
                        aal_linkdistribution:aal_linkdistribution,
                        aal_target:aal_target,
                        aal_relation:aal_relation,
                        aal_display:aal_display,
                        aal_cssclass:aal_cssclass,
                        aal_pluginstatus:aal_pluginstatus,
                        aal_displayc:aal_displayc
                       };
                       
                      console.log(data);

            $.ajax({
                    type: "POST",
                    url: ajax_script.ajaxurl,
                    data: data,
                    cache: false,
                    success: function(){

                     //$(".aal_add_link_status").text('Options Saved');
							//alert("Settings saved");
							$("#aal_settings_confirmation").show();
                    }

               });
            
       
    
        return false;
     }); 
 
 
 $("#aal_add_exclude_posts_form").submit(function() {
            
            
            var id = $("#aal_add_exclude_post_id").val();
            
            var data = {
                        action: 'aal_add_exclude_posts',
                        aal_post: id,

                       };

            $.ajax({
                    type: "POST",
                    url: ajax_script.ajaxurl,
                    data: data,
                    cache: false,
                    success: function(response){
                    	
 							if(response=='nopost') { 
 									alert('The post ID does not correspond with any post or page'); 
 							}
 							else if(response=='duplicate') { 
 									alert('A posts with the same ID is already excluded'); 
 							}
 							else { 	
                     $(".aal_exclude_posts").append('<div class="aal_excludeditem"><div class="aal_excludedcol aal_excludedidcol">'+id+'</div>   ' + response + '<div class="aal_excludedcol"><a href="javascript:;" id="'+id+'" class="aal_delete_exclude_link"><img src="'+ajax_script.aal_plugin_url+'images/delete.png"/></a></div><br/></div><div style="clear: both;"></div>');
                     $(".aal_exclude_status").append('<p><i>Exclude ID added!</i></p>');
                     
                  }
                     
                    }

               });
            
       
    
        return false;
     }); 


$(".aal_excludedcol").on('click', '.aal_delete_exclude_link', function() {
        
    var answer = confirm("Are you sure you want to delete this excluded link?");
    
        if (answer){
        
        //delete selected exclude id box from the form 
        var linkContainer = $(this).parent().parent();
        linkContainer.slideUp('slow', function() {$(this).remove();
            
});
        
        var removeItem=$(this).parent().parent().children(".aal_excludedcol:first-child").text();
        //console.log(removeItem);
        
        var posts=new Array();
        
        
        $(".aal_excludeditem").each(function(){
			//console.log($(this).children(".aal_excludedcol:first-child").text());
        	
            posts.push($(this).children(".aal_excludedcol:first-child").text());
        });
        
        //console.log(posts);
        
        posts=$.grep(posts,function(value){
            return value!=removeItem;
        });
        
       //console.log(posts);
        
        
        var data = {action: 'aal_update_exclude_posts',aal_exclude_posts:posts};
            
            $.ajax({
                    type: "POST",
                    url: ajax_script.ajaxurl,
                    data: data,
                    cache: false,
                    success: function(){
                    //console.log('succes');                    
                    }
                });
            }

                return false;
        }); 







}); 



var aal_selectclicked = false;

$( document ).ready(function() {
 $('#aal_selectall').click( function () {
 	
 	if(aal_selectclicked) {
		aal_selectclicked = false; 	
		$('#aal_panel3 :checkbox').each(function() {
          this.checked = false;
     	 });
     	 $(this).val('Select all');
     }
     else {
     	
 		 aal_selectclicked = true;
   		 $('#aal_panel3 :checkbox').each(function() {
          this.checked = true;
     	 });
     	 $(this).val('Deselect all');
     }
  });

	return false;
});





//show custom links

$(document).ready(function() {
      canvas = document.getElementById('aalshowcustomlinks');
      if(canvas) { 
      	apikey = canvas.getAttribute('data-apikey');
      	network = canvas.getAttribute('data-network');
      
		apidata = { network: network, apikey: apikey };

	$.ajax({
         type: "GET",
         url: "//autoaffiliatelinks.com/api/getcustomlinks.php",
         data: apidata,
         cache: false,
         success: function(returned){
         	
         	//console.log('succes');   
         	//console.log(returned); 
         	
         	
         	canvas = document.getElementById('aalshowcustomlinks');
         	
         	
         	if(!returned || returned == 'there was an error' ) {
					canvas.innerHTML = 'No shareasale links added yet';	         		
         		return false;
				}	                    
                  
				var farray = $.parseJSON(returned);
				//console.log(farray.list.q);
				//console.log(farray);

				if(!farray.number) {
					canvas.innerHTML = 'There are no links to be displayed';	         		
         		return false;			
				}

					
					while (canvas.firstChild) {
					    canvas.removeChild(canvas.firstChild);
					}
					
					
					 var div = document.createElement('div');
					div.className = "aalcustomlinkdeleteall";
					var htmltext = '<span class=""><a href="" onclick="aalCustomLinkDeleteAll();" >Delete All Links</a></span><div style="clear: both;"></div>';
					div.innerHTML = htmltext;

	    			canvas.appendChild(div);


				farray.links.forEach(function(entry) {
	    
					//console.log(entry.title + entry.link);	 
					
					var deletelink = '';   
					
					 var div = document.createElement('div');
					div.className = "aalcustomlink_item";
					var htmltext = '<span class="aalcustomlink_url"><a href="' + entry.link +'">Link</a>&nbsp;&nbsp;&nbsp;</span><span class="aalcustomlink_url" ><a onclick="return aalCustomLinkDelete('+ entry.id +');" style="color: #ff0000;" href="' + deletelink +'">Delete</a>&nbsp;&nbsp;&nbsp;</span><span class="aalcustomlink_title">' + entry.title + '</span><span class="aalcustomlink_merchant">' + entry.merchant +'      </span><div style="clear: both;"></div>';
					div.innerHTML = htmltext;

	    			canvas.appendChild(div);
	    			
				});
	
                   
     		}
     
   });      
      
      
      
      } 
      else {  }
});


//AAL javascript code for keyword suggestions

$(document).ready(function() {
	$(".aal_sugkey").click(function() { 
 		if($("#aal_formkeywords").val())  {
 				$("#aal_formkeywords").val($("#aal_formkeywords").val() + ", " + $(this).attr("title"));
 			}
 			else { 
 				$("#aal_formkeywords").val($(this).attr("title"));
 		}
 		$(window).scrollTop(0);
		$("#aal_formkeywords").addClass( "yellowhighlight" );
 		$(this).hide();
	});


	$("#aal_moresug").click(function() {
 		$("#aal_extended").toggle();
	});

});



//Aal notice dismiss function
	function aalDismiss() {


        var data = {action: 'aal_dismiss_notice'};
        
            $.ajax({
                    type: "POST",
                    url: ajax_script.ajaxurl,
                    data: data,
                    cache: false,
                    success: function(){
                    $("#aal_notice_div").slideUp('slow', function() {$("#aal_notice_div").remove();});
                                        }
                });
        	
		
		
	}
	
	
	

	
})(jQuery);



        
//Onclick delete function
function aalOnClickDeleteLink(el,linkid) {
              
    var answer = confirm("Are you sure you want to delete this automated link?");
    
        if (answer){
        
        var linkContainer = jQuery(el.parentNode);
        var id = linkid
        var data = {action: 'aal_delete_link',id: id};
        
            jQuery.ajax({
                    type: "POST",
                    url: ajax_script.ajaxurl,
                    data: data,
                    cache: false,
                    success: function(){
                    linkContainer.slideUp('slow', function() {jQuery(this).remove();});
                                        }
                });
        }

                return false;
        }

function aal_masscomplete() {

		var checkboxes = document.getElementsByName('aal_massids[]');
		var vals = "";
		for (var i=0, n=checkboxes.length;i<n;i++) {
		  if (checkboxes[i].checked) 
		  {
		  vals += ","+checkboxes[i].value;
		  }
		}
		if (vals) vals = vals.substring(1);
	
	
		document.getElementById('aal_massstring').value = vals;

		return confirm('Are you sure you want to delete all selected links ?');
}


//Frequency selector, display custom value
function aalFrequencySelector() {
	
	var es = document.getElementById('aal_notimes');
	

	if(es.options[es.selectedIndex].value == 'custom') { 
	
		document.getElementById('aal_custom_frequency').style.display = 'block';
		
	}
	else {
		document.getElementById('aal_custom_frequency').style.display = 'none';
	}
	

}



function aalCustomLinkDelete(linkid) {
	var answer = confirm("Are you sure you want to delete this link  ?")
	if (answer){
		
		
      var canvas = document.getElementById('aalshowcustomlinks');
      if(canvas) { 
      	apikey = canvas.getAttribute('data-apikey');
      	network = canvas.getAttribute('data-network');
		
		var apidata = { network: network, apikey: apikey, linkid: linkid };

	jQuery.ajax({
         type: "GET",
         url: "//autoaffiliatelinks.com/api/deletecustomlinks.php",
         data: apidata,
         cache: false,
         success: function(returned){
         	
         	//console.log('succes');   
         	console.log(returned); 
         	
         	
         	var canvas = document.getElementById('aalshowcustomlinks');
         	
         	
         	if(!returned || returned == 'there was an error' ) {
					alert("There was a problem completing your action, please refresh the page and try again");	         		
         		return false;
				}	                    
                  
				//var farray = $.parseJSON(returned);


					
					while (canvas.firstChild) {
					    canvas.removeChild(canvas.firstChild);
					}
	
                   
     		}
     
   });     		
		
		
		
	}	
	
	//return false;
		
	}
	else{
		return false;
	}
	
	//return false;
}



function aalCustomLinkDeleteAll() {

var answer = confirm("Are you sure you want to delete all the links below  ?")
	if (answer){
		
		
      var canvas = document.getElementById('aalshowcustomlinks');
      if(canvas) { 
      	apikey = canvas.getAttribute('data-apikey');
      	network = canvas.getAttribute('data-network');
		
		var apidata = { network: network, apikey: apikey, massdelete: 'all' };

	jQuery.ajax({
         type: "GET",
         url: "//autoaffiliatelinks.com/api/deletecustomlinks.php",
         data: apidata,
         cache: false,
         success: function(returned){
         	
         	//console.log('succes');   
         	console.log(returned); 
         	
         	
         	var canvas = document.getElementById('aalshowcustomlinks');
         	
         	
         	if(!returned || returned == 'there was an error' ) {
					alert("There was a problem completing your action, please refresh the page and try again");	         		
         		return false;
				}	                    
                  
				//var farray = $.parseJSON(returned);


					
					while (canvas.firstChild) {
					    canvas.removeChild(canvas.firstChild);
					}
	
                   
     		}
     
   });     		
		
		
		
	}	
	
	//return false;
		
	}
	else{
		return false;
	}




//return false;
}



function aalActivateModule(name) {

	document.forms["aal_apikey_form"][name].selectedIndex = 1;
	document.createElement('form').submit.call(document.forms["aal_apikey_form"]);
	return false;

}


	
function aalCopyCloak(el) {
 
 
  var id = el.getAttribute('data-id');
  document.getElementById("edit_advanced_" + id).style.display = "block";
  var cloak = document.getElementById("aal-cloak-" + id);

  /* Select the text field */
  cloak.select();
  cloak.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the link: " + cloak.value);
}



