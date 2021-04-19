<?php


function wpaal_import_export() {
	global $wpdb;
	$table_name = $wpdb->prefix . "automated_links";	
	
	?>
	
	
<div class="wrap">  
        <div class="icon32" id="icon-options-general"></div>  
        
                <h2>Import/Export</h2>
  				<br />
				<br />        
        
        
                <h2>Import Links</h2>
  				<br />
				<br />
				Upload your datafeed. The format should be keyword,url. The separator is the character who separate the columns, it can be a comma ( , ), a vertical bar ( | ) or a tab ( exactly 4 spaces ). For tab, just write "tab" in the text field. If you don't know, open the feed file in notepad or any other simple text editor. You can edit your datafeed in Microsoft Excell or Libre Office Calc. Make sure you save the file in csv format ( not in xls or odt ). Upon saving, you can select the separator. All the links inside the datafeed will be added to your affiliate links. 
				<br />
				<br />
				
			<?php 
			global $aal_import_error;			
			if(isset($aal_import_error)) echo $aal_import_error; ?>
				
			<form name="aal_import_form" method="post" enctype="multipart/form-data" onsubmit="">
			Upload the file here:    <input name="aal_import_file" type="file" /><br />
			Separator: <select name="aal_import_separator" onchange="if(document.aal_import_form.aal_import_separator.options[document.aal_import_form.aal_import_separator.selectedIndex].value == 'other') document.aal_import_form.aal_import_other.style.display = 'block'; else document.aal_import_form.aal_import_other.style.display = 'none';">
			<option value="|">| ( vertical line )</option>
			<option value="tab">Tab</option>
			<option value="," SELECTED>, ( comma )</option>
			<option value=";">; ( semicolon )</option>
			<option value=".">. ( dot )</option>
			<option value="other">other ( specify below )</option>
			</select><br />
			Overwrite: <select name="aal_import_overwrite" >
			<option value="keep">Keep existing links</option>
			<option value="delete">Delete existing links</option>
			</select>
			<br /><input type="text" name="aal_import_other" value="|" style="display: none;"/>
			<br />
			<input  class="button-primary"  type="submit" value="Import" /><input type="hidden" name="MAX_FILE_SIZE" value="10000000" /><input type="hidden" name="aal_import_check" value="1" />
			</form>
				
				
	

	
<br /><br /><br />
	
 
        
        
                <h2>Export Links</h2>
 				<br />
				<br />
				Here you can export your links so you can import to another blog or to make a backup. You can import this file later using the "Import" tab.
				<br />
				<br />
				
				
			<form name="aal_export_form" method="post" enctype="multipart/form-data" onsubmit="">
			Separator: <select name="aal_export_separator">
			<option value="|">| ( vertical line )</option>
			<option value="tab">Tab</option>
			<option value="," SELECTED >, ( comma )</option>
			<option value=";">; ( semicolon )</option>
			<option value=".">. ( dot )</option>
			</select>
			<input  class="button-primary"  type="submit" value="Click here to export your links" /><input type="hidden" name="aal_export_check" value="1" />
			</form>
				
		<br />
		<br />
		
<p>If you have problems or questions about the plugin, or if you just want to send a suggestion or request to our team, you can use the <a href="https://wordpress.org/support/plugin/wp-auto-affiliate-links">support forum</a>. Make sure that you consult our <a href="https://wordpress.org/plugins/wp-auto-affiliate-links/faq/">FAQ section</a> first. </p>
	
	</div>








	
	<?php
}





?>