<?php
    class PlayerException extends Exception {
        public function __construct($message = "Erreur personnalisé pour les Player", $code = 0, Throwable $previous = null)
        {
            parent::__construct($message, $code, $previous);
        }

        public function displayErrorWithFinger() {
            echo $this->getMessage()." avec le pouce";
        }
    }