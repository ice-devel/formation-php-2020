<?php
	// commentaire de ligne
	
	/*
		Commentaire
		de
		bloc
	*/
	
	/* 
	PHP est un langage serveur 
	Le code source se trouve sur un serveur,
	et le client (un navigateur) n'a pas accès ce code : il n'en reçoit qu'une réponse.
	Une réponse peut-être : html / css / js, xml, json, texte
	*/
	
	/* 
		Echange client / serveur
		- un navigateur appelle une page (url)
		- le serveur web correspondant reçoit la demande
		- php (qui doit être installé) interprète le code de la page demandée, et génère une réponse
		- serveur web renvoie cette réponse au client
		https://sti2d.ecolelamache.org/client_serveur.png
	*/
	
	/*
		Technologies équivalentes :
		- JAVA (oracle)
		- ASP .NET (microsoft)
		- NodeJS (javascript)
		
		SGBD comme Mysql : MariaDB, Postgresql, SQL serveur, oracle
	*/
	
	/*
		Environnement de développement nécessaire :
		- un ordinateur
		- un IDE (un logiciel pour écrire du code : PHPStorm, VS Code, SublimeText, Notepadd++)
		- un serveur web (apache)
		- PHP
		- Base de données (mysql)
		: xampp (wamp, mamp, lamp)
		
		+
		- un terminal (git bash, hyper)
		- git : système de versionning
	*/
	
	/*
		- On lance apache : il écoute sur le port 80 (ou 443) constamment et traite les requêtes qui y arrive
	*/

	/* En HTML on fait des sites statiques : c'est toujours la même chose qui sera affichée
		Avec PHP, on va pouvoir faire des sites dynamiques : qui change en fonction de l'utilisateur,
		d'une condition, d'une date
	*/
	
	// 1ère instruction : dire bonjour
	echo "Bonjour";
	echo "Bonjour2";

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<p>Bonjour3</p>

	<?php
	echo "<p>Nous sommes le ".date("d/m/Y H:i:s")."</p>"
	?>

	<form>
		<input type="text" required/>
		<input type="submit" />
	</form>
</body>
</html>