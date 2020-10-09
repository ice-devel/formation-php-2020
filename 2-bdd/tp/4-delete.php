<?php
    /**
     *  DELETE
     */
    // récupérer l'id du joueur qu'on veut éditer : on a passé son id dans l'URL
    $id = filter_input(INPUT_GET, 'id');

    // générer un code 404 si l'id n'est pas passé dans l'url
    if ($id == null) {
        header("HTTP/1.0 404 Not Found");
        die("Cette page n'existe pas");
    }

    // connexion à la bdd
    $pdo = new PDO("mysql:host=localhost;dbname=formation_202008", "root");
    // requête sql de suppression
    $sql = "DELETE FROM product WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $result = $stmt->execute();

    if ($result == true) {
        $param = 'deleted-product='.$id;
    }
    else {
        $param = 'delete-error';
    }

    // rediriger vers la page de liste en passant un paramètre
    // qui servira à afficher un message de confirmation
    header('Location: 1-list.php?'.$param);
    exit;
?>