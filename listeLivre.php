<?php

session_start();
class Livres{
    public function triLivres($colonne, $ordre)
    {
        global $bdd;
        $sqlLivreAuteur = $bdd->prepare("select titre as 'Titre du livre', annee as 'Année de parution',
            concat(a.nom,' ', a.prenom) as 'Auteur' , resume as 'Résumé'
            from ecrire e
            inner JOIN auteur a on a.id_auteur = e.ref_auteur
            inner join livre l on e.ref_livre = l.id_livre
            order by $colonne $ordre
            ");
        $sqlLivreAuteur->execute();
        while ($ligne = $sqlLivreAuteur->fetch()) {
            $titre = $ligne[0];
            $annee = $ligne[1];
            $auteur = $ligne[2];
            $resume = $ligne[3];

            // Chaque ligne contient les informations d'un livre
            echo "<tr>";
            echo "<td>$titre </td>";
            echo "<td>$annee</td>";
            echo "<td>$auteur </td>";
            echo "<td>$resume</td>";
            echo "</tr>";
        }
    }
}
//---------------------------PROGRAMME PRINCIPAL------------------------------
$livres = new Livres() ;



if(isset($_SESSION["login"])) {
    $bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');
    echo "<h2>Liste des livres </h2>";
    $recherche = "";

    echo "<div class ='contenu'>";

    echo "<div class='recherche'>";
    echo "<form method='POST' action='listeLivre.php'>";
    echo "<input type='search' name='recherche' placeholder='Recherche un livre...' />";
    echo "<input type='submit' value='Valider' />";
    echo "<input type='reset' value='Annuler' />";
    echo "</form>";


    $sqlAuteur = $bdd->query('SELECT concat(titre) FROM livre ORDER BY id_livre DESC');
    if (isset($_POST['recherche'])) {
        $recherche = htmlspecialchars($_POST['recherche']);

        $sqlLivre = $bdd->query('SELECT * FROM livre WHERE titre LIKE "%' . $recherche . '%" 
                 ORDER BY id_livre DESC');
        $sqlLivre->execute();
        while ($ligne = $sqlLivre->fetch()) {
            echo "<ul>";
            echo "<li>" . $ligne['titre'] . "</li>";
            echo "</ul>";
        }
    }
    echo "</div>";
    //------------------------Ferme le div recherche--------------------

    echo "<div class='livre'>";
    echo "<form action='listeLivre.php' method='POST'>";
    echo "<select name='filtre-livre'>";
    echo "<option value='affiche-tout' selected='selected'>Afficher tout</option>";
    echo "<option value='Trie-par-titre-asc'>Titre ordre croissant A-Z </option>";
    echo "<option value='Trie-par-titre-desc'>Titre ordre decroissant Z-A</option>";
    echo "<option value='Trie-par-annee-asc'>Année de parution par ordre croissant</option>";
    echo "<option value='Trie-par-annee-desc'>Année de parution par ordre decroissant</option>";
    echo "</select>";
    echo "<input name='Valider' type='submit' value='filtre'/>";
    echo "</form>";

    //Colonnes
    echo "<form action = 'listeLivre.php' method='POST'> ";
    echo "<table border='4'>";
    echo "<th>Titre </th>";
    echo "<th>Année parution</th>";
    echo "<th>Auteur</th>";
    echo "<th>Résumé</th>";
    echo "<tr>";


    $filtreLivre = "";
    if (!empty($_POST['filtre-livre'])) {
        $filtreLivre = $_POST['filtre-livre'];
        if ($filtreLivre == "Trie-par-titre-asc") {
            $livres->triLivres('titre', 'ASC');
        }
        if ($filtreLivre == "Trie-par-titre-desc") {
            $livres->triLivres('titre', 'DESC');
        }
        if ($filtreLivre == "Trie-par-annee-asc") {
            $livres->triLivres('annee', 'ASC');
        }
        if ($filtreLivre == "Trie-par-annee-desc") {
            $livres->triLivres('annee', 'DESC');
        }
    } else {
        $livres->triLivres('id_auteur', 'ASC');
    }


    echo "</table>";
    echo "</form>";
    echo "</div>";
    echo "<br>";
    echo "<br>";


    echo "<a href = 'pageAdmin.php'>Retour au menu principal</a>";
    echo "</div>";


    echo "<style>";

    echo "body{background-color: #f2f2f2 ;}";
    echo".auteur{background-color:light red;}";
    echo".recherche td{padding:20px;}";
    echo ".bas-page{display:fle}";
    echo "table {border-collapse: collapse; width: 80%;table-layout : fixed ;}";
    echo "th, td {border: 1px solid black; padding: 8px; text-align: left;}";
    echo "</style>";

}
?>

