<?php
session_start();
$bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');

echo "<H1> Onglet de suppression </H1>" ;
$id_inscrit ="" ;
$nom = "";
$prenom = "";
$tel_portable = "";
$tel_fixe ="";
$email = "";
$cp ="";
$rue ="";
$ville="";
$fonction="";

$sql = $bdd -> prepare("SELECT * from inscrit ");
$sql -> execute();


$i=0 ;

while($ligne = $sql -> fetch()) {
    $i++ ;
    $id_inscrit = $ligne['id_inscrit'];
    $nom = $ligne["nom"];
    $prenom = $ligne["prenom"];
    $email = $ligne['email'];
    $tel_portable = $ligne["tel_portable"];
    $tel_fixe = $ligne["tel_fixe"];
    $cp = $ligne["cp"];
    $rue = $ligne["rue"];
    $ville = $ligne["ville"];
echo "<form action = 'suppression.php' method='POST'> ";
    echo "<table border='1'>";

    echo "<h3> Inscrit $i </h3>";
    echo "<tr>";
    echo "<th>Id_inscrit</th>";
    echo "<th>nom</th>";
    echo "<th>prenom</th>";
    echo "<th>email</th>";
    echo "<th>tel_fixe</th>";
    echo "<th>Tel_portable</th>";
    echo "<th>Rue</th>";
    echo "<th>Code postal</th>";
    echo "<th>Ville</th>";
    echo "<th>Fonction</th>";

    echo "<th>Opérations</th></tr>";

    // Chaque ligne contient les informations d'un livre
    echo "<tr>";
    echo "<td>$id_inscrit</td>";
    echo "<td>$nom</td>";
    echo "<td>$prenom</td>";
    echo "<td>$email</td>";
    echo "<td>$tel_fixe</td>";
    echo "<td>$tel_portable</td>";
    echo "<td>$rue</td>";
    echo "<td>$cp</td>";
    echo "<td>$ville</td>";
    echo "<td>$fonction</td>";
    echo "<input type='hidden' name='id_inscrit' value='$id_inscrit'>";
    echo"<td> <button type ='submit' name='boutonSupprimer'> Supprimer </button></td>";
    $boutonSupprimer ="" ;
    if(isset($_POST['boutonSupprimer']) && $_POST['id_inscrit']) {
        $id_inscrit = $_POST['id_inscrit'];
        $boutonSupprimer = $_POST['boutonSupprimer'];
        $sqlDelete = $bdd->prepare("DELETE FROM inscrit WHERE id_inscrit = $id_inscrit");
        $sqlDelete->execute();
    }
    echo "</tr>";
    echo"<br>";
}
echo "</table>";
echo "</form>";
echo "<style>";
echo "table {border-collapse: collapse; width: 80%;}";
echo "th, td {border: 1px solid black; padding: 8px; text-align: left;}";
echo "</style>";



echo "<a href = 'pageAdmin.php'>Retour</a>";

?>