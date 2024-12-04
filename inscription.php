
<?php
$dsn = 'mysql:host=localhost;port=3307;dbname=rqe_librairie;charset=utf8';
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
    $sql = "INSERT  into inscrit ( nom , prenom , email , tel_fixe,tel_portable ,rue ,  cp , ville,mot_de_passe) values(:nom,:prenom,:email,:tel_fixe,:tel_portable,:rue,:cp,:ville,:mdp)";
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
        'mdp' => $mdp
    )) ;

    echo "<p> La personne a bien été inscrite </p>" ;

}


