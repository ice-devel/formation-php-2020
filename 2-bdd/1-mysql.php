<?php
    /**
     * Connexion à un SGBD en PHP
     */

    /*
     * old version mysql : n'est plus utilisé
     */
    /*
    // 1ère étape : connexion serveur bdd
    mysql_connect("localhost", "root", "");
    // 2éme étape : sélection de la bdd
    mysql_select_db("formation_202008");
    // 3ème étape : envoi des requêtes sql
    $sql = "SELECT * FROM player";
    $result = mysql_query($sql);
    */

    /**
     * 2eme version mysqli (procédurale ou objet)
     */
    // 1ere : connexion sereur bdd + choix bdd
    $db = mysqli_connect("localhost", "root", "", "formation_202008");

    // 2eme : envoi requête
    $sql = "SELECT * FROM player";
    // on récupère la ressource mysql
    $result = mysqli_query($db, $sql);

    // 3eme étape: récupérer les enregistrements pour les mettre dans
    // un tableau (array) : numérique ou associatif
    $players = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // 4eme étape : faire ce qu'on veut de ces enregistrements (afficher, modifier, etc.)

    /**
     * 3eme version : avec PDO (procédure ou objet)
     */
    // connexion
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202008;", "root", "");
    // requête
    $sql = "SELECT * FROM player";
    $statement = $pdo->query($sql);
    // traitement des résultats
    $players = $statement->fetchAll(PDO::FETCH_ASSOC);
    // affichage des players

    /*
     ** CRUD SQL : Create Read Update Delete
     *
     * SELECT * FROM nom_table
     * (WHERE conditions AND OR)
     * GROUP BY (HAVING)
     * ORDER BY
     * LIMIT
     *
     * INSERT INTO nom_table (nom_champ1, nom_champ2)
     * VALUES (valeur_champ1, valeur_champ2)
     *
     * UPDATE nom_table SET champ1 = valeur1, champ2 = valeur2
     * (WHERE conditions)
     *
     * DELETE FROM nom_table
     * (WHERE conditions)
     */
