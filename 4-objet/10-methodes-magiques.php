<?php
    /**
     * Les Méthodes magiques : méthodes qui sont appelées automatiquement
     * lors d'une action particulière en PHP
     * - __construct, __clone
     * https://www.php.net/manual/fr/language.oop5.magic.php
     */

    class User {
        private $name;
        private $createdAt;
        private $pet;

        public function getName() {return $this->name;}
        public function setName($name) {$this->name=$name;}
        public function getCreatedAt() {return $this->createdAt;}
        public function setCreatedAt($c) {$this->createdAt=$c;}
        public function getPet() {return $this->pet;}
        public function setPet($pet) {$this->pet=$pet;}

        // lors de l'instanciation
        public function __construct(){}

        // lors du clone
        public function __clone() {
            // $this est le nouvel objet

            // dissocier les références des objets
            $this->createdAt = clone $this->createdAt;
            $this->pet = clone $this->pet;
        }

        // si on cherche à utiler un objet comme une chaine, on passera par tostring
        public function __toString()
        {
            return "Ce user s'appelle ".$this->name." et il a été créé le ".$this->createdAt->format("d/m/Y H:i:s")."<br>";
        }

        // serialize an objet
        public function __serialize(): array
        {
           return [
               'name' => $this->name,
               'createdAt' => $this->createdAt,
               'serialize_date' => new DateTime()
           ];
        }

        // appelé quand une fonction inesistante ou inaccessible est appelée sur l'objet
        public function __call($method, $args) {
            var_dump($method);
            var_dump($args);
        }

        public function __get($property) {
            var_dump($property);
        }

        public function __set($property, $value) {
            var_dump($property);
            var_dump($value);
        }

        public function __invoke() {
            var_dump("L'objet ".$this->name." a été utilisé comme une fonction");
        }

        // déclenché lors d'un var_dump sur l'objet
        public function __debugInfo()
        {
            /*
             * // en imaginant que l'on ne veuille afficher que le nom du User dans le
             * // var_dump()
            return [
                'name' => $this->name
            ];
            */
        }
    }

    class Pet {
        public $name;
    }

    session_start();

    echo "<pre>";

    // __construct
    $user = new User();
    $user->setName("Gégé");
    $user->setCreatedAt(new DateTime());

    $pet = new Pet();
    $pet->name = "Zorro";
    $user->setPet($pet);

    $_SESSION['user'] = $user;

    // __clone
    $user2 = clone $user;
    // attention, les objets dans $user ne sont pas clonés, on garde
    // la même référence pour le nouvel user
    $c = $user2->getCreatedAt();
    $c->setDate(2010, 10, 10);

    $pet = $user2->getPet();
    $pet->name = "Edouard";

    var_dump($user);
    var_dump($user2);

    // __toString (cette ligne plante si la méthode tostring n'est pas définie dans User)
    echo $user;

    $array = ["toto", "gégé"];
    $tabSerialized = serialize($array);
    $tab = unserialize($tabSerialized);

    $serializedUser = serialize($user);
    var_dump($serializedUser);

    // __call (méthode inexistante ou inaccessibles)
    $user->getTest("test", "test2");
    // __get
    echo $user->prout;

    // __set
    $user->undefinedProperty = "test";

    // __invoke
    $user();
