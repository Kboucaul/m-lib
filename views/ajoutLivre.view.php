<?php

ob_start();
/*
**  Ici temporisation car l'usage de variables
**  n'est pas pratique pour afficher "beaucoup"
**  de contenu. On place ainsi notre code html
**	entre ces deux fonctions pour le deverser ensuite.
*/
	$titre = "Ajout d'un livre";
?>

<form method="post" action="<?= URL ?>livres/av" enctype="multipart/form-data">
  <div class="form-group">
    <label for="titre">Titre : </label>
    <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre" required>
  </div>
  <div class="form-group">
    <label for="nbPages">Nombre de pages : </label>
    <input type="number" class="form-control" id="nbPages" name="nbPages" placeholder="Nombre de pages">
  </div>
  <div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control-file" id="image" name="image">
  </div>
  <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php
    /*
    **  On peut utiliser une variable pour
    **  deverser du contenu dans une autre page.
    **  $content = "<h1 class='text-center'>Mes livres</h1>";
    */
    $content = ob_get_clean();
    require "views/template.view.php";
?>