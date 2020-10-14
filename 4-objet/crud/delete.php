<?php
    /**
     *  DELETE POO
     */
    // récupérer l'id du joueur qu'on veut éditer : on a passé son id dans l'URL
    $id = filter_input(INPUT_GET, 'id');

    // générer un code 404 si l'id n'est pas passé dans l'url
    if ($id == null) {
        header("HTTP/1.0 404 Not Found");
        die("Cette page n'existe pas");
    }

    $playerManager = new PlayerManager();
    $result = $playerManager->delete($id);

    $param = $result ? 'deleted-player='.$id : 'delete-error';

    // rediriger vers la page de liste en passant un paramètre
    // qui servira à afficher un message de confirmation
    header('Location: select.php?'.$param);
    exit;
?>