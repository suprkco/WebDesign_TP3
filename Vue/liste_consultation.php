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

        $Patients = $Util->getPatients();

        $Consultations = $Util->getConsultation();
        $ConsultationsMedecin = array();
        foreach ($Consultations as $Consultation) {
            if($Consultation->getId_Medecin() == $Medecin->getId_Medecin()){
                array_push($ConsultationsMedecin, $Consultation);
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
                                Mes consultations (Passée)
                            </div>
                            <div class="infos">
                                
                            </div>
                            <div class="en_bref">
                                <?php
                                    if (count($ConsultationsMedecin) > 0) {
                                        echo '<table class="table table-striped table-condensed">';
                                            echo '<thead>';
                                                echo '<tr>';
                                                    echo '<th>Id Consultation</th>';
                                                    echo '<th>Date Consultation</th>';
                                                    echo '<th>Compte Rendu Consultation</th>';
                                                    echo '<th>Patient</th>';
                                                echo '</tr>';
                                            echo '</thead>';
                                            echo '<tbody>';
                                                foreach ($ConsultationsMedecin as $Consultation) {
                                                    $id_consultation_patient = intval($Consultation->getId_Patient());
                                                    echo '<tr>';
                                                        echo '<td>'.$Consultation->Id_Consultation.'</td>';
                                                        echo '<td>'.$Consultation->Date_Consultation.'</td>';
                                                        echo '<td>'.$Consultation->Compte_Rendu_Consultation.'</td>';
                                                        echo '<td>'.$Patients[$id_consultation_patient]->getPrenom_Patient().' '.$Patients[$id_consultation_patient]->getNom_Patient().'</td>';
                                                    echo '</tr>';
                                                }
                                            echo '</tbody>';
                                        echo '</table>';
                                    } else {
                                        echo '<h5>Vous n\'avez pas encore de consultation</h5>';
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
        <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
    </body>
    
</html>
