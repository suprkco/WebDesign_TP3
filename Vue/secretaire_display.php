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

        $Medecins = $Util->getMedecins();
        $Secretaires = $Util->getSecretaires();
        $Patients = $Util->getPatients();
        $RendezVous = $Util->getRendezVousAVenir();
   }


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
        <?php include './Elements/headImports.php';?>
        
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
                            </div>
                            <div class="en_bref">
                                <!-- tables rendez vous à venrir -->
                                <table class="table table-striped table-condensed p-3">
                                    <thead>
                                        <tr>
                                            <th>Ordre</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Date</th>
                                            <th>Salle</th>
                                            <th>Médecin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if (isset($RendezVous) && isset($Patients)) { 
                                                try {
                                                    $i = 1;
                                                    foreach ($RendezVous as $rdv) {
                                                        $id_rendezvous = intval($rdv->getId_Rendez_Vous());
                                                        $id_rendezvous_patient = intval($rdv->getId_Patient());
                                                        $id_rendezvous_medecin = intval($rdv->getId_Medecin());

                                                        echo '<tr>';
                                                        echo '<td>'.$i.'</td>';
                                                        if (isset($Patients[$id_rendezvous_patient])) {
                                                            echo '<td>'.$Patients[$id_rendezvous_patient]->getNom_Patient().'</td>';
                                                            echo '<td>'.$Patients[$id_rendezvous_patient]->getPrenom_Patient().'</td>';
                                                        } else {
                                                            echo '<td>'.$id_rendezvous_patient.'</td>';
                                                            echo '<td>'.$id_rendezvous_patient.'</td>';
                                                        }
                                                        echo '<td>'.$rdv->getDate_Rendez_Vous().'</td>';
                                                        echo '<td>'.$rdv->getSalle_Rendez_Vous().'</td>';
                                                        if (isset($Medecins[$id_rendezvous_medecin])) {
                                                            echo '<td>'.$Medecins[$id_rendezvous_medecin]->getNom_Medecin().' '.$Medecins[$id_rendezvous_medecin]->getPrenom_Medecin().'</td>';
                                                        } else {
                                                            echo '<td>'.$id_rendezvous_medecin.'</td>';
                                                        }
                                                        echo '</tr>';
                                                        $i++;
                                                    }
                                                } catch (Exception $e) {
                                                    echo '<tr>';
                                                    echo '<td>'.$e.'</td>';
                                                    echo '</tr>';
                                                }
                                            }

                                            else {
                                                echo '<tr>';
                                                echo '<td>Aucun rendez-vous à venir</td>';
                                                echo '</tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
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
