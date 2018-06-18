<?php
/*
Student Name: Tuan Nam Dinh Tran
Student ID: 101373703

This file check the input from listing.htm 
*/
$name = $_GET["name"];
$price = $_GET["price"];
$qty = $_GET["qty"];
$desc = $_GET["desc"];






$doc = new DOMDocument();
$doc->preserveWhiteSpace = FALSE;
$doc->load('../../data/goods.xml');


$good = $doc->firstChild;
$number1 = $doc->getElementsByTagName("number")->length;
$number = $doc->getElementsByTagName("number")[$number1-1]->nodeValue;

$cItem = $doc->createElement("item");
	
$cNumber=$doc->createElement("number");
$vNumber = $doc->createTextNode($number+1);
$cNumber->appendChild($vNumber);
	
	
$cName=$doc->createElement("name");
$vName = $doc->createTextNode($name);
$cName->appendChild($vName);
	
$cPrice=$doc->createElement("price");
$vPrice = $doc->createTextNode($price);
$cPrice->appendChild($vPrice);
	
$cDesc=$doc->createElement("description");
$vDesc = $doc->createTextNode($desc);
$cDesc->appendChild($vDesc);
	
$cQty=$doc->createElement("qty");
$vQty = $doc->createTextNode($qty);
$cQty->appendChild($vQty);


$cHold=$doc->createElement("hold");
$vHold = $doc->createTextNode("0");
$cHold->appendChild($vHold);


$cSold=$doc->createElement("sold");
$vSold = $doc->createTextNode("0");
$cSold->appendChild($vSold);

	
$cItem->appendChild($cNumber);
$cItem->appendChild($cName);
$cItem->appendChild($cPrice);
$cItem->appendChild($cDesc);
$cItem->appendChild($cQty);
$cItem->appendChild($cHold);
$cItem->appendChild($cSold);

	
	$good->appendChild($cItem);
	$uniqid = $cItem->firstChild->nodeValue;
	$doc->saveXML();
	$doc->save('../../data/goods.xml');
	echo "<p>The item has been listed in the system, and the item number is: ".$uniqid."</p>";

?>