URL Reducer API


DESCRIPTION

 L'API URL Reducer est un service simple qui permet de raccourcir les URLs.
 Elle stocke les URLs longues et leurs équivalents courts dans une base de données MySQL et fournit des endpoints pour créer de nouvelles URLs courtes et rediriger vers les URLs longues.


INSTALLATION

Tout d'abord, assurez-vous d'avoir installé un serveur web local (comme Apache ou Nginx) et un serveur de base de données MySQL sur votre ordinateur.
Clonez le dépôt GitHub contenant le code de l'API en utilisant la commande git clone suivie de l'URL du dépôt :

git clone https://github.com/Achrefffff/url_reducer.git


Une fois le projet cloné, naviguez dans le répertoire du projet :

-cd url_reducer  

-Créez une base de données MySQL et importez le schéma de la base de données à partir du fichier reducer.sql dans le répertoire du projet.  

-Copiez les fichiers de l'API dans le répertoire racine de votre serveur web local.(htdocs)  

-Ouvrez votre navigateur web et accédez à http://localhost/url_reducer pour accéder à l'interface utilisateur de l'API.  


UTILISATION

-Pour utiliser l'API, vous pouvez envoyer des requêtes HTTP à http://localhost/url_reducer/index.php et http://localhost/url_reducer/  

redirect.php avec les paramètres appropriés.  

-Mettez à jour les variables $servername, $username, $password, et $dbname dans les fichiers index.php et redirect.php avec les  

  informations   de votre base de données.

C'est tout ! Vous devriez maintenant être en mesure d'utiliser l'API URL Reducer sur votre ordinateur local.

CONTRIBUTION  

Les contributions sont les bienvenues ! Si vous souhaitez contribuer à ce projet, veuillez soumettre une pull request.