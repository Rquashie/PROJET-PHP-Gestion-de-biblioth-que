
<?php

$dsn = 'mysql:host=localhost;port=3306;dbname=rqe_librairie;charset=utf8';
$bdd = new pdo($dsn, 'root', '');
$login = "";
$mdp = "";
if(isset($_POST['login']) && isset($_POST['mdp'])) {
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
}

$sqlFonction = $bdd -> prepare('SELECT fonction FROM inscrit WHERE email = :login and mot_de_passe = :mdp ');
$sqlFonction -> execute(array(
    'login'=> $login ,
    'mdp' => $mdp
 ));
$lignesFonction = $sqlFonction -> fetch();


$sql = $bdd->prepare("SELECT * from inscrit where email = :login and mot_de_passe = :mdp and fonction ='user'");
$sql -> execute(array(
    'login' => $login ,
    'mdp' => $mdp
));
$ligne= $sql -> fetch() ;

if($ligne ) {
        session_start();
        $_SESSION['login'] = $login;
        $_SESSION['mdp'] = $mdp;
        header('Location: pageUser.php');
    } else {
        echo "<h3> Veuillez saisir un mot de passe et un identifiant valide </h3>";
    }





?>




