<?php
require_once "Model.class.php";
require_Once "Livre.class.php";
/*
**  Classe permetant de gerer les livres.
**  Il contiendra la liste des livres et permettra de supprimer ou de modifier un livre.
**  Cela permet de "décharger" la classe Livre de toute opéations qui ne la concerne
**  pas directement.
*/
class LivreManager extends Model{
    /*
    **  Attributs :
    **  $livres => Tableau contenant
    **  l'ensemble de nos livres.
    */
    private $livres;

    /*
    **  Methode permetant de récuperer notre
    **  liste de livres.
    */
    public function getLivres(){return $this->livres;}

    /*
    **  Fonction permetant d'ajouter le livre
    **  passé en parametre a notre tableau de livres.
    **  /!\ Ici $livre est un objet de type Livre.
    */
    public function ajoutLivre($livre){$this->livres[] = $livre;}

    public function chargementlivres()
    {
        /*
        **  1-On cree une requete qui recupere tous les livres
        **  ordonnés par ordre croissant (id).
        */
        $req = $this->getBdd()->prepare("SELECT * FROM livres ORDER BY id DESC");

        //2- On l'execute
        $req->execute();

        //3- On recupere tous les livres
        $mesLivres = $req->fetchAll(PDO::FETCH_ASSOC);

        //4- On ferme la requete
        $req->closeCursor();

        //5- On parcours nos livres
        foreach($mesLivres as $livre)
        {
            $l = new Livre($livre['id'], $livre['title'], $livre['nbPages'], $livre['image']);
            $this->ajoutLivre($l);
        }
    }

    public function getLivreById($id)
    {
        $i = 0;
        while ($i < count($this->livres))
        {
            if ($id === $this->livres[$i]->getId())
            {
                return $this->livres[$i];
            }
            $i++;
        }
        return NULL;
    }

    public function ajoutLivreBd($titre,$nbPages,$image){
        $req = "
        INSERT INTO livres (title, nbPages, image)
        values (:title, :nbPages, :image)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":title",$titre,PDO::PARAM_STR);
        $stmt->bindValue(":nbPages",$nbPages,PDO::PARAM_INT);
        $stmt->bindValue(":image",$image,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $livre = new Livre($this->getBdd()->lastInsertId(),$titre,$nbPages,$image);
            $this->ajoutLivre($livre);
        }        
    }

    public function suppressionLivreBd($id)
    {
        //On crée une requete
        $req = "
        Delete from livres where id = :idLivre
        ";
        //On prepare la requete a l'envoie
        $stmt = $this->getBdd()->prepare($req);
        //On renseigne le parametre dans la requete
        $stmt->bindValue(":idLivre", $id, PDO::PARAM_INT);
        //On execute la requete
        $resultat = $stmt->execute();
        //On ferme la connection
        $stmt->closeCursor();
        //On verifie que la requete a marchée
        if ($resultat > 0)
        {
            //on recuper le livre a supprimer
            $livreToDelete = $this->getLivreById($id);
            //on supprime le livre du tableau de livres
            unset($livreToDelete);
        }

    }

    public function modificationLivreBd($id, $title, $nbPages, $image)
    {
        //on cree une requete
        $req = "
        update livres 
        set title = :title, nbPages = :nbPages, image = : image
        where id = :id
        ";
        // on prepare la requete
        $stmt = $this->getBdd()->prepare($req);
        //associer le sparametres
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $stmt->bindValue(":title",$title,PDO::PARAM_STR);
        $stmt->bindValue(":nbPages",$nbPages,PDO::PARAM_INT);
        $stmt->bindValue(":image",$image,PDO::PARAM_STR);
        //on l'execute
        $resultat = $stmt->execute();
        //on libere l'acces a la bd
        $stmt->closeCursor();
        //on verifie si la requete a marché

        if ($resultat > 0)
        {
           //On recupere le livre a modifier
           $livre = $this->getLivreById($id);
           //On change les valeurs
           $livre->setTitle($title);
           $livre->setNbPages($nbPages);
           $livre->setImage($image);

        }
    }
}

?>