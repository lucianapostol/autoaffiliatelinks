<?php


function wpaal_import_export() {
	global $wpdb;
	$table_name = $wpdb->prefix . "automated_links";	
	
	?>
	
	
<div class="wrap">  
        <div class="icon32" id="icon-options-general"></div>  
        
        
                <h2>Import</h2>
  				<br />
				<br />
				Upload your datafeed. The format should be keyword,url. The separator is the character who separate the columns, it can be a comma ( , ), a vertical bar ( | ) or a tab ( exactly 4 spaces ). For tab, just write "tab" in the text field. If you don't know, open the feed file in notepad or any other simple text editor. You can edit your datafeed in Microsoft Excell or Libre Office Calc. Make sure you save the file in csv format ( not in xls or odt ). Upon saving, you can select the separator. All the links inside the datafeed will be added to your affiliate links. 
				<br />
				<br />
				
				
			<form name="aal_import_form" method="post" enctype="multipart/form-data" onsubmit="">
			Upload the file here:    <input name="aal_import_file" type="file" /><br />
			Separator: <select name="aal_import_separator" onchange="if(document.aal_import_form.aal_import_separator.options[document.aal_import_form.aal_import_separator.selectedIndex].value == 'other') document.aal_import_form.aal_import_other.style.display = 'block'; else document.aal_import_form.aal_import_other.style.display = 'none';">
			<option value="|">| ( vertical line )</option>
			<option value="tab">Tab</option>
			<option value=",">, ( comma )</option>
			<option value=";">; ( semicolon )</option>
			<option value=".">. ( dot )</option>
			<option value="other">other ( specify below )</option>
			</select>
			<br /><input type="text" name="aal_import_other" value="|" style="display: none;"/>
			<br />
			<input type="submit" value="Import" /><input type="hidden" name="MAX_FILE_SIZE" value="10000000" /><input type="hidden" name="aal_import_check" value="1" />
			</form>
				
				
	
	</div>
	
<br /><br /><br />
	
<div class="wrap">  
        <div class="icon32" id="icon-options-general"></div>  
        
        
                <h2>Export</h2>
 				<br />
				<br />
				Here you can export your links so you can import to another blog or to make a backup. You can import this file later using the "Import" tab.
				<br />
				<br />
				
				
			<form name="aal_export_form" method="post" enctype="multipart/form-data" onsubmit="">
			Separator: <select name="aal_export_separator">
			<option value="|">| ( vertical line )</option>
			<option value="tab">Tab</option>
			<option value=",">, ( comma )</option>
			<option value=";">; ( semicolon )</option>
			<option value=".">. ( dot )</option>
			</select>
			<input type="submit" value="Click here to export your links" /><input type="hidden" name="aal_export_check" value="1" />
			</form>
				
				
	
	</div>
	
	<?php
}




?>