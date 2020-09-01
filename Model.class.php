<?php

    abstract class Model {
        private static $pdo;

        /*
        **  Fonction permettant d'etablir la connection a la bdd.
        **  Appelable que dans la classe même.
        */
        private static function setBdd()
        {
            self::$pdo = new PDO("mysql:host=localhost;dbname=biblio;charset=utf8","root","");
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }

        /*
        **  Fonction qui permet de renvoyer cette connection
        **
        */
        protected function getBdd()
        {
            if(self::$pdo === null)
            {
                self::setBdd();
            }
            return self::$pdo;
        }
    }

?>