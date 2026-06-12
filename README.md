# ECF - Auto École du Lycée (AEL)

Application de gestion interne pour une auto-école, développée avec Symfony 8.1 et SQL Server.

## Fonctionnalités

- Gestion des élèves (inscription, suivi code/conduite)
- Gestion des moniteurs et des véhicules
- Prise de rendez-vous (leçons de conduite)
- Statistiques de l'année en cours
- Mentions légales

## Prérequis

- PHP 8.4+
- Composer
- SQL Server avec les drivers PHP `pdo_sqlsrv` et `sqlsrv` installés
- Symfony CLI

## Installation

Installer les drivers PHP SQL Server

https://learn.microsoft.com/fr-fr/sql/connect/php/download-drivers-php-sql-server

Ajouter dans `php.ini` :
```ini
extension=php_sqlsrv_84_ts_x64
extension=php_pdo_sqlsrv_84_ts_x64
```

Configurer la connexion base de données pour SQL Server

Modifier `config/packages/doctrine.yaml` :
```yaml
doctrine:
    dbal:
        driver: pdo_sqlsrv
        host: "localhost\\NOM_DE_VOTRE_INSTANCE"
        dbname: ECF_AEL_CDA
        user: ""
        charset: UTF-8
        options:
            TrustServerCertificate: 1
        profiling_collect_backtrace: '%kernel.debug%'
```

Remplacer `NOM_DE_VOTRE_INSTANCE` par le nom de votre instance SQL Server (ex: `SQLEXPRESS`).

Importer la base de données pour SQL Server

Exécuter le script SQL fourni (`ECF_AEL_CDA.sql`) dans SQL Server Management Studio.

Lancer le serveur
```bash
symfony server:start
```

L'application est accessible sur le lien `http://localhost:8000`.

## Stack technique

- Symfony 8.1
- Doctrine ORM
- SQL Server
- Twig
- KnpPaginatorBundle
