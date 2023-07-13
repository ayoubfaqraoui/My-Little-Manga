<?php
function get_all_authors($conn){
    $sql  = "SELECT * FROM authors";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
 
    if ($stmt->rowCount() > 0) {
          $authors = $stmt->fetchAll();
    }else {
       $authors = 0;
    }
 
    return $authors;
 }


function get_author($con, $id){
   $sql  = "SELECT * FROM authors WHERE id=?";
   $stmt = $con->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() > 0) {
   	  $authors = $stmt->fetch();
   }else {
      $authors = 0;
   }

   return $authors;
} 
?>