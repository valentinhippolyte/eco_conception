# Projet GitHub - Liste de Jeux Vidéo et Création

Ce projet propose une application web pour gérer une liste et la création de jeux vidéo. Cette application est développée en utilisant les frameworks Symfony et Tailwind CSS.
Ce projet inclut également une approche d'éco-conception dans le développement de l'application. Cette approche vise à minimiser l'empreinte environnementale de l'application en optimisant l'utilisation des ressources informatiques, en réduisant la consommation d'énergie et en favorisant les pratiques de développement durable. 


## Instructions pour Démarrer le Projet

Avant de démarrer le projet, veuillez suivre les étapes suivantes :

1. Assurez-vous d'avoir Composer installé sur votre système. Si ce n'est pas le cas, veuillez installer Composer en suivant les instructions fournies sur le [site officiel](https://getcomposer.org/).

2. Exécutez la commande suivante dans votre terminal pour installer les dépendances PHP du projet : ```composer install```
   
3. Assurez-vous également d'avoir npm installé sur votre système. Si npm n'est pas installé, vous pouvez l'installer en téléchargeant Node.js à partir du [site officiel](https://nodejs.org/).

4. Exécutez la commande suivante pour installer les dépendances JavaScript du projet : ```npm install```

5. Enfin, exécutez la commande suivante pour compiler les ressources frontales du projet : ```npm run dev```


Une fois les étapes ci-dessus terminées avec succès, vous pouvez lancer le projet en exécutant la commande suivante : ```symfony server:start```

L'application sera alors accessible à l'adresse fournie dans la console.


## Fonctionnalités pour minimiser l'empreinte environnementale
* Compresser les images avant l'insertion en BDD
* SUppression des fichiers/bundles inutilsés à la fin du projet
* Ne pas afficher toute la liste des jeux mais seulement les plus pertinents
* Système de purge en BDD





