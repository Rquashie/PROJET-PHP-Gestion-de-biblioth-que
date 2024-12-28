<?php
session_start();

if(isset($_SESSION["login"])) {

    $titre= isset($_POST['titre']) ? $_POST['titre'] : '';
    $annee = isset($_POST['annee']) ? $_POST['annee'] : '';
    $resume = isset($_POST["resume"]) ? $_POST["resume"] : '';
    $bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');
    $sql = "INSERT  into livre (titre , annee ,resume) values(?,?,?)";
    $req = $bdd->prepare($sql);
    $req->execute([$titre,$annee,$resume,]) ;

    if($req) {
        echo "<p> Les informations du livre ont bien été enregistrées </p>";
        //Rester sur la page
        header("location:formAjouterLivre.html");
    }
    else {
        echo "<p> Erreur d'enregistrement du livre </p>";
    }

}

?>

