<?php


$aalAmazon = new aalModule('amazon','Amazon Links',3);
$aalModules[] = $aalAmazon;

$aalAmazon->aalModuleHook('content','aalAmazonDisplay');


//amazon ajax
add_action( 'wp_ajax_aal_amazon_get', 'aal_amazon_ajax' );
add_action( 'wp_ajax_nopriv_aal_amazon_get', 'aal_amazon_ajax' );


function aal_amazon_ajax() {
	
	check_ajax_referer( 'aalamazonnonce', 'security' ); 
	

		// Your AWS Access Key ID, as taken from the AWS Your Account page
		$aws_access_key_id = get_option('aal_amazonapikey');
		
		// Your AWS Secret Key corresponding to the above ID, as taken from the AWS Your Account page
		$aws_secret_key = get_option('aal_amazonsecret');
		
		$amazonactive = get_option('aal_amazonactive');
		$amazonid = get_option('aal_amazonid');
		$amazoncat = get_option('aal_amazoncat');
		$amazonlocal = get_option('aal_amazonlocal');
		
		$amazondisplaylinks = get_option('aal_amazondisplaylinks');
		$amazondisplaywidget = get_option('aal_amazondisplaywidget');
		if(!$amazondisplaywidget) $amazondisplaylinks = 1;

		if(!$amazonactive || !$amazonid) { exit(); die(); }
				
		if($amazoncat) $acategory = $amazoncat;
		else $acategory = 'All';
	
		if($amazonlocal) $amazonlocal = $amazonlocal;
		else $amazonlocal = 'com';	
		
		
	
	if(isset($_POST['keywords']) && is_array($_POST['keywords'])) $keywords = array_map( 'sanitize_text_field', $_POST['keywords'] );
	if(isset($_POST['notimes'])) $notimes = sanitize_text_field($_POST['notimes']);
	$alinks = array();
	$awidgets = array();

	//print_r($data);
	if(!$keywords[0]) { echo 'no keys'; die(); }
	$nrk = 0;
	$nrw = 0;
	foreach($keywords as $keyword) {		
	
			if($nrk>=$notimes) if(!$amazondisplaywidget || $nrk>2) break;
			$searchstring = $keyword;
		   
			
			//echo $searchstring;	
			
		if($amazondisplaywidget) $responsegroup = "Small,Images";
		else $responsegroup = "Small";
			
		
		// The region you are interested in
		$endpoint = "webservices.amazon.". $amazonlocal ."";
		
		$uri = "/onca/xml";
		
		$params = array(
		    "Service" => "AWSECommerceService",
		    "Operation" => "ItemSearch",
		    "AWSAccessKeyId" => $aws_access_key_id,
		    "AssociateTag" => $amazonid,
		    "SearchIndex" => $acategory,
		    "Keywords" => $searchstring,
		    "ResponseGroup" => $responsegroup,
		    "ItemPage" => '1'
		);
		
		// Set current timestamp if not set
		if (!isset($params["Timestamp"])) {
		    $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
		}
		
		// Sort the parameters by key
		ksort($params);
		
		$pairs = array();
		
		foreach ($params as $key => $value) {
		    array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
		}
		
		// Generate the canonical query
		$canonical_query_string = join("&", $pairs);
		
		// Generate the string to be signed
		$string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;
		
		// Generate the signature required by the Product Advertising API
		$signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));
		
		// Generate the signed URL
		$request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);
		
		//echo $request_url;
		
		
		//$html_response = wp_remote_get($request_url);


