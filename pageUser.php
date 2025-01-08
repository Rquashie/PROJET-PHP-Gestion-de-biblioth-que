<?php
session_start();
$bdd = new PDO('mysql:host=localhost;port=3306;dbname=rqe_librairie', 'root', '');
echo "<html>" ;
echo "<head>" ;
echo "</head>" ;
echo "<body>" ;
echo "<div class ='contenu'>";

echo "<div class ='haut-page'>" ;
echo "<h1> <a href='pageUser.php'>Mediathèque</a> </h1>" ;

echo "<div class='espace-user'>";
if(isset($_SESSION["login"])) {
    echo "<h3> Bienvenue " . $_SESSION['login'] . "</h3>";
echo "</div>";

    echo "<div class='recherche'>";
    echo "<form actions ='detailsLivre.php' method='GET'>";
    echo "<input type='search' name='recherche' placeholder='Recherche un livre...' />";
    echo "<button type ='submit'> <img src='recherche.png'  width = '20' alt='Rechercher' /></button>";
    echo "</form>";
    echo"<a href = 'formRechercheAvancee.html'>+ Rechercher avancée </a>";
    echo "</div>";
    echo "</div>";

    if (isset($_GET['recherche'])) {
        $recherche = htmlspecialchars($_GET['recherche']);

        $sqlLivre = $bdd->prepare("SELECT * FROM livre WHERE titre LIKE  ? ");
        $sqlLivre->execute(['%'.$recherche.'%']);
        if($sqlLivre->rowCount() > 0) {
            while ($ligne = $sqlLivre->fetch()) {
                //Creer un liens pour chaque  livres
                //Pas reussi
                echo " <a href='pageUser.php?id=" . htmlspecialchars($ligne['id_livre']) . "'>" . htmlspecialchars($ligne['titre']) . "</a><br>";

            }
        }
    }
    echo "</div>";

    echo "<a href = 'deconnecter.php'> Deconnexion </a> ";


}
?>
<style>
    body{
        width:100%;
    }
    .contenu .haut-page{
        padding:10px ;
        background-color: cornflowerblue;
        height : 60%
    }
    .contenu .haut-page h1{
        justify-content: center;
        display : flex;
        color:white;
    }
    .contenu .haut-page .espace-user{
       justify-content: flex-end;
        font-family: Calibri;
        font-size: small;
        right : 5px;
        top:10px;
        position : absolute;
    }
    .contenu .recherche {
        display: flex;
        justify-content: center;
        margin: 10px auto;

    }
    .contenu .recherche form{
        display: flex;
        width: 40%;
        border: 2px solid #ccc;
        border-radius: 25px;
        overflow: hidden;
        background-color: #f9f9f9;
    }
    .contenu .recherche form input[type='search']{
        font-size: 12px;
        padding:30px;
        border: 1px solid #ccc;
        border-radius: 5px 0 0 5px;
        outline: none;
        flex: 1;
    }
    .contenu .recherche form input[type='image']{
        border: none;
        padding:30px;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
    }
</style>
