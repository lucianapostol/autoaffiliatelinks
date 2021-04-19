(function($) {

	$(document).ready(function() { 
	
		//if(document.getElementById('aal_api_data')) {  
		if(!aalInIframe()) {
			
			
			$("div[id*='aal_api_data']").each(function() { 
				//datadiv = document.getElementById('aal_api_data');		
				var datadiv = this;
				var aal_divnumber = datadiv.getAttribute('data-divnumber');
				var aal_target = datadiv.getAttribute('data-target');
				var aal_relation = datadiv.getAttribute('data-relation');
				var aal_postid = datadiv.getAttribute('data-postid');
				var aal_apikey = datadiv.getAttribute('data-apikey');
				var aal_clickbankid = datadiv.getAttribute('data-clickbankid');
				var aal_clickbankgravity = datadiv.getAttribute('data-clickbankgravity');
				var aal_notimes = datadiv.getAttribute('data-notimes');
				var aal_clickbankcat = datadiv.getAttribute('data-clickbankcat');
				var aal_amazonlocal = datadiv.getAttribute('data-amazonlocal');
				var aal_amazonid = datadiv.getAttribute('data-amazonid');
				var aal_amazoncat = datadiv.getAttribute('data-amazoncat');
				var aal_amazondisplaylinks = datadiv.getAttribute('data-amazondisplaylinks');
				var aal_amazondisplaywidget = datadiv.getAttribute('data-amazondisplaywidget');
				var aal_amazonactive = datadiv.getAttribute('data-amazonactive');
				var aal_clickbankactive = datadiv.getAttribute('data-clickbankactive');
				var aal_shareasaleid = datadiv.getAttribute('data-shareasaleid');
				var aal_shareasaleactive = datadiv.getAttribute('data-shareasaleactive');
				var aal_cjactive = datadiv.getAttribute('data-cjactive');
				var aal_ebayactive = datadiv.getAttribute('data-ebayactive');
				var aal_ebayid = datadiv.getAttribute('data-ebayid');
				var aal_bestbuyactive = datadiv.getAttribute('data-bestbuyactive');
				var aal_bestbuyid = datadiv.getAttribute('data-bestbuyid');
				var aal_walmartactive = datadiv.getAttribute('data-walmartactive');
				var aal_walmartid = datadiv.getAttribute('data-walmartid');
				var aal_envatoid = datadiv.getAttribute('data-envatoid');
				var aal_envatosite = datadiv.getAttribute('data-envatosite');
				var aal_envatoactive = datadiv.getAttribute('data-envatoactive');
				var aal_rakutenactive = datadiv.getAttribute('data-rakutenactive');
				var aal_rakutenid = datadiv.getAttribute('data-rakutenid');
				var aal_aurl = datadiv.getAttribute('data-aurl');
				var aal_excludewords = datadiv.getAttribute('data-excludewords');
				
				//generatecontent
				var spydiv = document.getElementById('aalcontent_' + aal_divnumber);
				var parentdiv = spydiv.parentNode;
				if(parentdiv.innerHTML == '<div id="aalcontent_' + aal_divnumber + '></div>') parentdiv = parentdiv.parentNode;
				
				var acontent = aalParse(parentdiv, '');
				if(acontent.length>10000) {
					acontent = acontent.substring(0, 10000);
				}
				//console.log(acontent);							
				
				var aal_content = encodeURIComponent(acontent);
				//aalapidata = datadiv.getAttribute('data-apidata');	
				//console.log(decodeURIComponent(aal_content));
				
				
				//generate content end
						
				var aalapidata = {content: aal_content, apikey: aal_apikey, clickbankid: aal_clickbankid, clickbankcat: aal_clickbankcat,  clickbankgravity: aal_clickbankgravity, amazonid: aal_amazonid, amazoncat: aal_amazoncat, amazonlocal: aal_amazonlocal, amazondisplaylinks: aal_amazondisplaylinks, amazondisplaywidget: aal_amazondisplaywidget, amazonactive: aal_amazonactive, clickbankactive: aal_clickbankactive, shareasaleactive: aal_shareasaleactive, shareasaleid: aal_shareasaleid, cjactive: aal_cjactive, ebayactive: aal_ebayactive, ebayid: aal_ebayid, bestbuyactive: aal_bestbuyactive, bestbuyid: aal_bestbuyid, walmartactive: aal_walmartactive, walmartid: aal_walmartid, envatoid: aal_envatoid, envatosite: aal_envatosite, envatoactive: aal_envatoactive, rakutenactive: aal_rakutenactive, rakutenid: aal_rakutenid, aurl: aal_aurl, notimes: aal_notimes, excludewords: aal_excludewords};
	
				aal_retrievelinks(aalapidata,aal_divnumber,aal_target,aal_relation);
			
		//}
			});
		}		
	});

	function aal_retrievelinks(aalapidata,aal_divnumber,aal_target,aal_relation) {
	
		//aalapidata = {action: 'aal_update_exclude_posts',aal_exclude_posts:'aaa'};
 		$.ajax({
        type: "POST",
        url: "//autoaffiliatelinks.com/api/pro2.php",
        data: aalapidata,
        cache: false,
        success: function(returned){  
        //console.log(returned);
                 
	      if(returned == 'wrong apikey') {
					return true;        
	      }
	                 
			var response = $.parseJSON(returned);
			var parray = response.links;
		
			var notimes = response.notimes;
			var insertid = response.insertid;
		
			if(response.keywords && aalapidata.amazonactive && aalapidata.amazonid) { 
			//response.keywords.forEach(function(entry) {
					$.ajax({
					type: "post", url: aal_amazon_obj.ajaxurl, data: { action: 'aal_amazon_get', security: aal_amazon_obj.security, keywords: response.keywords, notimes: notimes },
	
					success: function(html){ 
	   				 	//console.log(html);
						try {
	       				var aresults = $.parseJSON(html);
	   				} catch (e) {
	   				 	//console.log(html);
	   				 	//console.log(e);
	   				 	return;
	   				}
						//var aresults = $.parseJSON(html);
						var alinks = aresults.amazonlinks;
						var awidgets;
						if(aresults.amazonwidget) awidgets = aresults.amazonwidget;
					
						
						if(alinks) for(var i=alinks.length-1;i>=0;i--) {
							if(alinks[i].key && alinks[i].url) {
								parray.unshift(alinks[i]);
								if(parray.length>notimes) parray.pop();
							}
								
						
						}	
						//console.log(parray);
						//console.log(awidgets);
						
						//var finalLinks = JSON.stringify(parray);
						if(insertid && (alinks[0] || awidgets[0])) {
							$.ajax({
			                type: "POST",
			                url: "//autoaffiliatelinks.com/api/acache.php",
			                data: { apikey: aalapidata.apikey, insertid: insertid, parray: parray, amazonwidget: awidgets },
			                cache: false,
			                //success: function(conf){
			                //	}
		               });
						}
						
						aal_replacement(parray,awidgets,response,aalapidata,aal_divnumber,aal_target,aal_relation);
					}
				}); //close jQuery.ajax 
		//	});
			}	//end if (response.keywords)
			else {
				var awidgets;
				if(response.amazonwidget) var awidgets = response.amazonwidget;
				aal_replacement(parray,awidgets,response,aalapidata,aal_divnumber,aal_target,aal_relation);
		
			} // else if not response.keywords
                 
     		}
     
   	});
   
   
	}

	function aal_replacement(parray,awidgets,response,aalapidata,aal_divnumber,aal_target,aal_relation) {
	
					var datadiv = document.getElementById('aal_api_data');
					var cssclass = datadiv.getAttribute('data-cssclass');	
					var disclosure = datadiv.getAttribute('data-disclosure');	
	
	
					var spydiv = document.getElementById('aalcontent_' + aal_divnumber);
					var parentdiv = spydiv.parentNode;
					if(parentdiv.innerHTML == '<div id="aalcontent_' + aal_divnumber + '></div>') parentdiv = parentdiv.parentNode;
					//var acontent = parentdiv.innerHTML;
					
					var price = '';
					
					
					
					//code for amazon widget
					var amazonWidget = document.createElement("div");
					amazonWidget.className = "aal-amazon-widget";
					var awhtml = '<ul>';
					if(awidgets) { 
						awidgets.forEach(function(entry) {
							if(entry.price) price = entry.price;
							else price = '';
							awhtml += '<li>';
							awhtml += '<a href="'+ entry.url +'" target="_blank"><img src="'+ entry.image +'" /><br /><span>'+ text_truncate(entry.title,45) +'</span><br /><span>'+ price +'</span></a>';
							awhtml += '</li>';
						});
					}
					
					
				
					
					awhtml += '</ul>';
					amazonWidget.innerHTML = awhtml;				
					
					//end amazon widget
					
					if(parray) parray.forEach(function(entry) {
						
					var re2 = new RegExp("(?!(?:[^<\\[]+[>\\]]|[^>\\]]+<\/a>))\\b("+ entry.key +")\\b","i");
					var re = new RegExp("(?!(?:[^<\\[]+[>\\]]|[^>\\]]+<\/a>))(?!(?:[^<\\[]+[>\\]]|[^>\\]]+<\/h.>))(?!(?:[^<\\[]+[>\\]]|[^>\\]]+<\/script.>))\\b("+ entry.key +")\\b","i");
					var mat = '<a title="$1" class="'+ cssclass +' aalauto" target="' + aal_target + '" ' + '" rel="' + aal_relation + '" ' + ' href="'+ entry.url +'">$1</a>' + disclosure;
					//acontent = acontent.replace(re, '<a title="$1" class="'+ cssclass +' aalauto" target="' + aal_target + '" ' + '" rel="' + aal_relation + '" ' + ' href="'+ entry.url +'">$1</a>');	    
				   
				   	rt = 'go';
					   aalTree(parentdiv,re,mat);  
					    
					});
					
				
				  
				   
				   
				   
						
					if(parray) parray.forEach(function(entry) {
						
						$('ul.aal_widget_holder').each(function(i, obj) {
				    		$( this ).append( '<li><a href="' + entry.url + '">' + entry.key + '</a></li>' );
						});    
					    
					    
					    
					    
					});
				
				
					var reg = '/(?!(?:[^<\[]+[>\]]|[^>\]]+<\/a>))\b($name)\b/imsU';
					var rep = '<a title="$1" class="aal" target="$targeto" relation="$relo" href="$url">$1</a>' + disclosure;
				
				
					//parentdiv.innerHTML = acontent;
					
					document.getElementById('aalcontent_' + aal_divnumber).appendChild(amazonWidget);
				
	
	
	
	}
	
 	function aalParse(obj,strcontent){
        //var obj = obj;
        if (obj.hasChildNodes()) {
          var child = obj.firstChild;
          while (child) {
            if ((child.nodeType === 1 || child.nodeType === 3 ) && child.nodeName != 'SCRIPT' && child.nodeName != 'A' && child.nodeName != 'IMG' && child.nodeName[0] != 'H'    ){
              		
              	if(child.nodeType === 3 && child.nodeValue !== null && child.nodeValue.replace(/\s/g, "").length>2 ) {
           			
              		var astr = child.nodeValue;
            		strcontent = strcontent + "." + astr;
              		
              	}
              	strcontent = aalParse(child,strcontent);
            }
            child = child.nextSibling;
          }
        }
        
        return strcontent;
      }	


 	function aalTree(obj,re,mat){
        //var obj = obj;
        if (obj.hasChildNodes()) {
          var child = obj.firstChild;
          var con = 'go';
          while (child && con == 'go') {
          	var p = child.parentNode;
            if ((child.nodeType === 1 || child.nodeType === 3 ) && child.nodeName != 'SCRIPT' && child.nodeName != 'A' && child.nodeName != 'IMG' && child.nodeName[0] != 'H'    ){
              		
              	if(child.nodeType === 3 && child.nodeValue !== null && child.nodeValue.replace(/\s/g, "").length>2 ) {
           			
              		var astr = child.nodeValue;
              		var rstr = astr.replace(re,mat);
              		
              							
						              		
              		if(rstr != astr) {
              			
              			var newel = document.createElement('div');
					   	newel.innerHTML = rstr;
							
					  		var c = newel.firstChild;
					  		while(c) {
					  			
					  			var d = c.cloneNode(true)
								p.insertBefore(d, child);	  		
					  		   
					  		c = c.nextSibling;
					  		}
              			p.removeChild(child);
              			return 'stop';
              		}
              		
              	}
              	con = aalTree(child,re,mat);
            }
            child = child.nextSibling;
          }
        }
        
        return 'go';
      }
	
	
	
	
	
	function aalInIframe () {
    	try {
      	  return window.self !== window.top;
   	 } catch (e) {
    	    return true;
   	 }
	}
	
	
	
	text_truncate = function(str, length, ending) {
    if (length == null) {
      length = 100;
    }
    if (ending == null) {
      ending = '...';
    }
    if (str.length > length) {
      return str.substring(0, length - ending.length) + ending;
    } else {
      return str;
    }
  };

})(jQuery);