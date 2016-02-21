<?php
	
	class Amazon
	{
		private $aid = "AKIAJ3JIQCH5GEUF4YFQ";
		private $tag = "haggle0b-21";
		
		public $title;
		public $price;
		public $fprice;
		public $image;
		public $url;
		public $asn;
		public $simage;
		public $itemCount = 0;
		
		function __construct($str)
		{   
			$str = trim($str);
			$str = str_replace(",", "", $str);
			$str = str_replace(".", "", $str);
			$str = str_replace(" ", "%20", $str);
			
			$this->getResponse($str);
		}
		
        private function getResponse($str)
		{
			$String1 = "GET\n";
			$String2 = "webservices.amazon.in\n";
			$String3 = "/onca/xml\n";
			
			$Timestamp = gmdate("Y-m-d\TH:i:s\Z");
			$Timestamp = str_replace(":", "%3A", $Timestamp);
			
			$String4="AWSAccessKeyId=$this->aid&AssociateTag=$this->tag&Keywords=$str&Operation=ItemSearch&ResponseGroup=ItemAttributes%2COffers%2CImages&SearchIndex=All&Service=AWSECommerceService&Timestamp=$Timestamp&Version=2011-08-01";
			
			$fstring = $String1.$String2.$String3.$String4;
			
			$Signature = base64_encode(hash_hmac("sha256", $fstring, "0ojoPPOBFAH1lbIlTnjz4EsFhHFKxlhspMtbDpB8", True)); $Signature = str_replace("+", "%2B", $Signature);
			$Signature = str_replace("=", "%3D", $Signature);
			
			$baseURL = "http://webservices.amazon.in/onca/xml?";
			$Signature = "&Signature=$Signature";
			$fstring = $baseURL.$String4.$Signature;
			
			$this->getResult($fstring);
		}
		
		private function getResult($str)
		{
			$XML = simplexml_load_file($str);
			
            echo '<a href="'.$str.'">XML</a><p>';
			
            $Items = $XML->Items->Item;
			
			foreach($Items as $item)
			{
				$this->fprice[$this->itemCount] = $item->Offers->Offer->OfferListing->SalePrice->FormattedPrice;
				$this->price[$this->itemCount] = $item->Offers->Offer->OfferListing->SalePrice->Amount;
				
				if($this->fprice[$this->itemCount]==null)
				{
					$this->fprice[$this->itemCount] = $item->Offers->Offer->OfferListing->Price->FormattedPrice;
				    $this->price[$this->itemCount] = $item->Offers->Offer->OfferListing->Price->Amount;

					/*if($this->fprice[$this->itemCount]==null)
					{
						$this->fprice[$this->itemCount] = $item->OfferSummary->LowestNewPrice->FormattedPrice;
						$this->price[$this->itemCount] = $item->Offers->Offer->OfferListing->Price->Amount;
					}*/
				}
				
			    $this->title[$this->itemCount] = $item->ItemAttributes->Title;
				$this->image[$this->itemCount] = $item->MediumImage->URL;
				$this->asn[$this->itemCount] = $item->ASIN;
				$this->url[$this->itemCount] = $item->DetailPageURL;
				$this->simage[$this->itemCount] = $item->SmallImage->URL;
				
				$this->itemCount = $this->itemCount+1;
			}
			}
	}
?>


