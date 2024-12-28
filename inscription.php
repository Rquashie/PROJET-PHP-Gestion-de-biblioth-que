
<?php
$dsn = 'mysql:host=localhost;port=3306;dbname=rqe_librairie;charset=utf8';
$bdd = new pdo($dsn, 'root', '');

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$telFixe = isset($_POST['telFixe']) ? $_POST['telFixe'] : '';
$telPortable = isset($_POST['telPortable']) ? $_POST['telPortable'] : "";
$rue = isset($_POST['rue']) ? $_POST['rue'] : '';
$cp = isset($_POST['cp']) ? $_POST['cp'] : '';
$ville = $_POST['ville'];
$mdp = $_POST['mdp'];
$confirmerMdp = $_POST['confirmerMdp'];
$fonction = $_POST['fonction'] ;
$login = $_POST['login'];

if(!empty($nom) && !empty($prenom) && !empty($email)  && !empty($telPortable)  && !empty($ville)) {
    if ($mdp == $confirmerMdp) {
        $sql = "INSERT  into inscrit ( nom , prenom , email , tel_fixe,tel_portable ,rue ,  cp , ville,mot_de_passe,fonction,login) values(:nom,:prenom,:email,:tel_fixe,:tel_portable,:rue,:cp,:ville,:mdp,:fonction,:login)";
        $req = $bdd->prepare($sql);
        $req->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'tel_fixe' => $telFixe,
            'tel_portable' => $telPortable,
            'rue' => $rue,
            'cp' => $cp,
            'ville' => $ville,
            'mdp' => $mdp,
            'fonction' => $fonction,
            'login' => $login
        ));

        echo "<p> Vos informations ont bien été enregistrées </p>";
        echo "<a href = 'formInscription.html' >Retour vers l'onglet </a> ";
    }
    else {
        echo "<p> Veuillez saisir des mots de passe identiques dans les champs 
          Mot de passe et Confirmer le mot de passe </p>";
        echo "<a href = 'formInscription.html' >Retour vers l'onglet </a> ";
    }
}
else {
    echo "<p> Erreur d'enregistrement </p>" ;
    echo "<a href = 'formInscription.html' >Retour vers l'onglet </a> ";
}

?>


