<?php
session_start();
//Afficher les auteurs par pays
if(isset($_SESSION["login"])) {
    $bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');


    echo "<div class ='liste-auteurs'> ";
    $sqlListeAuteur = $bdd->prepare("SELECT * from auteur ");
    $sqlListeAuteur->execute();
    $ligneAuteur = $sqlListeAuteur->fetch();



    $i = 0;



        echo "<div class=listAuteur>";
        echo"<table border =1px solid>";

        echo "<tr>";
        echo "<th> Nom </th>";
        echo "<th>Prenom</th>";
        echo "<th>Date de naissance</th>";
        echo "<th>Nationalité</th>";
        echo"</tr>";

       while ($ligneAuteur = $sqlListeAuteur->fetch()) {
           $i++;
           $ref_pays = $ligneAuteur['ref_pays'];
           $var =[$ref_pays];
           $nom = $ligneAuteur["nom"];
           $prenom = $ligneAuteur["prenom"];
           $date_naissance = $ligneAuteur["date_naissance"];
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
       }
           echo "</table>";
           echo "</div>";

        echo "<style>";
        echo "table {border-collapse: collapse; width: 80%;table-layout :fixed}";
        echo "th, td {border: 1px solid black; padding: 8px; text-align: left;}";
        echo "</style>";


}
echo"<a href = 'pageAdmin.php'>Retour au menu principal</a>";
?>