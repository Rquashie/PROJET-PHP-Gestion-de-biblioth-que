<?php

session_start();

if(isset($_SESSION['login'])) {

    echo "<H1> Associer un livre à un auteur </H1>";

    $bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');
    $id_auteur = "";
    $id_livre = "";
    if(isset($_POST['id_livre']) && isset ($_POST['id_auteur'])) {
        $id_auteur = $_POST['id_auteur'];
        $id_livre = $_POST['id_livre'];
        $sqlInsert = $bdd->prepare("INSERT INTO ecrire (ref_livre, ref_auteur) VALUES (?, ?)");
        $sqlInsert->execute([$id_livre, $id_auteur]);

        $sqlVerif = $bdd->prepare("SELECT * FROM ecrire WHERE ref_livre = ? AND ref_auteur = ? ");
        $sqlVerif->execute([$id_livre, $id_auteur]);
        if ($sqlVerif->rowCount() == 1) {
            echo "<p>Enregistrement réussi !</p>";
            echo "<a href = 'livreAuteur.html' >Retour vers l'onglet </a> ";
        } else {
            echo "<p>Une erreur s'est produite lors de l'ajout. Veuillez réessayer</p>";
            echo "<a href = 'livreAuteur.html' >Retour vers l'onglet </a> ";
        }
    }
}
?>