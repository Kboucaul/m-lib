<?php
    //on demarre la session
    session_start();

    define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http").
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

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
        try {
            //On decompose l'url
            $url = explode("/", filter_var($_GET['page']),FILTER_SANITIZE_URL);
            switch($url[0])
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
                        if (empty($url[1]))
                        {
                            $livresController->afficherLivres();
                        }
                        else if ($url[1] === "l")
                        {
                            $livresController->afficherLivre($url[2]);
                        }
                        else if ($url[1] === "a")
                        {
                            $livresController->ajoutLivre();
                        }
                        else if ($url[1] === "m")
                        {
                           $livresController->modificationLivre($url[2]);
                        }
                        else if ($url[1] === "s")
                        {
                            $livresController->suppressionLivre($url[2]);
                        } 
                        else if ($url[1] === "av")
                        {
                            $livresController->ajoutLivreValidation();
                        }
                        else if ($url[1] === "mv")
                        {
                            $livresController->modificationLivreValidation();
                        } 
                        else{
                            require_once "views/error404.view.php";
                            throw new Exception("La page n'existe pas");
                        }
                    break;
                    default :
                        require_once "views/error404.view.php";
                        throw new Exception("La page n'existe pas");
            }
        }
        catch(Exception $e)
        {
            
        }
    }
?>