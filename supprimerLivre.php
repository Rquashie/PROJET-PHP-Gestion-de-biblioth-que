<?php
session_start();

echo "<H1> Onglet de suppression </H1>";

$bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');

if(isset($_SESSION['login'])) {

    $id_livre = "";
    $titre = "";
    $annee = "";
    $resume = "";


    $sql = $bdd->prepare("SELECT * from livre ");
    $sql->execute();

    $i = 0;
    while ($ligne = $sql->fetch()) {
        $id_livre = $ligne['id_livre'];
        $titre = $ligne["titre"];
        $annee = $ligne["annee"];
        $resume = $ligne['resume'];


        //
        echo "<form action = 'supprimerLivre.php' method='POST'> ";
        echo "<table border='1'>";

        echo "<tr>";
        echo "<th> Identifiant</th>";
        echo "<th>Titre</th>";
        echo "<th>Année</th>";
        echo "<th>Résumé</th>";
        echo "<th>Opérations</th>";
        echo "</tr>";


        // Chaque ligne contient les informations d'un livre
        echo "<tr>";
        echo "<td> $id_livre </td>";
        echo "<td>$titre</td>";
        echo "<td>$annee </td>";
        echo "<td>$resume</td>";
        echo "<input type='hidden' name='id_livre' value='$id_livre'>";
        echo "<td> <button type='submit' name='boutonSupprimer' value='Supprimer'>Supprimer livre</button></td>";

        echo "</tr>";
        echo "</table>";
        echo "</form>";

    }

    if (isset($_POST['boutonSupprimer']) && isset($id_livre)) {
        $id_livre = $_POST['id_livre'];
        $sqlDelete = $bdd->prepare("DELETE FROM livre WHERE id_livre = ? ");
        $sqlDelete->execute([$id_livre]);

    }


    echo "<a href = 'pageAdmin.php'>Retour</a>";
}


    echo "<style>";
    echo "table {border-collapse: collapse; width: 80%;table-layout : fixed ;}";
    echo "th, td {border: 1px solid black; padding: 8px; text-align: left;}";
    echo "</style>";
?>
