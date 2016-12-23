<?php
session_start();
$isCorectInformation = true;

$ArrayFromForm = array("");
$adresError1 = $adresError2 = $postCodeError = $cityError = $stateError = $countryError = $EnteredInformation = "";

if ($_SESSION['IsCorectinfo'] == 2) {
	Validate();
}

if (isset($_POST['Next'])) {
		Validate();
		EnteredInformationInSesion();
		if ($isCorectInformation ) {
			header("LOCATION: http://localhost/PHP/Blocks/Note.php");
		}
}






if (isset($_POST['AddNewAdres'])) {
	global $EnteredInformation;
	Validate();
	
	if ($isCorectInformation) {
		EnteredInformationInSesion();
		$_SESSION['COUNT'] += 1;
		$_SESSION['AdressArray'][$_SESSION['COUNT']] = array('','','','','','');

	}
	else
	{
		$EnteredInformation = "Моля въведете информация преди да добавите нов адрес !!!";
	}
		
	
}
function Validate()
	{
	global $adresError1 , $adresError2 , $postCodeError , $cityError , $stateError , $countryError , $isCorectInformation,$ArrayFromForm;
		
		if (!empty($_POST['adres1'])) {

			$ArrayFromForm[0]= ucfirst(test_input($_POST['adres1']));
			
		}
		else
		{
			$adresError1 = "Полето е задължително!";
			$isCorectInformation = false;
		}


	
		if (!empty($_POST['city'])) {
			$ArrayFromForm[3] = ucfirst(test_input($_POST['city']));
		}
		else
		{
			$cityError = "Полето е задължително!";
			$isCorectInformation = false;
		}

		if (!empty($_POST['state'])) {
			$ArrayFromForm[4] = ucfirst(test_input($_POST['state']));
		}
		else
		{
			$stateError = "Полето е задължително!";
			$isCorectInformation = false;
		}

		if (!empty($_POST['country'])) {
			$ArrayFromForm[5] =ucfirst(test_input($_POST['country']));
		}
		else
		{
			$ArrayFromForm[5] ="";
		}

		if (!empty($_POST['adres2'])) {
			$ArrayFromForm[1] = ucfirst(test_input($_POST['adres2']));
		}
		else
		{
			$ArrayFromForm[1] = "";
		}
		
		

		if (!empty($_POST['postCode'])) {
			$ArrayFromForm[2]  = test_input($_POST['postCode']);
			for ($i=0; $i < ($_SESSION['COUNT']+1); $i++) { 
				if (!preg_match("/^[0-9]*$/", $ArrayFromForm[2])) {
					$postCodeError = "Некоректно въведени данни! Само числа от 0 до 9";
					$isCorectInformation = false;
				}
				else
				{
					if (!(strlen($ArrayFromForm[2]) == 4)) {
				
						$postCodeError = "Дължината на полето меже да е максимално 4 символа";
						$isCorectInformation = false;
					}
				}
			}
			
		}
		else
		{
			$postCodeError = "Полето е задължително!";
					$isCorectInformation = false;
		}	
		
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
	}

function EnteredInformationInSesion()
{
	global $ArrayFromForm;
	for ($s=0; $s < 6; $s++) {
		$_SESSION['AdressArray'][$_SESSION['COUNT']][$s]  = $ArrayFromForm[$s];
	}

}
?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
<header>
	<div class="wrapper">	
		<h1>Добавяне на потребител</h1>
	</div>
</header>
<div class="wrapper">	
<section>	
		<article id="menu">	
			<ul>	
				<li><a href="Person.php">Лични данни</a></li>
				<li><a href="Adress.php">&#8594 Адреси</a></li>
				<li><a href="Note.php">Бележки</a></li>
					
			</ul>
		</article>
		<article>	
<section>
<h3>Адрес</h3>
<p style="margin-top: 10px"><?php echo $EnteredInformation; ?></p>
</section>
	<article id="data">
		<form method="post" action="">
			<?php
			
			for ($i=0; $i < ($_SESSION['COUNT']+1); $i++) { 
			if ($_SESSION['AdressArray'][$i][0] == null) {
				$adres1VM = $adres2VM = $postCodeVM = $cityVM = $stateVM = $countryVM = "";
			}
			else
			{
				$adres1VM = $_SESSION['AdressArray'][$i][0];
				$adres2VM = $_SESSION['AdressArray'][$i][1];
				$postCodeVM = $_SESSION['AdressArray'][$i][2];
				$cityVM = $_SESSION['AdressArray'][$i][3];
				$stateVM = $_SESSION['AdressArray'][$i][4];
				$countryVM =  $_SESSION['AdressArray'][$i][5];
			}

			
			if ($i == $_SESSION['COUNT']) {
				echo "<section>
					<article id='fiedslHeader'>
						<p>Адрес 1*</p>
						<p>Адрес 2</p>
						<p>Пощенски код*</p>
						<p>Населено място*</p>
						<p>Област*</p>
						<p>Държава</p>
					</article>
					<article>
						<input type='adres1' name='adres1' value='$adres1VM'>
							<span class='error'>$adresError1</span></br>
						<input type='adres2' name='adres2' value='$adres2VM'>
							</br>
						<input type='postCode' name='postCode' value='$postCodeVM'>
							<span class='error'>$postCodeError</span></br>
						<input type='city' name='city' value='$cityVM'>
							<span class='error'>$cityError</span></br>
						<input type='state' name='state' value='$stateVM'>
							<span class='error'>$stateError</span></br>
						<input type='country' name='country' value='$countryVM'>
							</br>
						
					</article>
				</section>
						";
				}
				else
				{
					echo "<section>
					<article id='fiedslHeader'>
						<p>Адрес 1*</p>
						<p>Адрес 2</p>
						<p>Пощенски код*</p>
						<p>Населено място*</p>
						<p>Област*</p>
						<p>Държава</p>
					</article>
					<article>
						<input type='adres1' name='adres1' value='$adres1VM'></br>
						<input type='adres2' name='adres2' value='$adres2VM'></br>
						<input type='postCode' name='postCode' value='$postCodeVM'></br>
						<input type='city' name='city' value='$cityVM'></br>
						<input type='state' name='state' value='$stateVM'></br>
						<input type='country' name='country' value='$countryVM'>
							</br>
						
					</article>
				</section>
						";
				}

		
}?>

						<font style="color:red; margin-right: 15px">*Заължителни полета</font>
			<input type='submit' name='Next'  value='Запис'>
						<input type='submit' name='AddNewAdres' value='Добавяне на адрес'>	
						
		</form>

	</article>
</section>

</div>
</body>
</html> 
			