<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie;charset=utf8', 'root', '');
//PAS REUSSI
if (isset($_GET['id_livre']) && is_numeric($_GET['id_livre'])) {
    $id_livre = (int) $_GET['id_livre'];

    $sql = $bdd->prepare('SELECT * FROM livre WHERE id_livre = ?');
    $sql->execute([$id_livre]);
    $livre = $sql->fetch();

    if ($livre) {
        echo "<h2>" . htmlspecialchars($livre['titre']) . "</h2>";
        echo "<h5>" . htmlspecialchars($livre['auteur']) . "</h5>";
        echo "<p>" . htmlspecialchars($livre['resume']) . "</p>";
    } else {
        echo "Livre introuvable";
    }
} else {
    echo "ID de livre invalide ou manquant";
}

echo "<a href='pageUser.php' >Retour</a>";
