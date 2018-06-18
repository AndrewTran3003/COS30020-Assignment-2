<?php
/*Student Name: Tuan Nam Dinh Tran
Student ID: 101373703
This file echo the log out message*/
$type = $_GET['type'];
/*This function will echo the content of xml file */
if ($type === 'display'){
	header('Content-Type: text/xml');
	$doc = new DOMDocument();
	$doc->preserveWhiteSpace = FALSE;
    $doc->load('../../data/goods.xml');
	
	echo $doc->saveXML();
	
}
/*This function will handle the add item request */
if ($type === 'add'){
	$ID = $_GET['ID'];
	header('Content-Type: text/xml');
	$doc = new DOMDocument();
	$doc->preserveWhiteSpace = FALSE;
    $doc->load('../../data/goods.xml');
	$getID = $doc->getElementsByTagName("number");

	for ($i = 0; $i<$getID->length;$i++){
		if ($getID[$i]->nodeValue == $ID){
			$qty = $doc->getElementsByTagName("qty")[$i]->nodeValue;
	        $hold = $doc->getElementsByTagName("hold")[$i]->nodeValue;
			if($qty>0){
			$qty = $qty - 1;
			$hold = $hold + 1;
			$error = "no";
			}
			else{
				$error = "error";
			}
			$doc->getElementsByTagName("qty")[$i]->nodeValue = $qty;
			$doc->getElementsByTagName("hold")[$i]->nodeValue = $hold;		
	    }
	}
	$doc->saveXML();
	$doc->save('../../data/goods.xml');
	echo $doc->saveXML();
	
}



/*This function will handle the remove item request */
if ($type === 'remove'){
	$ID = $_GET['ID'];
	header('Content-Type: text/xml');
	$doc = new DOMDocument();
	$doc->preserveWhiteSpace = FALSE;
    $doc->load('../../data/goods.xml');
	$getID = $doc->getElementsByTagName("number");
	for($i = 0; $i<$getID->length;$i++){
		if ($getID[$i]->nodeValue == $ID){
			$qty = $doc->getElementsByTagName("qty")[$i]->nodeValue;
	        $hold = $doc->getElementsByTagName("hold")[$i]->nodeValue;
			$qty = $qty + 1;
			$hold = $hold - 1;
			$doc->getElementsByTagName("qty")[$i]->nodeValue = $qty;
			$doc->getElementsByTagName("hold")[$i]->nodeValue = $hold;			
		}
	}
	
	$doc->saveXML();
	$doc->save('../../data/goods.xml');
	echo $doc->saveXML();
	
}
/*This function will handle the confirm cart request */
if ($type === 'confirm'){
	header('Content-Type: text/xml');
	$doc = new DOMDocument();
	$doc->preserveWhiteSpace = FALSE;
    $doc->load('../../data/goods.xml');
	$item = $doc->getElementsByTagName("item");
	for ($i = 0;$i <$item->length; $i++){
		if($doc->getElementsByTagName("hold")[$i]->nodeValue > 0){
			$hold = $doc->getElementsByTagName("hold")[$i]->nodeValue;
			$sold = $doc->getElementsByTagName("sold")[$i]->nodeValue;
			$sold = $sold + $hold;
			$doc->getElementsByTagName("hold")[$i]->nodeValue = 0;
			$doc->getElementsByTagName("sold")[$i]->nodeValue = $sold;
		}
	}
	$doc->saveXML();
	$doc->save('../../data/goods.xml');
	echo $doc->saveXML();
	
}/*This function will handle the reset cart request */
if ($type === 'reset'){
	header('Content-Type: text/xml');
	$doc = new DOMDocument();
	$doc->preserveWhiteSpace = FALSE;
    $doc->load('../../data/goods.xml');
	$item = $doc->getElementsByTagName("item");
	for ($i = 0;$i <$item->length; $i++){
		if($doc->getElementsByTagName("hold")[$i]->nodeValue > 0){
			$hold = $doc->getElementsByTagName("hold")[$i]->nodeValue;
			$qty = $doc->getElementsByTagName("qty")[$i]->nodeValue;
			$qty = $qty + $hold;
			$doc->getElementsByTagName("hold")[$i]->nodeValue = 0;
			$doc->getElementsByTagName("qty")[$i]->nodeValue = $qty;
		}
	}
	$doc->saveXML();
	$doc->save('../../data/goods.xml');
	echo $doc->saveXML();
}
?>