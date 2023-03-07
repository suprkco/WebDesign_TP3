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
        $Medecins = $Util->getMedecins();
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
                        
                        <!-- Horizontal menu -->
                        <div class="Horizontal-menu">
                            <center>
                                <h4>
                                    <?php
                                        echo $Secretaire->getNom_Secretaire().' '.$Secretaire->getPrenom_Secretaire();
                                   ?>
                                </h4>
                            </center>
                        </div>

                        <!-- Left body -->
                        <div class="Left-body">
                            <div class="Left-body-head">
                                Ajouter un nouveau rendez-vous
                            </div>
                            <div class="infos">
                                
                            </div>
                            <div class="en_bref">
                                <form action="../Controller/ajout_rdv_2bdd.php" method="post">
                                    <br/>
                                    <label>Date du rendez vous :</label>
                                    <input class="date" type="date" name="Date_Rendez_Vous" value="<?php echo date('Y-m-d');?>" size="50"/><br/>


                                    <label>Salle du rendez vous :</label>
                                    <input class="textfield_form" type="text" name="Salle_Rendez_Vous" size="50"/><br/>

                                    <!-- "ID_Patient" -->
                                    <label>Patient :</label>
                                    <select name="ID_Patient">
                                        <?php
                                            foreach ($Patients as $Patient) {
                                                echo '<option value="'.$Patient->getID_Patient().'">'.$Patient->getNom_Patient().' '.$Patient->getPrenom_Patient().'</option>';
                                            }
                                        ?>
                                    </select>
                                    <br/>

                                    <!-- "ID_Medecin" -->
                                    <label>Medecin :</label>
                                    <select name="ID_Medecin">
                                        <?php
                                            if (isset($Medecins)) {
                                                foreach ($Medecins as $Medecin) {
                                                    echo '<option value="'.$Medecin->getID_Medecin().'">'.$Medecin->getNom_Medecin().' '.$Medecin->getPrenom_Medecin().'</option>';
                                                }
                                            }
                                            else{
                                                echo '<option value="0">Aucun medecin disponible</option>';
                                            }
                                        ?>
                                    </select>

                                    <br/>
                                    
                                    <input type="reset" name="effacer" value = "Effacer"/>
                                    <input type="submit" name="valider" value = "Ajouter"/>
                                </form>
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
