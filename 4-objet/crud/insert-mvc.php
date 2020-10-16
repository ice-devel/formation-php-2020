<?php
    /**
     * INSERT MVC :
     * MVC : Model view controller
     * Models : Player - Team : les classes métiers
     *
     * Views : HTML : aucun code métier ou logique ou traitement ou connexion bdd :
     * uniquement l'affichage
     *
     * Controller : Orchestre l'ensemble des composants, point d'entrée : un controller
     * doit être le plus léger
     *
     */
    include('autoload.php');
    include('pdo.php');

    include('controllers/insert-controller.php');
    include("templates/form-insert.php");
?>


