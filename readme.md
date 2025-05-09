### Bienvenue dans symfoDemo

Ceci est un projet de démo, il sera transformée en espace CV personnel pour ma personne dans un futur relatif

En attendant vous pouvez lancer le projet après quelques étapes nécessaires à son bon fonctionnement

Vous devrez installer :
- Microsoft Visual C++ Redistributable pour Visual Studio 2022 (dépendance de PHP)
- PHP (8.4.7)
- Node.js (22.15.0)
- Symfony (7.2)
- MySql (8.0.42)

Ensuite vous devrez paramétrer votre MySql pour fonctionner sur le port 3306 et décommentez `extension=pdo_mysql` dans le fichier `php.ini`, sinon il faudra ajuster la ligne `DATABASE_URL` dans le fichier `.env`.


> Dummy session utilisée de base : local

> Dummy mdp utilisé de base : rootlocal!63

N'oubliez pas de lancer les commandes suivantes dans cet ordre à la racine du projet:
- `composer install`
- `npm install`
- `php bin/console doctrine:database:create`
- `php bin/console doctrine:migrations:migrate`
- `npm run build`
- `symfony server:start`

Vous pouvez enfin accéder au projet à l'adresse `127.0.0.1:8000` !