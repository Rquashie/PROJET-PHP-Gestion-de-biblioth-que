<?php

session_start();
 class Auteurs{
        public function triAuteurs($colonne, $ordre)
        {
            global $bdd;
            $sql = $bdd->prepare("SELECT * FROM auteur order by $colonne $ordre");
            $sql->execute();
            while ($ligne = $sql->fetch()) {
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

                // Chaque ligne contient les informations d'un livre
                echo "<tr>";
                echo "<td>$nom</td>";
                echo "<td>$prenom</td>";
                echo "<td>$date_naissance</td>";
                echo "<td>$nationalite</td>";
                echo "</tr>";
            }
        }
}
$auteur = new Auteurs() ;

if(isset($_SESSION["login"])) {
    $bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');
    echo "<h2>Liste des auteurs</h2>";
    $recherche = "";

    echo "<div class ='contenu'>";

    echo "<div class='recherche'>";
    echo "<form method='POST' action='listeAuteur.php'>";
    echo "<input type='search' name='recherche' placeholder='Recherche un auteur...' />";
    echo "<input type='submit' value='Valider' />";
    echo "<input type='reset' value='Annuler' />";
    echo "</form>";


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
    echo "</div>";  //Ferme le div recherche

    echo "<div class='auteur'>";
    echo "<form action='listeAuteur.php' method='POST'>";
    echo "<select name='filtre-auteur'>";
    echo "<option value='affiche-tout' selected='selected'>Afficher tout</option>";
    echo "<option value='Trie-par-nom-asc'>Nom croissant</option>";
    echo "<option value='Trie-par-nom-desc'>Nom deroissant</option>";
    echo "<option value='Trie-par-prenom-asc'>Prenom croissant</option>";
    echo "<option value='Trie-par-prenom-desc'>Prenom decroissant</option>";
    echo "<option value='date-asc'>Date de naissance croissant</option>";
    echo "<option value='date-desc'>Date de naissance decroissant</option>";
    echo "</select>";
    echo "<input name='Valider' type='submit' value='filtre'/>";
    echo "</form>";

    //Colonnes
    echo "<form action = 'listeAuteur.php' method='POST'> ";
    echo "<table border='1'>";
    echo "<th>Nom </th>";
    echo "<th>prenom </th>";
    echo "<th>Date de naissance</th>";
    echo "<th>Nationalité </th>";
    echo "<tr>";


    $filtreAuteur = "";
    if (!empty($_POST['filtre-auteur'])) {
        $filtreAuteur = $_POST['filtre-auteur'];
        if ($filtreAuteur == "Trie-par-nom-asc") {
            $auteur->triAuteurs('nom', 'ASC');
        }
        if ($filtreAuteur == "Trie-par-nom-desc") {
            $auteur->triAuteurs('nom', 'DESC');
        }
        if ($filtreAuteur == "Trie-par-prenom-asc") {
            $auteur->triAuteurs('prenom', 'ASC');
        }
        if ($filtreAuteur == "Trie-par-prenom-desc") {
            $auteur->triAuteurs('prenom', 'DESC');
        }
        if ($filtreAuteur == "date-asc") {
            $auteur->triAuteurs('date_naissance', 'ASC');
        }
        if ($filtreAuteur == "date-desc") {
            $auteur->triAuteurs('date_naissance', 'DESC');
        }
        }
    else {
        $auteur -> triAuteurs('id_auteur', 'ASC');
        }

        echo "</table>";
        echo "</form>";
    } else {

    }
    echo "</table>";
    echo "</form>";


    echo "<input type='reset' value = 'Reinitialiser'/>";
    echo "<br>";
    echo "<br>";

    echo "<a href = 'pageAdmin.php'>Retour au menu principal</a>";
    echo "</div>";
    

echo "<style>";

echo "body{background-color: #f2f2f2 ;}";
echo ".contenu{display: flex;}";
echo".auteur{background-color:light red;}";
echo".recherche td{padding:20px;}";
echo ".bas-page{display:fle}";
echo "table {border-collapse: collapse; width: 80%;table-layout : fixed ;}";
echo "th, td {border: 1px solid black; padding: 8px; text-align: left;}";
echo "</style>";

?>

