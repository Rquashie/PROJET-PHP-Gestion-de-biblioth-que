<?php

var_dump($_POST);
session_start();
if (isset($_SESSION["login"])) {


    $dsn = 'mysql:host=localhost;port=3306;dbname=rqe_librairie;charset=utf8';
    $bdd = new PDO($dsn, 'root', '');
    $id_emprunt = "";
    $date_emprunt = "";
    $delai = "";
    $ref_exemplaire = "";
    $ref_inscrit = "";

    if (isset($_POST["id_emprunt"])) {
        $id_emprunt = $_POST['id_emprunt'];
    }
    $id [] = $id_emprunt;

    $sqlSelect = $bdd->prepare("SELECT * from emprunt where id_emprunt = ?");
    $sqlSelect->execute($id);
    $ligne = $sqlSelect->fetch();

    $date_emprunt = empty($_POST["date_empruntBIS"]) ? $date_emprunt = $ligne['date'] : $_POST["date_empruntBIS"];
    $delai = empty($_POST["delaiBIS"]) ? $delai = $ligne['delais'] : $_POST["delaiBIS"];
    $ref_exemplaire = empty($_POST["ref_exemplaireBIS"]) ? $ref_exemplaire = $ligne['ref_exemplaire'] : $_POST['ref_exemplaireBIS'];
    $ref_inscrit = empty($_POST["ref_inscritBIS"]) ? $ref_inscrit = $ligne['ref_inscrit'] : $_POST['ref_inscritBIS'];


    $colonne = [$date_emprunt, $delai, $ref_exemplaire, $ref_inscrit,$id_emprunt];
    if (!empty($id_emprunt)) {
        $sql = $bdd->prepare("UPDATE emprunt SET
                   date = ? , delais = ? , ref_exemplaire = ? , ref_inscrit = ? WHERE id_emprunt = ?");

        $sql->execute($colonne);
        if ($sql) {
            echo "<p>Modifications effectuées avec succès !</p>";
        }
        //Rester sur la page
        echo "<a href = 'modifierEmprunt.html' />Retour vers l'onglet modification</a> ";
    }
    }






