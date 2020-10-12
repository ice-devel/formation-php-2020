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

    /*
     * Structure d'expression régulière :
     * /pattern/options
     *
     * On construit l'expression caractère par caractères
     *
     * avec des caractères précis :
     * /salut/
     *
     * Classes de caractères (remplacé par un seul caractère)
     * [a-z] : lettres minuscules
     * [b-j] : lettre de b jusqu'à j
     *
     * [0-9] : chiffres de 0 à 9
     * [2-7] : chiffres de 2 à 7
     * [aeiou] : une des voyelles
     *
     * [a-z0-9A-Z] : lettres minuscules, chiffres ou majuscules
     * [1-34a-cj-] : de 1 à 3 ou 4 ou de a à c ou j ou tiret
     *
     * [^0-9] : tout sauf les chiffres de 0 à 9
     * [^a0-3i-p] : tous sauf le a, le 0 à 3, et le i à p
     *
     * Classe abrégées :
     * [0-9] : \d
     * [^0-9] : \D
     *
     * [a-zA-Z0-9_] : \w
     * [^a-zA-Z0-9_] : \W
     *
     * \n : saut de ligne
     * \t : tabulation
     * \s : espace
     * . : tout  (un seul caractère mais n'importe lequel sauf \n)
     *
     *  Quantificateurs :
     * ? : 0 ou 1 fois
     * + : 1 ou plusieurs fois
     * * : 0, 1 ou plusieurs fois
     * {3} : 3 fois
     * {3, 5} : min 3 max 5 fois
     * {3,} : min 3 fois
     * {,5} : max 5 fois
     *
     * (guitare|batterie|clavier|basse) : soit guitare, soit batterie, ...
     * (basse|flute){2}: basseflute ou bassebasse ou flutebasse ou fluteflute
     *
     *
     * Caractères spéciaux :
     * [] () + * ? ! ^ $
     * \
     *
     * Si on veut recherche le vrai caractère parmi les caractères spéciaux,
     * il faut l'échapper : \
     * a+(toto|tata)\[\\
     *
     * Commence par et termine :
     *
     * /^salut/ : commence par salut
     * /salut$/ : termine par salut
     * /^salut$/ : précisément le mot salut
     *
     * Parenthèses capturantes :
     * Les parenthèses servent
     * à décomposer les résultats de recherche, comme on l'a vu avec
     * preg_match_all dans le tableau $matches
     *
     *
     * Pourquoi les délimiteurs ?
     * / # @
     * /salut/i : insensible à la casse
     *
     * /salut/s : le ".", (le points) sert maintenant aussi pour les retours à la ligne : \n
     *
     * Attention les caractères utilisés comme délimiteurs deviennent des caractères
     * spéciaux, il faut les échapper si on les recherche comme caractère
     *
     * /sal\/ut/
     * @salut\@@
     *
     */





