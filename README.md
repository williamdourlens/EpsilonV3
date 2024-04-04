# Epsilon

Plateforme de peer-learning permettant de s'authentifier et d'uploader des fichiers.

## Composants

Créé avec Symfony, notre projet utilise de multiples composants :
- Twig
- Tailwind CSS
- Doctrine.

## Installation

Pour installer le projet, il faut exécuter des commandes :
- `composer install`
- `npm install`

Il faut ensuite exécuter ces commandes après avoir lancé un serveur local (XAMPP/WAMPP..) pour créer la BDD :
- `php bin/console doctrine:database:drop --force --if-exists`
- `php bin/console doctrine:database:create`
- `php bin/console make:migration`
- `php bin/console doctrine:migrations:migrate`

## Lancement

Pour lancer le projet, il faut suivre certaines étapes :
- Premièrement, lancez votre serveur local.
- Exécutez la commande `php -S 127.0.0.1:8000 -t public`
- Exécutez la commande `npm run watch`
Après ça, allez sur votre navigateur et dirigez vous sur l'adresse `localhost:8000`
