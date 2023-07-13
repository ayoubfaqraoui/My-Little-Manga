<?php 
if (!isset($_GET['key']) || empty($_GET['key'])) {
	header("Location: index.php");
	exit;
}
$key = $_GET['key'];
session_start();

include "../dao/Connexion.inc";

include "../metier/f-book.php";
$books = search_books($conn, $key);

include "../metier/f-author.php";
$authors = get_all_authors($conn);

include "../metier/f-category.php";
  $categories = get_all_categories($conn);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My little Manga</title>
  <link rel="shortcut icon" type="image" href="img/lo.png">
  <link rel="stylesheet" href="../css/style.css">

 <!-- bootstrap 5 CDN-->
 <link href="https://cdn.jsdelivr.net/npm/bootstr ap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<!-- bootstrap 5 Js bundle CDN-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
        <link rel=”stylesheet” href=”https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css” />
     <link rel="stylesheet" href="css/all.min.css"> 
    <link rel="stylesheet" href="css/man.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
      
    <nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="#">
      <a href="Index.php">
      <img src="img/My little Manga.png" class="logo" href="Index.php"></a> 
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main" aria-controls="main" aria-expanded="false" aria-label="Toggle navigation">
	<i class="fa-solid fa-bars"></i>

    </button>
    <div class="collapse navbar-collapse" id="main">
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active p-2 p-lg-3" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link p-2 p-lg-3" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  p-2 p-lg-3" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  p-2 p-lg-3" href="Login.php">login</a>
        </li>

    </div>
  </div>

</nav>


Search result for <b><?=$key?></b>

<div class="d-flex pt-3">
    <?php if ($books == 0){ ?>
        <div class="alert alert-warning 
                text-center p-5 pdf-list" 
         role="alert">
         <img src="img/empty-search.png" 
              width="100">
         <br>
          The key <b>"<?=$key?>"</b> didn't match to any record
           in the database
      </div>
    <?php }else{ ?>
      <?php foreach ($books as $book) { ?>
        <div class="card">
     <img src="../ups/cover/<?=$book['cover']?>">
     <a href="details.php?id=<?=$book['id']?>"><button>view</button></a>
<div class="info">
    <h3><?=$book['title']?></h3>
</div>
<strong class="category">
    <?php foreach($authors as $author){ 
					if ($author['id'] == $book['author_id'])
                        {
                         echo $author['name'];			
                        break;
					            	}		
                        ?>
                      <?php } ?>
                    </strong>                          
                               
</div>
<?php } ?> 
<?php } ?> 
</div>
</body>
</html>