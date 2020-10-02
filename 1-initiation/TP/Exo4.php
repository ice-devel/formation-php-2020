<?php
/*
    Exercice 4:

a) Créer un formulaire html, soumis en GET, avec ces champs:
- champ text : nom - obligatoire - trois caractères minimum
- champ text : date de naissance - obligatoire - format date français
- champ email : email - obligatoire - format email
- champ text : code postal - non obligatoire - format 5 chiffres
- champ text : telephone - non obligatoire - format 10 chiffres

b) forcer la validation html5 côté client avec les attributs adéquats (à vous de trouver comment faire pour 3 caractères minimum
et format 5 chiffres par exemple, indice : les attributs à utiliser sont “required” et “pattern”)

c) à la soumission du formulaire, vous devez :
- récupérer les différentes valeurs : vous pouvez voir que lorsqu’on valide le formulaire, les valeurs sont en fait envoyées dans l’URL (il faut avoir défini l’attribut html “name” pour chacun des champs). On peut donc les récupérer côté serveur en PHP avec la variable globale GET.
- vérifier si les valeurs sont valides en faisant les mêmes vérifications qui ont été faites avec les attributs HTML5 (obligatoire, pattern), mais côté serveur en PHP.
- si il y a des erreurs, il faut demander à l’utilisateur de saisir à nouveau, sinon afficher le message “Merci [Nom], vous êtes bien inscrit”.

*/


    // est-ce que le formulaire a été soumis ?
    if (isset($_GET['form-register'])) {
        // récupération des valeurs envoyées
        $name = $_GET['name'];
        $birthdate = $_GET['birthdate'];
        $email = $_GET['email'];
        $zipcode = $_GET['zipcode'];
        $phone = $_GET['phone'];

        // vérification des formats
        $errors = [];

        //if ($name == "" || strlen($name) < 3) {
        if (strlen($name) < 3) {
            $errors['name'] = "Votre nom n'est pas correct";
        }

        //if ($birthdate == "" || preg_match("#\d{2}/[0-9]{2}/\d{4}#") == 0) {
        //if (preg_match("#\d{2}/[0-9]{2}/\d{4}#") == 0) {
        if (!preg_match("#\d{2}/[0-9]{2}/\d{4}#", $birthdate)) {
            $errors['birthdate'] = "Votre date n'est pas correcte";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Votre adresse email n'est pas correcte";
        }

        if ($zipcode != "" && !preg_match("/\d{5}/", $zipcode)) {
            $errors['zipcode'] = "Votre code postal n'est pas correct";
        }

        if ($phone != "" && !preg_match("/0\d{9}/", $phone)) {
            $errors['phone'] = "Votre téléphone n'est pas correct";
        }

        if (count($errors) == 0) {
            // enregistrement en bdd
            // pas d'affichage ici car on est en dehors du html
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
    <title>Exo 3 Tp</title>
</head>
<body>
<?php
    // la variable errors existe seulement si on a validé le formulaire (et non la première fois
    // qu'on arrive sur la page)
    if (isset($errors)) {
        // pas d'erreur on affiche merci
        if (count($errors) == 0) {
            echo "<p>Merci $name vous êtes bien inscrit</p>";
        }
        // une ou plusieurs erreurs : on affiche les messages d'erreur
       else {
           echo "<ul>";
           foreach ($errors as $error) {
               echo "<li>".$error."</li>";
           }
           echo "</ul>";
       }
    }
?>
    <form method="get" action="">
        <label>Nom</label>
        <input type="text" required minlength="3" name="name"/>
        <?php
            if (isset($errors['name'])) {
                echo $errors['name'];
            }
        ?>
        <br>
        <label>Date de naissance</label>
        <input type="text" required placeholder="jj/mm/aaaa" pattern="\d{2}/[0-9]{2}/\d{4}" name="birthdate"/>
        <br>
        <label>Email</label>
        <input type="email" required name="email"/>
        <br>
        <label>Code postal</label>
        <input type="text" pattern="\d{5}" name="zipcode"/>
        <br>
        <label>Téléphone</label>
        <input type="text" pattern="0\d{9}" name="phone"/>
        <br>
        <input type="submit" name="form-register" />
    </form>
</body>
</html>
