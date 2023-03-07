<?php

    require('../Controller/Util.php');

    if(isset($_POST["login"]) && isset($_POST["password"])){
        $login = $_POST["login"];
        $pwd = $_POST["password"];
        $Util = new Util();
        
        $Utilisateur = $Util->getUtilisateur($login, $pwd);
        
        if ($Utilisateur!=NULL){
            
            session_unset();
            session_start();
            $_SESSION["acces"]='y';
            $_SESSION["ID_CONNECTED_USER"] = $Utilisateur->getId_Utilisateur();
            if($Utilisateur->getType_Utilisateur()=="Medecin"){
                $Medecin = new Medecin();
                $Medecin = $Utilisateur->getMedecin();
                
                $_SESSION["Medecins"] = $Util->getMedecins();

                header("location: ../Vue/medecin_display.php");
            }
            if($Utilisateur->getType_Utilisateur()=="Secretaire"){
                $Secretaire = new Secretaire();
                $Secretaire = $Utilisateur->getSecretaire();

                $_SESSION["Medecins"] = $Util->getMedecins();
                $_SESSION["Secretaires"] = $Util->getSecretaires();
                $_SESSION["Patients"] = $Util->getPatients();
                $_SESSION["RendezVous"] = $Util->getRendezVousAVenir();

                header("location: ../Vue/secretaire_display.php");
            }
                       
        }
        else
        {
            header("location: ../Vue/index.php");
        }
    }
        
?>
