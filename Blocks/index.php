<?php
session_start();
$_SESSION['COUNTNOTE'] = 0;
$_SESSION['COUNT']= 0;
$_SESSION['AdressArray']= array(
	array(""),

);
$_SESSION['Notes'] = array("");

			$_SESSION['persone']['fname'] = "";
			$_SESSION['persone']['lname'] = "";
			$_SESSION['persone']['sname']= "";
			$_SESSION['persone']['user'] = "";
			$_SESSION['persone']['email']= "";
			$_SESSION['persone']['telNumber'] = "";

$_SESSION['IsCorectinfo'] = 0;
header("LOCATION: http://localhost/PHP/Blocks/Person.php");
?>