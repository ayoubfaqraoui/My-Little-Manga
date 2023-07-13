<?php  
session_start();

if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

    include "../dao/Connexion.inc";


	if (isset($_POST['category_name'])) {

		$name = $_POST['category_name'];

		if (empty($name)) {
			$em = "The category name is required";
			header("Location: ../presentation/add-category.php?banana=$em");
            exit;
		}else {
			$sql  = "INSERT INTO categories (name)
			         VALUES (\"$name\")";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$name]);
		     if ($res) {
		     	$sm = "Successfully created!";
				header("Location: ../presentation/add-category.php?success=$sm");
	            exit;
		     }else{
		     	$em = "Unknown Error Occurred!";
                 header("Location: ../presentation/add-category.php?success=$em");
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