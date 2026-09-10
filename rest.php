<?php 
$maconnexion = new PDO('mysql:host=localhost;dbname=drone', 'root', '');
$req_type = $_SERVER['REQUEST_METHOD'];
if(isset($_SERVER['PATH_INFO'])) {
    $req_path = $_SERVER['PATH_INFO'];
    $req_data=explode('/',$req_path);
}


if($req_type == 'POST') {
    $donneesVolJSON = file_get_contents("php://input");
    echo $donneesVolJSON;
    $donnees = json_decode($donneesVolJSON, true);
    if(isset($req_data[1]) && $req_data[1] == 'utilisateur'){
    $nom = $donnees['nom'];
    $prenom = $donnees['prenom'];
    $email = $donnees['email'];
    $naissance = $donnees['naissance'];
    $pseudo = $donnees['pseudo'];
    $mdp = $donnees['mdp'];
    $req = "INSERT INTO utilisateur (nom, prenom, email, naissance, pseudo, mdp) VALUES ('$nom','$prenom','$email','$naissance','$pseudo','$mdp')";
    $reqpreparer=$maconnexion->prepare($req);
    $reqpreparer->execute();
    $reqpreparer->closeCursor();
    }

}
?>
    //echo $donneesVolAssoc["donneesVol"]["nom"];
    //echo "`\n";
    //echo $donneesVolAssoc["donneesVol"]["numero"];