# MenuCraft Project

[![Symfony](https://img.shields.io/badge/Symfony-7.x-green)](https://symfony.com/)
[![PHP](https://img.shields.io/badge/PHP-8.3-blue)](https://www.php.net/)
[![Docker](https://img.shields.io/badge/Docker-Compose-blue)](https://www.docker.com/)

**MenuCraft** est une application web pédagogique développée avec Symfony 7 et PHP 8.3, utilisant Docker pour l'environnement de développement. Ce projet a pour objectif d'apprendre les bases de Symfony tout en construisant une application de gestion de menus pour restaurants.

## Prérequis

Assurez-vous d'avoir les outils suivants installés sur votre machine :

- Docker
- Docker Compose
- Make (optionnel, pour utiliser les commandes facilitées)

## Installation

1. **Cloner le dépôt**

   ```bash
   git clone https://github.com/yhammououali/menucraft.git
   cd menucraft
   ```

2. **Configurer l'environnement Docker**

   Assurez-vous que Docker est en cours d'exécution et lancez :

   ```bash
   make up
   ```

   Cela démarrera les conteneurs Docker requis en arrière-plan.

3. **Installer les dépendances PHP**

   Pour installer les dépendances PHP avec Composer, exécutez :

   ```bash
   make composer-install
   ```

4. **Configurer la base de données**

   Pour créer la base de données et appliquer les migrations, exécutez :

   ```bash
   make db-setup
   ```

   Cela configurera la base de données `menucraft` et chargera les fixtures initiales.

5. **Configurer le fichier .env**

   Assurez-vous que le fichier `.env` contient les bonnes configurations, comme l'adresse Mailhog pour la capture des emails :

   ```dotenv
   MAILER_DSN=smtp://menucraft_mailhog:1025
   ```

## Utilisation

Une fois l'installation terminée, accédez à l'application via [http://menucraft.local](http://menucraft.local).

Pour arrêter l'application et les conteneurs Docker, exécutez :

```bash
make down
```

## Commandes Utiles

**Afficher les logs des conteneurs :**

```bash
make logs
```

**Afficher le statut des conteneurs :**

```bash
make status
```

**Rebuild des conteneurs (après des modifications dans le Dockerfile) :**

```bash
make build
```

**Se connecter au conteneur PHP :**

```bash
make start
```

**Vider le cache Symfony en mode développement :**

```bash
make cache-clear
```

**Exécuter les tests PHPUnit :**

```bash
make test-php
```

## Configuration des Services

Le projet utilise plusieurs services Docker pour ses différentes fonctionnalités :

- **Base de données MySQL** : Accessible sur le port `3306`.
- **Adminer** : Interface web pour MySQL, accessible sur [http://localhost:8081](http://localhost:8081).
- **PHP** : Conteneur pour exécuter l'application Symfony.
- **Nginx** : Serveur web pour servir l'application Symfony, accessible sur [http://menucraft.local](http://menucraft.local).
- **Mailhog** : Service de capture d'emails pour le développement, accessible sur [http://localhost:8090](http://localhost:8090).
