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
    echo json_encode($reponse);
    }
    elseif(isset($req_data[1])&& $req_data[1]=='utilisateur'){
        $req = "SELECT * FROM utilisateur";
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1], $req_data[2]) && $req_data[1] == 'drone'){
        $refdrone = $req_data[2];
        $req = "SELECT * FROM drone WHERE refDrone = :refDrone";
        $reqpreparer = $maconnexion->prepare($req);
        $reqpreparer->execute(['refDrone' => $refdrone]);
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1])&& $req_data[1] == 'drone'){
        $req = "SELECT * FROM drone";
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1], $req_data[2], $req_data[3])&& $req_data[1] == 'vol'){
        $req ="SELECT * FROM vol, utilisateur.nom FROM vol INNER JOIN utilisateur ON utilisateur.id = vol.idutilisateur WHERE utilisateur.nom = :nom AND vol.datevol = :datevol";
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute(['nom' => $req_data[2], 'datevol' => $req_data[3]]);
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1])&& $req_data[1] == 'vol'){
        $req = "SELECT * FROM vol";
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1])&& $req_data[1] == 'listecommande'){
        $req = "SELECT * FROM listecommande";
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1])&& $req_data[1] == 'nbvol'){
        $req = "SELECT COUNT(*) AS valeur FROM vol";
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetch(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1])&& $req_data[1] == 'nbutilisateur'){
        $req = "SELECT COUNT(*) AS valeur FROM utilisateur";
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetch(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1])&& $req_data[1] == 'nbdrone'){
        $req = "SELECT COUNT(*) AS valeur FROM drone";
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetch(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
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
        $req2="SELECT * FROM utilisateur WHERE nom='$nom'";
        $reqpreparer2=$maconnexion->prepare($req2);
        $reqpreparer2->execute();
        $reponse = $reqpreparer2->fetchAll(PDO::FETCH_ASSOC);
        if(empty($reponse)){
            $req = "INSERT INTO utilisateur (nom, prenom, email, naissance, pseudo, mdp)  VALUES ('$nom','$prenom','$email','$naissance','$pseudo','$mdp')";
            echo json_encode("Données créées", JSON_UNESCAPED_UNICODE);
        }else{
            $req = "UPDATE utilisateur WHERE nom='$nom' SET nom='$nom',prenom='$prenom',naissance='$naissance',mdp='$mdp'";
            echo json_encode("Données mise à jour", JSON_UNESCAPED_UNICODE);
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
            echo json_encode("Données créées", JSON_UNESCAPED_UNICODE);
            $reqpreparer=$maconnexion->prepare($req);
            $reqpreparer->execute(['marque' => $marque,'modele' => $modele,'refdrone' => $ref,'dateAchat' => $dateAchat]);
            $reqpreparer->closeCursor();
        }
    }



    elseif(isset($req_data[1]) && $req_data[1] == 'vol'){
        $idutilisateur = $donnees['idutilisateur'];
        $time = $donnees['dateVol'];
        $date = date('Y-m-d H:i:s',$time);
        $iddrone = $donnees['iddrone'];
        $req2 = "SELECT * FROM vol WHERE idutilisateur = '$idutilisateur' AND iddrone='$iddrone' AND datevol='$date'";
        $reqpreparer2=$maconnexion->prepare($req2);
        $reqpreparer2->execute();
        $reponse =$reqpreparer2->fetchAll(PDO::FETCH_ASSOC);
        if(empty($reponse)){
            $req = "INSERT INTO vol (idutilisateur, datevol, iddrone)VALUES (:idutilisateur, :datevol, :iddrone)";
            $reqpreparer=$maconnexion->prepare($req);
            $reqpreparer->execute(['idutilisateur' => $idutilisateur,'datevol' => $date,'iddrone' => $iddrone]);
            $reqpreparer->closeCursor();
            echo json_encode("Données créées", JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode("Données existantes", JSON_UNESCAPED_UNICODE);
        }
    }
//------------------------------------------------------------------------------------------




    elseif(isset($req_data[1]) && $req_data[1] == 'etat'){
        $date = date('Y-m-d H:i:s', $donnees['time']);

        $req = "SELECT vol.idvol FROM vol INNER JOIN utilisateur ON utilisateur.idutilisateur = vol.idutilisateur INNER JOIN drone ON drone.iddrone = vol.iddrone WHERE utilisateur.nom = :nom AND drone.refdrone = :refdrone AND vol.datevol = :datevol";
        $reqpreparer = $maconnexion->prepare($req);
        $reqpreparer->execute(['nom' => $donnees['nom'], 'refdrone' => $donnees['numero'], 'datevol' => $date]);
        $vol = $reqpreparer->fetch(PDO::FETCH_ASSOC);

        if($vol){
            $req = "INSERT INTO etat (idvol, pitch, roll, yaw, vgx, vgy, vgz, templ, temph, tof, h, bat, baro, time, agx, agy, agz) VALUES (:idvol, :pitch, :roll, :yaw, :vgx, :vgy, :vgz, :templ, :temph, :tof, :h, :bat, :baro, :time, :agx, :agy, :agz)";
            $reqpreparer = $maconnexion->prepare($req);

            for($i = 0; $i < count($donnees['etats']); $i++){
                $etat = $donnees['etats'][$i];
                $reqpreparer->execute(['idvol' => $vol['idvol'],'pitch' => $etat['pitch'],'roll' => $etat['roll'], 'yaw' => $etat['yaw'], 'vgx' => $etat['vgx'], 'vgy' => $etat['vgy'], 'vgz' => $etat['vgz'], 'templ' => $etat['templ'], 'temph' => $etat['temph'], 'tof' => $etat['tof'], 'h' => $etat['h'], 'bat' => $etat['bat'], 'baro' => $etat['baro'], 'time' => $etat['time'], 'agx' => $etat['agx'], 'agy' => $etat['agy'], 'agz' => $etat['agz']]);
            }
            $reqpreparer->closeCursor();
            echo json_encode("Données créées", JSON_UNESCAPED_UNICODE);
        }
    }

    elseif(isset($req_data[1],$req_data[2])&& $req_data[1]=='vol' && $req_data[2]=='drone'){
        $req = "SELECT * FROM vol INNER JOIN utilisateur ON utilisateur.idutilisateur = vol.idutilisateur INNER JOIN drone ON drone.iddrone = vol.iddrone";
        $reqpreparer=$maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse =$reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reponse, JSON_UNESCAPED_UNICODE);
    }
}
?>