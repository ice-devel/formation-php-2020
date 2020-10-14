<?php
    /*
     * La classe wizard étend la classe character :
     * elle a donc toutes les propriétés et méthodes de Character
     */
    class Wizard extends Character
    {
        private $mana;

        // override / redéfinition d'une méthode
        // réécrire une méthode qui existe déjà dans un parent
        // pour changer son comportement
        public function __construct($name, $mana)
        {
            //parent::__construct($name);

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

        public function hit() {
            echo "Fiouu Le chien par ".$this->getName()."<br>";
        }

        public function sayHello() {
            echo "Hi I'm ".$this->getName()."<br>";
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
    }