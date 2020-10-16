<?php
    /*
     * La classe wizard étend la classe character :
     * elle a donc toutes les propriétés et méthodes de Character
     */
    class Wizard extends Character implements Playable, GameOver
    {
        private $mana;

        // override / redéfinition d'une méthode
        // réécrire une méthode qui existe déjà dans un parent
        // pour changer son comportement
        public function __construct($name, $mana)
        {
            parent::__construct($name);

            // impossible d'accèder $this->name car la propriété est privée et se trouve
            // dans Character (et non dans Wizard)
            // $this->name == name;
            // on pourrait passer par le mutateur qui est public, lui
            $this->setName($name);

            // la propriété health est protected et donc on peut y accédre directement
            // dans les classes enfant de Character
            $this->health = 100;

            $this->mana = $mana;

        }

        /*
         * Override
         */
        public function hit() {
            echo "Fiouu Le chien par ".$this->getName()."<br>";
        }

        /*
         * Surcharge qui modifie la visibilité : private vers public
         * Final : cette méthode a pu être rédéfinit depusi Character, mais les enfants
         * de Wizard ne pourront pas la redéfinir
         */
        final public function sayHello() {
            echo "Hi I'm ".$this->getName()." and I'm a magician<br>";
        }

        /**
         * Surcharger une méthode en changeant sa visibilité n'est pas possible
         * que si la nouvelle visibilité est au moins autant permissive
         * public : impossible d'aller vers protected et vers private
         * protected : impossible d'aller vers private mais possible d'aller vers public
         * private : possible d'aller vers protected ou public
         **/
        /*
        private function sleep() {

        }
        */

        /*
         * Impossible de redéfinir walk car elle est finale dans parent
         */
        /*
        public function walk() {
            echo "Je marche comme un magicien<br>";
        }
        */

        public function warScream() {
            echo "IIIIIoouh<br>";
        }

        /**
         * Ces méthode proviennent de l'interface Playable
         * et doivent obligatoirement être définie
         */
        public function move() {

        }

        public function heal() {

        }

        public function howIDie()
        {
            // TODO: Implement howIDie() method.
        }

        public function whereIam()
        {
            // TODO: Implement whereIam() method.
        }


    }