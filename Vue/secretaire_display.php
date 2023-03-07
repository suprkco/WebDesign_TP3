<?php

   require('../Controller/Util.php');
   
   
   session_start();

    /*-- Verification si le formulaire d'authenfication a été bien saisie --*/
   if($_SESSION["acces"]!='y')
   {
            /*-- Redirection vers la page d'authentification --*/
           header("location:index.php");
   }
   else{
        $Util = new Util();
        $Utilisateur = $Util->getUtilisateurById($_SESSION["ID_CONNECTED_USER"]);
        $Secretaire = new Secretaire();
        $Secretaire = $Utilisateur->getSecretaire();
   }

   $Secretaires = $Util->getSecretaires();
   $Medecins = $Util->getMedecins();

    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
               <?php
                    echo $Secretaire->getNom_Secretaire().' '.$Secretaire->getPrenom_Secretaire();
               ?>
        </title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="js/jquery/css/ui-lightness/jquery-ui-1.9.2.custom.css" type="text/css" />
        <link rel="shortcut icon" href="bootstrap/img/brain_icon_2.ico"/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div id="content" class="span9">
                    <div class="main_body">
                    
                        <!-- Header widget -->
                        <?php include './Elements/header.php';?>

                        <div class="Horizontal-menu">
                            <center>
                                <h4>
                                    <?php echo $Secretaire->getNom_Secretaire().' '.$Secretaire->getPrenom_Secretaire(); ?>
                                </h4>
                            </center>
                        </div>

                        <!-- Left body -->
                        <div class="Left-body">
                            <div class="Left-body-head">
                                Liste des rendez-vous à venir 
                            </div>
                            <div class="infos">
                                <?php
                                    // $RendezVous & $Patients are in $_SESSION
                                    $RendezVous = $_SESSION["RendezVous"];
                                    $Patients = $_SESSION["Patients"];
                                
                                    if (isset($RendezVous) && isset($Patients)) { 
                                        try {
                                            foreach ($RendezVous as $rdv) {
                                                $id_rendezvous = intval($rdv->getId_Rendez_Vous());
                                                $id_rendezvous_patient = intval($rdv->getId_Patient());
                                                $id_rendezvous_medecin = intval($rdv->getId_Medecin());

                                                echo '<div class="info"><div class="info-head">';
                                                if (isset($Patients[$id_rendezvous_patient])) {
                                                    echo '<h5>'.$Patients[$id_rendezvous_patient]->getNom_Patient().' '.$Patients[$id_rendezvous_patient]->getPrenom_Patient().'</h5>';
                                                } else {
                                                    echo '<h5>'.$id_rendezvous_patient.'</h5>';
                                                }
                                                echo '</div><div class="info-body">';
                                                echo '<p> Date: '.$rdv->getDate_Rendez_Vous().'</p>';
                                                echo '<p> Salle: '.$rdv->getSalle_Rendez_Vous().'</p>';
                                                if (isset($Medecins[$id_rendezvous_medecin])) {
                                                    echo '<p> Médecin: '.$Medecins[$id_rendezvous_medecin]->getNom_Medecin().' '.$Medecins[$id_rendezvous_medecin]->getPrenom_Medecin().'</p>';
                                                } else {
                                                    echo '<p> Médecin: '.$id_rendezvous_medecin.'</p>';
                                                }
                                                echo '</div></div>';
                                            }
                                        } catch (Exception $e) {
                                            echo '<div class="info"><div class="info-head">';
                                            echo '<h5>'.$e.'</h5>';
                                            echo '</div></div>';
                                        }
                                    }

                                    else {
                                        echo '<div class="info">';
                                        echo '<div class="info-head">';
                                        echo '<h5>Aucun rendez-vous à venir</h5>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                ?>
                            </div>
                        </div>

                        <!-- Right body widget -->
                        <?php include './Elements/secretaireNavBar.php';?>

                    </div>

                    <!-- Footer widget -->
                    <?php include './Elements/footer.php';?>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="bootstrap/js/bootstrap.js')}}"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
    </body>
</html>
