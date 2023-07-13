 <?php

// préparation des informations nécessaires 

define("DSN","mysql:host=localhost;dbname=booky"); 
define("USER","root");
define("MDP","youb2002");

 // création d'un objet PDO et connexion 
try {
$conn=new PDO(DSN,USER,MDP);

} catch (Exception $erreur) {
echo "Erreur : "; 
exit();
}
?> 