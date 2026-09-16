//if(document.getElementById("nav_suivi"))
document.getElementById("nav_suivi").addEventListener("click", suiviAjax);


//////////////////////// Affichage onglet Suivi
function suiviAjax(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("section").innerHTML = this.responseText; // on récupère le fichier suivi.html et on le complète avec les valeurs
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
    xhttp.open("GET", "http://localhost/M07SW/rest.php/nbdrone");
    xhttp.send();
    return xhttp.onreadystatechange();
  }
  function recupererNombreVol(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var reponse=JSON.parse(this.responseText);
        document.querySelector("#nb_vol .statistique_valeur").innerHTML = reponse.valeur;
      }
    };
    xhttp.open("GET", "http://localhost/M07SW/rest.php/nbvol");
    xhttp.send();
    return xhttp.onreadystatechange();
  }
  function recupererNombreUtilisateur(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var reponse=JSON.parse(this.responseText);
        document.querySelector("#nb_utilisateur .statistique_valeur").innerHTML = reponse.valeur;
      }
    };
    xhttp.open("GET", "http://localhost/M07SW/rest.php/nbutilisateur");
    xhttp.send();
    return xhttp.onreadystatechange();
  }

/////////////////////FIN SUIVI

///////////////////// Donnees des vols
function recupererDonneesDrones(){
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let reponseAPI = JSON.parse(this.responseText);
      let table = "<div ><table class='tableau_statistique '><tr class='centrer'><th>Numéro utilisateur</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Date de naissance</th><th>Pseudo</th></tr>";
      for(let i=0; i<reponseAPI.valeur.length; i++){
        table+="<tr class='centrer'>";
        let donneesUtilisateur=reponseAPI.valeur[i];
        table+="<td>"+donneesUtilisateur.idutilisateur+"</td>";
        table+="<td>"+donneesUtilisateur.nom+"</td";
        table+="<td>"+donneesUtilisateur.prenom+"</td";
        table+="<td>"+donneesUtilisateur.email+"</td";
        table+="<td>"+donneesUtilisateur.naissance+"</td";
        table+="<td>"+donneesUtilisateur.pseudo+"</td";
        table+="</tr>";
      }
    }
  }  
}


