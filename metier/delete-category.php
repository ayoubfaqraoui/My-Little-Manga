<?php  
session_start();

if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	include "../dao/Connexion.inc";

        $id = $_GET['id'];

		if (empty($id)) {
			$em = "Error Occurred!";
			header("Location: presentation/Admin.php?banana=$em");
            exit;
		}else {
    
			$sql  = "DELETE FROM categories
			         WHERE id=?";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$id]);


		     if ($res) {
		    
		     	$sm = "Successfully deleted!";
				header("Location: ../presentation/Admin.php?success=$sm&id=$id");
	            exit;
		     }else{
	
		     	$em = "Unknown Error Occurred!";
				header("Location: ../presentation/Admin.php?banana=$em&id=$id");
	            exit;
		     }
		}
	}else {
      header("Location: ../presentation/Admin.php");
      exit;
	}
