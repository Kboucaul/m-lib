<?php

    /*
    **  -1 On recupere notre LivreController
    */
    require_once "controllers/LivresController.controller.php";

    /*
    **  -2 On instancie notre controller
    */
    $livresController = new LivresController();

    /*
    **  -3 Mise en place du systeme de routage
    **  Ici c'est index.php qui joue le role
    **  de routeur.
    */

    /*
    **  Si on a pas d epage de préciser on renvoie
    **  vers la page d'accueil par défaut.
    */
    if (empty($_GET['page']))
    {
        //On appelle le template accueil.views.php
        require "views/accueil.view.php";
    }
    else
    {
        switch($_GET['page'])
        {
            case "accueil" :
                require "views/accueil.view.php";
                break;
            case "livres" :
                /*
                **  On appelle la methode afficher livre
                **  qui se trouve dans le controller.
                **  On minimise ainsi le code PHP dans la vue.
                */
                $livresController->afficherLivres();
                break;
        }
    }
?>