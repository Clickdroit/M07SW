if(document.getElementById("nav_suivi"))
    document.getElementById("nav_suivi").addEventListener("click", ???????????);


//////////////////////// Affichage onglet Suivi
function suiviAjax(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("section").innerHTML = this.responseText; // on récupère le fichier suivi.html et on le complète avec les valeurs
  
      }
    };
    xhttp.open(??????????????, ????????????????);
    xhttp.send();
  }
  function recupererNombreDrone(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var reponse=JSON.parse(this.responseText);
        return reponse.valeur;
      }
    };
    xhttp.open(????????);
    xhttp.send();
    return xhttp.onreadystatechange(); // retourne la valeur renvoyer par la fonction onreadystatechange
  }
  function recupererNombreVol(){
    
  }
  function recupererNombreUtilisateur(){
    
  }

/////////////////////FIN SUIVI

///////////////////// Donnees des vols
function recupererDonneesDrones(){
  
}


