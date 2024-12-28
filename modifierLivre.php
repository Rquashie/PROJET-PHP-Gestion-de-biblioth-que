<?php
session_start() ;
if(isset($_SESSION["login"])) {


    $dsn = 'mysql:host=localhost;port=3306;dbname=rqe_librairie;charset=utf8';
    $bdd = new PDO($dsn, 'root', '');
    $id_livre = "";
    $titre = "";
    $annee = "";
    $resume = "";

    if (isset($_POST["id_livre"])) {
        $id_livre = $_POST['id_livre'];
    }
    $id [] = $id_livre;

    $sqlSelect = $bdd->prepare("SELECT * from livre where id_livre = ?");
    $sqlSelect->execute($id);
    $ligne = $sqlSelect->fetch();

    $titre = empty($_POST["titreBIS"]) ? $titre = $ligne['titre'] : $_POST["titreBIS"];
    $annee = empty($_POST["anneeBIS"]) ? $annee = $ligne['annee'] : $_POST["anneeBIS"];
    $resume = empty($_POST["resumeBIS"]) ? $resume = $ligne['resume'] : $_POST['resumeBIS'];


    $colonne = [$titre, $annee, $resume, $id_livre];
    if (!empty($id_livre)) {
        $sql = $bdd->prepare("UPDATE livre SET titre = ? , annee = ? , resume = ? 
                  WHERE id_livre = ?");
        $sql->execute($colonne);
        if ($sql) {
            echo "<p>Modifications effectuées avec succès !</p>";
        }
        //Rester sur la page
        echo "<a href = 'modifierLivre.html' />Retour vers l'onglet modification</a> ";
    }
}


?>

