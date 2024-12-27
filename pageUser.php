<?php
session_start();
$bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');
echo "<html>" ;
echo "<head>" ;
echo "</head>" ;
echo "<body>" ;
echo "<h1> Espace utilisateur</h1>" ;

if(isset($_SESSION["login"])) {
    echo "<h3> Bienvenue " . $_SESSION['login'] . "</h3>";
}
echo  "<ul>" ;
echo "<li> <a href= 'catalogue.php'> Catalogue des livres </a> </li>" ;
echo "<li> <a href= ''> Emprunter des livres </a> </li>" ;
echo "</ul>" ;

echo "<a href = 'deconnecter.php'> Deconnexion </a> " ;



?>