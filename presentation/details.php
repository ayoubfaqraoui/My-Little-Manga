<?php 
$id = $_GET['id'];

include "../dao/Connexion.inc";

include "../metier/f-book.php";
$book = get_book($conn, $id);


include "../metier/f-category.php";
$categories = get_all_categories($conn);

include "../metier/f-author.php";
$authors = get_all_authors($conn);

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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="body">
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
<body>

<div class="main">
  <div> 
    <img src="../ups/cover/<?=$book['cover']?> " width="200px" > 
    <span class="s">
  <a href="../ups/files/<?=$book['file']?>" class="btn btn2">Open</a>
<a href="../ups/files/<?=$book['file']?>" class="btn btn1" download="<?=$book['title']?>">Download</a>
<img src="img/play.png" class="music" id="icon">
<audio id="mysong">
<source src="media/song.mp3" type="audio/mp3">
</audio>
</span>
</div>
  <div class="detail">
  <div><p class="card-text"><br><i><b>Manga title :<?=$book['title']?></p></div>
  <div><p class="card-text"><br><i><b>Author:<?php
   foreach($authors as $author){ 
	if ($author['id'] == $book['author_id']) {
										echo $author['name'];
										break;
									}
                }
								?>
  </div>
  <div><br><i><b>Category:
								<?php foreach($categories as $category){ 
									if ($category['id'] == $book['category_id']) {
										echo $category['name'];
										break;
									}
								?>

								<?php } ?>
    </div>
    <div class="story">
    <br><i><b>Story:
    <?=$book['description']?>
    </div>
  </div>
</div>
<script>
  var mysong = document.getElementById("mysong")
  var icon = document.getElementById("icon")
  icon.onclick = function()
  {
    if(mysong.paused){
      mysong.play(); 
      icon.src= "img/pause.png"
    }else{
      mysong.pause();
      icon.src= "img/play.png"
    }

  }


</script>