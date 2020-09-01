<?php
//On récupere notre classe LivreManager
require_once "models/LivreManager.class.php";

class LivresController{
    private $livreManager;

    /*
    **  A la création de l'objet on a l'ensemble
    **  de nos données.
    */
    public function __construct()
    {
         //On crée notre objet de type LivreManager
        $this->livreManager = new LivreManager();
        $this->livreManager->chargementLivres();
    }

    /*
    **  Fonction qui permet l'affichage des livres
    **  en appelant le template correspondant.
    */
    public function afficherLivres()
    {
        $livres = $this->livreManager->getLivres();
        require "views/livres.view.php";
    }
}

?>