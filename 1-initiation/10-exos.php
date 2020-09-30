<?php
   /**
    * Pour chaque exercice, écrire la fonction, puis l'appeler dans le script au moins une fois
    * Exo 1 :
    * Ecrire une fonction qui dit bonjour.
    *
    * Exo 2 :
    * Ecrire une fonction qui dit bonjour suivi d'un prénom
    * qui sera passé en paramètre
    *
    * Exo 3 :
    * Ecrire une fonction qui retourne le carré d'une valeur
    * passée en paramètre
    *
    * Exo 4 :
    * Ecrire une fonction qui prend en paramètre une année de naissance
    * et retourne l'age correspondant(calcul simple sans se préoccuper
    * de savoir si l'anniversaire est passé)
    *
    * Exo 5 :
    * Ecrire une fonction qui prend en paramètre une année, un mois, un jour
    * de naissance, et qui retourne l'âge correspondant
    * en se souciant de savoir si l'anniversaire est passé ou non
    **/

    /**
     * Exo 6 :
     * Créer une fonction qui prend en paramètre un tableau de string
     * Et qui retourne une chaine qui correspond à tous les éléments du tableau
     * concaténés ensemble
     *
     * Exo 7 :
     * Créer une fonction qui prend en paramètre un tableau (d'entier)
     * et qui retourne la valeur la plus grande qui s'y trouve
     * [3, 5, 7, 2, 7]
     */

    function getMax($tabInts) {
        $max = $tabInts[0];
        foreach ($tabInts as $int) {
            if ($int > $max) {
                $max = $int;
            }
        }

        return $max;
    }

    $ages = [10, 25, 59, 49];
    $ageMax = getMax($ages);

    $points = [10, 400, 1000, 999];
    $pointMax = getMax($points);
