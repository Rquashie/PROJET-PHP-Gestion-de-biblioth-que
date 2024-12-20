
<?php

$dsn = 'mysql:host=localhost;port=3306;dbname=rqe_librairie;charset=utf8';
$bdd = new pdo($dsn, 'root', '');
$login = "";
$mdp = "";
if(isset($_POST['login']) && isset($_POST['mdp'])) {
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];

    $var = [$login, $mdp];

    $sqlAdmin = $bdd->prepare("SELECT * FROM inscrit WHERE login = ? and mot_de_passe = ? and fonction = 'admin' ");
    $sqlAdmin->execute($var);
    $lignesAdmin = $sqlAdmin->fetch();


    $sqlUser = $bdd->prepare("SELECT * from inscrit where  login = ? and mot_de_passe = ? and fonction ='user'");
    $sqlUser->execute($var);
    $ligneUser = $sqlUser->fetch();

    if ($ligneUser) {
        session_start();
        $_SESSION['login'] = $ligneUser['login'];
        header('Location: pageUser.php');
    } else if ($lignesAdmin) {
        session_start();
        $_SESSION['login'] = $lignesAdmin['login'];
        header('Location: pageAdmin.php');
    }

}



?>




