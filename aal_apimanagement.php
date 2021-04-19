<?php
//error_reporting(0);

	
	
	
add_action( 'admin_init', 'aal_api_register_settings' );


function aal_api_register_settings() { 
   register_setting( 'aal_api_settings', 'aal_apikey' );
   register_setting( 'aal_api_settings', 'aal_amazonactive' );
   register_setting( 'aal_api_settings', 'aal_clickbankactive' );
   register_setting( 'aal_api_settings', 'aal_shareasaleactive' );
   register_setting( 'aal_api_settings', 'aal_cjactive' );
   register_setting( 'aal_api_settings', 'aal_ebayactive' );
   register_setting( 'aal_api_settings', 'aal_bestbuyactive' );
   register_setting( 'aal_api_settings', 'aal_walmartactive' );
   register_setting( 'aal_api_settings', 'aal_envatoactive' );
   register_setting( 'aal_api_settings', 'aal_rakutenactive' );
}	
	


function wpaal_apimanagement() {
	global $wpdb;
	
	
	//Old code for requesting api key
	/*
	if($_POST['aal_apirequest']) {
		
		$apiname = $_POST['aal_apiname'];
		$apiemail = $_POST['aal_apiemail'];	
		
		$getcontent = 'apiname='. $apiname .'&apiemail='. $apiemail;	
		$returned = aal_post($getcontent,'http://autoaffiliatelinks.com/api/apirequest.php');
		$returned = json_decode($returned);
		
		//print_r($returned);
		if($returned->apikey) {
			
				delete_option('aal_apikey');
				add_option('aal_apikey', $returned->apikey);
			
			}
		else {
			
			$errormsg = "There was an error obtaining your API key. Please try again or contact support";
			
		}
		
	} */
	
	
$apikey = get_option('aal_apikey');
	
	
?>

<div class="wrap">  
        <div class="icon32" id="icon-options-general"></div>  
        
                 <h2>Auto Affiliate Links PRO features</h2>
                 
                 <br /><br />     
                 
                 
                 <?php if(!$apikey) { ?>      
                 
              	 To use PRO features of Wp Auto Affiliate Links you have to go to our website and get  <a href="https://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">your own API Key</a>. 
              		<br /><br /><br />
              	What you get by activating PRO features:
              	<br />
              	<ul class=aal_admin_list>
						<li>Links will be added <b>automatically</b> based on your content 
						<li><b>Amazon</b> Links are automatically extracted and inserted in content
						<li><b>ClickBank</b> Links are automatically extracted and inserted
						<li><b>Shareasale</b> links can be uploaded and displayed into your content   
						<li><b>Ebay</b> auctions can be automatically linked based on your content
						<!-- <li><b>Rakuten Linkshare</b> affiliate links can be automatically linked based on your content -->
						<li><b>Walmart</b> links can be automatically extracted and displayed
						<li><b>Commission Junction</b> product datafeeds can be uploaded and automatically displayed
						<li><b>Shareasale</b> links will be automatically shown          
						<li><b>Envato Marketplace</b> automatic links    	
              	</ul>
              	<br />
					 More info about Auto Affiliate Links PRO features <a href="https://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">here</a>.      

              	<br /><br />
              	
              	<?php } ?>	

                <?php if($apikey) {
                		
                	}
                	else { ?>                   	
              	
              	
              	<h3>Request an API key:</h3><br /><br />
              	 <a href="https://autoaffiliatelinks.com/auto-affiliate-links-payment-plans/">Click here</a> to get your own API key.
                <br /><br />
                <?php if(isset($errormsg)) echo $errormsg; ?>
                <br />

                <?php } ?>
                <br /><br />
    <form name="aal_apikey_form" method="post" action="options.php" >

<?php
		settings_fields( 'aal_api_settings' );
		do_settings_sections('aal_api_settings_display');
		
?>    

	<?php
		
		$validcheck = @file_get_contents('https://autoaffiliatelinks.com/api/apivalidate.php?apikey='. $apikey );
		if($validcheck === FALSE) {
			$valid = new StdClass();
			$valid->status = 'failed';
		}
		else $valid = json_decode($validcheck);
		
	
	
	?>
    
    
	Enter your API key here: <input type="text" name="aal_apikey" value="<?php echo get_option('aal_apikey'); ?>" /> 
	
	<?php if($apikey) { ?>
	<input type="submit" value="Remove this API Key" class="button button-primary" onclick="document.forms['aal_apikey_form'].elements['aal_apikey'].value = '';" />
	
	<?php } ?>	
	
	
	<?php submit_button('Save');  ?>	

	
	
	<br /><!-- <?php if($apikey) { ?>Your API key is <?php echo $valid->status; ?> <?php } ?> -->
	
	<br />
	
		
	
	<?php 
	
	if($valid->status == 'expired' && $apikey) { 
		echo 'Your Auto Affiliate Links PRO subscription is expired. Please <a href="https://autoaffiliatelinks.com/auto-affiliate-links-payment-plans/">renew your subscription</a> or <a href="https://autoaffiliatelinks.com/auto-affiliate-links-payment-plans/">create a new API key</a> <br /><br />';
		if(get_option('aal_apistatus')) {
			update_option('aal_apiexpired','expired');
		}
		else {
			add_option('aal_apistatus','expired','','yes');
		}	
	}  
	else 
	{
		delete_option('aal_apistatus');
		if($valid->status == 'invalid' && $apikey) { 
			echo 'The API key you entered is invalid. You have to <a href="https://autoaffiliatelinks.com/wp-auto-affiliate-links-pro/">register on our website</a> to get a valid API key. <br /><br />';
			if(get_option('aal_apiexpired')) {
				update_option('aal_apistatus','invalid');
			}
			else {
				add_option('aal_apistatus','invalid','','yes');
			}	
		}
		else 
		{
			delete_option('aal_apistatus');
		}
	}  
	
	if(isset($valid->queries)) if($valid->queries == 'overquota') {
		echo 'Your API queries monthly limit has been reached. Go to <a href="https://autoaffiliatelinks.com/members-area/download-page/">our website</a> to upgrade your plan. <br /><br />';
		if(get_option('aal_querylimit')) {
			update_option('aal_querylimit','overquota');
		}
		else {
			add_option('aal_querylimit','overquota','','yes');
		}
		
	}
	else {
		delete_option('aal_querylimit');
	}
	
	
	 if(get_option('aal_apikey') && $valid->status!='expired' && $valid->status!='invalid' ) {  ?>
	
	<br /><br />
	After you activate the modules, you need to set them up by clicking "Configure" link in the table to add your affiliate ID and to select preferred categories.
<br /><br />

	<h3>Manage PRO Modules</h3>
	<table class="widefat fixed aal_table" > 
	<thead>
		<tr>
			<th>Module name</th>
			<th>Status</th>
			<th>Actions</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Module name</th>
			<th>Status</th>
			<th>Actions</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</tfoot>
	
	
	<tr class="alternate">
		<td>Amazon</td>
		<td><select name="aal_amazonactive">
			<option value="0" <?php if(get_option('aal_amazonactive')=='0') echo "selected"; ?> > Inactive</option>
			<option value="1" <?php if(get_option('aal_amazonactive')=='1') echo "selected"; ?> >Active</option>
		</select></td>
		<td><?php if(get_option('aal_amazonactive')=='1') { ?><a href="<?php echo admin_url('admin.php?page=aal_module_amazon'); ?>">Configure Amazon Module</a><?php } 
		else { ?>   <a href="javascript:;" onclick="return aalActivateModule('aal_amazonactive');" >Activate Amazon Module</a>    <?php } ?></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Clickbank</td>
		<td><select name="aal_clickbankactive">
			<option value="0" <?php if(get_option('aal_clickbankactive')=='0') echo "selected"; ?> > Inactive</option>
			<option value="1" <?php if(get_option('aal_clickbankactive')=='1') echo "selected"; ?> >Active</option>
		</select></td>
		<td><?php if(get_option('aal_clickbankactive')=='1') { ?><a href="<?php echo admin_url('admin.php?page=aal_module_clickbank'); ?>">Configure Clickbank Module</a><?php } 
		else { ?>   <a href="javascript:;" onclick="return aalActivateModule('aal_clickbankactive');" >Activate Clickbank Module</a>    <?php }  ?></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr class="alternate">
		<td>Shareasale</td>
		<td><select name="aal_shareasaleactive">
			<option value="0" <?php if(get_option('aal_shareasaleactive')=='0') echo "selected"; ?> > Inactive</option>
			<option value="1" <?php if(get_option('aal_shareasaleactive')=='1') echo "selected"; ?> >Active</option>
		</select></td>
		<td><?php if(get_option('aal_shareasaleactive')=='1') { ?><a href="<?php echo admin_url('admin.php?page=aal_module_shareasale'); ?>">Configure Shareasale Module</a><?php } 
		else { ?>   <a href="javascript:;" onclick="return aalActivateModule('aal_shareasaleactive');" >Activate Shareasale Module</a>    <?php } ?></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
	<tr>
		<td>Commission Junction</td>
		<td><select name="aal_cjactive">
			<option value="0" <?php if(get_option('aal_cjactive')=='0') echo "selected"; ?> > Inactive</option>
			<option value="1" <?php if(get_option('aal_cjactive')=='1') echo "selected"; ?> >Active</option>
		</select></td>
		<td><?php if(get_option('aal_cjactive')=='1') { ?><a href="<?php echo admin_url('admin.php?page=aal_module_cj'); ?>">Configure Commission Junction Module</a><?php } 
		else { ?>   <a href="javascript:;" onclick="return aalActivateModule('aal_cjactive');" >Activate Commission Junction Module</a>    <?php } ?></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
	<tr class="alternate">
		<td>Best Buy</td>
		<td><select name="aal_bestbuyactive">
			<option value="0" <?php if(get_option('aal_bestbuyactive')=='0') echo "selected"; ?> > Inactive</option>
			<option value="1" <?php if(get_option('aal_bestbuyactive')=='1') echo "selected"; ?> >Active</option>
		</select></td>
		<td><?php if(get_option('aal_bestbuyactive')=='1') { ?><a href="<?php echo admin_url('admin.php?page=aal_module_bestbuy'); ?>">Configure Best Buy Module</a><?php } 
		else { ?>   <a href="javascript:;" onclick="return aalActivateModule('aal_bestbuyactive');" >Activate Bestbuy Module</a>    <?php } ?></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
	<tr>
		<td>Ebay</td>
		<td><select name="aal_ebayactive">
			<option value="0" <?php if(get_option('aal_ebayactive')=='0') echo "selected"; ?> > Inactive</option>
			<option value="1" <?php if(get_option('aal_ebayactive')=='1') echo "selected"; ?> >Active</option>
		</select></td>
		<td><?php if(get_option('aal_ebayactive')=='1') { ?><a href="<?php echo admin_url('admin.php?page=aal_module_ebay'); ?>">Configure Ebay Module</a><?php } 
		else { ?>   <a href="javascript:;" onclick="return aalActivateModule('aal_ebayactive');" >Activate Ebay Module</a>    <?php } ?></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
	<tr>
		<td>Walmart</td>
		<td><select name="aal_walmartactive">
			<option value="0" <?php if(get_option('aal_walmartactive')=='0') echo "selected"; ?> > Inactive</option>
			<option value="1" <?php if(get_option('aal_walmartactive')=='1') echo "selected"; ?> >Active</option>
		</select></td>
		<td><?php if(get_option('aal_walmartactive')=='1') { ?><a href="<?php echo admin_url('admin.php?page=aal_module_walmart'); ?>">Configure Walmart Module</a><?php } 
		else { ?>   <a href="javascript:;" onclick="return aalActivateModule('aal_walmartactive');" >Activate Walmart Module</a>    <?php } ?></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
	<tr>
		<td>Envato Marketplace</td>
		<td><select name="aal_envatoactive">
			<option value="0" <?php if(get_option('aal_envatoactive')=='0') echo "selected"; ?> > Inactive</option>
			<option value="1" <?php if(get_option('aal_envatoactive')=='1') echo "selected"; ?> >Active</option>
		</select></td>
		<td><?php if(get_option('aal_envatoactive')=='1') { ?><a href="<?php echo admin_url('admin.php?page=aal_module_envato'); ?>">Configure Envato Module</a><?php }
		else { ?>   <a href="javascript:;" onclick="return aalActivateModule('aal_envatoactive');" >Activate Envato Module</a>    <?php  } ?></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
<!--	<tr class="alternate">
		<td>Rakuten Linkshare</td>
		<td><select name="aal_rakutenactive">
			<option value="0" <?php if(get_option('aal_rakutenactive')=='0') echo "selected"; ?> > Inactive</option>
			<option value="1" <?php if(get_option('aal_rakutenactive')=='1') echo "selected"; ?> >Active</option>
		</select></td>
		<td><?php if(get_option('aal_rakutenactive')=='1') { ?><a href="<?php echo admin_url('admin.php?page=aal_module_rakuten'); ?>">Configure Rakuten Module</a><?php } 
		else { ?>   <a href="javascript:;" onclick="return aalActivateModule('aal_rakutenactive');" >Activate Rakuten Module</a>    <?php } ?></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	-->
	</table>
	
	
	<?php submit_button('Save'); ?>	
	
	<?php } else { ?>
	
	
	
	
	
	<h3>Available PRO Affiliate Networks</h3>
	<table class="widefat fixed aalpromodules" > 
	<thead>
		<tr>
			<th>Module name</th>
			<th>Status</th>
			<th>Actions</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Module name</th>
			<th>Status</th>
			<th>Actions</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</tfoot>
	
	
	<tr class="alternate">
		<td>Amazon</td>
		<td>Inactive</td>
		<td><a href="https://autoaffiliatelinks.com/members-area/download-page/">Get API Key</a></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Clickbank</td>
		<td>Inactive</td>
		<td><a href="https://autoaffiliatelinks.com/members-area/download-page/">Get API Key</a></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr class="alternate">
		<td>Shareasale</td>
		<td>Inactive</td>
		<td><a href="https://autoaffiliatelinks.com/members-area/download-page/">Get API Key</a></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
	<tr>
		<td>Commission Junction</td>
		<td>Inactive</td>
		<td><a href="https://autoaffiliatelinks.com/members-area/download-page/">Get API Key</a></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
	<tr class="alternate">
		<td>Best Buy</td>
		<td>Inactive</td>
		<td><a href="https://autoaffiliatelinks.com/members-area/download-page/">Get API Key</a></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
	<tr>
		<td>Ebay</td>
		<td>Inactive</td>
		<td><a href="https://autoaffiliatelinks.com/members-area/download-page/">Get API Key</a></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
	<tr>
		<td>Walmart</td>
		<td>Inactive</td>
		<td><a href="https://autoaffiliatelinks.com/members-area/download-page/">Get API Key</a></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>	
	<tr>
		<td>Envato Marketplace</td>
		<td>Inactive</td>
		<td><a href="https://autoaffiliatelinks.com/members-area/download-page/">Get API Key</a></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	</table>	
	
	
	
	
	
	
	
	<input type="hidden" name="aal_amazonactive" value="<?php echo get_option('aal_amazonactive'); ?>" />
	<input type="hidden" name="aal_clickbankactive" value="<?php echo get_option('aal_clickbankactive'); ?>" />
	<input type="hidden" name="aal_shareasaleactive" value="<?php echo get_option('aal_shareasaleactive'); ?>" />
	<input type="hidden" name="aal_ebayactive" value="<?php echo get_option('aal_sebayactive'); ?>" />
	<input type="hidden" name="aal_cjactive" value="<?php echo get_option('aal_cjactive'); ?>" />
	<input type="hidden" name="aal_bestbuyactive" value="<?php echo get_option('aal_bestbuyactive'); ?>" />
	<input type="hidden" name="aal_walmartactive" value="<?php echo get_option('aal_walmartactive'); ?>" />
	<input type="hidden" name="aal_envatoactive" value="<?php echo get_option('aal_envatoactive'); ?>" />
	
	<?php } ?>
	
	</form>
	</div>
	
	
<?php
	
	
}










?>