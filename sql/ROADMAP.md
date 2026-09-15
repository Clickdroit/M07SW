# Roadmap web M07 — suivi du PDF, pages 26 à 47

Cette roadmap reprend uniquement les travaux demandés dans le PDF, de la
séance **SW01** à la séance **SW06-08**. La partie C++ n'est pas concernée.

Légende :

- `[x]` réalisé et visible dans le dépôt ;
- `[ ]` à faire ou non vérifiable dans le dépôt.

## SW01 — Base de données (PDF pages 26 à 28)

- [x] Avoir le répertoire `M07SW` dans `htdocs`.
- [x] Avoir un fichier `README` contenant :
      `Module 7 Web` et `Gestion de données de drone.`
- [ ] Suivre le tutoriel Git du module M01 pour préparer le versioning.
- [ ] Créer une branche `SW01` (la branche actuelle est `main`).
- [x] Avoir un fichier SQL de création de la base et des tables :
      [sql/db.sql](./db.sql).
- [x] Définir les tables dans un ordre compatible avec leurs clés étrangères.
- [x] Avoir des fichiers SQL d'insertion pour les données de la base :
      [M07 Web/BdD/](../M07%20Web/BdD/).
- [ ] Importer `db.sql` dans phpMyAdmin ou dans un terminal MySQL.
- [ ] Importer les fichiers SQL de données dans chaque table.

## SW02 — Réception des données : utilisateur et drone (PDF pages 29 à 34)

- [x] Disposer d'un exemple de données au format JSON avec `nom`, `time`,
      `numero` et `etats` :
      [etat.json](../M07%20Web/etat.json) et
      [etat_long.json](../M07%20Web/etat_long.json).
- [x] Récupérer le corps JSON avec `file_get_contents("php://input")` dans
      [rest.php](../rest.php).
- [x] Convertir le JSON en tableau associatif avec `json_decode(..., true)`.
- [x] Extraire les principales données du JSON côté PHP (`nom`, `time`,
      `numero` et les états).
- [ ] Écrire la requête SQL de recherche d'un utilisateur par son nom.
- [ ] Écrire la requête SQL d'insertion d'un utilisateur par son nom.
- [ ] Compléter correctement l'API pour créer l'utilisateur s'il n'existe pas.
- [ ] Tester la création de l'utilisateur avec un client REST et un JSON.
- [ ] Écrire la requête SQL recherchant `iddrone` par `refdrone`.
- [ ] Écrire la requête SQL d'insertion d'un drone.
- [ ] Compléter l'API pour créer le drone si sa référence n'existe pas.
- [ ] Tester la création et la recherche du drone.

## SW03 — Réception des données : vol et états (PDF pages 35 à 37)

- [ ] Rechercher un vol avec le nom de l'utilisateur et sa date.
- [ ] Convertir le timestamp JSON en date SQL avec :
      `date('Y-m-d H:i:s', $time)`.
- [ ] Créer un vol si le champ `time` reçu est différent d'une date déjà
      présente dans la base.
- [ ] Mettre à jour les données si le vol existe déjà.
- [ ] Écrire la requête SQL d'insertion d'un vol avec `idutilisateur` et la
      date.
- [ ] Tester la création et la mise à jour d'un vol.
- [ ] Écrire la requête SQL d'insertion d'un état avec `idvol`.
- [ ] Compléter l'API pour insérer un état rattaché au bon `idvol`.
- [ ] Parcourir tous les états reçus avec une boucle `for`.
- [ ] Tester l'insertion avec un état puis avec plusieurs états.

## SW04 — Mise en place du site web (PDF pages 38 à 40)

- [x] Avoir une page principale avec une structure HTML et une navigation :
      [index.php](../M07%20Web/SW04_eleve/index.php).
- [x] Avoir la page HTML de suivi avec les trois statistiques :
      [suivi.html](../M07%20Web/SW04_eleve/suivi.html).
