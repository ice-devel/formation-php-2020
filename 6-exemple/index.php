<?php
    /*
    Exercice MVC - héritage - interface
    // article 3 colonnes
    // article simple
    // article image

    // titre
    // description : simple et image
    // 3 descrition : article 3 colonnes
    // image : image

    On peut gérer en BO les articles et un menu avec onglets
    On peut afficher les articles, et on peut afficher le menu

    On a créé une classe abstraite Article pour centraliser la propriété title,
    On a créé trois autres concrètes pour représenter les trois types d'articles,
    qui hérite chacun de Article, pour ne pas avoir à réécrire la propriété title

    On a créé une interface Displayable, qui oblige l'implémentation de la méthode render :
    Tous nos éléments qui peuvent être affichés dans une page doivent l'implémenter
    car c'est cette méthode qu'on va utiliser dans le template pour afficher un élément

    On a fini par créé la classe Page qui possède une propriété élément.
    Dans cette propriété, il n'y a que des objets d'un certain type : des objets qui implémentent
    l'interface Displayable : on s'en est assuré en typant le paramètre de la méthode
    addElement(Displayable $el)
    */

/*
 * Front controller : réceptionne toutes les requêtes
 */
function loadClass($className) {
    $filename = "Controllers/".$className.".php";

    if (file_exists($filename)) {
        include $filename;
    }
    else {
        $filename = "Models/".$className.".php";
        if (file_exists($filename)) {
            include $filename;
        }
    }
}

spl_autoload_register('loadClass');

$url = $_SERVER['REQUEST_URI'];

$articleController = new ArticleController();
switch ($url) {
    case "/formation-php-2020/6-exemple/index.php":
    case "/formation-php-2020/6-exemple/index.php?list":
        $articleController->list();
        break;
    case "/formation-php-2020/6-exemple/index.php?insert":
        $articleController->insert();
        break;
    default:
        http_response_code(404);
}

?>

