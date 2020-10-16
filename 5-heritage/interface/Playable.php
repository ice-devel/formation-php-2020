<?php
    interface Playable {
        /*
         * Dans une interface , il ne peut y avoir des
         * méthodes sans corps, que des signatures
         *
         * Une classe qui implémente une interface doit redéfinir
         * toutes les méthodes de l'interface
         */
        public function move();
        public function heal();
    }