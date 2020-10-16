<?php
    /*
     * Les exceptions / try catch
     */

    /*
    $exception = new Exception();
    throw $exception;
    */

    /**
     * Utilisation basique des exceptiosn avec les try catch
     */

    function add($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new Exception("Erreur d'addition");
        }

        return $a + $b;
    }

    // essayer d'exécuter des instructions
    try {
        // si jamais un des isntructions génère une exception
        // on peut l'error fatal d'être levée
        echo add(5, 10);

    }
    catch(Exception $exception) {

    }

    try {
        echo add("coucou", 19);
    }
    catch (Exception $e) {
        echo $e->getMessage()."<br>";
        echo "On ne peut additionner une chaine<br>";
        // envoyer un mail à l'admin
        // enregistrer l'erreur fatal
    }

    /**
     * Différents types d'exception
     */

    try {
        $pdo = new PDO("connecte-toi");
        add("coucou", 10);
    }
    catch (PDOException $e) {
        echo "Vérifie le dns du PDO<br>";
    }
    catch (Exception $e) {
        echo $e->getMessage()."<br>";
    }

    include('entity/Player.php');
    include('entity/PlayerException.php');

    $player = new Player();
    try {
        echo $player;
    }
    catch (PDOException $e) {
    }
    catch (PlayerException $e) {
        echo $e->displayErrorWithFinger();
    }
    catch (Exception $e) {
    }
    // bloc de code qui s'exécutera quoi qu'il arrive (erreur ou pas d'erreur)
    finally {
        echo "Test<br>";
    }



