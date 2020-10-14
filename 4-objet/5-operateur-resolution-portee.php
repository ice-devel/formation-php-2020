<?php
    /*
     * Opérateur de résolution de portée
     * Constantes de classe et membres statiques :
     * ce sont des éléments qui liés à la classe et non pas à une instance
     */
    class Character {
        private $name;

        // ceci est une constante de classe
        public const CRITICAL_HIT_MULTIPLY = 20;

        // propriétés statiques (par exemple : compteur d'instance)
        public static $count = 0;

        public function __construct() {
            Character::$count++;
        }

        public function getName() { return $this->name; }
        public function setName($name) { $this->name = $name; }

        /*
         * Méthode statique : qui affiche le nombre d'instance Character
         *
         * Attention : une méthode est lié à la classe et non pas à une instance
         * Utiliser $this dans ce contexte n'a pas de sens : une méthode
         * statique n'est pas appelé par une instance (un objet) particulière
         * mais par la classe elle-même
         */
        static public function displayCount() {
            // echo $this->name; // IMPOSSIBLE
            echo "Il y a actuellement ".Character::$count." personnages instanciés";
        }
    }

    // accès à une constante de classe
    echo "Multiplicateur coup critique : ".Character::CRITICAL_HIT_MULTIPLY."<br>";

    // ccès à un membre statique d'une classe
    echo "Nombre de Character instanciés : ".Character::$count."<br>";

    $character = new Character();
    echo "Nombre de Character instanciés : ".Character::$count."<br>";

    $character = new Character();

    Character::displayCount();

    // IMPOSSIBLE !! Constante
    // Character::CRITICAL_HIT_MULTIPLY = 3;
