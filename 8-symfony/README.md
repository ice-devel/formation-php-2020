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
