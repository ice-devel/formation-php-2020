<?php
    /**
     * Upload de fichier
     */

    // vérif formulaire soumis ?
    if (isset($_POST['form-cv'])) {
        // récupération
        $name = filter_input(INPUT_POST, 'name');

        // les input type file ont été transférés dans le tableau FILES
        // $cv = filter_input(INPUT_POST, 'cv');

        $cv = $_FILES['cv'];
        //$otherFile = $_FILES['other_file'];

        // un fichier : 5 infos automatiquement récupérées par php
        // https://www.php.net/manual/fr/features.file-upload.post-method.php
        $filename = $cv['name'];
        $type = $cv['type'];
        $tmpName = $cv['tmp_name'];
        $error = $cv['error'];
        $size = $cv['size'];

        // vérifications
        $errors = [];

        // type MIME
        $acceptedFormats = ["application/pdf", "image/jpeg"];
        if (!in_array($type, $acceptedFormats)) {
            $errors['type'] = "Le type n'est pas accepté";
        }

        // la taille du fichier
        if ($size > 2097152) {
            $errors['size'] = "Le fichier est trop gros";
        }

        // https://www.php.net/manual/fr/features.file-upload.errors.php
        if ($error != 0) {
            $errors['error'] = "Une autre erreur";
        }

        if (count($errors) == 0) {
            // quel dossier ?
            $folder = "uploads/";
            // quel nom de fichier ?
            $finalFilename = uniqid()."-".$filename;
            // copier le fichier depuis le dossier temporaire vers
            // le dossier final d'upload
            move_uploaded_file($tmpName, $folder.$finalFilename);
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
    <h1>Formulaire d'upload</h1>
    <?php
        if (isset($errors) && count($errors) > 0) {
            foreach ($errors as $error) {
                echo $error."<br>";
            }
        }
    ?>
    <p>
        Penser à indiquer l'attribut enctype pour autoriser l'upload
    </p>

    <p>
        Configuration de PHP (dans le fichier php.ini) :
        - upload_max_filesize : taille maximum autorisée par PHP pour un fichier uploadé.
        Si un fichier est plus lourd, le tableau concernant ce fichier dans
        la variable $_FILES aura des valeurs vides.
        - post_max_size : taille totale de la requête POST autorisée
        - memory_limit : mémoire vive maximum pour PHP
    </p>

    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name"/>

        <!-- il est possible de faire ça mais c'est un peu pourri
        car il n'y a pas de message d'erreur côté client, le fichier sera envoyé au serveur -->
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
        <input type="file" name="cv" accept=".pdf,.jpg"/> (2mo max)

        <input type="submit" name="form-cv" value="Envoyer ma CV DE BG"/>
    </form>
</body>
</html>