- [x] Avoir un fichier JavaScript dédié aux requêtes AJAX :
      [ajax.js](../M07%20Web/SW04_eleve/JS/ajax.js).
- [ ] Tester l'affichage du site dans un navigateur.
- [ ] Rendre l'onglet « Suivi » cliquable vers `suiviAjax()`.
- [x] Avoir la fonction `suiviAjax()` qui demande `suivi.html` et l'insère
      dans `section` (la route et l'événement restent à compléter).
- [ ] Créer l'API `GET rest.php/nbdrone`.
- [ ] Créer l'API `GET rest.php/nbvol`.
- [ ] Créer l'API `GET rest.php/nbutilisateur`.
- [ ] Écrire les trois requêtes SQL `COUNT(*)` correspondantes.
- [ ] Créer `recupererNombreDrone()` et afficher le résultat dans
      `#nb_drone`.
- [ ] Créer `recupererNombreVol()` et afficher le résultat dans `#nb_vol`.
- [ ] Créer `recupererNombreUtilisateur()` et afficher le résultat dans
      `#nb_utilisateur`.
- [ ] Vérifier le fonctionnement complet de la page Suivi avec AJAX.

## SW05 — Afficher les données dans des tableaux (PDF pages 41 à 44)

- [x] Avoir dans l'API les branches GET pour `drone`, `vol` et `utilisateur`
      dans [rest.php](../rest.php).
- [ ] Retourner des réponses exploitables en JSON pour ces trois routes
      (l'API utilise actuellement `print_r()`).
- [ ] Vérifier les URL demandées par le PDF :
      `rest.php/drone`, `rest.php/vol` et `rest.php/utilisateur`.
- [ ] Compléter `suiviAjax()` pour rendre accessibles les trois affichages.
- [ ] Créer `recupererDonneesDrones()` et afficher les drones dans un tableau.
- [ ] Créer `recupererDonneesVols()` et afficher les vols dans un tableau.
- [ ] Utiliser/adapter `recupererDonneesUtilisateurs()` pour afficher les
      utilisateurs dans un tableau.
- [ ] Vérifier l'affichage des trois tableaux dans le navigateur.

## SW06-08 — Graphes avec Chart.js (PDF pages 45 à 47)

- [x] Avoir la librairie Chart.js dans le projet :
      [Graphe_SW06_eleve/chart.js](../M07%20Web/Graphe_SW06_eleve/chart.js).
- [ ] Modifier l'API pour répondre à
      `GET rest.php/graphe/[idvol]/h`.
- [ ] Retourner les valeurs de `h` du vol demandé.
- [ ] Ajouter dans l'affichage des vols un bouton par `idvol` avec
      l'attribut `data-idvol`.
- [ ] Compléter `ajax.js` avec la fonction `ajaxGraphe`.
- [ ] Afficher la hauteur en fonction de l'`idetat`.
- [ ] Modifier le graphe pour afficher le temps sur l'axe des abscisses,
      en tenant compte des 10 valeurs envoyées chaque seconde.
- [ ] Modifier l'API pour permettre de récupérer les autres données de vol.
- [ ] Permettre à l'utilisateur de choisir la donnée à afficher dans le graphe.
- [ ] Tester les graphes avec un vol contenant plusieurs états.

## Objectif à atteindre pour considérer M04 terminé

- [ ] SW01 importé et versionné sur sa branche.
- [ ] SW02 fonctionnel : utilisateur et drone créés/retrouvés depuis le JSON.
- [ ] SW03 fonctionnel : vol et tous ses états enregistrés correctement.
- [ ] SW04 fonctionnel : statistiques affichées dans l'onglet Suivi par AJAX.
- [ ] SW05 fonctionnel : tableaux utilisateurs, drones et vols affichés.
- [ ] SW06-08 fonctionnel : graphe de hauteur, temps et autres mesures.
