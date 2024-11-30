
<?php
$dsn = 'mysql:host=localhost;dbname=rqe_librairie;charset=utf8';
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

if(!empty($nom) && !empty($prenom) && !empty($email) && !empty($telFixe) && !empty($telPortable) && !empty($rue) && !empty($cp) && !empty($ville)){
    $sql = "INSERT  into inscrit (id_inscrit , nom , prenom , email , tel_fixe,tel_portable ,rue ,  cp , ville,mot_de_passe) values(:id_inscrit , :nom,:prenom,:email,:tel_fixe,:tel_portable,:rue,:cp,:ville,:mdp)";
    $req = $bdd->prepare($sql);
    $req -> execute(array(
        'id_inscrit' => 'null',
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'tel_fixe' => $telFixe,
        'tel_portable' => $telPortable,
        'cp' => $cp,
        'ville' => $ville,
        'mdp' => $mdp
    )) ;

    echo "<p> La personne a bien été inscrite </p>" ;

}

