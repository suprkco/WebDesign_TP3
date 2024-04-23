# WebDesign_TP3

> Projet Web Design - EPF - 2023

## Table des matières

- [Présentation](#présentation)
- [Stockage des données](#stockage-des-données)
- [Technologies](#technologies)
- [Installation](#installation)
- [Utilisation](#utilisation)

## Présentation

Ceci est le dépôt du troisième TP effectué dans le cadre du cours de de web design.
Le but de ce TP est de créer un site web de gestion de cabinet médical et de mettre en lumière le fonctionnement de l'architecture Model, vue Controller.

1. Ce site web de gestion contient les fonctionnalités secrétaire suivantes:
- Afficher la liste des rendez-vous à venir.
- Afficher la liste des patients présents dans le cabinet.
- Visualiser la liste des médecins du cabinet.
- Visualiser la fiche d'information d'un patient.
- Visualiser les informations d'un rendez-vous.
- Rechercher un élément dans la base de données.
- Ajouter un patient.
- Ajouter un rendez-vous.

2. Et les fonctionnalités suivantes dans le cas de l'interface d'un médecins:
- Consulter la liste de ses rendez-vous.
- Visualiser la liste de ses patients.
- Visualiser la liste de ses consultations.

Certaines fonctionnalité et amélioration minimes ont aussi été ajoutées, tel que l'ajout de code par raccourcis widget (voir `Vue/Elements/[...].php`), les l'affichage dynamique des détails patients (voir `Vue/liste_patients.php`)


## Stockage des données

Les données sont stockées dans une base de données SQL hébergée sur un serveur distant.
la base de donnée est accessible à l'adresse : https://sql.webmo.fr/index.php?username=zdj62853&server=cl1-

## Technologies

Ce projet est réalisé avec:
- PHP
- HTML
- CSS
- Bootstrap
- SQL

## Installation

Pour installer ce projet, il suffit de le cloner avec la commande suivante:

    git clone https://github.com/suprkco/WebDesign_TP3_CODACCIONI.git

## Utilisation

Pour utiliser ce projet, il suffit de lancer le serveur web de PHP avec la commande suivante:

    php -S localhost:8000

Ensuite, il suffit de se rendre sur l'adresse `localhost:8000` dans un navigateur web.

Les identifiants de connexion sont les suivants:
Pour le cas d'une secrétaire: 
   login : secretaire
   mdp : 123
Pour le cas d'un medecin : 
   login : zammouri
   mdp : 123
