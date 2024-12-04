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
$sessionPrenom = $_SESSION['nouveauPrenom'];
$sessionMail = $_SESSION['nouveauMail'];
$sessionTelFixe = $_SESSION['nouveauTelFixe'];
$sessionTelPortable = $_SESSION['nouveauTelPortable'];
$sessionRue = $_SESSION['nouveauRue'];
$sessionCp = $_SESSION['nouveauCp'];
$sessionVille = $_SESSION['nouveauVille'];
$sessionMdp = $_SESSION['nouveauMdp'];



$dsn = 'mysql:host=localhost;port=3306;dbname=rqe_librairie;charset=utf8';
$bdd = new pdo($dsn, 'root', '');
if(isset($sessionProfil)) {
    if (!empty($sessionNom)) {
        $sql = "UPDATE inscrit  set nom = :nouveauNom where id_inscrit =:$sessionProfil";
        $req = $bdd->prepare($sql);
        $req->execute(array('nouveauNom' => $sessionNom));
        echo "<h3> Modification du nom effectué </h3>";
    } else if (!empty($sessionPrenom)){
        $sql = "UPDATE inscrit set prenom = :nouveauPrenom where id_inscrit =:$sessionProfil";
        $req = $bdd->prepare($sql);
        $req->execute(array('nouveauPrenom' => $sessionPrenom));
        echo "<h3> Modification du prenom effectué !</h3>";
    } else if (!empty($sessionMailail)) {
        $sql = "UPDATE inscrit set email =:nouveauMail where id_inscrit =:$sessionProfil";
        $req = $bdd->prepare($sql);
        $req->execute(array('nouveauMail' => $sessionMail));
        echo "<H3>Modification du mail effectué !</H3>";

    } else if (!empty($sessionTelFixe)) {
        $sql = "UPDATE inscrit set tel_fixe =:nouveauTelFixe where id_inscrit =:$sessionProfil";
        $req = $bdd->prepare($sql);
        $req->execute(array('nouveauTelFixe' => $sessionTelFixe));
        echo "<h3>Modification du telephone fixe effectué !</h3>";
        
    } else if (!empty($sessionTelPortable))  {
        $data = (array(
            'id_inscrit'=> $sessionProfil ,
            'tel_portable' => $sessionTelPortable));
        $sql = "UPDATE inscrit set tel_portable = :nouveauTelPortable where id_inscrit = :$sessionProfil;";
        $req = $bdd->prepare($sql);
        $req->execute($data);
        echo "<h3>Modification du telephone portable effectué </h3>";

    } else if (!empty($sessionRue)) {
        $sql = "UPDATE inscrit set rue = :nouveauRue where id_inscrit =:$sessionProfil";
        $req = $bdd->prepare($sql);
        $req->execute(array('nouvelleRue' => $sessionRue));
        echo "<h3> Modification de la rue effectuée </h3>";
    } else if (isset($sessionCp)) {
        $sql = "UPDATE inscrit set cp = :nouveauCp where id_inscrit =:$sessionProfil";
        $req = $bdd->prepare($sql);
        $req->execute(array('nouveauCp' => $sessionCp));
        echo "<h3> Modification du code postal effectué </h3>";
    }
}
echo "<a href ='formConnexion.html'>Retour vers la page de connexion</a> ";



