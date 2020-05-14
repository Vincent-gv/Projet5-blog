# Blog 

Projet 5 - Parcours Développeur d'application - PHP / Symfony
Openclassrooms

Réalisation d'un blog Professionnel basé sur le modèle d'architecture MVC.

![screenshot](http://vincent-dev.com/img/screenshot.jpg)

## Installer le projet

### Prérequis  

* Apache server 2.4 ou supérieur.  
* Version PHP 7 ou supérieure. 

### Installation

* Cloner le projet sur Github  https://github.com/Vincent-gv/blog et l’ajouter dans le dossier des projets de votre environnement de serveur apache local avec la commande :
```
git clone https://github.com/Vincent-gv/blog.git
```
* Dans le dossier blog\src\Config\ mettre à jour le fichier Parameters.php avec les identifiants de connexion à votre base de données locale, votre mail pour les formulaires de contact et vos clés public et privée pour le Captcha Google et Google Map.  
* Exécuter ``composer install`` à la racine du dossier pour installer les dépendances.
* Créer une base de données locale nommée "blog " et importer le fichier blog.sql situé à la racine du projet  
* Pour vous connecter à l’admin utiliser l’identifiant : admin@admin.com et le mot de passe 123456789  

## Développé avec

* **PHP 7.3.3**
* **HTML5 & CSS**
* **Mysql**
* **Composer** 

## Auteur

**Vincent Gauchevertu** - Étudiant Openclassrooms 
https://github.com/Vincent-gv/

Démo en ligne : https://vincent.dev.com

## Badge du projet
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/005910e71c9541b9b40ea8a70335f0ae)](https://www.codacy.com/manual/Vincent-gv/blog?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Vincent-gv/blog&amp;utm_campaign=Badge_Grade)
