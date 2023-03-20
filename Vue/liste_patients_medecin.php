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

        // recupere seulement les patients qui ont eu un rendez vous avec le medecin connecté
        $PatientsMedecin = array();
        

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
                                Mes patients
                            </div>
                            <div class="infos">
                            </div>

                            <div class="en_bref">
                                <table class="table table-striped table-condensed p-3">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($Patients as $Patient) {
                                                echo '<tr>';
                                                    echo '<td>'.$Patient->getId_Patient().'</td>';
                                                    echo '<td>'.$Patient->getNom_Patient().'</td>';
                                                    echo '<td>'.$Patient->getPrenom_Patient().'</td>';
                                                    echo '<td><button onclick="expandDetails('.$Patient->getId_Patient().')">Details</button></td>';
                                                echo '</tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>

                                <?php
                                    foreach ($Patients as $Patient) {
                                        echo '<div class="details details'.$Patient->getId_Patient().'" style="display: none;">';
                                            echo '<div class="card">';
                                                echo '<div class="card-header">';
                                                    echo ''.$Patient->getId_Patient().'. '.$Patient->getNom_Patient().' '.$Patient->getPrenom_Patient().'';
                                                echo '</div>';
                                                echo '<div class="card-body">';
                                                    echo '<div class="row">';
                                                        echo '<div class="col-auto">';
                                                            echo '<img src="bootstrap/img/profile.png" alt="patient" width="100" height="100">';
                                                        echo '</div>';
                                                        echo '<div class="col-auto">';
                                                            echo '<h5 class="card-title">Détails du patient</h5>';
                                                            echo '<p class="card-text">Sexe : '.$Patient->getSexe_Patient().'</p>';
                                                            echo '<p class="card-text">Adresse : '.$Patient->getAdresse_Patient().'</p>';
                                                            echo '<p class="card-text">Ville : '.$Patient->getVille_Patient().'</p>';
                                                            echo '<p class="card-text">Département : '.$Patient->getDepartement_Patient().'</p>';
                                                            echo '<p class="card-text">Date de naissance : '.$Patient->getDate_Naissance_Patient().'</p>';
                                                            echo '<p class="card-text">Situation familiale : '.$Patient->getSituation_Familiale_Patient().'</p>';
                                                            echo '<p class="card-text">Affiliation mutuelle : '.$Patient->getAffiliation_Mutuelle().'</p>';
                                                            echo '<p class="card-text">Date de création du dossier : '.$Patient->getDate_Creation_Dossier().'</p>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                    echo '<button onclick="hideDetails('.$Patient->getId_Patient().')">Fermer</button>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';        
                                    }
                                ?>
                            </div>
                        </div>

                        <!-- Right body widget -->
                        <?php include './Elements/medecinNavBar.php';?>

                    </div>

                    <!-- Footer widget -->
                    <?php include './Elements/footer.php';?>
                </div>
            </div>
        </div>
        <script>
            function expandDetails(i) {
                document.querySelector('.details'+i).style.display = 'block';
            }
            function hideDetails(i) {
                document.querySelector('.details'+i).style.display = 'none';
            }
        </script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.js')}}"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
    </body>
</html>
