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
        $Medecin = new Secretaire();
        $Medecin = $Utilisateur->getMedecin();

        $Medecins = $Util->getMedecins();
        $Patients = $Util->getPatients();
        $Secretaires = $Util->getSecretaires();

        $RendezVous = $Util->getRendezVousAVenir();
        // Recupere seulement les rendezvous du medecin connecté
        $RendezVousMedecin = array();
        foreach ($RendezVous as $RendezVous) {
            if($RendezVous->getId_Medecin() == $Medecin->getId_Medecin()){
                array_push($RendezVousMedecin, $RendezVous);
            }
        }
   }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
               <?php
                    
                    echo $Medecin->getNom_Medecin().' '.$Medecin->getPrenom_Medecin();
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
                                    <?php
                                        echo $Medecin->getNom_Medecin().' '.$Medecin->getPrenom_Medecin();
                                   ?>
                                </h4>
                            </center>
                        </div>

                        <!-- Left body -->
                        <div class="Left-body">
                            <div class="Left-body-head">
                                Liste des vos rendez-vous (à venir)
                            </div>
                            <div class="infos">
                                
                            </div>
                            <div class="en_bref">
                                    <!-- Si il y a des rendez-vous à venir, ils seront affichés dans le tableau ci-dessous.
                                    Sinon on affiche un message d'erreur. -->
                                    <?php
                                        if(count($RendezVousMedecin) == 0){
                                            echo '<div class="alert alert-error">';
                                                echo '<center>';
                                                    echo '<h4 class="alert-heading">Aucun rendez-vous à venir</h4>';
                                                echo '</center>';
                                            echo '</div>';
                                        }
                                        else{
                                            $i = 1;
                                            echo '<table class="table table-striped table-condensed p-3">';
                                                echo '<thead>';
                                                    echo '<tr>';
                                                        echo '<th>Ordre</th>';
                                                        echo '<th>Date Rendez-Vous</th>';
                                                        echo '<th>Salle Rendez-Vous</th>';
                                                        echo '<th>Id Patient</th>';
                                                        echo '<th>Nom Patient</th>';
                                                        echo '<th>Prenom Patient</th>';
                                                        echo '</tr>';
                                                echo '</thead>';
                                                echo '<tbody>';
                                                foreach ($RendezVousMedecin as $rdv){
                                                    $Patient = new Patient();
                                                    $id_rendezvous_patient = intval($rdv->getId_Patient());
                                                    echo '<tr>';
                                                        echo '<td>'. $i . '</td>';
                                                        echo '<td>'. $rdv->getDate_Rendez_Vous() . '</td>';
                                                        echo '<td>'. $rdv->getSalle_Rendez_Vous() . '</td>';
                                                        echo '<td>'. $rdv->getId_Patient() . '</td>';
                                                        if (isset($Patients[$id_rendezvous_patient])) {
                                                            echo '<td>'.$Patients[$id_rendezvous_patient]->getNom_Patient().'</td>';
                                                            echo '<td>'.$Patients[$id_rendezvous_patient]->getPrenom_Patient().'</td>';
                                                        } else {
                                                            echo '<td>Pas définis</td>';
                                                            echo '<td>Pas définis</td>';
                                                        }
                                                    echo '</tr>';
                                                    $i++;
                                                }
                                                echo '</tbody>';
                                            echo '</table>';
                                        }
                                    ?>
                            </div>
                        </div>

                        <!-- Right body -->
                        <?php include './Elements/medecinNavBar.php';?>

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
