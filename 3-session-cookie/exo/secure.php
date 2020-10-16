<?php
    session_start();
    //est-ce qu'on est connecté ?
    if (!isset($_SESSION['connected'])) {
        // soit redirection vers page de login
        // soit générer une erreur
        //      401 : not authorized : connecté mais qu'on a pas les droits
        //      403 : forbidden : pas connecté et donc interdit
        header('Location: login.php?not-connected');
        exit;
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Contenu protégé pour les admins
</body>
</html>
