<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# If book ID is not set
	if (!isset($_GET['id'])) {
        header("Location: Admin.php");
        exit;
	}

	$id = $_GET['id'];

	include "../dao/Connexion.inc";

	# Book helper function
	include "../metier/f-book.php";
    $book = get_book($conn, $id);
    
    # If the ID is invalid
    if ($book == 0) {
    	#Redirect to admin.php page
        header("Location: Admin.php");
        exit;
    }

    # Category helper function
	include "../metier/f-category.php";
    $categories = get_all_categories($conn);

    # author helper function
	include "../metier/f-author.php";
    $authors = get_all_authors($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Book</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<nav>
		<a  href="Admin.php" class="text-secondary" >
	<img src="img/admin.png" class="admin"> 
				       Admin</a>
		</nav>

     <form action="../metier/edit-book.php"
           method="post"
           enctype="multipart/form-data" 
		   class="card text-white bg-dark mb-3 shadow p-4 rounded mt-5" style="width: 50%; max-width: 25rem;">

     	<h1 class="text-center pb-5 display-4 fs-3">
     		Edit Book
     	</h1>
     	<?php if (isset($_GET['banana'])) { ?>
          <div class="alert " role="alert">
			  <?=htmlspecialchars($_GET['banana']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>
     	<div class="mb-3">
		    <label class="form-label">
		           manga Title
		          
		    <input type="text" 
			       class="form-control"
			       hidden
		           value="<?=$book['id']?>" 
		           name="book_id">

		    <input type="text" 
		           class="form-control"
		           value="<?=$book['title']?>" 
		           name="book_title">
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Description
		           </label>
		    <input type="text" 
		           class="form-control" 
		           value="<?=$book['description']?>"
		           name="book_description">
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Author
		           </label>
		    <select name="book_author"
		            class="form-control">
		    	    <option value="0">
		    	    	Select author
		    	    </option>
		    	    <?php 
                    if ($authors == 0) {
                    }else{
		    	    foreach ($authors as $author) { 
		    	    	if ($book['author_id'] == $author['id']) { ?>
		    	    	<option 
		    	    	  selected
		    	    	  value="<?=$author['id']?>">
		    	    	  <?=$author['name']?>
		    	        </option>
		    	        <?php }else{ ?>
						<option 
							value="<?=$author['id']?>">
							<?=$author['name']?>
						</option>
		    	   <?php }} } ?>
		    </select>
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Category
		           </label>
		    <select name="book_category"
		            class="form-control">
		    	    <option value="0">
		    	    	Select category
		    	    </option>
		    	    <?php 
                    if ($categories == 0) {
                    }else{
		    	    foreach ($categories as $category) { 
		    	    	if ($book['category_id'] == $category['id']) { ?>
		    	    	<option 
		    	    	  selected
		    	    	  value="<?=$category['id']?>">
		    	    	  <?=$category['name']?>
		    	        </option>
		    	        <?php }else{ ?>
						<option 
							value="<?=$category['id']?>">
							<?=$category['name']?>
						</option>
		    	   <?php }} } ?>
		    </select>
		</div>
		<div class="mb-3">
		    <label class="form-label">
		           Book Cover
		           </label>
		    <input type="file" 
		           class="form-control" 
		           name="book_cover">

		     <input type="text" 
		           hidden
		           value="<?=$book['cover']?>" 
		           name="current_cover">

		    <a href="../ups/cover/<?=$book['cover']?>"
		       class="link-dark">Current Cover</a>
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           File
		           </label>
		    <input type="file" 
		           class="form-control" 
		           name="file">

		     <input type="text" 
		           hidden
		           value="<?=$book['file']?>" 
		           name="current_file">

		    <a href="../ups/files/<?=$book['file']?>"
		       class="link-dark">Current File</a>
		</div>

	    <button type="submit" 
	            class="btn btn-secondary">
	            Update</button>
     </form>
	</div>
</body>
</html>

<?php }else{
  header("Location: Login.php");
  exit;
} ?>