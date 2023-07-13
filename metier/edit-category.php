<?php  
session_start();


if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {


	include "../dao/Connexion.inc";


	if (isset($_POST['category_name']) &&
        isset($_POST['category_id'])) {

		$name = $_POST['category_name'];
		$id = $_POST['category_id'];

		if (empty($name)) {
			$em = "The category name is required";
			header("Location: ../edit-category.php?error=$em&id=$id");
            exit;
		}else {
			$sql  = "UPDATE categories 
			         SET name=?
			         WHERE id=?";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$name, $id]);

		
		     if ($res) {
		
		     	$sm = "Successfully updated!";
				header("Location: ../presentation/edit-category.php?success=$sm&id=$id");
	            exit;
		     }else{
		     
		     	$em = "Unknown Error Occurred!";
				header("Location: ../presentation/edit-category.php?error=$em&id=$id");
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