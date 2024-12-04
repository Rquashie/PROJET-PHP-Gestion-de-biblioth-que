<?php
session_start();
var_dump($_SESSION);
$membre = $_POST['chercheProfil'];
$nouveauNom = $_POST['nouveauNom'];
$nouveauPrenom = $_POST['nouveauPrenom'];
$nouveauMail = $_POST['nouveauMail'];
$nouveauTelFixe = $_POST['nouveauTelFixe'];
$nouveauTelPortable = $_POST['nouveauTelPortable'];
$nouvelleRue = $_POST['nouvelleRue'];
$nouveauCp = $_POST['nouveauCp'];
$nouvelleVille = $_POST['nouvelleVille'];
$nouveauMdp = $_POST['nouveauMdp'];

$_SESSION['chercheProfil'] = $membre;
$_SESSION['nouveauNom'] = $nouveauNom;
$_SESSION['nouveauPrenom'] = $nouveauPrenom;
$_SESSION['nouveauMail'] = $nouveauMail;
$_SESSION['nouveauTelFixe'] = $nouveauTelFixe;
$_SESSION['nouveauTelPortable'] = $nouveauTelPortable;
$_SESSION['nouveauRue'] = $nouvelleRue;
$_SESSION['nouveauCp'] = $nouveauCp;
$_SESSION['nouveauVille'] = $nouvelleVille;
$_SESSION['nouveauMdp'] = $nouveauMdp;

$sessionProfil = $_SESSION['chercheProfil'];
$sessionNom = $_SESSION['nouveauNom'];


$dsn = 'mysql:host=localhost;port=3307;dbname=rqe_librairie;charset=utf8';
$bdd = new pdo($dsn, 'root', '');
if(isset($SESSION['chercheProfil'])) {
    if (!isset($nouveauNom)) {
        $sql = "UPDATE inscrit 
            set nom = :nouveauNom where id_inscrit =:$membre";
        $req = $bdd->prepare($sql);
        $req->execute(array('nouveauNom' => $sessionNom));
        echo "<h3> Modification du nom effectué </h3>";
    } else if (isset($nouveauPrenom)) {
        $sql = "UPDATE inscrit 
            set prenom = :nouveauNom where id_inscrit =:$membre";
        $req = $bdd->prepare($sql);
        $req->execute(array('nouveauPrenom' => $nouveauPrenom));
        echo "<h3> Modification du prenom effectué !</h3>";
    } else if (isset($nouveauMail)) {
        $sql = "UPDATE inscrit 
    set email =:nouveauMail where id_inscrit =:$membre";
        $req = $bdd->prepare($sql);
        $req->execute(array('nouveauMail' => $nouveauMail));
        echo "<H3>Modification du mail effectué !</H3>";

    } else if (isset($nouveauTelFixe)) {
        $sql = "UPDATE inscrit 
     set tel_fixe =:nouveauTelFixe where id_inscrit =:$membre;";
        $req = $bdd->prepare($sql);
        $req->execute(array('nouveauTelFixe' => $nouveauTelFixe));
        echo "<h3>Modification du telephone fixe effectué !</h3>";
    } else if (isset($nouveauTelPortable)) {
        $sql = "UPDATE inscrit 
     set tel_portable = :nouveauTelPortable where id_inscrit =:$membre;";
        $req = $bdd->prepare($sql);
        $req->execute(array('nouveauTelPortable' => $nouveauTelPortable));
        echo "<h3>Modification du telephone portable effectué </h3>";
    } else if (isset($nouveauRue)) {
        $sql = "UPDATE inscrit set rue = :nouveauRue where id_inscrit =:$membre";
        $req = $bdd->prepare($sql);
        $req->execute(array('nouvelleRue' => $nouvelleRue));
        echo "<h3> Modification de la rue effectuée </h3>";
    } else if (isset($nouveauCp)) {
        $sql = "UPDATE inscrit 
    set cp = :nouveauCp where id_inscrit =:$membre";
        $req = $bdd->prepare($sql);
        $req->execute(array('nouveauCp' => $nouveauCp));
        echo "<h3> Modification du code postal effectué </h3>";
    }

    echo "<a href ='formConnexion.html'>Retour vers la page de connexion</a> ";
}


