<?php
/*
    Exercice 3 :

- créer une page web avec trois liens, et un div
- chaque lien doit pointer vers cette même page,
mais en passant le paramètre GET "numero"
(vous pouvez passer des paramètres GET grâce à un lien : il suffit de
mettre dans l’attribut href quelque-chose comme monlien.fr?param=test).
Pour le premier lien, la valeur du paramètre “numero” doit être "page1",
pour le deuxième lien : "page2", pour le troisième “page3”
- lors du clic sur un des liens, le paramètre GET  doit être récupérée en PHP
lors du rechargement de la page, et sa valeur affichée dans le div
- voici un array contenant des articles : vous pouvez le copier dans votre code :
il faut ensuite afficher les articles dans la page. Mais il ne faut afficher
que 2 articles par page : les deux premiers si le parametre GET vaut “page1”,
les deux suivants s’il vaut “page2”, et les deux derniers s’il vaut “page3”
si le paramètre GET “numero” n’existe pas, il faut considérer qu’on est sur la
page 1
$articles = [
   ['nom' => 'Titre 1', 'description' => 'Description de article 1'],
   ['nom' => 'Titre 2', 'description' => 'Description de article 2'],
   ['nom' => 'Titre 3', 'description' => 'Description de article 3'],
   ['nom' => 'Titre 4', 'description' => 'Description de article 4'],
   ['nom' => 'Titre 5', 'description' => 'Description de article 5'],
   ['nom' => 'Titre 6', 'description' => 'Description de article 6'],
];

*/

if (isset($_GET['numero'])) {
    $numero = $_GET['numero'];
}
else {
    $numero = "page1";
}

$articles = [
    ['nom' => 'Titre 1', 'description' => 'Description de article 1'],
    ['nom' => 'Titre 2', 'description' => 'Description de article 2'],
    ['nom' => 'Titre 3', 'description' => 'Description de article 3'],
    ['nom' => 'Titre 4', 'description' => 'Description de article 4'],
    ['nom' => 'Titre 5', 'description' => 'Description de article 5'],
    ['nom' => 'Titre 6', 'description' => 'Description de article 6'],
];

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
    <a href="Exo3.php?numero=page1">Lien1</a>
    <a href="Exo3.php?numero=page2">Lien2</a>
    <a href="?numero=page3">Lien3</a>
    <div>
        <?= $numero; ?>
    </div>

    <?php
        if ($numero == "page1") {
            $article1 = $articles[0];
            $article2 = $articles[1];
        }
        elseif ($numero == "page2") {
            $article1 = $articles[2];
            $article2 = $articles[3];
        }
        elseif ($numero == "page3") {
            $article1 = $articles[4];
            $article2 = $articles[5];
        }
        else {
            echo "Cette page n'existe pas >:-(";
            exit;
        }

        echo "
            <article>
                <h1>". $article1['nom']."</h1>
                <p>". $article1['description']."</p>
            </article>
        
            <article>
                <h1>". $article2['nom']."</h1>
                <p>". $article2['description']."</p>
            </article>
            ";

        // autre solution plus dynamique
        if ($numero == "page1") {
            $debut = 0;
        }
        elseif ($numero == "page2") {
           $debut = 2;
        }
        elseif ($numero == "page3") {
           $debut = 4;
        }

        $fin = $debut + 1;

        for ($i=$debut;$i<=$fin;$i++) {
            echo "
             <article>
                <h1>". $articles[$i]['nom']."</h1>
                <p>". $articles[$i]['description']."</p>
            </article>
            ";
        }
    ?>

</body>
</html>
