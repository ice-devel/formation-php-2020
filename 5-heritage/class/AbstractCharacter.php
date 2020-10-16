<?php

    /*
        Classe abstraite : classe qu'on ne peut pas instancier
     */
    abstract class AbstractCharacter
    {
        protected $strength;

        public function getStrength() {
            return $this->strength;
        }

        public function setStrength($strength) {
            $this->strength = $strength;
        }

        final function toto() {
            // cette fonction ne fait rien et donc ne sert à rien
            // et en plus elle peut pas être redéfinie
        }

        /*
        * Méthode abstraite : pas de corps uniquement la signature
        * c'est une méthode qui doit obligatoirement
        * être redéfinie par les enfants qui héritent de cette classe
        */
        abstract public function warScream();
    }