<?php
session_start();
echo "<html>" ;
echo "<head>" ;
echo "</head>" ;
echo "<body>" ;
echo "<h1> Espace utilisateur</h1>" ;
if(isset($_SESSION["login"])&& $_SESSION["mdp"]) {
    echo "<h3> Bienvenue " . $_SESSION['login'] . "</h3>";
}

?>
