<?php
session_start();

if(isset($_SESSION["login"])) {

$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
$var = $_POST['date_naissance'] ;
$date = str_replace('/', '-', $var);
$date_naissance = date('Y-m-d', strtotime($date));
$pays = isset($_POST["pays"]) ? $_POST["pays"] : '';

$ligneRef_pays = "";
$ref_pays = "";
$bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');




    $colonne = [$pays];
    if (isset($_POST["pays"])) {
        $sqlRef_pays = $bdd->prepare("SELECT * FROM pays where nom = ? ");
        $sqlRef_pays->execute($colonne);
        $ligneRef_pays = $sqlRef_pays->fetch();
        if ($ligneRef_pays) {
            $ref_pays = $ligneRef_pays["id_pays"];
        }


        $sql = "INSERT  into auteur ( nom , prenom , date_naissance,ref_pays) values(:nom,:prenom,:date_naissance,:ref_pays)";
        $req = $bdd->prepare($sql);
        $req->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naissance' => $date_naissance,
            'ref_pays' => $ref_pays
        ));


        if (isset($_POST['Submit'])) {
            //Rester sur la page
            header("location:formAuteur.html");

        }
    } else {
        echo "<p> Erreur d'enregistrement </p>";
    }

}


?>

