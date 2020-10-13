<?php


    class User
    {
        /*
         * Création de la classe User représentant les utilisateurs
         * du site web :
         * - Propriétés
         * - Constructeur
         * - Getter/Setter (accesseur/mutateur)
         * - Méthodes
         */

        /*
         * Portée de la propriété : private, protected, public
         */
        private $id;
        private $createdAt;
        private $name;
        private $email;
        private $isEnabled;

        /*
         * Constructeur : initialiser les valeurs par défaut des propriétés
         */
        public function __construct($id=null, $createdAt=null, $name=null, $email=null, $isEnabled=null) {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->isEnabled = $isEnabled;

            if ($createdAt == null) {
                $this->createdAt = new DateTime();
            }
            else {
                $this->createdAt = $createdAt;
            }

            // même dans le constructeur, dans un monde parfait,
            // on pourrait respecter le principe d'encapsulation
            // et utiliser les setters
            // $this->setName($name);
        }

        /*
         * Getters / setters
         * Principe d'encapsulation
         */
        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            if (is_string($name) == false) {
                throw new Exception();
            }
            $name = mb_strtoupper($name);
            $this->name = $name;
        }

        /**
         * @return mixed|null
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed|null $id
         */
        public function setId($id): void
        {
            $this->id = $id;
        }

        /**
         * @return DateTime|mixed
         */
        public function getCreatedAt()
        {
            return $this->createdAt;
        }

        /**
         * @param DateTime|mixed $createdAt
         */
        public function setCreatedAt($createdAt): void
        {
            $this->createdAt = $createdAt;
        }

        /**
         * @return mixed|null
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * @param mixed|null $email
         */
        public function setEmail($email): void
        {
            $this->email = $email;
        }

        /**
         * @return mixed|null
         */
        public function getIsEnabled()
        {
            return $this->isEnabled;
        }

        /**
         * @param mixed|null $isEnabled
         */
        public function setIsEnabled($isEnabled): void
        {
            $this->isEnabled = $isEnabled;
        }

        /*
         * Autres méthodes
         */
        public function sayHello() {
            echo "Hello I'm ".$this->getName();
        }

    }