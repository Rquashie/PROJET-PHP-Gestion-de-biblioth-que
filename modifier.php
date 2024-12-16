<?php
var_dump($_POST);
session_start() ;


$dsn = 'mysql:host=localhost;port=3306;dbname=rqe_librairie;charset=utf8';
$bdd = new PDO($dsn, 'root', '');



$membre = $_POST['id_membre'] ;
$id [] = $membre ;

$sqlSelect =$bdd -> prepare( "SELECT * from inscrit where id_inscrit = ?");
$sqlSelect -> execute($id);
$ligne = $sqlSelect -> fetch();

$nom = empty($_POST['nomBIS']) ? $nom = $ligne['nom']  : $_POST['nomBIS'] ;


$prenom = empty($_POST['prenomBIS']) ? $prenom = $ligne['prenom']  : $_POST['prenomBIS'] ;

$email = empty($_POST['emailBIS']) ? $email = $ligne['email'] : $_POST['emailBIS'] ;

$tel_fixe = empty($_POST['telFixeBIS']) ? $tel_fixe = $ligne['tel_fixe'] : $_POST['telFixeBIS'] ;

$tel_portable = empty($_POST['telPortableBIS']) ? $tel_portable = $ligne['tel_portable'] : $_POST['telPortableBIS'] ;

$rue = empty($_POST['rueBIS']) ? $rue = $ligne['rue'] : $_POST['rueBIS'] ;

$cp = empty($_POST['cpBIS']) ? $cp = $ligne['cp'] : $_POST['cpBIS'] ;

$ville  = empty($_POST['villeBIS']) ? $ville = $ligne['ville'] : $_POST['villeBIS'] ;



$colonne = [ $nom , $prenom , $email , $tel_fixe , $tel_portable , $rue , $cp , $ville,$membre ,];
if(!empty($membre)){
    $sql = $bdd -> prepare("UPDATE inscrit SET nom = ? , prenom = ? , email = ? , tel_fixe = ? , tel_portable = ? ,
                   rue = ? , cp = ? , ville = ?  WHERE id_inscrit = ?");
    $sql -> execute($colonne);

}


?>