// API V5		
		
		$searchItemRequest = new SearchItemsRequest ();
		$searchItemRequest->PartnerType = "Associates";
		// Put your Partner tag (Store/Tracking id) in place of Partner tag
		$searchItemRequest->PartnerTag = $amazonid;
		$searchItemRequest->Keywords = $searchstring;
		$searchItemRequest->SearchIndex = $acategory;
		$searchItemRequest->Resources = ["Images.Primary.Medium","ItemInfo.Title","Offers.Listings.Price"];
		$host = "webservices.amazon.". $amazonlocal;
		$path = "/paapi5/searchitems";
		$payload = json_encode ($searchItemRequest);
		//Put your Access Key in place of <ACCESS_KEY> and Secret Key in place of <SECRET_KEY> in double quotes
		$awsv4 = new AwsV4 ("$aws_access_key_id", "$aws_secret_key");
		$awsv4->setRegionName("us-east-1");
		$awsv4->setServiceName("ProductAdvertisingAPI");
		$awsv4->setPath ($path);
		$awsv4->setPayload ($payload);
		$awsv4->setRequestMethod ("POST");
		$awsv4->addHeader ('content-encoding', 'amz-1.0');
		$awsv4->addHeader ('content-type', 'application/json; charset=utf-8');
		$awsv4->addHeader ('host', $host);
		$awsv4->addHeader ('x-amz-target', 'com.amazon.paapi5.v1.ProductAdvertisingAPIv1.SearchItems');
		$headers = $awsv4->getHeaders ();
		$headerString = "";
		foreach ( $headers as $key => $value ) {
		    $headerString .= $key . ': ' . $value . "\r\n";
		}
		$params = array (
		        'http' => array (
		            'header' => $headerString,
		            'method' => 'POST',
		            'content' => $payload
		        )
		    );
		$stream = stream_context_create ( $params );
		
		$fp = @fopen ( 'https://'.$host.$path, 'rb', false, $stream );
		
		if (! $fp) {
		   //throw new Exception ( "Exception Occured" );
		   $nrk++; 
		   sleep(2);
		   continue;
		}
		$response = @stream_get_contents ( $fp );
		
		//ob_clean();
		if ($response === false) {
			$nrk++; 
			sleep(2);
		   continue;
		   // throw new Exception ( "Exception Occured" );
		}
		//echo 'alo';
		//print_r($response);
		
		
		
		
// End API V5	
		
		
		
		
		
		
		//echo "Signed URL: \"".$request_url."\"";	
			//echo $request_url;
			
			
			
			
		  // echo $html_response['body'];
			//$xml = simplexml_load_string( $html_response['body'] );
			//print_r($xml);
			//if($xml->Error->Code) { echo $xml->Error->Code; 
			//exit(); die(); }
			//print_r($xml->Items);	
			
			
			
			//$items = $xml->Items->Item;
			$jsitems = json_decode($response);
		//	print_r($jsitems); die();
			$items = $jsitems->SearchResult->Items;
			if(!$items) { 
			   //echo 'no links' ; 
				sleep(3); continue; 
			}
			
			//print_r($items);
			//$link = $items[0]->DetailPageURL;
		
			foreach($items as $item) {
				
				//print_r($item);
				
				
				
				if($amazondisplaywidget && $nrw<=2 && $item->Images->Primary->Medium->URL) {
					
					$awidget = new StdClass();
					$awidget->url = $item->DetailPageURL;
					$awidget->id = $item->ASIN;
					$awidget->image = $item->Images->Primary->Medium->URL;
					$awidget->title = $item->ItemInfo->Title->DisplayValue;
					$awidget->price = $item->Offers->Listings[0]->Price->DisplayAmount;
					
					$awidgets[] = $awidget;
					$nrw++;
									
				
				
				}
		
				
				if($amazondisplaylinks) {
					
					$link = (string) $item->DetailPageURL;
					
					$found = 0;
					foreach($alinks as $aa) {
						if($link == $aa->link) $found = 1;		
					}
					if($found != 1) {
						$alink = new StdClass();
						$alink->key = $searchstring;
						$alink->url = $link;
						$alinks[] = $alink;
						break;
					}
				
				}
				
				

				
					
			
			}
			
		$nrk++;
		sleep(2);
			
	}
	$jsonresult = new StdClass();
	$jsonresult->amazonlinks = $alinks;
	$jsonresult->amazonwidget = $awidgets;
	$jsonlinks = json_encode($jsonresult);
	echo $jsonlinks;
	?>
	

	<?php
	exit();
	die();
}


		class SearchItemsRequest {
		    public $PartnerType;
		    public $PartnerTag;
		    public $Keywords;
		    public $SearchIndex;
		    public $Resources;
		}		
		

class AwsV4 {

    private $accessKeyID = null;
    private $secretAccessKey = null;
    private $path = null;
    private $regionName = null;
    private $serviceName = null;
    private $httpMethodName = null;
    private $queryParametes = array ();
    private $awsHeaders = array ();
    private $payload = "";

    private $HMACAlgorithm = "AWS4-HMAC-SHA256";
    private $aws4Request = "aws4_request";
    private $strSignedHeader = null;
    private $xAmzDate = null;
    private $currentDate = null;

