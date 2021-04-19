<?php


$aalRakuten = new aalModule('rakuten','Rakuten Linkshare',8);
$aalModules[] = $aalRakuten;

$aalRakuten->aalModuleHook('content','aalRakutenDisplay');
//$aalEbay->aalModuleHook('actions','aalRakutenActions');


add_action( 'admin_init', 'aal_rakuten_register_settings' );


function aal_rakuten_register_settings() { 
   //register_setting( 'aal_rakuten_settings', 'aal_rakutenactive' );
   register_setting( 'aal_rakuten_settings', 'aal_rakutenid' );
}

function aalRakutenDisplay() {
	
?>


<script type="text/javascript">




function aal_rakuten_validate() {
	
		if(!document.aal_rakutenform.aal_rakutenid.value) { alert("Please add your Rakuten linkshare affiliate ID"); return false; }
		
		return true;
				
	}



	
</script>
	
	
<div class="wrap">  
    <div class="icon32" id="icon-options-general"></div>  
        
        
                <h2>Rakuten Linkshare</h2>
                <br /><br />
Enter your Rakuten Linkshare affiliate id and activate the module
<br /><br />
                
<div class="aal_general_settings">
		<form method="post" action="options.php" name="aal_rakutenform" onsubmit="return aal_rakuten_validate();"> 
<?php
		settings_fields( 'aal_rakuten_settings' );
		do_settings_sections('aal_rakuten_settings_display');
		
?>

			<span class="aal_label">Affiliate ID:</span> <input type="text" name="aal_rakutenid" value="<?php echo get_option('aal_rakutenid'); ?>" /><br />
			<!--	<span class="aal_label">Status: </span><select name="aal_rakutenactive">
			<option value="0" <?php if(get_option('aal_bestbuyactive')=='0') echo "selected"; ?> > Inactive</option>
			<option value="1" <?php if(get_option('aal_bestbuyactive')=='1') echo "selected"; ?> >Active</option>
		</select> -->



<?php
	submit_button('Save');
	echo '</form></div>';
	
	if(get_option('aal_rakutenactive') ) {
		
	
?>


<?php

	}
	
	
	
	
	echo '</div>';

}





?>