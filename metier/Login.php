
<?php 
include "../dao/Connexion.inc";
session_start();

if (isset($_POST['email']) && 
	isset($_POST['password'])) {

	include "func-validation.php";
	

	$email = $_POST['email'];
	$password = $_POST['password'];


	$text = "Email";
	$location = "../presentation/Login.php";
	$ms = "banana";
    is_empty($email, $text, $location, $ms, "");

    $text = "Password";
	$location = "../presentation/Login.php";
	$ms = "banana";
    is_empty($password, $text, $location, $ms, "");

  $sql = "SELECT * FROM admin 
	  WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$email]);

if ($stmt->rowCount() === 1) {
	$user = $stmt->fetch();

	$user_id = $user['id'];
	$user_email = $user['email'];
	$user_password = $user['password'];
	if ($email === $user_email) {
		if (password_verify($password, $user_password)) {
			$_SESSION['user_id'] = $user_id;
			$_SESSION['user_email'] = $user_email;
			header("Location: ../presentation/Admin.php");
		}else {
			# Error message
			$em = "Incorrect email or password";
			header("Location: ../presentation/Login.php?banana=$em");
		      }
	}else {
		# Error message
		$em = "Incorrect email or password";
		header("Location: ../presentation/Login.php?banana=$em");
	      }
}else{
	# Error message
	$em = "Incorrect email or password";
	header("Location: ../presentation/Login.php?banana=$em");
}

}else {
# Redirect to "../login.php"
header("Location: ../presentation/Login.php?banana=$em");
}


