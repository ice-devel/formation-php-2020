<?php
    session_start();

    if (isset($_POST['btn-login'])) {
        $username = filter_input(INPUT_POST, 'id');
        $password = filter_input(INPUT_POST, 'password');

        if ($username == "admin" && $password = "123") {
            $_SESSION['connected'] = "admin";
            header('Location: secure.php');
            exit;
        }
        else {
            $error = "Mauvais identifiants";
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
    if (isset($error)) {
        echo $error;
    }

    if (isset( $_SESSION['connected'])) {
        echo "Bonjour admin";
    }
    if (isset( $_GET['not-connected'])) {
        echo "Veuillez vous connecter avant d'accéder aux ressources sécurisées, na";
    }
?>
    <form method="post">
        <input type="text" name="id" />
        <input type="password" name="password" />
        <input type="submit" name="btn-login" />
    </form>
</body>
</html>
