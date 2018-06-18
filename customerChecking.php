<?php
/*Student Name: Tuan Nam Dinh Tran
Student ID: 101373703
This file respond to all requests from buying.htm*/
$Fname = $_GET["Fname"];
$Lname = $_GET["Lname"];
$pw = $_GET["pw"];
$mail = $_GET["email"];
$phone = $_GET["phone"];
$doc = new DOMDocument();
$doc->load('../../data/customer.xml');
$email = $doc->getElementsByTagName('email');

$i = 0;
/*Check if email has been used or not*/
foreach($email as $emails){
	if($mail === $emails->nodeValue){
		$i++;
	}
}

if($i!== 0){
	echo "The email you've enter has already been used. Please use another email";
}
/*If successful, the server will generate customer ID and write to the XML file*/
else{
	$ID = uniqid();
	$customers = $doc->firstChild;
	$cCustomer = $doc->createElement("customer");
	
	$cID=$doc->createElement("ID");
	$vID = $doc->createTextNode($ID);
	$cID->appendChild($vID);
	
	
	$cEmail=$doc->createElement("email");
	$vEmail = $doc->createTextNode($mail);
	$cEmail->appendChild($vEmail);
	
	$cName=$doc->createElement("name");
	$vName = $doc->createTextNode($Fname." ".$Lname);
	$cName->appendChild($vName);
	
	$cPw=$doc->createElement("password");
	$vPw = $doc->createTextNode($pw);
	$cPw->appendChild($vPw);
	
	$cPhone=$doc->createElement("phone");
	$vPhone = $doc->createTextNode($phone);
	$cPhone->appendChild($vPhone);
	
	$cCustomer->appendChild($cID);
	$cCustomer->appendChild($cEmail);
	$cCustomer->appendChild($cName);
	$cCustomer->appendChild($cPw);
	$cCustomer->appendChild($cPhone);
	
	$customers->appendChild($cCustomer);
	
	$doc->saveXML();
	$doc->save('../../data/customer.xml');
	echo "Successfully registered! Click <a href = 'buying.htm'>here</a> to go shopping!!!|".$ID;
	
	
	
	
}




?>