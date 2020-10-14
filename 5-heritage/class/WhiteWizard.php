<?php
    /*
     * La classe WhiteWizard étend la classe Wizard :
     * elle a donc toutes les propriétés et méthodes de Wizard
     * mais comme Wizard étend Character, WhiteWizard hérite aussi de Character
     */
    class WhiteWizard extends Wizard
    {
        public function healEverybody() {
            echo "Alleluia Mes amis<br>";
        }
    }