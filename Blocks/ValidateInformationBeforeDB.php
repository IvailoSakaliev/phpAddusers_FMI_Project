<?php 
session_start();


$_SESSION['IsCorectinfo'] = 0;

ValidatePersone();
ValidateAdreses();
if ($_SESSION['IsCorectinfo'] == 0) {
	header("LOCATION: EnterInformationInDB.php");
	}
	else
	{
		if ( $_SESSION['IsCorectinfo'] == 1)
			{
				header("LOCATION: Person.php");
			}
			else if($_SESSION['IsCorectinfo'] == 2)
			{
				header("LOCATION: Adress.php");
			}
	}
function ValidatePersone()
{
	if ($_SESSION['persone']['fname'] == "" ) {
		$_SESSION['IsCorectinfo'] = 1;
	}
	if ($_SESSION['persone']['sname'] == "" ) {
		$_SESSION['IsCorectinfo'] = 1;
	}
	if ($_SESSION['persone']['lname'] == "" ) {
		$_SESSION['IsCorectinfo'] = 1;
	}
	if ($_SESSION['persone']['user'] == "" ) {
		$_SESSION['IsCorectinfo'] = 1;
	}
	if ($_SESSION['persone']['email'] == "" ) {
		$_SESSION['IsCorectinfo'] = 1;
	}

	

	
}
function ValidateAdreses()
{
		for ($i=0; $i < ($_SESSION['COUNT']+1); $i++) { 
			if ($_SESSION['AdressArray'][$i][0] == "") {
				$_SESSION['IsCorectinfo'] = 2;
			}
			if ($_SESSION['AdressArray'][$i][2] == "") {
				$_SESSION['IsCorectinfo'] = 2;
			}
			if ($_SESSION['AdressArray'][$i][3] == "") {
				$_SESSION['IsCorectinfo'] = 2;
			}
			if ($_SESSION['AdressArray'][$i][4] == "") {
				$_SESSION['IsCorectinfo'] = 2;
			}

		}
}

 ?>