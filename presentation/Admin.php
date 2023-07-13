<!DOCTYPE html>
<html lang="en">
    <head>
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
  <!-- bootstrap 5 CDN-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAtegoryngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<!-- bootstrap 5 Js bundle CDN-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php 
  include"../dao/Connexion.inc";
  include "../metier/f-book.php";
  $books = get_all_books($conn);
	include "../metier/f-author.php";
  $authors= get_all_authors($conn);
  include "../metier/f-category.php";
  $categories = get_all_categories($conn);
  ?> 
  <ul class="nav flex-column sticky-bottom">
  <li class="nav-item">
    <a class="nav-link disabled" tabindex="-1" aria-disabled="true">
	<img src="img/admin.png" class="admin" href="Admin.php">
				       Admin</a>
  </li>
  </li>
  <li class="nav-item">
    <a class="nav-link fw-bolder text-muted" href="add-book.php">Add Manga</a>
  </li>
  <li class="nav-item">
    <a class="nav-link fw-bolder text-muted" href="add-author.php">Add Author</a>
  </li>
  <li class="nav-item">
    <a class="nav-link fw-bolder text-muted" href="add-category.php">Add category</a>
  </li>
  <li class="nav-item">
    <a class="nav-link fw-bolder text-primary" href="index3.php">Store</a>
  </li>

</ul>
    <?php  if ($books == 0) { ?>
        	<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
		  </div>
        <?php }else {?>

        <div class="pow">
		<table class="table table-bordered ">
			<thead class="thead-dark">
				<tr>
					<th>id</th>
					<th>Title</th>
					<th>Author</th>
					<th>Description</th>
					<th>Category</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			  <?php 
			  $i = 0;
			  foreach ($books as $book) {
			    $i++;
			  ?>
			  <tr>
				<td><?=$i?></td>
				<td>
					<img width="100px"
					     src="../ups/cover/<?=$book['cover']?>" >
					<a  class="link-dark d-block
					             text-center" 
					    href="../ups/files/<?=$book['file']?>">
					   <?=$book['title']?>	
					</a>
						
				</td>
				<td>
					<?php if ($authors == 0) {
						echo "Undefined";}else{ 

					    foreach ($authors as $author) {
					    	if ($author['id'] == $book['author_id']) {
					    		echo $author['name'];
					    	}
					    }
					}
					?>

				</td>
				<td><?=$book['description']?></td>
				<td>
					<?php if ($categories == 0) {
						echo "Undefined";}else{ 

					    foreach ($categories as $category) {
					    	if ($category['id'] == $book['category_id']) {
					    		echo $category['name'];
					    	}
					    }
					}
					?>
				</td>
				<td>
					<a href="edit-book.php?id=<?=$book['id']?>" >
					<img src="img/update.png" class="up">
				       </a>

					   <a href="../metier/delete-book.php?id=<?=$book['id']?>" ><img src="img/delete.png" class="up">
				       </a>
				</td>
			  </tr>
			  <?php } ?>
			</tbody>
		</table>
	   <?php }?>
	   </div>

        <?php  if ($categories == 0) { ?>
        <div>
			  There is no category in the database
		    </div>
        <?php }else {?>
		<div class="pow">
		<h4 class="mt-5">All Categories</h4>
		<table class="table table-bordered shadow">
			<thead>
				<tr>
					<th>id</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$j = 0;
				foreach ($categories as $category ) {
				$j++;	
				?>
				<tr>
					<td><?=$j?></td>
					<td><?=$category['name']?></td>
					<td>
						<a href="edit.php?id=<?=$category['id']?>">
						<img src="img/update.png" class="up">
				       </a>

						<a href="../metier/delete-category.php?id=<?=$category['id']?>" >
						<img src="img/delete.png" class="up">
				       </a>
					</td>
				</tr>
			    <?php } ?>
			</tbody>
		</table>
	    <?php } ?>
		</div>


	    <?php  if ($authors == 0) { ?>
        	<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			  There is no author in the database
		    </div>
        <?php }else {?>
			<div class="pow">
		<h4 class="mt-5">All Authors</h4>
         <table class="table table-bordered ">
			<thead>
				<tr>
					<th>id</th>
					<th>Author Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$k = 0;
				foreach ($authors as $author ) {
				$k++;	
				?>
				<tr>
					<td><?=$k?></td>
					<td><?=$author['name']?></td>
					<td>
					<a href="edit-author.php?id=<?=$author['id']?>">
					<img src="img/update.png" class="up">
				       </a>

						<a href="../metier/delete-author.php?id=<?=$author['id']?>">
						<img src="img/delete.png" class="up">
				       </a>
					</td>
				</tr>
			    <?php } ?>
			</tbody>
		</table> 
		<?php } ?>
		</div>
		


		

		


