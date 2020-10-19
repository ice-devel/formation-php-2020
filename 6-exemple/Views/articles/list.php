<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vue : liste des article</title>
</head>
<body>
    <!-- affichage de tous les éléments (articles / menu) -->
    <?php
        $elements = $page->getElements();

        foreach ($elements as $ele) {
            $ele->render();
        }
    ?>
</body>
</html>
