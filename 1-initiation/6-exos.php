<?php
   /*
    * Exo 1 :
    * A partir d'une date de naissance : année, mois, jour
    * Calculer l'âge (en années et uniquement en années) correspondant
    *
    */
    $currentYear = date('Y');
    $currentMonth = date('m');
    $currentDay = date('d');

    /*
     * Exo 2 : afficher la table de multiplication d'un nombre contenu
     * dans une variable :
     * 1 * 3 = 3
     * 2 * 3 = 6
     * 3 * 3 = 9
     * ...
     * 9 * 3 = 27
     */
    $nb = 3;





/*

Variables
	anneeActuelle : entier
moisActuel : entier
jourActuel : entier
anneeNaissance : entier
moisNaissance : entier
jourNaissance : entier
age : entier
Début Algo
	anneeActuelle = year()
moisActuel = month()
jourActuel = day()
Lire anneeNaissance
Lire moisNaissance
Lire jourNaissance

// version 1
SI moisActuel < moisNaissance
	// anniv pas passé
	age = anneeActuelle - anneeNaissance - 1
FIN SI

SI moisActuel > moisNaissance
	// anniv passé
	age = anneeActuelle - anneeNaissance
FIN SI

SI moisActuel == moisNaissance
	SI jourActuel < jourNaissance
		// pas passé
age = anneeActuelle - anneeNaissance - 1
	FIN SI
	SI jourActuel >= jourNaissance
		// passé
		age = anneeActuelle - anneeNaissance
	FIN SI
FIN SI

// version 2
SI moisActuel < moisNaissance
	age = anneeActuelle - anneeNaissance – 1
SINON SI moisActuel > moisNaissance
	age = anneeActuelle - anneeNaissance
SINON SI moisActuel == moisNaissance
	SI jourActuel < jourNaissance
age = anneeActuelle - anneeNaissance - 1
	SINON
age = anneeActuelle - anneeNaissance
	FIN SI
FIN SI

// version 3
age = anneeActuelle - anneeNaissance
SI moisActuel < moisNaissance
	age = age – 1
SINON SI moisActuel == moisNaissance ET jourActuel < jourNaissance
		age = age - 1
FIN SI
 

// version 4
age = anneeActuelle - anneeNaissance
SI moisActuel < moisNaissance OU (moisActuel == moisNaissance ET jourActuel < jourNaissance)
	age = age - 1
FIN SI
Fin Algo

 */
?>