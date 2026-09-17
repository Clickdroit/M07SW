document.getElementById("nav_suivi").addEventListener("click", suiviAjax);
document.getElementById("nav_inscription").addEventListener("click", inscriptionAjax);
document.getElementById("nav_connexion").addEventListener("click", connexionAjax);


//////////////////////// Affichage onglet Suivi
function suiviAjax(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("section").innerHTML = this.responseText; // on récupère le fichier suivi.html et on le complète avec les valeurs
        document.getElementById("nb_drone").addEventListener("click", recupererDonneesDrones);
        document.getElementById("nb_vol").addEventListener("click", recupererDonneesVols);
        document.getElementById("nb_utilisateur").addEventListener("click", recupererDonneesUtilisateurs);
        recupererNombreDrone();
        recupererNombreVol();
        recupererNombreUtilisateur();
      }
    };
    xhttp.open("GET", "suivi.html");
    xhttp.send();
  }
  function recupererNombreDrone(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var reponse=JSON.parse(this.responseText);
        document.querySelector("#nb_drone .statistique_valeur").innerHTML = reponse.valeur;
      }
    };
    xhttp.open("GET", "rest.php/nbdrone");
    xhttp.send();
  }
  function recupererNombreVol(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var reponse=JSON.parse(this.responseText);
        document.querySelector("#nb_vol .statistique_valeur").innerHTML = reponse.valeur;
      }
    };
    xhttp.open("GET", "rest.php/nbvol");
    xhttp.send();
  }
  function recupererNombreUtilisateur(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var reponse=JSON.parse(this.responseText);
        document.querySelector("#nb_utilisateur .statistique_valeur").innerHTML = reponse.valeur;
      }
    };
    xhttp.open("GET", "rest.php/nbutilisateur");
    xhttp.send();
  }

/////////////////////FIN SUIVI

///////////////////// Donnees des vols
function recupererDonneesUtilisateurs(){
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let reponseAPI = JSON.parse(this.responseText);
      let table = "<div ><table class='tableau_statistique '><tr class='centrer'><th>Numéro utilisateur</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Date de naissance</th><th>Pseudo</th></tr>";
      for(let i=0; i<reponseAPI.length; i++){
        table+="<tr class='centrer'>";
        let donneesUtilisateur=reponseAPI[i];
        table+="<td>"+donneesUtilisateur.idutilisateur+"</td>";
        table+="<td>"+donneesUtilisateur.nom+"</td>";
        table+="<td>"+donneesUtilisateur.prenom+"</td>";
        table+="<td>"+donneesUtilisateur.email+"</td>";
        table+="<td>"+donneesUtilisateur.naissance+"</td>";
        table+="<td>"+donneesUtilisateur.pseudo+"</td>";
        table+="</tr>";
      }
      table+="</table></div>";
      document.getElementById("section").innerHTML = table;
    }
  };
  xhttp.open("GET", "rest.php/utilisateur");
  xhttp.send();
}
function recupererDonneesDrones(){
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let reponseAPI = JSON.parse(this.responseText);
      let table = "<div ><table class='tableau_statistique '><tr class='centrer'><th>Numéro drone</th><th>Marque</th><th>Modèle</th><th>Référence</th><th>Date d'achat</th></tr>";
      for(let i=0; i<reponseAPI.length; i++){
        table+="<tr class='centrer'>";
        let donneesdrone=reponseAPI[i];
        table+="<td>"+donneesdrone.iddrone+"</td>";
        table+="<td>"+donneesdrone.marque+"</td>";
        table+="<td>"+donneesdrone.modele+"</td>";
        table+="<td>"+donneesdrone.refdrone+"</td>";
        table+="<td>"+donneesdrone.dateAchat+"</td>";
        table+="</tr>";
      }
      table+="</table></div>";
      document.getElementById("section").innerHTML = table;
    }
  };
  xhttp.open("GET", "rest.php/drone");
  xhttp.send();
}
function recupererDonneesVols(){
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let reponseAPI = JSON.parse(this.responseText);
      let table = "<div ><table class='tableau_statistique '><tr class='centrer'><th>Numéro vol</th><th>Numéro utilisateur</th><th>Date du vol</th><th>Numéro drone</th></tr>";
      for(let i=0; i<reponseAPI.length; i++){
        table+="<tr class='centrer'>";
        let donneesvol=reponseAPI[i];
        table+="<td><button class='idvol_graphe' data-idvol='"+donneesvol.idvol+"'>"+donneesvol.idvol+"</button></td>";
        table+="<td>"+donneesvol.idutilisateur+"</td>";
        table+="<td>"+donneesvol.datevol+"</td>";
        table+="<td>"+donneesvol.iddrone+"</td>";
        table+="</tr>";
      }
      table+="</table></div>";
      document.getElementById("section").innerHTML = table;
      document.querySelectorAll(".idvol_graphe").forEach(function(bouton) {
        bouton.addEventListener("click", function() {
          chargerGraphe(this.dataset.idvol, 'h');
        });
      });
    }
  };
  xhttp.open("GET", "rest.php/vol");
  xhttp.send();
}
function chargerGraphe(idvol, donnee) {
    if (!donnee) {
        donnee = "h";
    }
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var donnees = JSON.parse(this.responseText);
            var temps = [];
            var valeurs = [];
            for (var i = 0; i < donnees.length; i++) {
                temps.push(i / 10);
                valeurs.push(donnees[i][donnee]);
            }
            afficherGraphique(idvol, donnee, temps, valeurs);
        }
    };
    xhttp.open("GET", "rest.php/graphe/" + idvol + "/" + donnee);
    xhttp.send();
}

