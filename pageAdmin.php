
<?php
    session_start();
if(isset($_SESSION['login'])) {
    echo "<html>";
    echo "<head>";
    echo "</head>";
    echo "<body>";
    echo "<h1> Page Administrateur</h1>";
    if (isset($_SESSION["login"])) {
        echo "<h3> Bienvenue " . $_SESSION['login'] . "</h3>";


        echo "<div class= 'gestion-inscrit'>";
        echo "<h3> Gestion des inscrits</h3>";
        echo "<p> Dans cet onglet vous pouvez ajouter , modifier ou supprimer un inscrit </p>";
        echo "<ul>";
        echo "<li> <a href='formInscription.html'> Ajouter un utilisateur</a></li>";
        echo "<li><a href = 'modifier.html'> Modifier un utilisateur</a></li>";
        echo "<li><a href='suppression.php'>Supprimer un utilisateur</li>";
        echo "</ul>";
        echo "</div>";

        echo "<div class= 'gestion-auteur'>";
        echo "<h3> Gestion des auteurs</h3>";
        echo "<p> Dans cet onglet vous pouvez afficher , ajouter , modifier ou supprimer un auteur </p>";
        echo "<ul>";
        echo "<li> <a href='formAuteur.html'> Ajouter un auteur</a></li>";
        echo "<li><a href = 'modifierAuteur.html'> Modifier un auteur</a></li>";
        echo "<li><a href='supprimerAuteur.php'>Supprimer un auteur</li>";
        echo "<li> <a href='listeAuteur.php'>Liste des auteurs</a>";
        echo "</ul>";
        echo "</div>";

        echo "<div class= 'gestion-livre'>";
        echo "<h3> Gestion des livres</h3>";
        echo "<p> Dans cet onglet vous pouvez afficher , ajouter , modifier ou supprimer des livres</p>";
        echo "<ul>";
        echo "<li> <a href='formAjouterLivre.html'> Ajouter un livre</a></li>";
        echo "<li><a href = 'modifierLivre.html'> Modifier un livre</a></li>";
        echo "<li><a href='supprimerLivre.php'>Supprimer un livre</li>";
        echo "<li> <a href='listeLivre.php'>Liste des livres</a>";
        echo "</ul>";
        echo "</div>";


        echo "<div class = 'pied-page' >";
        echo "<a href=index.html>Se deconnecter</a> ";
        echo "</div>";


    }
    echo "</body>";
    echo "</html>";
}
?>
<style type ="text/css">
    .gestion-inscrit {
        border : 1px solid ;
        width : 25% ;
    }
    .gestion-auteur {
        margin-top : 50px ;
        border : 1px solid ;
        width : 25% ;
    }
    .gestion-livre {
        margin-top : 50px ;
        border : 1px solid ;
        width : 25% ;
    }


    .pied-page{
        margin-top : 100px;
    }


