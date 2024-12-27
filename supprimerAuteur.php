<?php
session_start();

echo "<H1> Onglet de suppression </H1>";

$bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');

if(isset($_SESSION['login'])) {

    $id_auteur = "";
    $nom = "";
    $prenom = "";
    $date_naissance = "";
    $nationalite = "";


    $sql = $bdd->prepare("SELECT * from auteur ");
    $sql->execute();


    $i = 0;
    while ($ligne = $sql->fetch()) {
        $i++;
        $ref_pays = $ligne['ref_pays'];
        $var = [$ref_pays];

        $id_auteur = $ligne['id_auteur'];
        $nom = $ligne["nom"];
        $prenom = $ligne["prenom"];
        $date_naissance = $ligne['date_naissance'];
        $sqlNationalite = $bdd->prepare("SELECT p.nom FROM pays p inner join auteur a 
                                       on p.id_pays = a.ref_pays where a.ref_pays = ?");
        $sqlNationalite->execute($var);
        $data = $sqlNationalite->fetchAll();
        $nationalite = $data[0]["nom"];

        //
        echo "<form action = 'supprimerAuteur.php' method='POST'> ";
        echo "<table border='1'>";

        echo "<tr>";
        echo "<th> Identifiant</th>";
        echo "<th>Nom</th>";
        echo "<th>prenom</th>";
        echo "<th>Date de naissance</th>";
        echo "<th>Nationalité</th>";
        echo "<th>Opérations</th>";
        echo "</tr>";


        // Chaque ligne contient les informations d'un livre
        echo "<tr>";
        echo "<td> $id_auteur </td>";
        echo "<td>$nom</td>";
        echo "<td>$prenom</td>";
        echo "<td>$date_naissance</td>";
        echo "<td>$nationalite</td>";
        echo "<input type='hidden' name='id_auteur' value='$id_auteur'>";
        echo "<td> <button type='submit' name='boutonSupprimer' value='Supprimer'>Supprimer</button></td>";

        echo "</tr>";
        echo "</table>";
        echo "</form>";

    }

    if (isset($_POST['boutonSupprimer']) && isset($id_auteur)) {
        $id_auteur = $_POST['id_auteur'];
        $sqlDelete = $bdd->prepare("DELETE FROM auteur WHERE id_auteur = $id_auteur ");
        $sqlDelete->execute();

        //Rester sur la page
        header("location:supprimerAuteur.php");
        exit;
    }


    echo "<a href = 'pageAdmin.php'>Retour</a>";

    echo "<style>";
    echo "table {border-collapse: collapse; width: 80%;table-layout : fixed ;}";
    echo "th, td {border: 1px solid black; padding: 8px; text-align: left;}";
    echo "</style>";
}
?>