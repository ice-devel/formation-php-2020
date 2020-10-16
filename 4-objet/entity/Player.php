<?php

class Player
{
    /*
     * Propriétés
     */
    public $name;
    public $health;
    public $strength;

    /*
     * Constructeur
     */
    public function __construct($name="", $health="", $strength="") {
        // initialiser les valeurs par défaut de cette instance
        // $this représente l'instance qui exécute la fonction
        $this->name = $name;
        $this->health = $health;
        $this->strength = $strength;
    }

    /*
     * Méthodes
     */
    public function hit(Player $hitPlayer) {
        // le joueur qui frappe c'est $this
        echo $this->name." frappe ".$hitPlayer->name;
        $hitPlayer->health = $hitPlayer->health - $this->strength;
    }

    public function __toString()
    {
        throw new PlayerException();
        return "";
    }

}