    public function __construct($accessKeyID, $secretAccessKey) {
        $this->accessKeyID = $accessKeyID;
        $this->secretAccessKey = $secretAccessKey;
        $this->xAmzDate = $this->getTimeStamp ();
        $this->currentDate = $this->getDate ();
    }

    function setPath($path) {
        $this->path = $path;
    }

    function setServiceName($serviceName) {
        $this->serviceName = $serviceName;
    }

    function setRegionName($regionName) {
        $this->regionName = $regionName;
    }

    function setPayload($payload) {
        $this->payload = $payload;
    }

    function setRequestMethod($method) {
        $this->httpMethodName = $method;
    }

    function addHeader($headerName, $headerValue) {
        $this->awsHeaders [$headerName] = $headerValue;
    }

    private function prepareCanonicalRequest() {
        $canonicalURL = "";
        $canonicalURL .= $this->httpMethodName . "\n";
        $canonicalURL .= $this->path . "\n" . "\n";
        $signedHeaders = '';
        foreach ( $this->awsHeaders as $key => $value ) {
            $signedHeaders .= $key . ";";
            $canonicalURL .= $key . ":" . $value . "\n";
        }
        $canonicalURL .= "\n";
        $this->strSignedHeader = substr ( $signedHeaders, 0, - 1 );
        $canonicalURL .= $this->strSignedHeader . "\n";
        $canonicalURL .= $this->generateHex ( $this->payload );
        return $canonicalURL;
    }

    private function prepareStringToSign($canonicalURL) {
        $stringToSign = '';
        $stringToSign .= $this->HMACAlgorithm . "\n";
        $stringToSign .= $this->xAmzDate . "\n";
        $stringToSign .= $this->currentDate . "/" . $this->regionName . "/" . $this->serviceName . "/" . $this->aws4Request . "\n";
        $stringToSign .= $this->generateHex ( $canonicalURL );
        return $stringToSign;
    }

    private function calculateSignature($stringToSign) {
        $signatureKey = $this->getSignatureKey ( $this->secretAccessKey, $this->currentDate, $this->regionName, $this->serviceName );
        $signature = hash_hmac ( "sha256", $stringToSign, $signatureKey, true );
        $strHexSignature = strtolower ( bin2hex ( $signature ) );
        return $strHexSignature;
    }

    public function getHeaders() {
        $this->awsHeaders ['x-amz-date'] = $this->xAmzDate;
        ksort ( $this->awsHeaders );
        $canonicalURL = $this->prepareCanonicalRequest ();
        $stringToSign = $this->prepareStringToSign ( $canonicalURL );
        $signature = $this->calculateSignature ( $stringToSign );
        if ($signature) {
            $this->awsHeaders ['Authorization'] = $this->buildAuthorizationString ( $signature );
            return $this->awsHeaders;
        }
    }

    private function buildAuthorizationString($strSignature) {
        return $this->HMACAlgorithm . " " . "Credential=" . $this->accessKeyID . "/" . $this->getDate () . "/" . $this->regionName . "/" . $this->serviceName . "/" . $this->aws4Request . "," . "SignedHeaders=" . $this->strSignedHeader . "," . "Signature=" . $strSignature;
    }

    private function generateHex($data) {
        return strtolower ( bin2hex ( hash ( "sha256", $data, true ) ) );
    }

    private function getSignatureKey($key, $date, $regionName, $serviceName) {
        $kSecret = "AWS4" . $key;
        $kDate = hash_hmac ( "sha256", $date, $kSecret, true );
        $kRegion = hash_hmac ( "sha256", $regionName, $kDate, true );
        $kService = hash_hmac ( "sha256", $serviceName, $kRegion, true );
        $kSigning = hash_hmac ( "sha256", $this->aws4Request, $kService, true );

        return $kSigning;
    }

    private function getTimeStamp() {
        return gmdate ( "Ymd\THis\Z" );
    }

    private function getDate() {
        return gmdate ( "Ymd" );
    }
}


add_action( 'admin_init', 'aal_amazon_register_settings' );


function aal_amazon_register_settings() { 
   register_setting( 'aal_amazon_settings', 'aal_amazonid' );
   register_setting( 'aal_amazon_settings', 'aal_amazonapikey' );
   register_setting( 'aal_amazon_settings', 'aal_amazonsecret' );
   register_setting( 'aal_amazon_settings', 'aal_amazoncat' );
   //register_setting( 'aal_amazon_settings', 'aal_amazonactive' );
   register_setting( 'aal_amazon_settings', 'aal_amazonlocal' );
   register_setting( 'aal_amazon_settings', 'aal_amazondisplaylinks' );
   register_setting( 'aal_amazon_settings', 'aal_amazondisplaywidget' );
}


