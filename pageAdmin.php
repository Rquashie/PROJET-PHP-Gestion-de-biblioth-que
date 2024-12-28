
<?php
    session_start();
if(isset($_SESSION['login'])) {
    echo "<html>";
    echo "<head>";
    echo "</head>";
    echo "<body>";

    echo "<div class= 'contenu'>";


    echo "<div class = 'colonne-gauche' >" ;
    if (isset($_SESSION["login"])) {
        echo "<h3> Bienvenue " . $_SESSION['login'] . "</h3>";

        echo "<div class = 'titre'>";
        echo "<h2> Page Administrateur</h2>";
        echo "</div>";

        echo "<div class= 'gestion-inscrit'>";
        echo "<h3> Gestion des inscrits</h3>";
        echo "<p> Dans cet onglet vous pouvez ajouter , modifier ou supprimer un inscrit </p>";
        echo "<ul>";
        echo "<li> <a href='formInscription.html'> Ajouter un utilisateur</a></li>";
        echo "<li><a href = 'modifier.html'> Modifier un utilisateur</a></li>";
        echo "<li><a href='suppression.php'>Supprimer un utilisateur</a></li>";
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

        echo "</div>";



        echo "<div class = 'colonne-droite'>" ;

        echo "<div class= 'gestion-livre'>";
        echo "<h3> Gestion des livres</h3>";
        echo "<p> Dans cet onglet vous pouvez afficher , ajouter , modifier ou supprimer des livres</p>";
        echo "<ul>";
        echo "<li> <a href='formAjouterLivre.html'> Ajouter un livre</a></li>";
        echo "<li><a href = 'modifierLivre.html'> Modifier un livre</a></li>";
        echo "<li><a href='supprimerLivre.php'>Supprimer un livre</li>";
        echo "<li> <a href='listeLivre.php'>Liste des livres</a>";
        echo "<li> <a href='livreAuteur.html'>Associer livre à un auteur </a>";
        echo "</ul>";
        echo "</div>";

        echo "<div class = 'gestion-emprunt'>";
        echo "<h3> Gestion des emprunts</h3>";
        echo "<p> Dans cet onglet vous pouvez afficher , ajouter , modifier ou supprimer des emprunts</p>";
        echo "<ul>";
        echo "<li> <a href='ajouterEmprunt.html'>Enregistrer un emprunt</a></li>";
        echo "<li><a href = ''> Modifier un emprunt</a></li>";
        echo "<li><a href=''>Supprimer un emprunt</li>";
        echo "<li> <a href=''>Liste des emprunts</a>";
        echo "</ul>";
        echo "</div>" ;


        echo "<div class = 'deconnexion' >";
        echo "<a href=index.html>Se deconnecter</a> ";
        echo "</div>";

        echo "</div>";

        echo"</div>";
        echo "</body>";
        echo "</html>";
    }

}
?>
<style type ="text/css">
    body .contenu{
        display: flex;
    }
    body ul{
        list-style: none;
    }

    body ul li{
        margin-top:20px;
    }
    .contenu .colonne-gauche .titre{
        margin-top: :0px;
        text-align: center;
    }
    .contenu .colonne-gauche{
        margin-top:50px;
        width : 50% ;
    }
    .contenu .colonne-droite{
        margin-top:100px;
        width : 50% ;
    }

    .contenu .colonne-gauche .gestion-inscrit {
        border : 1px solid ;
        width:400px;
        padding : 20px;
    }
    .contenu .colonne-gauche .gestion-auteur {
        margin-top : 50px ;
        border : 1px solid ;
        width:400px;
        padding : 20px;
    }
    .contenu .colonne-droite .gestion-livre {
        margin-top : 50px ;
        border : 1px solid ;
        width:400px;
        padding : 20px;
    }
    .contenu .colonne-droite .gestion-emprunt {
        margin-top : 50px ;
        border : 1px solid ;
        width:400px;
        padding : 20px;
    }
    .contenu  .colonne-droite .deconnexion {
        width : 100px;
        margin-top: 50px;
        margin-left:300px;
    }



