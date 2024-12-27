<?php
session_start();
$bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');
if(isset($_SESSION["login"])){
    echo "<p> Cataloge des livres disponibles</p>" ;
    $sql = $bdd -> prepare("SELECT * FROM livre");
    $sql -> execute();
    $i = 1 ;
    while($livre = $sql -> fetch()) {

        echo "<form>";
        echo "<table border=1>";
        echo "<tr>";
        echo "<th> titre </th>";
        echo "<th> Année </th>";
        echo "<th> Résumé </th>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $livre['titre'] . "</td>";
        echo "<td>" . $livre['annee'] . "</td>";
        echo "<td>" . $livre['resume'] . "</td>";
        echo "</tr>";
        echo "</table>";
        echo "</form>";
        echo "<style>";
        echo "table {border-collapse: collapse; width: 80%;}";
        echo "th, td {border: 1px solid black; padding: 8px; text-align: left;}";
        echo "</style>";
    }
}

echo "<a href = 'pageUser.php'>Retour</a>";