<?php

/*
**  Classe permetant de gerer les livres.
**  Il contiendra la liste des livres et permettra de supprimer ou de modifier un livre.
**  Cela permet de "décharger" la classe Livre de toute opéations qui ne la concerne
**  pas directement.
*/
class LivreManager {
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
}

?>