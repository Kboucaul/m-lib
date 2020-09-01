<?php

class Livre
{
    //Attributs de classe
    private $id;
    private $title;
    private $nbPages;
    private $image;

    /*
    **  Constructeur pour générer un livre
    **  $id         => Identifiant unique du livre
    **  $title      => Titre de notre livre
    **  $nbPages    => Nombre de pages du livre
    */
    public function __construct($id, $title, $nbPages, $image)
    {
        $this->id       = $id;
        $this->title    = $title;
        $this->nbPages  = $nbPages;
        $this->image    = $image;
    }
/*
**  ==========SETTER ET GETTER===============================
*/
    /*
    **  Permet d'attribuer un id unique à notre livre
    */
    public function setId($id){$this->id = $id;}
    
    /*
    **  Permet de récuperer l'identiifiant unique de notre livre
    */
    public function getId(){return $this->id;}
    
    /*
    **  Permet d'attribuer un titre à notre livre
    */
    public function setTitle($title){$this->title = $title;}
    
    /*
    **  Permet de récuperer le titre de notre livre
    */
    public function getTitle(){return $this->title;}
    
    /*
    **  Permet d'attribuer le nombre de pages de notre livre
    */
    public function setNbPages($nbPages){$this->nbPages = $nbPages;}
    
    /*
    **  Permet de récuperer le nombre de pages de notre livre
    */
    public function getNbPages(){return $this->nbPages;}
    
    /*
    **  Permet d'attribuer une image à notre livre
    */
    public function setImage($image){$this->image = $image;}
    
    /*
    **  Permet de récuperer l'image de notre livre
    */
    public function getImage(){return $this->image;}
}

?>