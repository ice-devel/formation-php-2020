<?php
    /*
    - Dans la BDD, créons une table "user" : id, username, password
    - Créer une page en html avec un formulaire pour enregistrer un utilisateur
    - Créer une autre page pour identifier un utilisateur (formulaire de connexion) :
    - si les identifiants sont bons, on va lui créer une variable de session,
    et lui afficher bonjour, sinon on va réafficher le formulaire d'erreur
    */
    session_start();

    // formulaire de création de compte soumis ?
    if (isset($_POST['btn-user'])) {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        if ($username != "" && $password != "") {
            $pdo = new PDO("mysql:host=localhost;dbname=formation_202008;", "root", "");
            $sql = "INSERT INTO user (username, password) VALUES (:username, :pass)";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([
                ':username' => $username,
                ':pass' => $password
            ]);
            $message = "Merci pour votre inscription";
        }
        else {
            $error = "Veuillez remplir les champs";
        }
    }

    // formulaire de login a été soumis ?
    if (isset($_POST['btn-login'])) {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        $pdo = new PDO("mysql:host=localhost;dbname=formation_202008;", "root", "");

        $sql = "SELECT * FROM user WHERE username = :username AND password = :pass";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':pass' => $password
        ]);

        // est-ce la requête renvoie un enregistrement ?
        if ($stmt->rowCount() == 1) {
            // un utilisateur correspond aux identifiants : on le connecte
            $_SESSION['user'] = $username;
        }
        else {
           // aucun utilisateur ne correspond : message d'erreur
            $errorLogin = "Mauvais identifiants";
        }
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
    <?php
        // si l'utilisateur est connecté, on lui dit bonjour
        if (isset($_SESSION['user'])) {
            echo "Bonjour ".$_SESSION['user'];
            echo " <a href='logout.php'>Déconnexion</a>";
        }
    ?>

    <h1>Création de compte</h1>
    <?php
        if (isset($error)) {
            echo $error;
        }

        if (isset($message)) {
            echo $message;
        }
    ?>
    <form method="post">
        <input type="text" name="username"/><br>
        <input type="password" name="password"/><br>
        <input type="submit" name="btn-user"/>
    </form>

    <h1>Connexion</h1>

    <?php
        if (isset($errorLogin)) {
            echo $errorLogin;
        }
    ?>
    <form method="post">
        <input type="text" name="username"/><br>
        <input type="password" name="password"/><br>
        <input type="submit" name="btn-login"/>
    </form>
</body>
</html>