function aalAmazonDisplay() {
	
	$amazoncat = get_option('aal_amazoncat');
	
	if(get_option('aal_amazondisplaylinks') && get_option('aal_amazondisplaylinks') != 1  ) delete_option('aal_amazondisplaylinks');
	if(get_option('aal_amazondisplaywidget') && get_option('aal_amazondisplaywidget') != 1  ) delete_option('aal_amazondisplaywidget');
	
	?>

<script type="text/javascript">

function aal_amazon_validate() {
	
		if(!document.aal_amazonform.aal_amazoncat.value) { alert("Please select a category"); return false; }
		if(!document.aal_amazonform.aal_amazonid.value) { alert("Please add your amazon ID"); return false; }
		if(!document.aal_amazonform.aal_amazonapikey.value) { alert("Please add your amazon API Key"); return false; }
		if(!document.aal_amazonform.aal_amazonsecret.value) { alert("Please add your amazon Secret Key"); return false; }
				
	}

jQuery(document).ready(function() {
      jQuery("#aal_amazoncat").val("<?php echo $amazoncat; ?>");	
}); 

	
	</script>
	
	
<div class="wrap">  
    <div class="icon32" id="icon-options-general"></div>  
        
        
                <h2>Amazon Links</h2>
                <br /><br />
                
                         
                
                
                Once you add your affiliate ID and activate amazon links, they will start to appear on your website. The manual links that you add will have priority.<br />
                This feature will only work if you have set the API Key in the "API Key" menu.
                <br /><br />
                
<div class="aal_general_settings">
		<form method="post" action="options.php" name="aal_amazonform" onsubmit="return aal_amazon_validate();"> 
<?php
		settings_fields( 'aal_amazon_settings' );
		do_settings_sections('aal_amazon_settings_display');
		
?>
		<span class="aal_label">Amazon Affiliate ID:</span> <input type="text" name="aal_amazonid" value="<?php echo get_option('aal_amazonid'); ?>" />
		<br /><br />
	<span class="aal_label">Category: </span><select id="aal_amazoncat"  name="aal_amazoncat" ><option value="">-Select a cateogry-	</option>
	   <option value="AmazonVideo">Prime Video</option>
		<option value="Apparel">Apparel & Accessories</option>
		<option value="Appliances">Appliances</option>
		<option value="ArtsAndCrafts">Arts, Crafts & Sewing</option>
		<option value="Automotive">Automotive</option>
		<option value="Baby">Baby</option>
		<option value="Beauty">Beauty</option>
		<option value="Books">Books</option>
		<option value="Classical">Classical</option>
		<option value="Collectibles">Collectibles & Fine Art</option>
		<option value="Computers">Computers</option>
		<option value="DigitalMusic">Digital Music</option>
		<option value="DigitalEducationalResources">Digital Educational Resources</option>
		<option value="Electronics">Electronics</option>
		<option value="EverythingElse">Everything Else</option>
		<option value="Fashion">Clothing, Shoes & Jewelry</option>
		<option value="FashionBaby">Clothing, Shoes & Jewelry Baby</option>
		<option value="FashionBoys">Clothing, Shoes & Jewelry Boys</option>
		<option value="FashionGirls">Clothing, Shoes & Jewelry Girls</option>
		<option value="FashionMen">Clothing, Shoes & Jewelry Men</option>
		<option value="FashionWomen">Clothing, Shoes & Jewelry Women</option>
		<option value="GardenAndOutdoor">Garden & Outdoor</option>
		<option value="GroceryAndGourmetFood">Grocery & Gourmet Food</option>
		<option value="Handmade">Handmade</option>
		<option value="HealthPersonalCare">Health, Household & Baby Care</option>
		<option value="HomeAndKitchen">Home & Kitchen</option>
		<option value="Industrial">Industrial & Scientific</option>
		<option value="Jewelry">Jewelry</option>
		<option value="KindleStore">Kindle Store</option>
		<option value="LocalServices">Home & Business Services</option>
		<option value="Luggage">Luggage & Travel Gear</option>
		<option value="LuxuryBeauty">Luxury Beauty</option>
		<option value="Magazines">Magazine Subscriptions</option>		
		<option value="MobileAndAccessories">Cell Phones & Accessories</option>
		<option value="MoviesAndTV">Movies & TV</option>
		<option value="MobileApps">Apps & Games</option>
		<option value="Music">CDs & Vinyl</option>
		<option value="MusicalInstruments">Musical Instruments</option>	
		<option value="OfficeProducts">Office Products</option>		
		<option value="PetSupplies">PetSupplies</option>
		<option value="Photo">Photo</option>
		<option value="Shoes">Shoes</option>
		<option value="Software">Software</option>
		<option value="SportsAndOutdoors">Sports & Outdoors</option>
		<option value="ToolsAndHomeImprovement">Tools & Home Improvement</option>		
		<option value="ToysAndGames">Toys & Games</option>
		<option value="VHS">VHS</option>
		<option value="VideoGames">Video Games</option>	
		<option value="Watches">Watches</option>
		<option value="All">All Categories</option>
	</select>
	<br /><br />
	<span class="aal_label">Localization: </span><select id="aal_amazonlocal"  name="aal_amazonlocal" >
		<option value="com" <?php if(get_option('aal_amazonlocal')=='com') echo "selected"; ?> >COM</option>
		<option value="ca" <?php if(get_option('aal_amazonlocal')=='ca') echo "selected"; ?>>CA</option>
		<option value="cn" <?php if(get_option('aal_amazonlocal')=='cn') echo "selected"; ?>>CN</option>
		<option value="de" <?php if(get_option('aal_amazonlocal')=='de') echo "selected"; ?>>DE</option>
		<option value="es" <?php if(get_option('aal_amazonlocal')=='es') echo "selected"; ?>>ES</option>
		<option value="fr" <?php if(get_option('aal_amazonlocal')=='fr') echo "selected"; ?>>FR</option>
		<option value="in" <?php if(get_option('aal_amazonlocal')=='in') echo "selected"; ?>>IN</option>
		<option value="it" <?php if(get_option('aal_amazonlocal')=='it') echo "selected"; ?>>IT</option>
		<option value="co.jp" <?php if(get_option('aal_amazonlocal')=='co.jp') echo "selected"; ?>>JP</option>
		<option value="co.uk" <?php if(get_option('aal_amazonlocal')=='co.uk') echo "selected"; ?>>UK</option>
	</select>
	<br /><br />

	
	<span class="aal_label">Display</span> 
	<input type="checkbox" name="aal_amazondisplaylinks" value="1" <?php checked( '1', get_option('aal_amazondisplaylinks'), 'checked');  ?>  /> Display links in text &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="checkbox" name="aal_amazondisplaywidget" value="1" <?php checked( '1', get_option('aal_amazondisplaywidget'), 'checked');  ?> /> Display product widget at bottom of post

	<!-- <br />
		<span class="aal_label">Status: </span><select name="aal_amazonactive">
			<option value="0" <?php if(get_option('aal_amazonactive')=='0') echo "selected"; ?> > Inactive</option>
			<option value="1" <?php if(get_option('aal_amazonactive')=='1') echo "selected"; ?> >Active</option>
		</select><br /> -->
	<br /><br />
	<h4>Amazon API settings:</h4>
	<br />
	<span class="aal_label">Amazon API key:</span> <input class="aal_big_input" type="text" name="aal_amazonapikey" value="<?php echo get_option('aal_amazonapikey'); ?>" />
		<br /><br />
	<span class="aal_label">Amazon API Secret:</span> <input class="aal_big_input" "aal_big_input" type="text" name="aal_amazonsecret" value="<?php echo get_option('aal_amazonsecret'); ?>" />
		<br /><br />
		<p>You can get your Amazon API key and secret from your Amazon Associates account, from <a href="https://affiliate-program.amazon.com/assoc_credentials/home">Manage Credentials</a>	 page. Check <a href="https://autoaffiliatelinks.com/how-to-obtain-amazon-product-advertising-api-key-and-secret/">this article</a> for instructions.</p>	
		<br /><br />



<?php
	submit_button('Save');
	echo '</form></div>';
?>
	<a href="<?php echo admin_url('admin.php?page=aal_apimanagement'); ?>" class="button button-primary">Back to API Management</a>

<?php
	
	echo '</div>';

}




?>