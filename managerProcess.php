<?php
/*Student Name: Tuan Nam Dinh Tran
Student ID: 101373703
This file respond to all requests from processing.htm*/
$type = $_GET['type'];
if($type === 'display'){
	header('Content-Type: text/xml');
	$doc = new DOMDocument();
	$doc->preserveWhiteSpace = FALSE;
    $doc->load('../../data/goods.xml');
	
	echo $doc->saveXML();
	
}


if($type === 'process'){
	header('Content-Type: text/xml');
	$doc = new DOMDocument();
	$doc->preserveWhiteSpace = FALSE;
    $doc->load('../../data/goods.xml');
	$good = $doc->documentElement;
	$sold = $doc->getElementsByTagName("sold");
	$hold = $doc->getElementsByTagName("hold");
	$qty = $doc->getElementsByTagName("qty");
	$items = $doc->getElementsByTagName("item");
	for($i = 0;$i<$sold->length;$i++){
		$sold[$i]->nodeValue = 0;
		if(($hold[$i]->nodeValue == 0) && ($qty[$i]->nodeValue == 0)){
			$good->removeChild($items[$i]);
		}
	}
	$doc->saveXML();
	$doc->save('../../data/goods.xml');
	echo $doc->saveXML();
}
?>