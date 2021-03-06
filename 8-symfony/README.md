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
        Ou utiliser le système de migration
        
#### Migrations
À préférer pour pouvoir revenir en arrière, et avoir une trace des requêtes/migrations qui ont lancées par le passé)
```
make:migration // créer une classe qui crée les requêtes pour mettre à jour la bdd
doctrine:migrations:migrate // lancer les requêtes en attente
```

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

## 4 - Formulaires

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

### Validation des entités
Il existe un service Validator dans symfony qui permet de valider une entité
(est-ce les données dans les propriétés de l'objets sont valides ou non)
Le service form.factory (celui qui permet de créer les formulaires), appelle
automatiquement le validator quand on fait
``` $form->handleRequest($request) ```

Il suffit de configurer nos entités avec les contraintes directement
dans les annotations (obligatoire, unique, regex) :
https://symfony.com/doc/current/reference/constraints.html

Si une contrainte n'existe pas, vous pouvez également créer votre propre
contrainte :
https://symfony.com/doc/current/validation/custom_constraint.html

### Messages flash
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

Exercice :
Modifier la page homepage pour afficher les posts du plus récent au plus vieux
Ajouter dans le template les informations concernant le user auquel appartient le post
PostRepository : comment créer une requête qui trie les enregistrements ?
I dont know ? Then :
You to Google : symfony doctrine order by please
Google : it's easy, you have to code this bitch :

Puis au dessus de la liste des postes, afficher le formulaire de création de post
Codez la validation côté du serveur pour les posts :
- Description : au moins 20 caractères

### Requête Ajax
Une requête ajax est une requête HTTP qui s'exécute en arrière-plan : il n'y a pas de rechargement de page pendant que
l'on contacte le serveur.
Ce qui permet d'avoir une application dynamique. L'utilisateur peut continuer d'utiliser le site ou l'appli pendant que l'on
envoie ou demande des choses au serveur.

On utilise javascript pour faire ceci. Il faut envoyer une requête puis écouter "onreadystatechange" pour lancer une fonction
JS quand le serveur aura fini de traiter la requête et obtenir sa réponse.

### Génerer un crud
Il existe une commande dans le MakerBundle pour générer un crud entier sur une entité
(controller, template, form, route) :
```php bin/console make:crud```

### Options des formulaires
On peut configurer des options dans le FormType :
 - le type de champ html à utiliser
 - le label à afficher
 - ajouter des contraintes de validation
 - non mapped

#### Champs non mapped
On peut insérer des champs dans un formulaire même si ce ne sont pas des propriétés mappées (qui ont une équivalence en bdd).
Il suffit de renseigner ```['mapped' => false]``` dans les options du champ de formulaire.

On l'a utilisé par exemple dans le UserType pour le plainPassword.
 
### Relations entre entités dans les formulaires
- manyToOne
    - association avec entités existantes : EntityType
    - création d'une entité (un formulaire inbriqué) : FormType (nos forms à nous)
- manyToMany  / oneToMany
    - association avec entités existantes : EntityType
    - création d'une ou plusieurs entités (un ou plusieurs formulaires inbriqués) : CollectionType.
     Pour cette partie, il faut obligatoirement gérer avec du javascript l'ajout dynamique de form dans la page.
    https://symfony.com/doc/current/form/form_collections.html
 
## 5 - Sécurité / Authentification
composer require security

Dans symfony, l'authentification et les sessions utilisateurs sont gérées par un composant
qu'il va falloir configurer : la config se trouve dans le fichier config/packages/security

TOUT EST EXPLIQUE ICI, LISEZ AS, READ IT :
https://symfony.com/doc/current/security.html

La tâche est facilitée grâce à deux commandes. Il faut créer une entité capable d'être connectée
(un User) et un système d'authentification (Guard authenticator).
```php bin/console make:user```
```php bin/console make:auth```

Il faut ensuite configurer dans le fichier security.yaml les routes que l'on veut protéger.
On peut protéger toutes les routes du site, ou par exemple uniquement le back-office :
on fait ceci en configurant la clé "pattern" du firewall.

On peut ensuite décider route par route dans la section "access_control" si il
faut un rôle particulier pour accéder à une page en particulier.

On peut aussi vérifier si l'accès est autorisé grâce aux annotations @IsGranted
pour un controller en entier, ou pour juste certaines méthodes dans un controller.
Il faut installer :
```composer required sensio/framework-extra-bundle```

### Accéder à l'utilisateur connecté
#### Dans un controller :
```$this->getUser()```

#### Dans un template :
```{{ app.user }}```

### Vérifier les rôles du user connecté 
#### Dans un controller
```$this->isGranted("ROLE_A_TESTER")```

### Dans un template
``` {% if is_granted("ROLE_A_TESTER")```

### Voters
Les voters permettent de vérifier des régles métier avant d'effectuer une action sur une entité.
Au lieu d'avoir les vérifications, on les mets dans des classes Voters qui seront automatiquement utilisées
lors d'un ```$this->denyAccessUnlessGranted``` dans un controller.

Un voter ne se déclenche que pour un seul type d'entité, mais on peut créer plusieurs voters pour un même type d'entité.

On peut également attribuer une stratégie de décision d'accès :
(un seul voter suffit ou tous les voters ou plus de voters qui disent oui que non...)
https://symfony.com/doc/current/security/voters.html

## Après un GIT PULL
composer update
php bin/console doctrine:schema:update --force

## 6 - Services
Un service est une classe qui offre une fonctionnalité particulière.
On découpe nos fonctionnalités dans des classes (single responsibility principle), et on 
va les charger dans un container de service.

Le service est maintenant accessible via le container.
Le container permet :
    - d'instancier les services pour nous (et s'il est déjà instancié, il retourne l'instance existante)
    - de gérer les dépendances à d'autres services pour nous (qui seront passés dans le controller)

## 7 - Déploiement :
- achat nom de domaine : faire pointer vers le serveur qui va héberger les applications/sites symfo
- configurer serveur web (apache, php, mysql)
- déployer l'application sur le serveur :
    - se placer dans le dossier où on veut placer le projet
    - git clone __URL__
    - composer update
    - configurer le .env.local si nécessaire (accès bdd, etc.)
    - php bin/console doctrine:database:create
    - php bin/console doctrine:migrations:migrate
    - importer les données (de prod ou fixtures)
- mise à jour du projet
    - se placer dans le dossier du projet
    - git pull
    - php bin/console cache:clear --env=prod

Paramètres de l'application :
- Soit des variables d'environnements (OS, serveur web, symfony .env)
- Soit les paramètres dans services.yaml

## Uploads de fichier
- Créer un service d'upload
- Créer une propriété pour l'entité
- Ajouter un champ non mappé dans le formulaire (FileType)
- Appeler le service d'upload dans le controller

https://symfony.com/doc/current/controller/upload_file.html#using-a-doctrine-listener

## Tests automatisés
On va utiliser l'outil PHPUnit pour PHP.
Pour lancer l'outil : php bin/phpunit

On va mettre en mettre des tests automatisés pour éviter les régressions
et pour :
- TDD : test driven development
Développement piloté par les tests
- Intégration continue et le déploiement continue

### Tests unitaires
### Tests fonctionnels

https://symfony.com/doc/current/testing.html

Tuto par Fabien Potencier :
https://symfony.com/doc/current/index.html
Symfony 5 : The fast track

bundle connus :
sonataadminbundle / easybundle
fosuserbundle
vichuploaderbundle
liipimaginebundle

POO :
traits

Pour aller plus loin  :
Traduction,
ParamConverter,
swiftmailer,
subscriber/listener




