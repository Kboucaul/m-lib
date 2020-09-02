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

    public function afficherLivre($id)
    {
      $livre = $this->livreManager->getLivreById($id);
      require_once "views/afficherLivre.views.php";
    }

    public function ajoutLivre()
    {
        require "views/ajoutLivre.view.php";
    }

    public function suppressionLivre($id)
    {
        //On recupere l'image
        $nomImage = $this->livreManager->getLivreById($id)->getImage();
        //On la supprime dur repertoire
        if ($nomImage)
            unlink("public/images/".$nomImage);
        //On supprime en base de données
        $this->livreManager->suppressionLivreBd($id);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression réalisée"
        ];
        //on redirige vers la page listant les livres
        header('location: '. URL . "livres");

    }

    public function modificationLivre($id)
    {
        //On recupere le livre
        $livre = $this->livreManager->getLivreById($id);
        require "views/modifierLivre.view.php";

    }

    public function modificationLivreValidation()
    {
        //On recupere l'image actuelle
        $imageActuelle = $this->livreManager->getLivreById($_POST['identifiant'])->getImage();
        //On recupere le fichier image posté par le formulaire
        $file = $_FILES['image'];
        //On verifie que l'on a bien recu une nouvelle image
        if ($file['size'] > 0)
        {
            //On supprime l'ancienne image
            unlink("public/images/".$imageActuelle);
            //On trouve le repertoire ou est stocké l'image
            $repertoire = "public/images/";
            //On ajoute la nouvelle image
            $nomImageToAdd = $this->ajoutImage($file, $repertoire);
        }
        else {
            //Ici bidouille ou on ajoute l'anciene image pour se
            //simplifier la tache
            $nomImageToAdd = $imageActuelle;
        }
        //Modification en bd
        $this->livreManager->modificationLivreBd($_POST['identifiant'], $_POST['title'], $_POST['nbPages'], $nomImageToAdd);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Modification réalisé"
        ];
        //On redirige
        header('location: ' . URL . "livres");

    }

    public function ajoutLivreValidation(){
        $file = $_FILES['image'];
        $repertoire = "public/images/";
        $nomImageAjoute = $this->ajoutImage($file,$repertoire);
        $this->livreManager->ajoutLivreBd($_POST['titre'],$_POST['nbPages'],$nomImageAjoute);
        //messag alert session
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout réalisé"
        ];

        header('Location: '. URL . "livres");
    }
    private function ajoutImage($file, $dir){
        if(!isset($file['name']) || empty($file['name']))
            throw new Exception("Vous devez indiquer une image");
    
        if(!file_exists($dir)) mkdir($dir,0777);
    
        $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        $random = rand(0,99999);
        $target_file = $dir.$random."_".$file['name'];
        
        if(!getimagesize($file["tmp_name"]))
            throw new Exception("Le fichier n'est pas une image");
        if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new Exception("L'extension du fichier n'est pas reconnu");
        if(file_exists($target_file))
            throw new Exception("Le fichier existe déjà");
        if($file['size'] > 500000)
            throw new Exception("Le fichier est trop gros");
        if(!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("l'ajout de l'image n'a pas fonctionné");
        else return ($random."_".$file['name']);
    }
}

?>