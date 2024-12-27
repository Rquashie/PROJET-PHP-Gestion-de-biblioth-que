<?php
var_dump($_POST);
session_start() ;
if(isset($_SESSION["login"])) {


    $dsn = 'mysql:host=localhost;port=3306;dbname=rqe_librairie;charset=utf8';
    $bdd = new PDO($dsn, 'root', '');
    $id_auteur = "" ;
    $nom_auteur = "" ;
    $prenom_auteur = "" ;
    $date_naissance = "" ;

    if(isset($_POST["id_auteur"]) ) {
        $id_auteur = $_POST['id_auteur'];
    }
    $id [] = $id_auteur;

    $sqlSelect = $bdd->prepare("SELECT * from auteur where id_auteur = ?");
    $sqlSelect->execute($id);
    $ligne = $sqlSelect->fetch();

    $nomAuteur = empty($_POST["nomAuteurBIS"]) ? $nomAuteur = $ligne['nom'] : $_POST["nomAuteurBIS"];
    $prenomAuteur = empty($_POST["prenomAuteurBIS"]) ? $prenomAuteur = $ligne['prenom'] : $_POST["prenomAuteurBIS"];
    $date_naissance = empty($_POST["date_naissanceAuteur"]) ? $date_naissance = $ligne['date_naissance'] : $_POST['date_naissanceAuteur'];



            $colonne = [$nomAuteur, $prenomAuteur, $date_naissance, $id_auteur];
            if (!empty($auteur)) {
                $sql = $bdd->prepare("UPDATE auteur SET nom = ? , prenom = ? , date_naissance = ? 
                  WHERE id_auteur = ?");
                $sql->execute($colonne);
            }
    //Rester sur la page
    header("location:modifierAuteur.php");
    exit;
        }


?>

