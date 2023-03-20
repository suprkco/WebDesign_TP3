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

        $search = $_POST['search'];
        $results = $Util->researchInDb($search);

        $Number_results = 0;
        foreach ($results as $key => $value) {
            $Number_results += count($value);
        }

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
                                Résultat de la recherche: <?php echo $Number_results; ?> résultat(s)
                            </div>
                            <div class="infos">
                            </div>
                            <div class="en_bref">
                                <?php                               
                                    if ($results['patients']) {
                                        echo '<h3>Patient:</h3><br/>';
                                        echo '<table class="table table-striped table-condensed p-3">';
                                            echo '<thead>';
                                                echo '<tr>';
                                                    echo '<th>Id patient</th>';
                                                    echo '<th>Nom</th>';
                                                    echo '<th>Prénom</th>';
                                                    echo '<th>Adresse</th>';
                                                    echo '<th>Ville</th>';
                                                    echo '<th>Departement</th>';
                                                echo '<tr>';
                                            echo '</thead>';
                                            echo '<tbody>';
                                                foreach ($results['patients'] as $patient) {
                                                    echo '<tr>';
                                                        echo '<td>'.$patient->getId_Patient().'</td>';
                                                        echo '<td>'.$patient->getNom_Patient().'</td>';
                                                        echo '<td>'.$patient->getPrenom_Patient().'</td>';
                                                        echo '<td>'.$patient->getAdresse_Patient().'</td>';
                                                        echo '<td>'.$patient->getVille_Patient().'</td>';
                                                        echo '<td>'.$patient->getDepartement_Patient().'</td>';
                                                    echo '</tr>';
                                                }
                                            echo '</tbody>';
                                        echo '</table>';
                                    } else {
                                        echo '<h3>Aucun patient trouvé</h3><br/>';
                                    }

                                    if ($results['medecins']) {
                                        echo '<h3>Médecin:</h3><br/>';
                                        echo '<table class="table table-striped table-condensed p-3">';
                                            echo '<thead>';
                                                echo '<tr>';
                                                    echo '<th>Id médecin</th>';
                                                    echo '<th>Nom</th>';
                                                    echo '<th>Prénom</th>';
                                                echo '<tr>';
                                            echo '</thead>';
                                            echo '<tbody>';
                                                foreach ($results['medecins'] as $medecin) {
                                                    echo '<tr>';
                                                        echo '<td>'.$medecin->getId_Medecin().'</td>';
                                                        echo '<td>'.$medecin->getNom_Medecin().'</td>';
                                                        echo '<td>'.$medecin->getPrenom_Medecin().'</td>';
                                                    echo '</tr>';
                                                }
                                            echo '</tbody>';
                                        echo '</table>';
                                    } else {
                                        echo '<h3>Aucun médecin trouvé</h3><br/>';
                                    }

                                    if ($results['rendez_vous']) {
                                        echo '<h3>Rendez-vous:</h3><br/>';
                                        echo '<table class="table table-striped table-condensed p-3">';
                                            echo '<thead>';
                                                echo '<tr>';
                                                    echo '<th>Id rendez-vous</th>';
                                                    echo '<th>Date</th>';
                                                    echo '<th>Heure</th>';
                                                    echo '<th>Médecin</th>';
                                                    echo '<th>Patient</th>';
                                                echo '<tr>';
                                            echo '</thead>';
                                            echo '<tbody>';
                                                foreach ($results['rendez_vous'] as $rendez_vous) {
                                                    echo '<tr>';
                                                        echo '<td>'.$rendez_vous->getId_RendezVous().'</td>';
                                                        echo '<td>'.$rendez_vous->getDate_RendezVous().'</td>';
                                                        echo '<td>'.$rendez_vous->getHeure_RendezVous().'</td>';
                                                        echo '<td>'.$rendez_vous->getMedecin()->getNom_Medecin().' '.$rendez_vous->getMedecin()->getPrenom_Medecin().'</td>';
                                                        echo '<td>'.$rendez_vous->getPatient()->getNom_Patient().' '.$rendez_vous->getPatient()->getPrenom_Patient().'</td>';
                                                    echo '</tr>';
                                                }
                                            echo '</tbody>';
                                        echo '</table>';
                                    } else {
                                        echo '<h3>Aucun rendez-vous trouvé</h3><br/>';
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
