<?php

    class Character extends AbstractCharacter
    {
        private $name;
        /*
         * Protected : propriétés accessibles directement dans les classes et ses enfants
         */
        protected $health;

        public function __construct($name)
        {
            $this->name = $name;
            $this->health = 100;
            $this->warScream();
        }

        public function setName($name) {
            // ...
            $this->name = $name;
        }

        public function getName() {
            return $this->name;
        }

        public function hit() {
            echo "PAF le chien par ".$this->name."<br>";
        }

        private function sayHello() {
            echo "Hello I'm ".$this->name."<br>";
        }

        public function sleep() {
            echo "rrrRRRrrrrffff : ".$this->getName()." dort<br>";
        }

        /*
         * Une méthode finale ne peut pas être redéfinie dans les enfants
         */
        final public function walk() {
            echo "Je marche<br>.";
        }

        public function warScream() {
            echo "AAAAeenh<br>";
        }
    }