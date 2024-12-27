<?php
session_start();

if(isset($_SESSION["login"])) {
    $bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');
    echo "<h1>Liste des auteurs</h1>";
    $recherche = "";

    echo "<table>";

    echo "<form method='POST' action='listeAuteur.php'>";
    echo "<tr>";
    echo "<td><input type='search' name='recherche' placeholder='Recherche un auteur...' /></td>";
    echo "<td><input type='submit' value='Valider' /></td>";
    echo "<td><input type='reset' value='Annuler' /></td>";
    echo "</tr>";
    echo "</form>";
    echo "</table>";


    $sqlAuteur = $bdd->query('SELECT concat(prenom+nom) FROM auteur ORDER BY id_auteur DESC');
    if (isset($_POST['recherche'])) {
        $recherche = htmlspecialchars($_POST['recherche']);

        $sqlAuteur = $bdd->query('SELECT * FROM auteur WHERE nom LIKE "%' . $recherche . '%" 
                  or prenom like "%' . $recherche . '%" ORDER BY id_auteur DESC');
        $sqlAuteur->execute();
        while ($ligne = $sqlAuteur->fetch()) {
            echo "<ul>";
            echo "<li>" . $ligne['prenom'] . " " . $ligne['nom'] . "</li>";
            echo "</ul>";
        }
    }

    echo "<a href = 'pageAdmin.php'>Retour au menu principal</a>";
}
?>