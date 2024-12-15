
<?php
$dsn = 'mysql:host=localhost;port=3306;dbname=rqe_librairie;charset=utf8';
$bdd = new pdo($dsn, 'root', '');

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['mail'];
$telFixe = $_POST['telFixe'];
$telPortable = $_POST['telPortable'];
$rue = $_POST['rue'];
$cp = $_POST['cp'];
$ville = $_POST['ville'];
$mdp = $_POST['mdp'];
$fonction = isset($_POST['fonction']) ? $_POST['fonction'] : null ;

if(!empty($nom) && !empty($prenom) && !empty($email)  && !empty($telPortable)  && !empty($ville)){
    $sql = "INSERT  into inscrit ( nom , prenom , email , tel_fixe,tel_portable ,rue ,  cp , ville,mot_de_passe,fonction) values(:nom,:prenom,:email,:tel_fixe,:tel_portable,:rue,:cp,:ville,:mdp,:fonction)";
    $req = $bdd->prepare($sql);
    $req -> execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'tel_fixe' => $telFixe,
        'tel_portable' => $telPortable,
        'rue'=> $rue,
        'cp' => $cp,
        'ville' => $ville,
        'mdp' => $mdp,
        'fonction' => $fonction
    )) ;

    echo "<p> La personne a bien été inscrite </p>" ;
    header('location : formConnexion.html');
}
else {
    echo "<p> Erreur d'enregistrement </p>" ;
}


