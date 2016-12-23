<?php
session_start();
$NumberOfNotes = "Текс на бележката";
$NumberOfNotes = "Бележка";
$isEnterInformation = true;
$ErrorNotes = "";


	if(isset($_POST['Save'])){
		if ($_SESSION['COUNTNOTE'] == 0 && empty($_POST['note'])) {
			$ErrorNotes = "Моля въведете една бележка";
		}
		else
		{
			EnterInformationInSesion();		
			header("LOCATION: ValidateInformationBeforeDB.php");
		}
		
	}

	if(isset($_POST['AddNote'])){
		
		if ($_SESSION['COUNTNOTE'] <= 10) {
			EnterInformationInSesion();
			if (!($_SESSION['Notes'][$_SESSION['COUNTNOTE']] == "")) {
				$_SESSION['COUNTNOTE'] ++;		
				$_SESSION['Notes'][$_SESSION['COUNTNOTE']] = "";
			}
			else
			{
				$ErrorNotes = "Моля преди добавянето на нова бележка да въведете информация в предишната !!!";
			}
			
		}
		else
		{
			$maxNumberOfnotes = "Въведохте максималния брой бележки, които можете да въведете в системата!!!";
		}
		
	}

	function EnterInformationInSesion()
	{
		$_SESSION['Notes'][$_SESSION['COUNTNOTE']] = $_POST['note'];
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
			<ul >	
				<li><a href="Person.php"> Лични данни</a></li>
				<li><a href="Adress.php">Адреси</a></li>
				<li><a href="Note.php">&#8594 Бележки</a></li>
			</ul>
		</article>
		<article>	
<section>
	<h3>Бележки</h3>
	
	<article>
	
	<form method="post" action="">
	<?php
		echo $ErrorNotes;
		for ($i=0; $i < ($_SESSION['COUNTNOTE']+1) ; $i++) { 
			if ($_SESSION['Notes'][$i] == null) {
					$arrayinfoemation = "";
			}
			else
			{
					$arrayinfoemation = $_SESSION['Notes'][$i];
			}
			
			
			if ($i == ($_SESSION['COUNTNOTE']) && $_SESSION['COUNTNOTE'] !== 0) {
				echo "<p style='margin:10px 0px;'>Нова Бележка </p>";
			}
			else
			{
				if ($_SESSION['COUNTNOTE'] == 0) {
					echo "<p style='margin:10px 0px;'>$NumberOfNotes</p>";
				}
				else
				{
					echo "<p style='margin:10px 0px;'>$NumberOfNotes     ".($i+1)."</p>";
				}
			}
			echo "
				<textarea name='note' cols='40' rows='15'>$arrayinfoemation</textarea></br>";
		}
	?>
		<input type="submit" name="Save" value="Запис в базата">
		<input type="submit" name="AddNote" value="Добави бележка">
	<form>
	</article>
</section>
</article>

</div>
</body>
</html>