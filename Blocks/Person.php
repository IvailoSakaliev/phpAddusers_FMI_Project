<?php
session_start();

$nameError = $lastNameError= $secondNameError = $UserNameEror = $EmailEror = $telefonError=$globaleror =  " ";
$name = $secondName = $lastName = $user = $tel = $email = "";


if ($_SESSION['IsCorectinfo'] == 1) {
	ValidateInfo();
}


if(isset($_REQUEST['submit'])){
	$isCorectRegistration = true;
	ValidateInfo();
	enterinfoInSesion();
		if ($isCorectRegistration) {
			header("LOCATION: http://localhost/PHP/Blocks/Adress.php");
		}
	
}
function EmptyFields(){
	$nameError = $lastNameError= $secondNameError = $UserNameEror = $EmailEror = $telefonError= " ";
	
	}

function ValidateEmail($email){
	
	return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
	}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
	}

function ValidateInfo(){
	global  $name , $secondName , $lastName ,$user , $tel ,$email,$isCorectRegistration,$nameError, $lastNameError, $secondNameError , $UserNameEror , $EmailEror , $telefonError;
	EmptyFields();
	

	if (empty($_POST['FirstName'])) {
		$nameError ="Полето  неможе да остане празно !";
			$isCorectRegistration = false;
		}
		else
		{
			$name = ucfirst(test_input($_POST['FirstName']));
			if (strlen($name) > 3) {
					if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
					{
						$nameError = "Плоето може да съдържа само букви";	
						$isCorectRegistration = false;
					}
				}
				else
				{
					$nameError = "Недостатъчни символи";
					$isCorectRegistration = false;
				}
		}

	if (empty($_POST['SecondName'])) {
		$secondNameError= "Полето неможе да остане празно !";
			$isCorectRegistration = false;	
		}
		else
		{
			$secondName = ucfirst(test_input($_POST['SecondName']));
			if (strlen($secondName) > 3) {
						if (!preg_match("/^[a-zA-Z ]*$/",$secondName)) {
						$secondNameError = "Плоето  може да съдържа само букви";
						$isCorectRegistration = false;
					}
				}
				else
				{
					$secondNameError =  "Недостатъчни символи";
					$isCorectRegistration = false;
				}
		}

	if (empty($_POST['LastName'])) {
		$lastNameError= "Полето неможе да остане празно !";
			$isCorectRegistration = false;
		}
		else
		{
			$lastName = ucfirst(test_input($_POST['LastName']));
			if (strlen($lastName) > 3) {
						if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
					$lastNameError =  "Плоето  може да съдържа само букви";	
					$isCorectRegistration = false;
					}
				}
				else
				{
					$lastNameError = "Недостатъчни символи";
					$isCorectRegistration = false;
				}

		}

	if (empty($_POST['Login'])) {
		$UserNameEror =  "Полето неможе да остане празно !";	
			$isCorectRegistration = false;
		}
		else
		{
			$user = test_input($_POST['Login']);
			if (strlen($user) > 6 && strlen($user) < 20) {
				if (!preg_match('/^[A-Za-z][A-Za-z0-9]{6,20}$/', $user)) {
				$UserNameEror =  "Символи от А-Z и числа от 0-9 !!!";
				$isCorectRegistration = false;
				}
			}
			else
			{
				$UserNameEror = "Повече от 6 символаи по-малко от 20 !";
				$isCorectRegistration = false;
			}
			
		}

	if (empty($_POST['TelephoneNumber'])) {
		
		}
		else
		{

			$tel = test_input($_POST['TelephoneNumber']);
			if (!preg_match('/^[0-9]{9,13}$/', $tel)) {
					$telefonError ="Телефона трябва да съдържа само цифри";
					$isCorectRegistration = false;
				
					
			}
			else
			{
				if ($tel <9 && $tel > 9) {
					$telefonError= "Номера трябва да бъде 10 цири";
					$isCorectRegistration = false;
				}
				
			}
		}

	if (empty($_POST['Email'])) {
		$EmailEror = "Полето неможе да остане празно !";	
			$isCorectRegistration = false;
		}	
		else
		{
			$email = test_input($_POST['Email']);
			if (!ValidateEmail($email)) {
					$EmailEror = "Email не е коректно въведен !!!";
					$isCorectRegistration = false;
				}
		}
}
function enterinfoInSesion(){
	global  $name , $secondName , $lastName ,$user , $tel ,$email ;
	
			$_SESSION['persone']['fname'] = $name;
			$_SESSION['persone']['lname'] = $lastName;
			$_SESSION['persone']['sname']= $secondName;
			$_SESSION['persone']['user'] = $user;
			$_SESSION['persone']['email']= $email;
			$_SESSION['persone']['telNumber'] = $tel;
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
			<li><a href="Person.php">&#8594 Лични данни</a></li>
			<li><a href="Adress.php">Адреси</a></li>
			<li><a href="Note.php">Бележки</a></li>
		</ul>
	</article>
	<article>	
		<section>
			<h3>Лични данни</h3>
				
			<article id="data">
			<form method="post" action="">
			<?php echo $globaleror; ?>
				<section>
					<article id="fiedslHeader">
						<p>Собствено име*</p>
						<p>Бащино име*</p>
						<p>Фамилия*</p>
						<p>Потребителско име(login)*</p>
						<p>Електронна поща*</p>
						<p>Телефон</p>
						<P style="color:red">*Заължителни полета</P>
					</article>
					<article>	
					<input type="text" name="FirstName"  value="<?php echo $_SESSION['persone']['fname'];?>">
						<span class="error"><?php echo $nameError;?></span>
					</br>
					<input type="text" name="SecondName" value="<?php echo $_SESSION['persone']['sname'];?>">
						<span class="error"><?php echo $secondNameError;?></span>
					</br>
					<input type="text" name="LastName" value="<?php echo $_SESSION['persone']['lname'];?>">
						<span class="error"><?php echo $lastNameError;?></span>
					</br>
					<input type="text" name="Login" value="<?php echo $_SESSION['persone']['user'];?>" >
						<span class="error"><?php echo $UserNameEror;?></span>
					</br>
					<input type="text" name="Email" value="<?php echo $_SESSION['persone']['email'];?>">
						<span class="error"><?php echo $EmailEror;?></span>
					</br>
					<input type="text" name="TelephoneNumber" value="<?php echo $_SESSION['persone']['telNumber'];?>">
						<span class="error"><?php echo $telefonError;?></span>
					</br>
					<input type="submit" name="submit" id="infoSubmit" value="Запис">
					</article>
				</section>
		</form>
	</article>
</section>
</article>

</div>
</body>
</html>