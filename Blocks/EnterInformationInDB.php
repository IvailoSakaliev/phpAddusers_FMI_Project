<?php
session_start();
$isCorrectInsertInDatabase = true;
$connection = mysqli_connect("127.0.0.1", "root","" , "phplab");
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
	}


InsertIntoUser();
$_SESSION['userId'] = mysqli_insert_id($connection);
InsertIntoAdreses();
$_SESSION['adresID'] = mysqli_insert_id($connection) - $_SESSION['COUNT'];
InsertintoNotes($_SESSION['userId']);
EnterInfoInRelationDB($_SESSION['userId'],$_SESSION['adresID'] );
mysql_close();
if ($isCorrectInsertInDatabase) {
		header("LOCATION: Print.php");
	}
	else
	{
		header("LOCATION: Note.php");
}


function InsertIntoUser(){
	global  $connection, $isCorrectInsertInDatabase;

	$name = $_SESSION['persone']['fname']; 
	$lastName = $_SESSION['persone']['lname'];
	$secondName = $_SESSION['persone']['sname'];
	$user = $_SESSION['persone']['user'];
	$email = $_SESSION['persone']['email']; 
	$tel = $_SESSION['persone']['telNumber'];

	$insert = "INSERT INTO users VALUES(DEFAULT,'$name', '$lastName','$secondName','$user','$email','$tel')";

	$result = mysqli_query($connection,$insert);
	CheckcorectInsertInformation($result);
}

function InsertIntoAdreses(){
	global  $connection, $isCorrectInsertInDatabase;
	for ($i=0; $i < ($_SESSION['COUNT']+1); $i++) { 

		$adres1VM = $_SESSION['AdressArray'][$i][0];
		$adres2VM = $_SESSION['AdressArray'][$i][1];
		$postCodeVM = $_SESSION['AdressArray'][$i][2];
		$cityVM = $_SESSION['AdressArray'][$i][3];
		$stateVM = $_SESSION['AdressArray'][$i][4];
		$countryVM =  $_SESSION['AdressArray'][$i][5];

		$insert = "INSERT INTO addresses VALUES(DEFAULT,'$adres1VM','$adres2VM','$postCodeVM','$cityVM','$stateVM','$countryVM')";

		$result = mysqli_query($connection,$insert);
	

	}	
	CheckcorectInsertInformation($result);
}

function InsertintoNotes($userId){
	global  $connection, $isCorrectInsertInDatabase;
	for ($i=0; $i < ($_SESSION['COUNTNOTE']+1) ; $i++) { 
		$arrayinfoemation = $_SESSION['Notes'][$i];
		$insert = "INSERT INTO notes VALUES(DEFAULT,'$userId','$arrayinfoemation')";
		if ($arrayinfoemation == "") {
			break;
		}
		$result = mysqli_query($connection,$insert);
	}	
	CheckcorectInsertInformation($result);
}

function EnterInfoInRelationDB($userId,$adressids){
	global  $connection, $isCorrectInsertInDatabase;
	for ($i=0; $i < ($_SESSION['COUNT']+1); $i++) { 
		$insert = "INSERT INTO users_addresses VALUES(DEFAULT,'$userId','".($adressids + ($i + 1))."')";
		$result = mysqli_query($connection,$insert);
	}
	CheckcorectInsertInformation($result);
}

function CheckcorectInsertInformation($result){
	global $isCorrectInsertInDatabase;
	if (!$result) {
		$isCorrectInsertInDatabase = false;
	}
}

?>