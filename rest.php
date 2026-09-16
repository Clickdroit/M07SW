<?php 
$maconnexion = new PDO('mysql:host=localhost;dbname=drone', 'root', '');
$req_type = $_SERVER['REQUEST_METHOD'];
if(isset($_SERVER['PATH_INFO'])) {
    $req_path = $_SERVER['PATH_INFO'];
    $req_data = explode('/', $req_path);
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
    elseif(isset($req_data[1]) && $req_data[1] == 'utilisateur'){
        $req = "SELECT * FROM utilisateur";
        $reqpreparer = $maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1], $req_data[2]) && $req_data[1] == 'drone'){
        $refdrone = $req_data[2];
        $req = "SELECT * FROM drone WHERE refdrone = :refdrone";
        $reqpreparer = $maconnexion->prepare($req);
        $reqpreparer->execute(['refdrone' => $refdrone]);
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1]) && $req_data[1] == 'drone'){
        $req = "SELECT * FROM drone";
        $reqpreparer = $maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1], $req_data[2], $req_data[3]) && $req_data[1] == 'vol'){
        $req = "SELECT vol.*, utilisateur.nom FROM vol INNER JOIN utilisateur ON utilisateur.idutilisateur = vol.idutilisateur WHERE utilisateur.nom = :nom AND vol.datevol = :datevol";
        $reqpreparer = $maconnexion->prepare($req);
        $reqpreparer->execute(['nom' => urldecode($req_data[2]), 'datevol' => urldecode($req_data[3])]);
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1]) && $req_data[1] == 'vol'){
        $req = "SELECT * FROM vol";
        $reqpreparer = $maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1]) && $req_data[1] == 'listecommande'){
        $req = "SELECT * FROM listecommande";
        $reqpreparer = $maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1]) && $req_data[1] == 'nbvol'){
        $req = "SELECT COUNT(*) AS valeur FROM vol";
        $reqpreparer = $maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetch(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1]) && $req_data[1] == 'nbutilisateur'){
        $req = "SELECT COUNT(*) AS valeur FROM utilisateur";
        $reqpreparer = $maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetch(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    elseif(isset($req_data[1]) && $req_data[1] == 'nbdrone'){
        $req = "SELECT COUNT(*) AS valeur FROM drone";
        $reqpreparer = $maconnexion->prepare($req);
        $reqpreparer->execute();
        $reponse = $reqpreparer->fetch(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
    //Modifier l'API pour répondre à `GET rest.php/graphe/[idvol]/h`.
    elseif(isset($req_data[1], $req_data[2], $req_data[3]) && $req_data[1] == 'graphe' && $req_data[3] == 'h'){
        $idvol = $req_data[2];
        $req = "SELECT time, h FROM etat WHERE idvol = :idvol ORDER BY time";
        $reqpreparer = $maconnexion->prepare($req);
        $reqpreparer->execute(['idvol' => $idvol]);
        $reponse = $reqpreparer->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($reponse);
    }
}

elseif($req_type == 'POST') {

    $donneesVolJSON = file_get_contents("php://input");
    $donnees = json_decode($donneesVolJSON, true);

    if(isset($req_data[1]) && $req_data[1] == 'utilisateur'){
        $nom = isset($donnees['nom']) ? $donnees['nom'] : '';
        $prenom = isset($donnees['prenom']) ? $donnees['prenom'] : '';
        $email = isset($donnees['email']) ? $donnees['email'] : '';
        $naissance = isset($donnees['naissance']) ? $donnees['naissance'] : null;
        $pseudo = isset($donnees['pseudo']) ? $donnees['pseudo'] : '';
        $mdp = isset($donnees['mdp']) ? $donnees['mdp'] : '';

        $req2 = "SELECT * FROM utilisateur WHERE nom = :nom";
        $reqpreparer2 = $maconnexion->prepare($req2);
        $reqpreparer2->execute(['nom' => $nom]);
        $reponse = $reqpreparer2->fetch(PDO::FETCH_ASSOC);

        if(empty($reponse)){
            $req = "INSERT INTO utilisateur (nom, prenom, email, naissance, pseudo, mdp) VALUES (:nom, :prenom, :email, :naissance, :pseudo, :mdp)";
            $reqpreparer = $maconnexion->prepare($req);
            $reqpreparer->execute(['nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'naissance' => $naissance, 'pseudo' => $pseudo, 'mdp' => $mdp]);
            echo json_encode("Données créées", JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode("Données existantes", JSON_UNESCAPED_UNICODE);
        }
    }
    elseif(isset($req_data[1]) && $req_data[1] == 'drone'){
        $ref = isset($donnees['numero']) ? $donnees['numero'] : (isset($donnees['refdrone']) ? $donnees['refdrone'] : (isset($donnees['refDrone']) ? $donnees['refDrone'] : ''));
        $marque = isset($donnees['marque']) ? $donnees['marque'] : '';
        $modele = isset($donnees['modele']) ? $donnees['modele'] : '';
        $dateAchat = isset($donnees['dateAchat']) ? $donnees['dateAchat'] : null;

        $req2 = "SELECT * FROM drone WHERE refdrone = :refdrone";
        $reqpreparer2 = $maconnexion->prepare($req2);
        $reqpreparer2->execute(['refdrone' => $ref]);
        $reponse = $reqpreparer2->fetch(PDO::FETCH_ASSOC);

        if(empty($reponse)){
            $req = "INSERT INTO drone (marque, modele, refdrone, dateAchat) VALUES (:marque, :modele, :refdrone, :dateAchat)";
            $reqpreparer = $maconnexion->prepare($req);
            $reqpreparer->execute(['marque' => $marque, 'modele' => $modele, 'refdrone' => $ref, 'dateAchat' => $dateAchat]);
            echo json_encode("Données créées", JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode("Données existantes", JSON_UNESCAPED_UNICODE);
        }
    }
    elseif(isset($req_data[1]) && ($req_data[1] == 'vol' || $req_data[1] == 'etat')){
        if(isset($donnees['nom'], $donnees['numero'], $donnees['time'])){
            // 1. Utilisateur : recherche ou création
            $nom = $donnees['nom'];
            $reqUser = "SELECT idutilisateur FROM utilisateur WHERE nom = :nom";
            $stmtUser = $maconnexion->prepare($reqUser);
            $stmtUser->execute(['nom' => $nom]);
            $user = $stmtUser->fetch(PDO::FETCH_ASSOC);
            if(!$user){
                $stmtInsertUser = $maconnexion->prepare("INSERT INTO utilisateur (nom) VALUES (:nom)");
                $stmtInsertUser->execute(['nom' => $nom]);
                $idutilisateur = $maconnexion->lastInsertId();
            } else {
                $idutilisateur = $user['idutilisateur'];
            }

            // 2. Drone : recherche ou création
            $refdrone = $donnees['numero'];
            $reqDrone = "SELECT iddrone FROM drone WHERE refdrone = :refdrone";
            $stmtDrone = $maconnexion->prepare($reqDrone);
            $stmtDrone->execute(['refdrone' => $refdrone]);
            $drone = $stmtDrone->fetch(PDO::FETCH_ASSOC);
            if(!$drone){
                $stmtInsertDrone = $maconnexion->prepare("INSERT INTO drone (refdrone) VALUES (:refdrone)");
                $stmtInsertDrone->execute(['refdrone' => $refdrone]);
                $iddrone = $maconnexion->lastInsertId();
            } else {
                $iddrone = $drone['iddrone'];
            }

            // 3. Vol : conversion timestamp -> date SQL et recherche ou création
            $time = $donnees['time'];
            $datevol = date('Y-m-d H:i:s', $time);
            $reqVol = "SELECT idvol FROM vol WHERE idutilisateur = :idutilisateur AND iddrone = :iddrone AND datevol = :datevol";
            $stmtVol = $maconnexion->prepare($reqVol);
            $stmtVol->execute(['idutilisateur' => $idutilisateur, 'iddrone' => $iddrone, 'datevol' => $datevol]);
            $vol = $stmtVol->fetch(PDO::FETCH_ASSOC);
            if(!$vol){
                $stmtInsertVol = $maconnexion->prepare("INSERT INTO vol (idutilisateur, datevol, iddrone) VALUES (:idutilisateur, :datevol, :iddrone)");
                $stmtInsertVol->execute(['idutilisateur' => $idutilisateur, 'datevol' => $datevol, 'iddrone' => $iddrone]);
                $idvol = $maconnexion->lastInsertId();
            } else {
                $idvol = $vol['idvol'];
            }

            // 4. États : insertion de la liste d'états
            if(isset($donnees['etats']) && is_array($donnees['etats'])){
                $reqEtat = "INSERT INTO etat (idvol, pitch, roll, yaw, vgx, vgy, vgz, templ, temph, tof, h, bat, baro, time, agx, agy, agz) VALUES (:idvol, :pitch, :roll, :yaw, :vgx, :vgy, :vgz, :templ, :temph, :tof, :h, :bat, :baro, :time, :agx, :agy, :agz)";
                $stmtEtat = $maconnexion->prepare($reqEtat);
                for($i = 0; $i < count($donnees['etats']); $i++){
                    $etat = $donnees['etats'][$i];
                    $stmtEtat->execute(['idvol' => $idvol,'pitch' => $etat['pitch'],'roll' => $etat['roll'],'yaw' => $etat['yaw'],'vgx' => $etat['vgx'],'vgy' => $etat['vgy'],'vgz' => $etat['vgz'],'templ' => $etat['templ'],'temph' => $etat['temph'],'tof' => $etat['tof'],'h' => $etat['h'],'bat' => $etat['bat'],'baro' => $etat['baro'],'time' => $etat['time'],'agx' => $etat['agx'],'agy' => $etat['agy'],'agz' => $etat['agz']]);
                }
            }
            echo json_encode("Données créées", JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode("Données invalides", JSON_UNESCAPED_UNICODE);
        }
    }
}
?>