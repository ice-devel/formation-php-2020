<?php

    class Character
    {
        private $name;
        protected $health;

        public function __construct($name)
        {
            $this->name = $name;
            $this->health = 100;
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
    }