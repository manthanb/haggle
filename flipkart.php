<?php
	
    class Flipkart
	{

		private $baseUrl = "https://affiliate-api.flipkart.net/affiliate/api/affid.json";

        private $headers = array(
	            'Fk-Affiliate-Id: affid',
	            'Fk-Affiliate-Token: token'
	            );

		public $result;
		public $links;
		public $mainLinksCount=0;
		public $pc=0;
		public $id;
		public $title;
		public $image;
		public $sellingPrice;
		public $maximumRetailPrice;
		public $productURL;
		public $flag=0;

		function __construct()
	    {
			ini_set('max_execution_time', 0);
			ini_set('memory_limit', '1024M');
			$this->curl($this->baseUrl);
		}
       
		public function curl($url)
		{		
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	        
			$this->result = curl_exec($ch);
	      
			curl_close($ch);
		}

        public function getProductFeedJason($res)
		{
            $i=0;

		    $productFeeds = json_decode($res, TRUE);
	
			$this->links = $productFeeds['apiGroups']['affiliate']['apiListings'];

			foreach($this->links as $keys=>$value)
			{
				$this->links[$i] = $value['availableVariants']['v0.1.0']['get'];
				//echo $this->links[$i];
				$i = $i + 1;
			}
		}

		public function getProducts($res, $str)
		{	
			$products = null;
			$products = json_decode($res, TRUE);

			$outerPart = $products['productInfoList'];
			$nextUrl = $products['nextUrl'];
			//echo $nextUrl.'<br />';

			foreach($outerPart as $data)
			{
                $t = $data['productBaseInfo']['productAttributes']['title'];
				similar_text($str, $t, $percent);
				if($percent>70)
				{
					$this->id[$this->pc] = $data['productBaseInfo']['productIdentifier']['productId'];
					//echo $this->id[$this->pc].'<br />';

					$this->title[$this->pc] = $data['productBaseInfo']['productAttributes']['title'];
					//echo $this->title[$this->pc].'<br />';

					$this->image[$this->pc] = $data['productBaseInfo']['productAttributes']['imageUrls']['400x400'];
					//echo $this->image[$this->pc].'<br />';

					$this->sellingPrice[$this->pc] = $data['productBaseInfo']['productAttributes']['sellingPrice']['amount'];
					//echo $this->sellingPrice[$this->pc].'<br />';

					$this->maximumRetailPrice[$this->pc] = $data['productBaseInfo']['productAttributes']['maximumRetailPrice']['amount'];
					//echo $this->maximumRetailPrice[$this->pc].'<br />';

					$this->productUrl[$this->pc] = $data['productBaseInfo']['productAttributes']['productUrl'];
					//echo $this->productUrl[$this->pc].'<br />';

					$this->pc = $this->pc+1;

					if($this->pc >=10)
					{
						$this->flag=1;
						break;
					}
				}
			}

			if($nextUrl && $this->flag==0)
			{
				$this->curl($nextUrl);
				$this->getProducts($this->result, $str);
			}
		}
	}

?>
   


