# Roadmap - Exploitation des données JSON

## Objectif

- [ ] Créer un nouveau vol si le champ `time` envoyé dans le JSON est différent
      de celui du vol précédent.
- [ ] Mettre à jour les données si le vol existe déjà.
- [ ] Transformer le timestamp en date avec la fonction `date()` de PHP :

  ```php
  $date = date('Y-m-d H:i:s', $timestamp);
  ```

- [ ] Écrire la requête SQL permettant de sélectionner un vol en connaissant le
      nom de l'utilisateur et la date.

## Insertion des états de vol

- [ ] En s'aidant des étapes de la partie utilisateur, compléter le fichier PHP
      afin de créer un nouvel état de vol s'il n'est pas déjà présent dans la
      base de données.
- [ ] Tester le bon fonctionnement du code.
- [ ] Écrire la requête SQL permettant d'insérer un état de vol en connaissant
      l'`idvol`.
- [ ] Compléter le fichier PHP afin d'insérer un nouvel état de vol dans la base
      de données en connaissant l'`idvol`.
- [ ] Compléter une boucle `for` dans le cas où plusieurs états de vol sont
      envoyés par la requête HTTP.
- [ ] Tester le bon fonctionnement du code.
