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
                                Ajouter un nouveau patient 
                            </div>
                            <div class="infos">
                                
                            </div>
                            <div class="en_bref">
                                <form action="../Controller/ajout_patient_2bdd.php" method="post">
                                    <br/>
                                    <label>Nom :</label>
                                    <input class="textfield_form" type="text" name="Nom_Patient" size="50"/><br/>
                                    
                                    <label>Prénom :</label>
                                    <input class="textfield_form" type="text" name="Prenom_Patient" size="50"/><br/>
                                    
                                    <label>Sexe :</label>
                                    <input class="textfield_form" type="radio"  name="Sexe_Patient" value="Femme"/>Femme
                                    <input class="textfield_form" type="radio"  name="Sexe_Patient" value="Homme"/>Homme
                                    <br/><br/>
                                    
                                    <label>Adresse :</label>
                                    <textarea name="Adresse_Patient"></textarea>
                                    <br/>

                                    <label>Ville :</label>
                                    <input class="textfield_form" type="text" name="Ville_Patient" size="50"/>
                                    
                                    <label>Département :</label>
                                    <input class="textfield_form" type="text" name="Departement_Patient" size="50"/>
                                    <br/>                                            
                                    
                                    <label>Date Naissance :</label>
                                    <input type="date" name="Date_Naissance_Patient"/>
                                    <br/>
                                    
                                    <label>Situation familiale :</label>
                                    <input  type="radio"  name="Situation_Familiale_Patient" value="Celibataire"/>Célibataire
                                    <input  type="radio"  name="Situation_Familiale_Patient" value="Marie(e)"/>Marié(e)
                                    <br/><br/>
                                    
                                    <label>Affiliation Mutuelle :</label>
                                    <input class="textfield_form" type="text" name="Affiliation_Mutuelle_Patient" size="50"/>
                                    <br/>

                                    <label>Date création dossier :</label>
                                    <input type="date" name="Date_Creation_Dossier_Patient" value="<?php echo date('Y-m-d');?>" />
                                    <br/><br/><br/>
                                    
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
