<?php
error_reporting(0);

$arr = array('http://www.amazon.in','http://www.flipkart.com'); // insert list of URLs to scrape

echo "<table>";
foreach ($arr as &$value) {

$file = $DOCUMENT_ROOT. $value;
$doc = new DOMDocument();
$doc->loadHTMLFile($file);
$xpath = new DOMXpath($doc);

$elements = $xpath->query("*//div[3]/div[2]/div/a/span"); // insert Xpath reference.
    
if (!is_null($elements)) {
	echo "<tr>";
	echo "<td>".$value."</td>";
  foreach ($elements as $element) {
	
	$nodes = $element->childNodes;
    foreach ($nodes as $node) {
      echo "<td>".$node->nodeValue. "</td>\n";
    }
	
  }
  echo "</tr>";
}

}
echo "</table>";
?>