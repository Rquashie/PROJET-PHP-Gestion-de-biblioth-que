<?php
session_start();

echo "<H1> Onglet de suppression </H1>";

$bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');

if(isset($_SESSION['login'])) {

    $id_emprunt = "";
    $date_emprunt = "";
    $delai = "";
    $inscritEmprunt = "";
    $ref_exemplaire = "";
    $id_inscrit = "";

    $sql = $bdd->prepare("SELECT * from emprunt ");
    $sql->execute();


    $i = 0;
    while ($ligne = $sql->fetch()) {
        $i++;
        $ref_inscrit = $ligne['ref_inscrit'];
        $var = [$ref_inscrit];

        $id_emprunt = $ligne['id_emprunt'];
        $date_emprunt = $ligne["date"];
        $delai = $ligne["delais"];
        $ref_exemplaire = $ligne['ref_exemplaire'];
        $sqlInscritEmprunt = $bdd->prepare("SELECT id_inscrit, CONCAT(prenom,' ',nom) as 'nom' FROM inscrit i 
        inner join emprunt e  
        on i.id_inscrit = e.ref_inscrit where i.id_inscrit = ?");

        $sqlInscritEmprunt->execute($var);
        $ligne = $sqlInscritEmprunt->fetchAll();

        $inscritEmprunt = $ligne[0]["nom"];

        //
        echo "<form action = 'supprimerEmprunt.php' method='POST'> ";
        echo "<table border='1'>";

        echo "<tr>";
        echo "<th> Numéro de l'emprunt</th>";
        echo "<th>Date de l'emprunt</th>";
        echo "<th>Delai</th>";
        echo "<th>Numéro d'exemplaire </th>";
        echo "<th>Identifiant de l'inscrit</th>";
        echo "<th>Nom de l'inscrit</th>";
        echo "<th>Opérations</th>";
        echo "</tr>";


        // Chaque ligne contient les informations d'un emprunt
        echo "<tr>";
        echo "<td> $id_emprunt </td>";
        echo "<td>$date_emprunt</td>";
        echo "<td>$delai</td>";
        echo "<td>$ref_exemplaire</td>";
        echo "<td>$ref_inscrit</td>";
        echo "<td>$inscritEmprunt</td>";
        echo "<input type='hidden' name='id_emprunt' value='$id_emprunt'>";
        echo "<td> <button type='submit' name='boutonSupprimer' value='Supprimer'>Supprimer</button></td>";

        echo "</tr>";
        echo "</table>";
        echo "</form>";

    }

    if (isset($_POST['boutonSupprimer']) && isset($id_emprunt)) {
        $id_emprunt = $_POST['id_emprunt'];
        $sqlDelete = $bdd->prepare("DELETE FROM emprunt WHERE id_emprunt = ? ");
        $sqlDelete->execute([$id_emprunt]);
        //Rester sur la page
        echo "L'emprunt a été supprimé du système 🗑️ ";
        echo "<a href = 'supprimerEmprunt.php'> Retour </a>";
    }
    echo "<a href = 'pageAdmin.php'> Retour </a>";
}
    echo "<style>";
    echo "table {border-collapse: collapse; width: 80%;table-layout : fixed ;}";
    echo "th, td {border: 1px solid black; padding: 8px; text-align: left;}";
    echo "</style>";

?>