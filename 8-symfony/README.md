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
Le controller doit obligatoirement retourner un objet Response.

Générer un controller en ligne de commande :
php bin/console make:controller

Les routes sont de préférences déclarées grâce aux annotations.
L'annotation doit se trouve juste au dessus de la fonction qui sera appelée
si l'url correspond.

## 1-bis Routing
Un controller est appelé si le composant routing fait un lien entre l'URL et un pattern défini dans la route.

Les patterns peuvent avoir des paramètres dynamiques :
/edit-post/{id}
Ici {id} est un paramètre d'URL dynamique, qu'on va pouvoir récupérer
dans le controller (il va injecter dans la variable $id).

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

### 1 - Création d'entité
On va modéliser nos entités par des classes d'objets, et on laisse Doctrine (ORM) faire les intéractions
avec la base de données grâce à un mapping.
    1 - Configurer les accès à la base dans .env :
        DATABASE_URL
    2 - Créer la base de données
        php bin/console doctrine:database:create
    3 - Créer une entité 
        php bin/console make:entity
    4 - Mettre à jour la bdd
        php bin/console doctrine:schema:update --force
       
### 2 - Utilisation des entités
Dans un controller, on a besoin d'une entité : il faut utiliser Doctrine pour récupérer une entité
ou l'instancier pour créer une nouvelle entité.

#### Pour enregistrer une entité :
    - récupération du manager de doctrine
    - persist (prise en compte de l'objet par doctrine)
    - flush (envoi en bdd)
    - après un insert, l'id de l'objet est automatiquement setté
    
#### Pour récupérer une ou des entités :
    on récupère des entités en passant par les Repository associés aux entités que l'on veut récup.
    - findAll() : récupérer toutes les entités
    - find() : pour récupérer une entité par son id
    - findBy : récupérer des entités en ajoutant des conditions
    - findOneBy : récupérer une entité grâce à des conditions

Mais on peut aussi créer nos propres méthodes de récupération dans le repository associé.
Quand on génère une entité avec la commande make, un repo est toujours automatiquement créé,
et propose deux exemples en commentaires : un pour récup plusieurs entité,
un autre pour récup une seul entité.

#### Relation entre entité :
    - OneToMany / ManyToOne
    - ManyToMany
    - OneToOne
    
#### Cycle de vie des entités
6 événements lancés par Doctrine :
    - avant et après un insert : prePersist / postPersist
    - avant et après un update : preUpdate / postUpdate
    - avant et après un delete : preRemove / postRemove

## Formulaires

Pour "hydrater" une entité, on passait avant par un formulaire html,
puis on devait récupérer les valeurs une par une, les vérifier, instancier
un objet et puis enfin setter ses propriétés grâce aux valeurs récupérées.

Avec symfony, on va créer une classe Formulaire, que l'on va associer à une entité.
    1- Créer une entité (console make:entity)
    2- Créer le formulaire associé (console make:form)
    3- Dans le controller on va instancier ce formulaire
    (4-) Quand on a validé le formulaire, le composant Form aura mis l'entité automatiquement
    5- Passer ce formulaire à la vue

Dans le controller précisément, pour créer une entité :
    1- Instanciation de l'entité
    2- Création du form et association avec l'entité 
    3- Est-ce que le form est soumis et valide ?
    4- Si oui : enregistrement en bdd avec manager
    5- Passer le FormView à la vue ($form->createView())

### Afficher le formulaire dans un template
1 - Afficher en une fois :
```
    {{ form(formPost) }}
```
2 - Afficher champs par champs
```
    {{ form_row(formPost.description) }}
```
3- Afficher élément de champ par élément de champ (widget, label, errors)
```
    {{ form_errors(formPost.description) }}
    {{ form_widget(formPost.description) }}
    {{ form_label(formPost.description) }}
```
4- Personnaliser chaque élément grâce à des options
```
    {{ form_widget(formPost.description, {'attr': {'class': 'la_classe_html_du_widget'}}) }}
```

Exercice :
Il faut maintenant créer les utilisateurs dans notre application.
- Créer l'entité User (nom, email, isEnabled, createdAt, liste de Posts)
- Mettre à jour la base
- Créer le formulaire pour les users
  (sans date de création ni qqch concernant les posts)
- Créer un controller USER
    - une méthode pour afficher tous les users de la base
    - une méthode pour créer un user via un formulaire

## Messages flash
Les messages flash sont des messages destinés à n'être affichés qu'une seule fois. Ils sont pratiques lors du CRUD
des entités. Un message flash et un message mis en session, et supprimé de la session automatiquement dès lors
qu'il a été affiché une fois.

Créer un message flash dans un controller

```
$this->addFlash("type", "le message à afficher");
```

Afficher un message dans un template
```
{% for label, messages in app.flashes %}
    {% for message in messages %}
        <div class="alert alert-{{ label }}" role="alert">
            {{ message }}
        </div>
    {% endfor %}
{% endfor %}
```


    

