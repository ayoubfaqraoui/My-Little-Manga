<?php  
session_start();

if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Category</title>

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
		<h1 >
     		Add New Category
     	</h1>
     <form action="../metier/add-category.php"
           method="post" 
		   class="card text-white bg-dark mb-3 shadow p-4 rounded mt-5" style="width: 50%; max-width: 25rem;">

     	<?php if (isset($_GET['banana'])) { ?>
          <div class="alert" role="alert">
			  <?=htmlspecialchars($_GET['banana']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>
     	<div class="mb-3">
		    <label class="form-label">
		           	Category Name
		           </label>
		    <input type="text" 
		           class="form-control" 
		           name="category_name">
		</div>

	    <button type="submit" 
		class="btn btn-secondary">
	            Add Category</button>
     </form>
	</div>
</body>
</html>

<?php }else{
  header("Location: Login.php");
  exit;
} ?>