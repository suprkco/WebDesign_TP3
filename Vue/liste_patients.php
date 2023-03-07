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
                                informations clients
                            </div>
                            <div class="infos">
                                <?php
                                    // liste des clients et de leurs informations ci dessous
                                    // 'Id_Patient'
                                    // 'Nom_Patient'
                                    // 'Prenom_Patient'
                                    // 'Sexe_Patient'
                                    // 'Adresse_Patient'
                                    // 'Ville_Patient'
                                    // 'Departement_Patient'
                                    // 'Date_Naissance_Patient'
                                    // 'Situation_Familiale_Patient'
                                    // 'Affiliation_Mutuelle'
                                    // 'Date_Creation_Dossier'

                                    foreach ($Patients as $Patient) {
                                        echo '<div class="info">';
                                            echo '<div class="info-head">';
                                                echo '<h5>';
                                                    echo '<span class="id_patient">Id: '.$Patient->getId_Patient().'</span>';
                                                    echo '<span class="nom_patient">, Nom Prénom: '.$Patient->getNom_Patient().'</span>';
                                                    echo '<span class="prenom_patient"> '.$Patient->getPrenom_Patient().'</span>';
                                                echo '</h5>';
                                            echo '</div>';
                                            echo '<div class="infos-body">';
                                                echo '<p>';
                                                    echo '<span class="sexe_patient">Sexe: '.$Patient->getSexe_Patient().'</span>';
                                                    echo '<span class="date_naissance_patient">, Date de naissance: '.$Patient->getDate_Naissance_Patient().'</span>';
                                                    echo '<span class="adresse_patient">, Adresse: '.$Patient->getAdresse_Patient().'</span>';
                                                    echo '<span class="ville_patient">, Ville: '.$Patient->getVille_Patient().'</span>';
                                                    echo '<span class="departement_patient">, Dpt: '.$Patient->getDepartement_Patient().'</span>';
                                                    echo '<span class="situation_familiale_patient">, Situation: '.$Patient->getSituation_Familiale_Patient().'</span>';
                                                    echo '<span class="affiliation_mutuelle">, Mutuelle: '.$Patient->getAffiliation_Mutuelle().'</span>';
                                                    echo '<span class="date_creation_dossier">, Date création: '.$Patient->getDate_Creation_Dossier().'</span>';
                                                echo '</p>';
                                            echo '</div>';
                                        echo '</div>';
                                    }

                                ?>
                            </div>

                            <div class="en_bref">
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
