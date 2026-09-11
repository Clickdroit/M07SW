<?php 
$maconnexion = new PDO('mysql:host=localhost;dbname=drone', 'root', '');
$req_type = $_SERVER['REQUEST_METHOD'];
if(isset($_SERVER['PATH_INFO'])) {
    $req_path = $_SERVER['PATH_INFO'];
    $req_data=explode('/',$req_path);
}

if($req_type == 'GET'){

}
else($req_type == 'POST') {

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
    if(isset($req_data[1]) && $req_data[1] == 'vol'){
        $idutilisateur = $donnees['idutilisateur'];
        $date = $donnees['datevol'];
        $iddrone = $donnees['iddrone'];
        $req = "INSERT INTO vol (idutilisateur, datevol, iddrone) VALUES ('$idutilisateur', '$date', '$iddrone')";
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reqpreparer->closeCursor();
    }
    if(isset($req_data[1]) && $req_data[1] == 'etat'){
        $idvol = $donnees['idvol'];
        $pitch = $donnees['pitch'];
        $roll = $donnees['roll'];
        $yaw = $donnees['yaw'];
        $vgx = $donnees['vgx'];
        $vgy = $donnees['vgy'];
        $vgz = $donnees['vgz'];
        $templ = $donnees['templ'];
        $temph = $donnees['temph'];
        $tof = $donnees['tof'];
        $h = $donnees['h'];
        $bat = $donnees['bat'];
        $baro = $donnees['baro'];
        $time = $donnees['time'];
        $agx = $donnees['agx'];
        $agy = $donnees['agy'];
        $agz = $donnees['agz'];
        $req2= "SELECT * FROM etat WHERE idvol = '$idvol'";
        $reqpreparer2=$maconnexion->prepare($req2);
        $reponse = $reqpreparer2->fetchAll(PDO::FETCH_ASSOC);
        if(empty($reponse)) {
            $req = "INSERT INTO etat(idvol, pitch, roll, yaw, vgx, vgy, vgz, templ, temph, tof, h, bat, baro, time, agx, agy, agz) VALUES ('$idvol', '$pitch', '$roll', '$yaw', '$vgx', '$vgy', '$vgz', '$templ', '$temph', '$tof', '$h', '$bat', '$baro', '$time', '$agx', '$agy', '$agz')";
            $reqpreparer=$maconnexion->prepare($req);
            print_r("Données créées");
        } else {
            $req = "UPDATE etat SET pitch='$pitch', roll='$roll', yaw='$yaw', vgx='$vgx', vgy='$vgy', vgz='$vgz', templ='$templ', temph='$temph', tof='$tof', h='$h', bat='$bat', baro='$baro', time='$time', agx='$agx', agy='$agy', agz='$agz' WHERE idvol = '$idvol'";
            $reqpreparer=$maconnexion->prepare($req);
            print_r("Données mises à jour");
        }



       
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reqpreparer->closeCursor();
    }
}
?>