<?php
    class Team
    {
        private $id;
        private $name;
        private $level;

        /**
         * Team constructor.
         * @param $id
         * @param $name
         * @param $level
         */
        public function __construct($id=null, $name=null, $level=null)
        {
            $this->id = $id;
            $this->name = $name;
            $this->level = $level;
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
        public function getLevel()
        {
            return $this->level;
        }

        /**
         * @param mixed|null $level
         */
        public function setLevel( $level): void
        {
            $this->level = $level;
        }
    }