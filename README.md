# RPGptApi
Cours api/sql avec openAI

# Projet Laravel avec Laravel Sail et Laravel Sanctum - Guide d'installation

Laravel 8.83.27 utilisant Laravel Sail et Laravel Sanctum.

## Prérequis

- [Docker](https://www.docker.com/)

## Étapes d'installation

1. Clonez le référentiel du projet depuis GitHub :

```bash
git clone https://github.com/TheoPasquier/RPGptApi.git
```

2. Accédez au répertoire du projet :

```bash
cd api_1
```

3. Copiez le fichier d'exemple `.env.example` et renommez-le `.env` :

```bash
cp .env.example .env
```

4. configurer le `.env` si besoin.

5. Générez une clé d'application Laravel :

```bash
php artisan key:generate
```

6. Installez les dépendances du projet à l'aide de Composer :

```bash
composer install
```

7. Lancez les conteneurs Docker avec Laravel Sail :
(possibilité de mettre un alias sail dans le ~/.bashrc)
```bash
./vendor/bin/sail up -d
```

8. Exécutez les migrations de la base de données :

```bash
./vendor/bin/sail artisan migrate
```

9. Générez les clés de chiffrement pour Laravel Sanctum :

```bash
./vendor/bin/sail artisan key:generate --force
./vendor/bin/sail artisan config:cache
```

10. Vous pouvez maintenant accéder à votre application Laravel via l'URL suivante : [http://127.0.0.1](http://127.0.0.1)

11. Vous pouvez également accéder à l'interface de ligne de commande de Laravel Sail en exécutant la commande suivante :

```bash
./vendor/bin/sail shell
```

Cela vous permettra d'exécuter des commandes Artisan et d'autres commandes utiles à l'intérieur du conteneur Docker.

## Conclusion
Le projet Laravel 8 devrait être installé et fonctionnel
