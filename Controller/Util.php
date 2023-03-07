<?php

/**
 * Description of Util
 *
 * @author Amin
 */

include '../Model/Utilisateur.php';
include '../Model/Secretaire.php';
include '../Model/Medecin.php';
include '../Model/Patient.php';
include '../Model/Rendez_Vous.php';

class Util {
    
    public $serveur = "195.144.11.150";
    public $base = "zdj62853";
    public $usr =  "zdj62853";
    public $pass = "MIN2022!!";
    public $mysqli;
    
    /**
     * 
     * @param type $Login
     * @param type $password
     * @return \Utilisateur
     */
    public function getUtilisateur($Login, $password){
        
        $Utilisateur = NULL;
        
        $query = "SELECT * FROM utilisateur";
        
        $this->dbConnection();
        
        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }
        
        else{
            if(($result = $this->mysqli->query($query))){
                while($ligne = $result->fetch_assoc()){
                    $_Login = $ligne['Login'];
                    $_password = $ligne['Password'];
                    
                    if( ($Login == $_Login) && ($password == $_password) )
                    {
                         $Utilisateur = new Utilisateur();
                         $Utilisateur->Id_Utilisateur = $ligne['Id_Utilisateur'];
                         $Utilisateur->Login = $ligne['Login'];
                         $Utilisateur->Password = $ligne['Password'];
                         $Utilisateur->Type_Utilisateur = $ligne['Type_Utilisateur'];
                         $Utilisateur->Last_Login = $ligne['Last_Login'];
                         
                         if($Utilisateur->getType_Utilisateur()=="Secretaire"){
                             $Secretaire = $this->getSecretaireByID($ligne['Id_Secretaire']);
                             $Utilisateur->setSecretaire($Secretaire);
                         }
                         if($Utilisateur->getType_Utilisateur()=="Medecin"){
                             $Medecin = $this->getMedecinByID($ligne['Id_Medecin']);
                             $Utilisateur->setMedecin($Medecin);
                         }
                         break;
                    }
                }

            }
        
        }
        return $Utilisateur;
    }
    
    /**
     * 
     * @param type $Id
     * @return \Utilisateur
     */
    public function getUtilisateurById($Id){
        $Utilisateur = NULL;
        
        $query = "SELECT * FROM utilisateur WHERE Id_Utilisateur='".$Id."'";
        
        $this->dbConnection();
        
        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }
        
        else{
            if(($result = $this->mysqli->query($query))){
                while($ligne = $result->fetch_assoc()){
                    $_Id = $ligne['Id_Utilisateur'];
                    
                    if(($Id == $_Id))
                    {
                         $Utilisateur = new Utilisateur();
                         $Utilisateur->Id_Utilisateur = $ligne['Id_Utilisateur'];
                         $Utilisateur->Login = $ligne['Login'];
                         $Utilisateur->Password = $ligne['Password'];
                         $Utilisateur->Type_Utilisateur = $ligne['Type_Utilisateur'];
                         $Utilisateur->Last_Login = $ligne['Last_Login'];
                         
                         if($Utilisateur->getType_Utilisateur()=="Secretaire"){
                             $Secretaire = $this->getSecretaireByID($ligne['Id_Secretaire']);
                             $Utilisateur->setSecretaire($Secretaire);
                         }
                         if($Utilisateur->getType_Utilisateur()=="Medecin"){
                             $Medecin = $this->getMedecinByID($ligne['Id_Medecin']);
                             $Utilisateur->setMedecin($Medecin);
                         }
                         break;
                    }
                }

            }
        
        }
        return $Utilisateur;
    }

    /**
     * 
     * @return \Secretaires
     */
    public function getSecretaires() {
        $query = "SELECT * FROM secretaire";
        $this->dbConnection();
        $Secretaires = (array) null;
        $index = 0;

        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }

        if(($result = $this->mysqli->query($query))){
            while($row = $result->fetch_assoc()){
                $Secretaire = new Secretaire();
                $Secretaire->Id_Secretaire = $row['Id_Secretaire'];
                $Secretaire->Nom_Secretaire = $row['Nom_Secretaire'];
                $Secretaire->Prenom_Secretaire = $row['Prenom_Secretaire'];
                
                $Secretaires[$index] = $Secretaire;
                $index++;
            }
        }
        return $Secretaires;
    }
    
    /**
     * 
     * @param type $Id
     * @return \Secretaire
     */
    public function getSecretaireByID($Id){
        $Secretaire = NULL;
        
        $query = "SELECT * FROM secretaire WHERE Id_Secretaire='".$Id."'";
        
        $this->dbConnection();
        
        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }
        
        else{
            if(($result = $this->mysqli->query($query))){
                while($ligne = $result->fetch_assoc()){
                    $_Id = $ligne['Id_Secretaire'];
                    if(($Id == $_Id))
                    {
                        $Secretaire = new Secretaire();
                        $Secretaire->Id_Secretaire = $ligne['Id_Secretaire'];
                        $Secretaire->Nom_Secretaire = $ligne['Nom_Secretaire'];
                        $Secretaire->Prenom_Secretaire = $ligne['Prenom_Secretaire'];
                        break;
                    }
                }

            }
        
        }
        return $Secretaire;
    }

    /**
     * 
     * @return \Medecins
     */
    public function getMedecins() {
        $query = "SELECT * FROM medecin";
        $this->dbConnection();
        $Medecins = (array) null;
        $index = 0;
        

        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }

        if(($result = $this->mysqli->query($query))){
            while($row = $result->fetch_assoc()){
                $Medecin = new Medecin();
                $Medecin->Id_Medecin = $row['Id_Medecin'];
                $Medecin->Nom_Medecin = $row['Nom_Medecin'];
                $Medecin->Prenom_Medecin = $row['Prenom_Medecin'];
                
                $Medecins[$index] = $Medecin;
                $index++;
            }
        }

        return $Medecins;
    }
    
    /**
     * 
     * @param type $Id
     * @return \Medecin
     */
    public function getMedecinByID($Id){
        $Medecin = NULL;
        
        $query = "SELECT * FROM medecin WHERE Id_Medecin='".$Id."'";
        
        $this->dbConnection();
        
        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }
        
        else{
            if(($result = $this->mysqli->query($query))){
                while($ligne = $result->fetch_assoc()){
                    $_Id = $ligne['Id_Medecin'];
                    
                    if(($Id == $_Id))
                    {
                        $Medecin = new Medecin();
                        $Medecin->Id_Medecin = $ligne['Id_Medecin'];
                        $Medecin->Nom_Medecin = $ligne['Nom_Medecin'];
                        $Medecin->Prenom_Medecin = $ligne['Prenom_Medecin'];
                        break;
                    }
                }

            }
        
        }
        return $Medecin;
    }

    /**
     * 
     * @param type $Id
     * @return \Patient
     */
    public function getPatientByID($Id){
        $Patient = NULL;
        
        $query = "SELECT * FROM patient WHERE Id_Patient='".$Id."'";
        
        $this->dbConnection();
        
        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }
        
        else{
            if(($result = $this->mysqli->query($query))){
                while($ligne = $result->fetch_assoc()){
                    $_Id = $ligne['Id_Patient'];
                    
                    if(($Id == $_Id))
                    {
                        $Patient = new Patient();
                        $patient->Id_Patient = $row['Id_Patient'];
                        $patient->Nom_Patient = $row['Nom_Patient'];
                        $patient->Prenom_Patient = $row['Prenom_Patient'];
                        $patient->Sexe_Patient = $row['Sexe_Patient'];
                        $patient->Adresse_Patient = $row['Adresse_Patient'];
                        $patient->Ville_Patient = $row['Ville_Patient'];
                        $patient->Departement_Patient = $row['Departement_Patient'];
                        $patient->Date_Naissance_Patient = $row['Date_Naissance_Patient'];
                        $patient->Situation_Familiale_Patient = $row['Situation_Familiale_Patient'];
                        $patient->Affiliation_Mutuelle = $row['Affiliation_Mutuelle'];
                        $patient->Date_Creation_Dossier = $row['Date_Creation_Dossier'];
                        break;
                    }
                }

            }
        
        }
        return $Patient;
    }

    /**
     * 
     * @return \Patients
     */
    public function getPatients() {
        $query = "SELECT * FROM patient";
        $this->dbConnection();
        $patients = (array) null;
        $index=0;

        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }

        if(($result = $this->mysqli->query($query))){
            while($row = $result->fetch_assoc()){
                $patient = new Patient();
                $patient->Id_Patient = $row['Id_Patient'];
                $patient->Nom_Patient = $row['Nom_Patient'];
                $patient->Prenom_Patient = $row['Prenom_Patient'];
                $patient->Sexe_Patient = $row['Sexe_Patient'];
                $patient->Adresse_Patient = $row['Adresse_Patient'];
                $patient->Ville_Patient = $row['Ville_Patient'];
                $patient->Departement_Patient = $row['Departement_Patient'];
                $patient->Date_Naissance_Patient = $row['Date_Naissance_Patient'];
                $patient->Situation_Familiale_Patient = $row['Situation_Familiale_Patient'];
                $patient->Affiliation_Mutuelle = $row['Affiliation_Mutuelle'];
                $patient->Date_Creation_Dossier = $row['Date_Creation_Dossier'];

                $patients[$index] = $patient;
                $index++;
            }
        }

        return $patients;
    }

    /**
     * 
     * @param type $Id
     * @return \Rendez_Vous
     */
    public function getRendezVousByID($Id){
        $Rendez_Vous = NULL;
        
        $query = "SELECT * FROM rendez_vous WHERE Id_Rendez_Vous='".$Id."'";
        
        $this->dbConnection();
        
        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }
        
        else{
            if(($result = $this->mysqli->query($query))){
                while($ligne = $result->fetch_assoc()){
                    $_Id = $ligne['Id_Rendez_Vous'];
                    
                    if(($Id == $_Id))
                    {
                        $Rendez_Vous = new Rendez_Vous();
                        $Rendez_Vous->Id_Rendez_Vous = $ligne['Id_Rendez_Vous'];
                        $Rendez_Vous->Date_Rendez_Vous = $ligne['Date_Rendez_Vous'];
                        $Rendez_Vous->Salle_Rendez_Vous = $ligne['Salle_Rendez_Vous'];
                        $Rendez_Vous->Id_Patient = $ligne['Id_Patient'];
                        $Rendez_Vous->Id_Medecin = $ligne['Id_Medecin'];

                        break;
                    }
                }

            }
        
        }
        return $Rendez_Vous;
    }

    /**
     * 
     * @return \Rendez_Vous
     */
    public function getRendezVous() {
        $query = "SELECT * FROM rendez_vous ORDER BY Date_Rendez_Vous";
        // $query = "SELECT * FROM rendez_vous";
        $this->dbConnection();
        $rendez_vous = (array) null;
        $index=0;

        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }

        if(($result = $this->mysqli->query($query))){
            while($row = $result->fetch_assoc()){
                $current_rendez_vous = new Rendez_Vous();
                $current_rendez_vous->Id_Rendez_Vous = $row['Id_Rendez_Vous'];
                $current_rendez_vous->Date_Rendez_Vous = $row['Date_Rendez_Vous'];
                $current_rendez_vous->Salle_Rendez_Vous = $row['Salle_Rendez_Vous'];
                $current_rendez_vous->Id_Patient = $row['Id_Patient'];
                $current_rendez_vous->Id_Medecin = $row['Id_Medecin'];

                $rendez_vous[$index] = $current_rendez_vous;
                $index++;
            }
        }

        return $rendez_vous;
    }

    /**
     * 
     * @return \Rendez_Vous
     */
    public function getRendezVousAVenir() {
        $query = "SELECT * FROM rendez_vous WHERE Date_Rendez_Vous > NOW() ORDER BY Date_Rendez_Vous";
        $this->dbConnection();
        $rendez_vous = (array) null;
        $index=0;

        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }

        if(($result = $this->mysqli->query($query))){
            while($now = $result->fetch_assoc()){
                $current_rendez_vous = new Rendez_Vous();
                $current_rendez_vous->Id_Rendez_Vous = $now['Id_Rendez_Vous'];
                $current_rendez_vous->Date_Rendez_Vous = $now['Date_Rendez_Vous'];
                $current_rendez_vous->Salle_Rendez_Vous = $now['Salle_Rendez_Vous'];
                $current_rendez_vous->Id_Patient = $now['Id_Patient'];
                $current_rendez_vous->Id_Medecin = $now['Id_Medecin'];

                $rendez_vous[$index] = $current_rendez_vous;
                $index++;
            }
        }

        return $rendez_vous;
    }
    
    /**
     * connection to the database
     */
    public function dbConnection(){
        $this->mysqli= new mysqli($this->serveur, $this->usr, $this->pass, $this->base);
        $this->mysqli->set_charset("utf8");
    }

}