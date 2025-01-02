<?php
session_start();

class Emprunts
{
    public function triEmprunts($colonne, $ordre)
    {
        global $bdd;
        $sqlEmprunt= $bdd->prepare("
          Select id_emprunt , date ,delais ,DATE_ADD(date,INTERVAL delais DAY) as 'Date de retour',
          ref_inscrit as 'Numéro d''inscrit', CONCAT(prenom,' ',nom) as 'nom' ,
          ref_exemplaire as 'Numéro d''exemplaire', titre as 'Titre du livre'
          from exemplaire e 
          inner join emprunt em on e.id_exemplaire = em.ref_exemplaire
          inner join livre l on e.ref_livre = l.id_livre
          inner join inscrit i on i.id_inscrit = em.ref_inscrit
            order by $colonne $ordre
            ");
        $sqlEmprunt->execute();
        while ($ligne = $sqlEmprunt->fetch()) {
            $id_emprunt = $ligne[0];
            $date_emprunt = $ligne[1];
            $delais = $ligne[2];
            $date_retour= $ligne[3];
            $id_inscrit = $ligne[4];
            $nom_inscrit = $ligne[5];
            $ref_exemplaire = $ligne[6];
            $titre_livre = $ligne[7];

            // Chaque ligne contient les informations d'un livre
            echo "<tr>";
            echo "<td>$id_emprunt </td>";
            echo "<td>$date_emprunt</td>";
            echo "<td>$delais </td>";
            echo "<td>$date_retour </td>";
            echo "<td>$id_inscrit</td>";
            echo "<td>$nom_inscrit</td>";
            echo "<td>$ref_exemplaire</td>";
            echo "<td>$titre_livre</td>";

            echo "</tr>";
        }
    }
}

//---------------------------PROGRAMME PRINCIPAL------------------------------
$emprunts= new Emprunts();


if (isset($_SESSION["login"])) {
    $bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');
    echo "<h2>Liste des Emprunts </h2>";
    $recherche = "";

    echo "<div class ='contenu'>";



    //------------------------Ferme le div recherche--------------------

    echo "<div class='emprunt'>";
    echo "<form action='listeEmprunt.php' method='POST'>";
    echo "<select name='filtre-emprunt'>";
    echo "<option value='Trie-par-date-asc'>Date d'emprunt du + récent au - récent </option>";
    echo "<option value='Trie-par-date-desc'>Date d'emprunt du - récent au + récent</option>";
    echo "<option value='Trie-par-numExemplaire-asc'>Tri par numero d'exemplaire croissant</option>";
    echo "<option value='Trie-par-numExemplaire-desc'>Tri par numero d'exemplaire decroissant</option>";
    echo "<option value='Trie-par-inscrit-desc'>Tri par numéro d'inscrit croissant</option>";
    echo "<option value='Trie-par-inscrit-desc'>Tri par numéro d'inscrit decroissant</option>";
    echo "<option value='sans-filtre'>Afficher tout </option>";
    echo "</select>";
    echo "<input name='Valider' type='submit' value='filtre'/>";
    echo "</form>";

    //Colonnes
    echo "<form action = 'listeEmprunt.php' method='POST'> ";
    echo "<table border='4'>";
    echo "<tr>";
    echo "<th> Numéro de l'emprunt</th>";
    echo "<th>Date de l'emprunt</th>";
    echo "<th>Delai</th>";
    echo "<th>Date de retour</th>";
    echo "<th>Identifiant de l'inscrit</th>";
    echo "<th>Nom de l'inscrit</th>";
    echo "<th>Numéro d'exemplaire </th>";
    echo "<th>Titre du livre </th>";




    $filtreEmprunt = "";
    if (!empty($_POST['filtre-emprunt'])) {
        $filtreEmprunt = $_POST['filtre-emprunt'];
        if ($filtreEmprunt == "Trie-par-date-asc") {
            $emprunts->triEmprunts('date', 'DESC');
        }
        if ($filtreEmprunt == "Trie-par-date-desc") {
            $emprunts->triEmprunts('date', 'ASC');
        }
        if ($filtreEmprunt == "Trie-par-numExemplaire-asc") {
            $emprunts->triEmprunts('ref_exemplaire', 'ASC');
        }
        if ($filtreEmprunt == "Trie-par-numExemplaire-desc") {
            $emprunts->triEmprunts('ref_exemplaire', 'DESC');
        }
        if ($filtreEmprunt == "Trie-par-inscrit-asc") {
            $emprunts->triEmprunts('ref_inscrit', 'ASC');
        }
        if ($filtreEmprunt == "Trie-par-inscrit-desc") {
            $emprunts->triEmprunts('ref_inscrit', 'DESC');
        }
        if ($filtreEmprunt == "sans-filtre") {
            $emprunts->triEmprunts('id_emprunt', 'ASC');
        }
    } else {
        $emprunts->triEmprunts('id_emprunt', 'ASC');
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
    echo ".auteur{background-color:light red;}";
    echo ".recherche td{padding:20px;}";
    echo ".bas-page{display:fle}";
    echo "table {border-collapse: collapse; width: 80%;table-layout : fixed ;}";
    echo "th, td {border: 1px solid black; padding: 8px; text-align: left;}";
    echo "</style>";

}



