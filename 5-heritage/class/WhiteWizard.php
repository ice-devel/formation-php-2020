<?php
    /*
     * La classe WhiteWizard étend la classe Wizard :
     * elle a donc toutes les propriétés et méthodes de Wizard
     * mais comme Wizard étend Character, WhiteWizard hérite aussi de Character
     */

    /*
     * Classe finale : on ne peut pas hériter de cette classe
     */
    final class WhiteWizard extends Wizard
    {
        public function healEverybody() {
            echo "Alleluia Mes amis<br>";
        }
    }

    /*
     * Impossible : on ne peut pas hériter de whitewizard
     */
    // class YellowWhiteWizard extends WhiteWizard {}