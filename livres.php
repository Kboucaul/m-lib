<?php 
    $titre = "Tous nos livres";
    
    //1- On récupere notre classe Livre
    require_once "Livre.class.php";
    
    //2- On récupere notre classe LivreMnager
    require_once "LivreManager.class.php";

    //3- On crée notre objet de type LivreManager
    $livreManager = new LivreManager();

    
    /*
    **  On ajoute nos livres
    */
    $livreManager->chargementlivres();
    /*
    **  Ici temporisation car l'usage de variables
    **  n'est pas pratique pour afficher "beaucoup"
    **  de contenu.
    */
    ob_start();

?>
<h4 class="text-center my-5">Voici l'ensemble des livres que nous proposons</h4>

<table class="table text-center mt-5">
    <tr class="table-dark">
        <th>Image</th>
        <th>Titre</th>
        <th>Nombre de pages</th>
        <th colspan="2">Actions</th>
    </tr>
    <!-- UN LIVRE -->
    <?php
        $i = -1;
        while (++$i < count($livreManager->getLivres())) {?>
    <tr>
        <td class="align-middle">
            <img src="<?= "public/images/" . $livreManager->getLivres()[$i]->getImage();?>" width="60px"/>
        </td>
        <td class="align-middle">
            <?= $livreManager->getLivres()[$i]->getTitle(); ?>
        </td>
        <td class="align-middle"><?= $livreManager->getLivres()[$i]->getNbPages();?></td>
        <td class="align-middle">
            <a href="" class="btn btn-warning">Modifier</a>
        </td>
        <td class="align-middle">
            <a href="" class="btn btn-danger">Supprimer</a>
        </td>
    </tr>
    <?php }?>
</table>
    <!--
        Bouton pour ajouter un livre
    -->
    <a href="" class="btn btn-success d-block mb-5">
        Ajouter un livre
    </a>
<?php
    /*
    **  On peut utiliser une variable pour
    **  deverser du contenu dans une autre page.
    **  $content = "<h1 class='text-center'>Mes livres</h1>";
    */
    $content = ob_get_clean();
    require "template.php";
?>