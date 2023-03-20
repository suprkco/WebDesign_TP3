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
include '../Model/Consultation.php';

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
        $query = "SELECT * FROM patient WHERE Id_Patient='".$Id."'";
        $Patient = NULL;

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
                        $Patient->Id_Patient = $ligne['Id_Patient'];
                        $Patient->Nom_Patient = $ligne['Nom_Patient'];
                        $Patient->Prenom_Patient = $ligne['Prenom_Patient'];
                        $Patient->Sexe_Patient = $ligne['Sexe_Patient'];
                        $Patient->Adresse_Patient = $ligne['Adresse_Patient'];
                        $Patient->Ville_Patient = $ligne['Ville_Patient'];
                        $Patient->Departement_Patient = $ligne['Departement_Patient'];
                        $Patient->Date_Naissance_Patient = $ligne['Date_Naissance_Patient'];
                        $Patient->Situation_Familiale_Patient = $ligne['Situation_Familiale_Patient'];
                        $Patient->Affiliation_Mutuelle = $ligne['Affiliation_Mutuelle'];
                        $Patient->Date_Creation_Dossier = $ligne['Date_Creation_Dossier'];
                        break;
                    }
                }
            }
        }
        return;
    }

    /**
     * 
     * @return \Patients
     */
    public function getPatients() {
        $query = "SELECT * FROM patient";
        $patients = (array) null;
        $index=0;

        $this->dbConnection();

        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }

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
     * 
     * @return \Rendez_Vous
     */
    public function getRendezVousPasse() {
        $query = "SELECT * FROM rendez_vous WHERE Date_Rendez_Vous < NOW() ORDER BY Date_Rendez_Vous";
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
     * 
     * @return \Consultations
     */
    public function getConsultation() {
        $query = "SELECT * FROM consultation ORDER BY Date_Consultation";
        $this->dbConnection();
        $consultations = (array) null;
        $index=0;

        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }

        if(($result = $this->mysqli->query($query))){
            while($row = $result->fetch_assoc()){
                $current_consultation = new Consultation();
                $current_consultation->Id_Consultation = $row['Id_Consultation'];
                $current_consultation->Date_Consultation = $row['Date_Consultation'];
                $current_consultation->Compte_Rendu_Consultation = $row['Compte_Rendu_Consultation'];
                $current_consultation->Id_Patient = $row['Id_Patient'];
                $current_consultation->Id_Medecin = $row['Id_Medecin'];

                $consultations[$index] = $current_consultation;
                $index++;
            }
        }
        return $consultations;
    }

    /**
     * 
     * @return patientsResults
     */
    public function researchInPatients($search){
        // search $search string in patients table
        $query = "SELECT * FROM patient WHERE Id_Patient LIKE '%$search%' OR Nom_Patient LIKE '%$search%' OR Prenom_Patient LIKE '%$search%' OR Adresse_Patient LIKE '%$search%' OR Ville_Patient LIKE '%$search%' OR Departement_Patient LIKE '%$search%' OR Date_Naissance_Patient LIKE '%$search%'";
        $this->dbConnection();
        $patientsResults = (array) null;
        $index=0;

        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }

        if(($result = $this->mysqli->query($query))){
            while($row = $result->fetch_assoc()){
                $current_patient = new Patient();
                $current_patient->Id_Patient = $row['Id_Patient'];
                $current_patient->Nom_Patient = $row['Nom_Patient'];
                $current_patient->Prenom_Patient = $row['Prenom_Patient'];
                $current_patient->Adresse_Patient = $row['Adresse_Patient'];
                $current_patient->Ville_Patient = $row['Ville_Patient'];
                $current_patient->Departement_Patient = $row['Departement_Patient'];
                $current_patient->Date_Naissance_Patient = $row['Date_Naissance_Patient'];
                $current_patient->Situation_Familiale_Patient = $row['Situation_Familiale_Patient'];
                $current_patient->Affiliation_Mutuelle = $row['Affiliation_Mutuelle'];
                $current_patient->Date_Creation_Dossier = $row['Date_Creation_Dossier'];

                $patientsResults[$index] = $current_patient;
                $index++;
            }
        }
        return $patientsResults;
    }

    /**
     * 
     * @return medecinsResults
     */
    public function researchInMedecins($search){
        // search $search string in medecins table, id, nom, prenom
        $query = "SELECT * FROM medecin WHERE Id_Medecin LIKE '%".$search."%' OR Nom_Medecin LIKE '%".$search."%' OR Prenom_Medecin LIKE '%".$search."%'";
        $this->dbConnection();
        $medecinsResults = (array) null;
        $index=0;

        if ($this->mysqli->connect_error) {
            die('Erreur de connexion ('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
        }

        if(($result = $this->mysqli->query($query))){
            while($row = $result->fetch_assoc()){
                $current_medecin = new Medecin();
                $current_medecin->Id_Medecin = $row['Id_Medecin'];
                $current_medecin->Nom_Medecin = $row['Nom_Medecin'];
                $current_medecin->Prenom_Medecin = $row['Prenom_Medecin'];

                $medecinsResults[$index] = $current_medecin;
                $index++;
            }
        }
        return $medecinsResults;
    }

    /**
     * 
     * @return rendez_vousResults
     */
    public function researchInRendezVous($search){
        // search $search string in rendez_vous table
        $query = "SELECT * FROM rendez_vous WHERE Id_Rendez_Vous LIKE '%".$search."%' OR Date_Rendez_Vous LIKE '%".$search."%' OR Salle_Rendez_Vous LIKE '%".$search."%' OR Id_Patient LIKE '%".$search."%' OR Id_Medecin LIKE '%".$search."%'";
        $rendez_vousResults = (array) null;
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

                $rendez_vousResults[$index] = $current_rendez_vous;
                $index++;
            }
        }
        return $rendez_vousResults;
    }

    /**
     * 
     * @return results
     */
    public function researchInDb($search){
        // search in all tables and return a dict with the results
        $results = array();
        $results['patients'] = $this->researchInPatients($search);
        $results['medecins'] = $this->researchInMedecins($search);
        $results['rendez_vous'] = $this->researchInRendezVous($search);
        return $results;
    }
    
    /**
     * connection to the database
     */
    public function dbConnection(){
        $this->mysqli= new mysqli($this->serveur, $this->usr, $this->pass, $this->base);
        $this->mysqli->set_charset("utf8");
    }

}