<?php
var_dump($_POST);
session_start() ;


$dsn = 'mysql:host=localhost;port=3307;dbname=rqe_librairie;charset=utf8';
$bdd = new pdo($dsn, 'root', '');


$membre = $_POST['id_membre'];
$nom = $_POST['nom'];
$prenom = $_POST['prenomBIS'];
$email = $_POST['mailBIS'];
$telFixe = $_POST['telFixeBIS'];
$telPortable = $_POST['telPortableBIS'];
$rue = $_POST['rueBIS'];
$cp = $_POST['cpBIS'];
$ville = $_POST['villeBIS'];

$champs  = [$membre , $prenom , $email , $telFixe, $telPortable , $rue , $cp , $ville];

        // Affiche les valeurs de l'id_inscrit

    $sqlInscrit = "SELECT * from inscrit where id_inscrit= :$membre";

      // Les champs remplis
     foreach($champs as $champ){
      if(isset($champ )){
         $sql = "UPDATE 
      }


}



echo "<a href ='pageUtilisateur.php'>Retour vers la page d'Utilisateur'</a> ";



