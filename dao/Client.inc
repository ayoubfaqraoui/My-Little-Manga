 <?php 
 require_once("Connexion.inc") ;
 function login($email,$password)
  {
    global $conn;
    echo"hello 1";
    $sql = "INSERT INTO client(email, password) VALUES (\"$email\",\"$password\")";
    
    $conn->exec($sql);
  
    }
 
    ?>