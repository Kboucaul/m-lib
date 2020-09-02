<?php

ob_start();
/*
**  Ici temporisation car l'usage de variables
**  n'est pas pratique pour afficher "beaucoup"
**  de contenu. On place ainsi notre code html
**	entre ces deux fonctions pour le deverser ensuite.
*/
	$titre = $livre->getTitle();
?>

<div class="row">
    <div class="col-6 mt-5">
        <img src="<?= URL ?>public/images/<?= $livre->getImage(); ?>" alt="livre <?= $livre->getId() ?>">
    </div>
    <div class="col-6 mt-5">
        <p>Titre : <?= $livre->getTitle(); ?>
        <p>Nombre de pages : <?= $livre->getNbPages(); ?>
    </div>
</div>

<?php
    /*
    **  On peut utiliser une variable pour
    **  deverser du contenu dans une autre page.
    **  $content = "<h1 class='text-center'>Mes livres</h1>";
    */
    $content = ob_get_clean();
    require "views/template.view.php";
?>