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

        $Patients = $_SESSION["Patients"];
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
                                informations medecins
                            </div>
                            <div class="infos">
                            </div>

                            <div class="en_bref">

                                <!-- table -->
                                <table class="table table-striped table-condensed p-3">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($Medecins as $Medecin) {
                                                echo '<tr>';
                                                    echo '<td>'.$Medecin->getId_Medecin().'</td>';
                                                    echo '<td>'.$Medecin->getNom_Medecin().'</td>';
                                                    echo '<td>'.$Medecin->getPrenom_Medecin().'</td>';
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
