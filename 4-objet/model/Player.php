<?php


    class Player
    {
        private $id;
        private $name;
        private $birthdate;
        private $email;
        private $points;
        private $zipcode;
        private $teamId;
        private $weaponId;

        public function __construct($id=null, $name=null,
                                    $birthdate=null, $email=null, $points=null,
                                    $zipcode=null, $teamId=null, $weaponId=null)
        {
            $this->id = $id;
            $this->name = $name;
            $this->birthdate = $birthdate;
            $this->email = $email;
            $this->points = $points;
            $this->zipcode = $zipcode;
            $this->teamId = $teamId;
            $this->weaponId = $weaponId;
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
        public function setId( $id): void
        {
            $this->id = $id;
        }

        /**
         * @return mixed|null
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed|null $name
         */
        public function setName( $name): void
        {
            $this->name = $name;
        }

        /**
         * @return mixed|null
         */
        public function getBirthdate()
        {
            return $this->birthdate;
        }

        /**
         * @param mixed|null $birthdate
         */
        public function setBirthdate( $birthdate): void
        {
            $this->birthdate = $birthdate;
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
        public function setEmail( $email): void
        {
            $this->email = $email;
        }

        /**
         * @return mixed|null
         */
        public function getPoints()
        {
            return $this->points;
        }

        /**
         * @param mixed|null $points
         */
        public function setPoints( $points): void
        {
            $this->points = $points;
        }

        /**
         * @return mixed|null
         */
        public function getZipcode()
        {
            return $this->zipcode;
        }

        /**
         * @param mixed|null $zipcode
         */
        public function setZipcode( $zipcode): void
        {
            $this->zipcode = $zipcode;
        }

        /**
         * @return mixed|null
         */
        public function getTeamId()
        {
            return $this->teamId;
        }

        /**
         * @param mixed|null $teamId
         */
        public function setTeamId( $teamId): void
        {
            $this->teamId = $teamId;
        }

        /**
         * @return mixed|null
         */
        public function getWeaponId()
        {
            return $this->weaponId;
        }

        /**
         * @param mixed|null $weaponId
         */
        public function setWeaponId( $weaponId): void
        {
            $this->weaponId = $weaponId;
        }

        
        
    }