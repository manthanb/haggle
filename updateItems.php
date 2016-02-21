<?php

  function update($asn)
  {
     echo $asn;

	  $String1 = "GET\n";
	  $String2 = "webservices.amazon.in\n";
	  $String3 = "/onca/xml\n";
			
	  $Timestamp = gmdate("Y-m-d\TH:i:s\Z");
	  $Timestamp = str_replace(":", "%3A", $Timestamp);

	  $String4="AWSAccessKeyId=AKIAJ3JIQCH5GEUF4YFQ&AssociateTag=haggle0b-21&IdType=ASIN&ItemId=$asn&Operation=ItemLookup&ResponseGroup=OfferFull&Service=AWSECommerceService&Timestamp=$Timestamp&Version=2011-08-01";

	  $fstring = $String1.$String2.$String3.$String4;
			
	  $Signature = base64_encode(hash_hmac("sha256", $fstring,"0ojoPPOBFAH1lbIlTnjz4EsFhHFKxlhspMtbDpB8",True)); $Signature = str_replace("+", "%2B", $Signature);
	  $Signature = str_replace("=", "%3D", $Signature);
			
	  $baseURL = "http://webservices.amazon.in/onca/xml?";
	  $Signature = "&Signature=$Signature";
	  $fstring = $baseURL.$String4.$Signature;

	  $XML = simplexml_load_file($fstring);
			
      $p1 = $XML->Items->Item->Offers->Offer->OfferListing->Price->Amount;
	  $p2 = $XML->Items->Item->Offers->Offer->OfferListing->SalePrice->Amount;

      echo '<a href="'.$fstring.'">XML</a><p>';
  }

  mysql_connect('localhost', 'root', 'manthan');
  mysql_select_db('loginregister');

  $query =  mysql_query("select wasn from item_info");

  $i = 0;
  
  while($rows = mysql_fetch_array($query))
  {
	  $res_asin[$i] = $rows['wasn'];
      update($res_asin[$i]);
	  $i = $i + 1;
  }
 ?>