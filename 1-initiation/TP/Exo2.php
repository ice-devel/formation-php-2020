<?php
/*
Exercice 2 :

- créer une fonction qui prend un paramètre obligatoire,
et un autre facultatif.
- Le premier paramètre sera une chaine et le deuxième un entier
- la fonction doit trouver le nombre de caractères du premier
paramètre
- puis elle doit retourner le nombre de caractères manquant
pour arriver au nombre défini par le second paramètre.
- Ce second paramètre doit avoir pour valeur par défaut 100
- si le nombre de caractères du premier paramètre est égal
ou supérieure à ce second paramètre, la fonction doit
renvoyer 0
- utiliser cette fonction dans un script en affichant :
Il manque [x] caractères pour que la chaine [chaine] arrive à [y] catactères.
Exemple : si le paramètre 1 a pour valeur “coucou”, et que le deuxième a pour valeur 100;
la fonction doit renvoyer 94 car la longueur de coucou est 6 et qu’il manque donc 94 caractères pour arriver à 100.
*/

function countRemainingChars($str, $limit=100) {
    $nbChars = strlen($str);
    $nbRemainingChars = $limit - $nbChars;

    if ($nbRemainingChars < 0) {
        $nbRemainingChars = 0;
    }

    return $nbRemainingChars;

    /*
    // V2
    $nb = $limit - $nbChars;
    if ($nb < 0) {
        return 0;
    }
    else {
        return $nb ;
    }
    */
}

$word = "bonjour";
$nbChars = countRemainingChars($word);
echo "Il manque $nbChars caractères pour que la chaine $word arrive à 100 caractères.<br>";

$word2 = "Coucou comment ça va ?";
$limit = 50;
$nbChars = countRemainingChars($word2, $limit);
echo "Il manque $nbChars caractères pour que la chaine $word2 arrive à $limit caractères.";
