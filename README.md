# Blog 

Projet 5 - Parcours Développeur d'application - PHP / Symfony
Openclassrooms

## Installer le projet

* Créer une base de données locale nommée "blog " et y importer le fichier blog.sql  
* Cloner le projet disponible sur Github  https://github.com/Vincent-gv/blog et l’ajouter dans le dossier des projets de votre environnement de serveur apache local en utilisant la commande :
``$ git clone https://github.com/Vincent-gv/blog.git``  
* Apache server 2.4 ou supérieur.  
* Version PHP 7 ou supérieure.  
* Dans le dossier blog\src\Config\ mettre à jour le fichier Parameters.php avec les identifiants de connexion à votre base de données locale.  
* Exécuter ``$ composer install`` à la racine du dossier pour installer les dépendances.  
* Créer un virtual host « blog » qui pointe vers le dossier blog/public  
* L’adresse locale du projet dans le navigateur est localhost/blog  
* Pour tester le projet, connectez-vous à l’admin blog/admin avec l’identifiant : admin@admin.com et le mot de passe 123456789  
* Modifier et utiliser vos clés API Google pour l’utilisation du Captcha dans le dossier blog/Util/Captcha.php  
* Pour recevoir les messages des formulaires de contact, remplacer l’adresse mail indiquée dans le fichier blog\src\Controller\ContactController.php dans la variable $recipient.  

Démo en ligne à cette adresse : https://vincent.dev.com
