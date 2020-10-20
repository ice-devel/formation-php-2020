# Symfony
## I - Présentation
Editeur : SensioLabs - Fondateur : Fabien Potencier

Framework - Cadre de travail :
- Imposer une structure / façon de coder
- Offrir des composants pré-faits :
    (Ne pas réinventer la roue / Don't reinvent the wheel)
- Basé sur du MVC
- Concurrents : ZendFramework, Laravel, CakePHP
- Différent d'un CMS Content Manager System (Wordpress - Joomla - Prestashop)

Avantages :
    - Accélération du développement / gain de temps
    - Avoir à disposition des bibliothèques éprouvés
    - + de sécurité, + de facilité
    - Evolutivité et maintenance
    - Travail en équipe amélioré
    
Inconvénients :
    - Pas réservé à des novices
    - Courbe d'apprentissage

## II - Installation
Pré-requis:
- Serveur web, php, sgbd (apache, php, mysql)
- Composer (gestionnaire de dépendance) : https://getcomposer.org/download/
- Symfony installer : https://symfony.com/download
- mettre php, composer et symfony dans la variable d'environnement PATH

Installation: 
- symfony new nom_projet
- Se placer dans le projet en ligne de commande et taper : symfony server:start

Ou alors récupération d'un projet existant depuis git
- git clone url_projet

Si vous travaillez avec Apache : 
    - il faudrait créer un vhost : associer un nom de domaine à un projet
    - Pensez ç installer le recipe : apache2-pack
    
### III - Architecture
- bin : console (faire des commandes dans le projet)
- config : configuration des bundles, des composants
- public : seul dossier accessible depuis le navigateur
    - index.php: front controller (le point d'entrée de l'application)
- src : notre code source, le dossier où on va passer le plus de temps
- var : cache, log
- vendor : bibliothèque externe - third party - on ne touche jamais à rien dans ce dossier
- .env : paramètres globaux à l'application (variable d'environnement),
    qu'on peut configurer au niveau de l'OS, du serveur, ou de symfony
- composer.json : la configuration du projet et de ses dépendances
- templates : créé avec la dépendance twig : on y placera toutes les vues (html)

### IV - Utilisation
On ne crée pas un fichier par page, on va créer des routes qu'on va correspondre à un controller :

## 1 - Controllers
Le controller est un point d'entrée, il faut définir une route pour chaque méthode.

Générer un controller en ligne de commande :
php bin/console make:controller

Les routes sont de préférences déclarées grâce aux annotations.
L'annotation doit se trouve juste au dessus de la fonction qui sera appelée
si l'url correspond.

## 1-bis Routing

## 2 - Templates
Par défaut, les templates sont générés avec twig dans symfony.
Twig est ce que l'on appelle un moteur de template (template engine).

Dans un controller, on a accès à $this->render(), elle prend deux paramètres :
- le chemin du fichier "vue" depuis le dossier templates
- des paramètres : tableau associatif dont les clés seront les noms des variables dans le template

- Dans le template, on peut alors utiliser ces variables
    - Afficher une variable : {{ nom_variable }}
    - Commentaire : {# ici mon commentaire #}
    - Faire quelquechose (condition, boucle) : {%  %}
    
- Hériter d'un template avec extends
    - reprendre le contenu du template parent, et pouvoir modifier le contenu des blocks qui s'y trouvent
    - on peut redéfinir les blocks dans l'ordre que l'on veut
    - on peut reprendre le contenu du bloc parent grâce à la fonction "parent()"

- Inclure des assets (css/js/images) dans un template : La fonction asset() pour générer automatiquement l'url vers un fichier

- accéder aux propriétés d'un objet passé à un template : on peut écrire {{ objet.property }}
 En réalité la propriété ne va appelée directement mais :
    - vérifie si objet est un tableau, et property une clé valide de ce tableau : $objet['property']
    - ensuite si finalement c'est un objet, vérifie si property est un attribut valide (existant et public : $object->property)
    - Sinon, vérifie si property() est une méthode valide :  $object->property()
    - Sinon, vérifie si getProperty() est une méthode valide : $object->getProperty()
    - Sinon, vérifie si isProperty(), hasProperty() valide
    - Sinon, regarde si __call est définie
    - Sinon bug
    
## 3 - Entités
Ce sont les données qu'on veut persister, qui représente le côté "métier" de notre application. Par ex pour un site e-commerce :
produit, commande, compte client, etc.

1 - Création d'entité : on va modéliser nos entités par des classes d'objets, et on laisse Doctrine (ORM) faire les intéractions
avec la base de données grâce à un mapping.
    1 - Configurer les accès à la base dans .env :
        DATABASE_URL
    2 - Créer la base de données
        php bin/console doctrine:database:create
    3 - Créer une entité 
        php bin/console make:entity
    4 - Mettre à jour la bdd
        php bin/console doctrine:schema:update --force
        
2 - Utilisation des entités
Dans un controller, on a besoin d'une entité : il faut utiliser Doctrine pour récupérer une entité
ou l'instancier pour créer une nouvelle entité.

Pour enregistrer une entité :
    - récupération du manager de doctrine
    - persist (prise en compte de l'objet par doctrine)
    - flush (envoi en bdd)
    - après un insert, l'id de l'objet est automatiquement setté
    
Pour récupérer une ou des entités : on récupère des entités en passant par les Repository associés
aux entités que l'on veut récup.
    

    



    

