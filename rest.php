<?php 
$maconnexion = new PDO('mysql:host=localhost;dbname=drone', 'root', '');
$req_type = $_SERVER['REQUEST_METHOD'];
if(isset($_SERVER['PATH_INFO'])) {
    $req_path = $_SERVER['PATH_INFO'];
    $req_data=explode('/',$req_path);
}

if($req_type == 'GET'){
    if(isset($req_data[1], $req_data[2]) && $req_data[1] == 'utilisateur'){
    $nom = $req_data[2];
    $req = "SELECT * FROM utilisateur WHERE nom = :nom";
    $reqpreparer = $maconnexion->prepare($req);
    $reqpreparer->execute(['nom' => $nom]);
    $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
    print_r($reponse);
    }
    elseif(isset($req_data[1])&& $req_data[1]=='utilisateur'){
        $req = "SELECT * FROM utilisateur";
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        print_r($reponse);
    }
    elseif(isset($req_data[1], $req_data[2]) && $req_data[1] == 'drone'){
        $refdrone = $req_data[2];
        $req = "SELECT * FROM drone WHERE refDrone = :refDrone";
        $reqpreparer = $maconnexion->prepare($req);
        $reqpreparer->execute(['refDrone' => $refdrone]);
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        print_r($reponse);
    }
    elseif(isset($req_data[1])&& $req_data[1] == 'drone'){
        $req = "SELECT * FROM drone";
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        print_r($reponse);
    }
    elseif(isset($req_data[1])&& $req_data[1] == 'vol'){
        $req = "SELECT * FROM vol";
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        print_r($reponse);
    }
    elseif(isset($req_data[1])&& $req_data[1] == 'listecommande'){
        $req = "SELECT * FROM listecommande";
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        print_r($reponse);
    }
}


//GET   
//------------------------------------------------------------------------------------------------
//POST



elseif($req_type == 'POST') {

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
        $req2="SELECT * FROM utilisateur WHERE nom='$nom";
        $reqpreparer2=$maconnexion->prepare($req2);
        $reqpreparer2->execute();
        $reponse = $reqpreparer2->fetchAll(PDO::FETCH_ASSOC);
        if(empty($reponse)){
            $req = "INSERT INTO utilisateur (nom, prenom, email, naissance, pseudo, mdp)  VALUES ('$nom','$prenom','$email','$naissance','$pseudo','$mdp')";
            print_r("Données créées");
        }else{
            $req = "UPDATE utilisateur WHERE nom='$nom' SET nom='$nom',prenom='$prenom',naissance='$naissance',mdp='$mdp'";
            print_r("Données mise à jour");
        }        
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reqpreparer->closeCursor();
    }
    elseif(isset($req_data[1]) && $req_data[1] == 'drone'){
        $marque = $donnees['marque'];
        $modele = $donnees['modele'];
        $ref = $donnees['refDrone'];
        $dateAchat = $donnees['dateAchat'];
        $req2="SELECT * FROM drone WHERE marque = :marque AND modele = :modele AND refdrone = :refdrone AND dateAchat = :dateAchat";
        $reqpreparer2=$maconnexion->prepare($req2);
        $reqpreparer2->execute(['marque' => $marque,'modele' => $modele,'refdrone' => $ref,'dateAchat' => $dateAchat]);
        $reponse = $reqpreparer2->fetchAll(PDO::FETCH_ASSOC);
        if(empty($reponse)){
            $req = "INSERT INTO drone (marque, modele, refdrone, dateAchat) VALUES (:marque, :modele, :refdrone, :dateAchat)";
            print_r("Données créées");
            $reqpreparer=$maconnexion->prepare($req);
            $reqpreparer->execute(['marque' => $marque,'modele' => $modele,'refdrone' => $ref,'dateAchat' => $dateAchat]);
            $reqpreparer->closeCursor();
        }
    }



    elseif(isset($req_data[1]) && $req_data[1] == 'vol'){
        $idutilisateur = $donnees['idutilisateur'];
        $date = $donnees['datevol'];
        $iddrone = $donnees['iddrone'];
        $req2 = "SELECT * FROM vol WHERE idutilisateur = '$idutilisateur' AND iddrone='$iddrone' AND datevol='$date'";
        $reqpreparer2=$maconnexion->prepare($req2);
        $reqpreparer2->execute();
        $reponse =$reqpreparer2->fetchAll(PDO::FETCH_ASSOC);
        if(empty($reponse)){
            $req = "INSERT INTO vol (idutilisateur, datevol, iddrone) VALUES ('$idutilisateur', '$date', '$iddrone')";
            print_r("Données créées");
        } else {
            print_r("Données existantes");
        }
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reqpreparer->closeCursor();
    }
//------------------------------------------------------------------------------------------




    elseif(isset($req_data[1]) && $req_data[1] == 'etat'){
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
        $req = "INSERT INTO etat(idvol, pitch, roll, yaw, vgx, vgy, vgz, templ, temph, tof, h, bat, baro, time, agx, agy, agz) VALUES ('$idvol', '$pitch', '$roll', '$yaw', '$vgx', '$vgy', '$vgz', '$templ', '$temph', '$tof', '$h', '$bat', '$baro', '$time', '$agx', '$agy', '$agz')";
        print_r("Données créées");
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reqpreparer->closeCursor();
    }
    if(isset($req_data[1],$req_data[2])&& $req_data[1]=='vol' && $req_data[2]=='drone'){
        $req = "SELECT * FROM vol INNER JOIN utilisateur ON utilisateur.idutilisateur = vol.idutilisateur INNER JOIN drone ON drone.iddrone = vol.iddrone";
    }
}
?>