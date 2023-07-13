<?php  
session_start();


if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {


	include "../dao/Connexion.inc";


	if (isset($_POST['author_name']) &&
        isset($_POST['author_id'])) {

		$name = $_POST['author_name'];
		$id = $_POST['author_id'];

		if (empty($name)) {
			$em = "The author name is required";
			header("Location: ../presentation/edit-author.php?banana=$em&id=$id");
            exit;
		}else {

			$sql  = "UPDATE authors 
			         SET name=?
			         WHERE id=?";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$name, $id]);

		     if ($res) {
		    
		     	$sm = "Successfully updated!";
				header("Location: ../presentation/edit-author.php?success=$sm&id=$id");
	            exit;
		     }else{
		
		     	$em = "Unknown Error Occurred!";
				header("Location: ../presentation/edit-author.php?banana=$em&id=$id");
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