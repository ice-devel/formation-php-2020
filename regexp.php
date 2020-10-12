<?php
 /*
  * RegExp : expressions régulières / rationnelles
  *
  * Système permettant de faire des recherches dans les chaines de
  * caractères grâce à ce qu'on va appeler un "pattern"
  *
  * preg_match : chercher si une occurence correspond, et s'arrête dès la premiere
  * preg_match_all : cherchent toutes les occurences
  * preg_replace
  *
  * Une expression doit être délimité, grâce à un délimiteur :
  * / @ #
  * Le même délimiteur doit être utilisé au début à la fin.
  * Le délimiteur permettra notamment d'inscrire des options pour la regex
  */

    $str = "Coucou biloute, comment ça va biloute ?";

    // rechercher un mot dans un chaine
    // est-ce que le mot biloute se trouve dans la chaine $str
    $result = preg_match("/biloute/", $str);

    // la fonction va renvoyer false si la syntaxe est mauvaise
    // 0 si le mot n'est pas trouvé
    // 1 si le mot est trouvé
    var_dump($result);

    // la même avec preg_match_all : connaitre le nb de fois où le pattern correspond
    $result = preg_match_all("/biloute/", $str);
    var_dump($result);

    // recherche plus avancé : rechercher un format, par exemple
    // je veux si une adresse email se trouve dans une chaine
    $str = "Bonjour je m'appelle jean-jean et je te file mes emails : jeanjean@mail.fr et biloute@mail.fr";
    $result = preg_match("/[0-9a-z]+@[0-9a-z]{2,}\.[a-z]{2,}/", $str);
    var_dump($result);

    $result = preg_match_all("/[0-9a-z]+@[0-9a-z]{2,}\.[a-z]{2,}/", $str);
    var_dump($result);

    // si on a besoin de récupérer les occurences qui correspondent, on va utiliser le troisième paramètre
    // de la fonction &$matches
    $matches = [];
    $result = preg_match_all("/[0-9a-z]+@[0-9a-z]{2,}\.[a-z]{2,}/", $str, $matches);

    // le tableau $matches va être rempli avec les occurences correspondantes
    // à l'indice 0
    echo "<pre>";
    var_dump($matches);
    echo "</pre>";

    /*
     * preg_replace : remplacer les occurences par quelque-chose
     */
    $str = "Bonjour je m'appelle jean-jean et je te file mes emails : jeanjean@mail.fr et biloute@mail.fr";
    $replacedStr = preg_replace("/[0-9a-z]+@[0-9a-z]{2,}\.[a-z]{2,}/", "***", $str);
    echo "<pre>";
    var_dump($str);
    var_dump($replacedStr);
    echo "</pre>";

    /*
     * Parenthèses capturantes : remplacer en reprenant si besoin l'ancien valeur
     * On peut utiliser les variable $i :
     * $0 : l'occurrence elle-même en entier
     * $1 : le contenu des premières parenthèses capturantes
     * $2 : le contenu des deuxiemes
     * $3 : etc.
     */
    $str = "Coucou, va voir mon site : topachat.com et www.moncul.fr";
    echo $str."<br>";

    $pattern = "/(www\.)?([a-z0-9]+)(\.[a-z]{2,})/";
    preg_match_all($pattern, $str, $matches);
    echo "<pre>";
    var_dump($matches);
    echo "</pre>";
    $replacedStr = preg_replace($pattern, '<a href="http://$0">$2$3</a>', $str);
    echo $replacedStr;

    $str = "Coucou mes tels : 0645454545 et 0356565656 et 0734343434";
    $pattern = "/0(6|3|7)\d{8}/";
    preg_match_all($pattern, $str, $matches);
    echo "<pre>";
    var_dump($matches);
    echo "</pre>";







