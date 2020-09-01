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
}

?>