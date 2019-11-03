#Peojet 5 - Créer un Blog
[![CodeFactor](https://www.codefactor.io/repository/github/captainfrak/projet5/badge)](https://www.codefactor.io/repository/github/captainfrak/projet5)

##1 Thème utilisé

https://github.com/BlackrockDigital/startbootstrap-clean-blog

Le thème utilisé pour la partie du front du site vient de Start Bootstrap.
Vous n'avez pas a télécharger quoi que ce soit.
En clonnant le projet sur github, vous recupererez le thème en même temps.

##2 DB INSTALL

Importez le fichier db_blog.sql dans votre administration SQL (phpmyadmin,etc).
Vous le trouverez dans le dossier Database du repository Github.


##3 Réglages

Le site fonctionne en local comme en ligne mais vérfiez bien ceci.
Dans System/Router.php il faudra changer le nom du domaine (par défaut il est reglé sur blog.local)

Pour tout changement par rapport a la connexion MYSQL, il faudra se rendre dans le fichier System/Database.php.

Après avoir cloner le projet sur votre machine, il vous faudra faire deux installations via composer

- doctrine/orm (dernière version)

- twig/twig (version 2.11 ou supérieure)

Ces installations sont indispensables pour que le site fonctionne.