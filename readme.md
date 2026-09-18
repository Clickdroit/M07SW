Module 7 WEB 


Requete SQL disponible : 

| Type de requetes | Routes |
|:-------- |:--------:|
| GET     | /utilisateur   |
| GET | /drone|
| GET | /vol |
| GET | /listecommande |
| GET | /utilisateur/"nom"|
| GET | /drone/"refdrone" |
| GET | /vol/"nom"/"datevol" |
| GET | /nbvol |
| GET | /nbutilisateur |
| GET | /nbdrone |
| POST | /utilisateur |
| POST | /drone |
| POST | /vol |
| POST | /etat |


Exemple de JSON à mettre pour chaque POST: 


`Utilisateur`
```
  {
    "nom": "eleve",
    "prenom": "Eleve",
    "email": "lla@gmail.com",
    "naissance": "2000-03-01",
    "pseudo": "eleve",
    "mdp": "LLA2026"
  }
```

`Drone`
```
  {
    "marque": "DJI",
    "modele": "Tello",
    "refdrone": "TEST",
    "dateAchat": "2018-01-09 23:00:00"
  }
```

`Vol`
```
  {
    "nom": "eleve",
    "numero": "TEST",
    "time": 1570463475,
    "etats": [
      {
        "pitch": 0,
        "roll": 0,
        "yaw": 0,
        "vgx": 0,
        "vgy": 0,
        "vgz": 0,
        "templ": 20,
        "temph": 25,
        "tof": 10,
        "h": 50,
        "bat": 90,
        "baro": 50.2,
        "time": 0,
        "agx": 0,
        "agy": 0,
        "agz": 0
      }
    ]
  }
```

`Etat`
```
  {
    "nom": "eleve",
    "numero": "TEST",
    "time": 1570463475,
    "etats": [
      {
        "pitch": 0,
        "roll": 0,
        "yaw": 0,
        "vgx": 0,
        "vgy": 0,
        "vgz": 0,
        "templ": 20,
        "temph": 25,
        "tof": 10,
        "h": 50,
        "bat": 90,
        "baro": 50.2,
        "time": 0,
        "agx": 0,
        "agy": 0,
        "agz": 0
      }
    ]
  }
```

## Démarrer et vérifier le site en local

Depuis la racine du projet, avec PHP installé :

```powershell
php -l rest.php
php -l connexion.php
php -l inscription.php
php -S 127.0.0.1:8080
```

Ouvrir `http://127.0.0.1:8080/index.php`. Le serveur PHP ne démarre pas MySQL :
la base et sa connexion doivent être préparées séparément, comme indiqué
dans [la roadmap](sql/ROADMAP.md). Un double-clic sur `index.php` n'exécute
pas le PHP. Vérifier l'onglet Réseau du navigateur si les statistiques restent vides.