function afficherGraphique(idvol, donnee, temps, valeurs) {
    var html = "<label>Donnée à afficher : </label>";
    html += "<select id='choix_donnee'>";
    html += "<option value='h'>Hauteur</option>";
    html += "<option value='bat'>Batterie</option>";
    html += "<option value='baro'>Baromètre</option>";
    html += "<option value='pitch'>Pitch</option>";
    html += "<option value='roll'>Roll</option>";
    html += "<option value='yaw'>Yaw</option>";
    html += "<option value='vgx'>Vitesse X</option>";
    html += "<option value='vgy'>Vitesse Y</option>";
    html += "<option value='vgz'>Vitesse Z</option>";
    html += "<option value='templ'>Température min</option>";
    html += "<option value='temph'>Température max</option>";
    html += "<option value='tof'>TOF</option>";
    html += "</select>";
    html += "<canvas id='graphique'></canvas>";

    document.getElementById("section").innerHTML = html;

    document.getElementById("choix_donnee").value = donnee;
    document.getElementById("choix_donnee").addEventListener("change", function() {
        chargerGraphe(idvol, this.value);
    });

    new Chart(document.getElementById("graphique"), {
        type: "line",
        data: {
            labels: temps,
            datasets: [{
                label: donnee,
                data: valeurs,
                borderColor: "blue"
            }]
        },
        options: {
            scales: {
                x: {
                    title: { 
                      display: true,
                      text: "Temps (s)"
                      }
                },
                y: {
                    title: { 
                      display: true,
                      text: donnee
                     }
                }
            }
        }
    });
}

function inscriptionAjax() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("section").innerHTML = this.responseText;
            document.getElementById("bouton_inscription").addEventListener("click", inscrire);
        }
    };
    xhttp.open("GET", "inscription.php");
    xhttp.send();
}

function inscrire() {
    var nom = document.getElementById("nom").value;
    var prenom = document.getElementById("prenom").value;
    var pseudo = document.getElementById("pseudo").value;
    var mdp1 = document.getElementById("mdp1").value;
    var mdp2 = document.getElementById("mdp2").value;

    if (mdp1 != mdp2) {
        alert("Les 2 mots de passe sont différents");
        return;
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert("Inscription réussie !");
            connexionAjax();
        }
    };
    xhttp.open("GET", "rest.php/inscription/" + nom + "/" + prenom + "/" + pseudo + "/" + mdp1);
    xhttp.send();
}

function connexionAjax() {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("section").innerHTML = this.responseText;
            document.getElementById("bouton_connexion").addEventListener("click", connecter);
        }
    };
    xhttp.open("GET", "connexion.php");
    xhttp.send();
}

function connecter() {
    var pseudo = document.getElementById("pseudo_connexion").value;
    var mdp = document.getElementById("mdp_connexion").value;

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var reponse = JSON.parse(this.responseText);
            if (reponse.success) {
                alert("Connexion réussie !");
            } else {
                alert("Identifiant ou mot de passe incorrect");
            }
        }
    };
    xhttp.open("GET", "rest.php/connexion/" + pseudo + "/" + mdp);
    xhttp.send();
}