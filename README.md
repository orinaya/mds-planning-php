# mds-planning-php

mds-planning-php est une application web développée en PHP, Sass et JavaScript, conçue pour gérer des plannings. 
Le projet utilise Composer pour la gestion des dépendances PHP et npm pour les dépendances front-end.

## Table des matières


## Fonctionnalités

- Gestion des plannings (affichage desc cours, des modules)
- Affichage des formateurs
- Affichage des classes
- Affichage des années

## Architecture
Le projet a une structure MVC avec séparation claire entre le code source (`src/`), les fichiers publics (`public/`), la configuration (`config/`) et la base de données (`database/`).

## Prérequis

- PHP 7.4 ou supérieur
- Composer
- Node.js et npm

## Installer le projet

📂 Clônez le dépôt
```bash
# HTTPS
git clone https://github.com/orinaya/mds-planning-php.git

# SSH 
git clone git@github.com:orinaya/mds-planning-php.git
```

📦 Installer les dépendances PHP :
```bash
composer install
```

📦 Installer les dépendances frontend :
```bash
npm install

```
Compiler les fichiers Sass :
```bash
npm run build:css
```

## Structure du projet

    config/ : fichiers de configuration.

    database/ : scripts et fichiers liés à la base de données.

    public/ : fichiers accessibles publiquement (point d'entrée de l'application).

    src/ : code source de l'application.

    .htaccess : configuration pour le serveur Apache.

    composer.json : gestion des dépendances PHP.

    package.json : gestion des dépendances JavaScript.

## Utilisation

Après l'installation, configurez votre serveur web pour pointer vers le répertoire `public/` comme racine. Assurez-vous que les fichiers `.htaccess` sont pris en charge si vous utilisez Apache.
