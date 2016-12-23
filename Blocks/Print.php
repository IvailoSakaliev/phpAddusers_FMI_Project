<?php 
	
session_start();
$ArrayFromForm= array(
	array('','','','','',''),
	);
$NotesInformation = array("");
$name = $secondName = $lastName = $user = $tel = $email = "";

$connection = mysqli_connect("127.0.0.1", "root","" , "phplab");
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
	}
SelectUserInformation();
SelectAdressInformation();
SelectnotesInformation();

function SelectUserInformation(){
		global $name , $secondName , $lastName , $user , $tel , $email,$connection;
		$select = "SELECT 
						user_fname,
						user_mname,
						user_lname,
						user_login,
						user_email,
						user_phone 
						FROM users 
						WHERE 
						user_id = '".$_SESSION['userId']."'
						";
		$result = mysqli_query($connection, $select);
		while ($row = mysqli_fetch_assoc($result))
		{
			$name = $row["user_fname"];
			$secondName = $row["user_mname"];
			$lastName =  $row["user_lname"];
			$user =  $row["user_login"];
			$tel =  $row["user_phone"];
			$email = $row["user_email"];
		}
}

function SelectAdressInformation(){
	global $adres1VM , $adres2VM , $postCodeVM , $cityVM , $stateVM , $countryVM,$connection,$ArrayFromForm ;
	for ($i=0; $i < ($_SESSION['COUNT']+1); $i++) {
		$select = "SELECT 
						address_line_1,
						address_line_2,
						address_zip,
						address_city,
						address_province,
						address_country
						FROM  addresses
						WHERE address_id = '".($_SESSION['adresID']+ $i)."'
						";
		$result = mysqli_query($connection, $select);
		while ($row = mysqli_fetch_assoc($result)) {
			$ArrayFromForm[$i][0] = $row['address_line_1'];
			$ArrayFromForm[$i][1] = $row['address_line_2'];
			$ArrayFromForm[$i][2] = $row['address_zip'];
			$ArrayFromForm[$i][3] = $row['address_city'];
			$ArrayFromForm[$i][4] = $row['address_province'];
			$ArrayFromForm[$i][5] = $row['address_country'];

		}
		$ArrayFromForm[($i +1)] = array('','','','','','');

	}
}
function SelectnotesInformation(){
	global $countryVM,$connection,$NotesInformation ;
	for ($i=0; $i < ($_SESSION['COUNTNOTE']+1); $i++) {
		$select = "SELECT 
						note_text
						FROM  notes
						WHERE  note_user_id = '".$_SESSION['userId']."'
						";
		$result = mysqli_query($connection, $select);
		while ($row = mysqli_fetch_assoc($result)) {
			$NotesInformation[$i] = $row['note_text'];

		}
		$NotesInformation[($i +1)] = array("");

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
		<ul >	
				<li>Лични данни</li>
				<li>Адреси</li>
				<li>Бележки</li>
		</ul>
	</article>
	<article>	
		<section id="PrintInformaation">
			<h4>Следната информация беше успешно записана в MySQL базата от данни</h4>
		
			<article>
				<h2>Лична информация</h2>
				<hr id="headersHR" width="100% ">
				<section id="userInformacion" >
					<article id="fiedslHeader" style="width: 26%; display: inline-block;">
						<p>Собствено име*</p>
						<p>бащино име*</p>
						<p>Фамилия*</p>
						<p>Потребителско име(login)*</p>
						<p>Електронна поща*</p>
						<p>Телефон</p>
						</article>
					<article id="fiedslHeader" style="width: 40%; display: inline-block;">
						<p><?php echo $name;?></p>
						<p><?php echo $secondName;?></p>
						<p><?php echo $lastName;?></p>
						<p><?php echo $user;?></p>
						<p><?php echo $email;?></p>
						<p><?php echo $tel;?></p>
						
					</article>
				</section>
			</article>

			<article>
				<h2>Адреси</h2>
				<hr id="headersHR" width="100% ">
				
					 
						
					



				 

				 <ol id="printElementsAdress" start="" ="1">
				 <?php 
				 	for ($i= 0; $i < ($_SESSION['COUNT']+1) ; $i++) {
						$adres1VM = $ArrayFromForm[$i][0];
						$adres2VM =$ArrayFromForm[$i][1];
						$postCodeVM =$ArrayFromForm[$i][2];
						$cityVM = $ArrayFromForm[$i][3];
						$stateVM = $ArrayFromForm[$i][4];
						$countryVM =  $ArrayFromForm[$i][5];
						 
						 echo "	
							<span>".($i + 1)."</span>
						 <li>
						 		<P>$adres1VM </P>
						 		<p>$cityVM , $postCodeVM</p>
						 		<p>$stateVM</p>
						 		<p>$countryVM</p>
						 	</li>";
				 	}
				 ?>
				 </ol> 
			</article>
			
			<article style="margin-bottom: 30px;">	
				<h2>Бележки</h2>
				<hr id="headersHR" width="100% ">

				 <?php
					for ($i=0; $i < ($_SESSION['COUNTNOTE']+1); $i++) { 
						$arrayinfoemation = $NotesInformation[$i];
						echo "
							<P id='printNotes'>
								$arrayinfoemation
							</p>
							<hr width='100%'>
						"	;
					}
				?>  
			</article>
				<a href="index.php" class="newUser">Add New User</a>
		</section>

</div>
</body>
</html>