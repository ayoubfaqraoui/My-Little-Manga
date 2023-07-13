<?php  
session_start();

if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
	include "../dao/Connexion.inc";
    include "func-validation.php";
	include "f-upload.php";

	if (isset($_POST['book_title'])       &&
        isset($_POST['book_description']) &&
        isset($_POST['book_author'])      &&
        isset($_POST['book_category'])    &&
        isset($_FILES['book_cover'])      &&
        isset($_FILES['file'])) {
		
		$title       = $_POST['book_title'];
		$description = $_POST['book_description'];
		$author      = $_POST['book_author'];
		$category    = $_POST['book_category'];

		$user_input = 'title='.$title.'&category_id='.$category.'&desc='.$description.'&author_id='.$author;
		
        $text = "Book title";
        $location = "../presentation/add-book.php";
        $ms = "banana";
		is_empty($title, $text, $location, $ms, $user_input);

		$text = "Book description";
        $location = "../presentation/add-book.php";
        $ms = "banana";
		is_empty($description, $text, $location, $ms, $user_input);

		$text = "Book author";
        $location = "../presentation/add-book.php";
        $ms = "banana";
		is_empty($author, $text, $location, $ms, $user_input);

		$text = "Book category";
        $location = "../presentation/add-book.php";
        $ms = "banana";
		is_empty($category, $text, $location, $ms, $user_input);

	   $allowed_image_exs = array("jpg", "jpeg", "png");
	   $path = "cover";
	   $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

	   if ($book_cover['status'] == "banana") {
		   $em = $book_cover['data'];

		   header("Location: ../presentation/add-book.php?banana=$em&$user_input");
		   exit;
	   }else {
		   $allowed_file_exs = array("pdf", "docx", "pptx");
		   $path = "files";
		   $file = upload_file($_FILES['file'], $allowed_file_exs, $path);

		   if ($file['status'] == "banana") {
			   $em = $file['data'];

			   header("Location: ../presentation/add-book.php?banana=$em&$user_input");
			   exit;
		   } 

		   else {
		
			$file_URL = $file['data'];
			$book_cover_URL = $book_cover['data'];

			$sql  = "INSERT INTO books (title,
										author_id,
										description,
										category_id,
										cover,
										file)
					 VALUES (?,?,?,?,?,?)";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$title, $author, $description, $category, $book_cover_URL,$file_URL]);

		 if ($res) {
			 $sm = "The Manga successfully created!";
			header("Location: ../presentation/add-book.php?success=$sm");
			exit;
		 }else{
			 $em = "Unknown Error Occurred!";
			header("Location: ../presentation/add-book.php?error=$em");
			exit;
		 }

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
	