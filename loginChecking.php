<?php 

/*Student Name: Tuan Nam Dinh Tran
Student ID: 101373703

This file responsible for logining in for both administrator and customer. Upon login successfully, they will be provided link to approriate page
 */
$type = $_GET["type"];
$Uname = $_GET['Uname'];
$pw = $_GET['pw'];

/*This part is responsible for manager login*/
if($type === "manager"){
	$b = file_get_contents("../../data/manager.txt");
		$c = str_replace("\n",",",$b);
		$file = explode(",",$c);
		for ($i = 0; $i < count($file)- 1;$i = $i+2){
			$sub = trim($file[$i]);
			$a[$sub] = $file[$i+1];
		}
		
		
		
		if(array_key_exists($Uname,$a)){
			
			if(trim($pw) === trim($a[$Uname])){
				$ID = uniqid();
				echo "Successfully login! Click <a href = 'admin.htm'>here</a> to access admin page!|".$ID;
			}
			else{
				echo "Wrong password!";
			}
		}
		else{
			echo "Wrong Username";
		}	
}
/*This part is responsible for customer login*/
if($type === "user"){
	$doc = new DOMDocument();
    $doc->load('../../data/customer.xml');

	$email = $doc->getElementsByTagName('email');
	$password = $doc->getElementsByTagName('password');
	$ID = $doc->getElementsByTagName('ID');
	for($i = 0; $i < $email->length; $i = $i +1){
		$sub = trim($email[$i]->nodeValue);
		$a[$sub] = [$password[$i]->nodeValue,$ID[$i]->nodeValue];
	}
	if(array_key_exists($Uname,$a)){
			
			if(trim($pw) === trim($a[$Uname][0])){
				echo "Successfully login! Click <a href = 'buying.htm'>here</a> to access buying page!|".$a[$Uname][1];
			}
			else{
				echo "Wrong password!";
			}
		}
		else{
			echo "Wrong Username";
		}	
}
		
?>