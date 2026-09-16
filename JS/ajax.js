//if(document.getElementById("nav_suivi"))
document.getElementById("nav_suivi").addEventListener("click", suiviAjax);


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
        table+="<td>"+donneesvol.idvol+"</td>";
        table+="<td>"+donneesvol.idutilisateur+"</td>";
        table+="<td>"+donneesvol.datevol+"</td>";
        table+="<td>"+donneesvol.iddrone+"</td>";
        table+="</tr>";
      }
      table+="</table></div>";
      document.getElementById("section").innerHTML = table;
    }
  };
  xhttp.open("GET", "rest.php/vol");
  xhttp.send();
}
function chargerGrapheHauteur(idvol) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let donnees = JSON.parse(this.responseText);
            let temps = [];
            let hauteurs = [];
            for(let i = 0; i < donnees.length; i++) {
                temps.push(donnees[i].time);
                hauteurs.push(donnees[i].h);
            }
            afficherGraphique(temps, hauteurs);
        }
    };
    xhttp.open("GET", "rest.php/graphe/" + idvol + "/h");
    xhttp.send();
}