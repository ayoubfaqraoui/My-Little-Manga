<?php  
session_start();

if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
	include "../dao/Connexion.inc";


	if (isset($_POST['author_name'])) {

		$name = $_POST['author_name'];

		if (empty($name)) {
			$em = "The author name is required";
			header("Location: ../presentation/add-author.php?banana=$em");
            exit;
		}else {

			$sql  = "INSERT INTO authors (name)
			         VALUES (?)";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$name]);

		     if ($res) {
		
		     	$sm = "Successfully created!";
				header("Location: ../presentation/add-author.php?success=$sm");
	            exit;
		     }else{
		     	$em = "Unknown Error Occurred!";
                 header("Location: ../presentation/add-author.php?success=$em");
	            exit;
		     }
		}
	}else {
      header("Location: ../presentation/Admin.php");
      exit;
	}

}else{
  header("Location: ../presentation/Login.php");
  exit;
}