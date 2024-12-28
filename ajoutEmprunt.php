<?php
session_start();

if(isset($_SESSION["login"])) {
    $bdd = new PDO('mysql:host=localhost;port = 3306 ;dbname=rqe_librairie;charset=utf8', 'root', '');

    $date = $_POST["date_emprunt"];
    $delais = $_POST["delai"];
    $ref_exemplaire = $_POST["ref_exemplaire"];
    $ref_inscrit = $_POST["ref_inscrit"];
    $sqlAdminOuUser = $bdd->prepare("SELECT * from inscrit where id_inscrit  = ? ");
    $sqlAdminOuUser->execute([$ref_inscrit]);
    $ligne = $sqlAdminOuUser->fetch();
    if ($ligne && $ligne['fonction'] == 'user') {
        $sqlInsertEmprunt = $bdd->prepare(
            "INSERT INTO emprunt (date,delais,ref_exemplaire,ref_inscrit )
                   VALUES(? , ? , ? , ?) ");
        $sqlInsertEmprunt->execute([$date, $delais, $ref_exemplaire, $ref_inscrit]);
        $sqlVerif = $bdd->prepare("SELECT * FROM emprunt WHERE date = ? AND delais = ? and ref_exemplaire = ?
                                     AND ref_inscrit = ?");
        $sqlVerif->execute([$date, $delais,$ref_exemplaire, $ref_inscrit]);
        if ($sqlVerif->rowCount() == 1) {
            echo "<p>Enregistrement effectué avec succes</p>";
            echo "<a href = 'ajouterEmprunt.html' >Retour vers l'onglet </a> ";
        } else {
            echo "<p>Une erreur s'est produite lors de l'ajout. Veuillez réessayer</p>";
            echo "<a href = 'ajouterEmprunt.html' >Retour vers l'onglet </a> ";
        }
    }
    else {
        echo "<p>Seuls les utilisateurs peuvent emprunter</p>";
        echo "<a href = 'ajouterEmprunt.html' >Retour vers l'onglet </a> ";
    }
}

