<?php

ob_start();
/*
**  Ici temporisation car l'usage de variables
**  n'est pas pratique pour afficher "beaucoup"
**  de contenu. On place ainsi notre code html
**	entre ces deux fonctions pour le deverser ensuite.
*/
	$titre = "Bienvenue";
?>

<h4 class="text-center my-5">Lecteur acharné ou non, venez découvrir nos livres !</h4>

<?php
    /*
    **  On peut utiliser une variable pour
    **  deverser du contenu dans une autre page.
    **  $content = "<h1 class='text-center'>Mes livres</h1>";
    */
    $content = ob_get_clean();
    require "template.php";
?>