<?php
/**
 * Description of Consultation
 *
 * @author Suprkco
 */
class Consultation {
    
    /**
     * Attributs
     */
    public $Id_Consultation;
    public $Date_Consultation;
    public $Compte_Rendu_Consultation;
    public $Id_Patient;
    public $Id_Medecin;

    /**
     * 
     */
    public function __construct() {
        
    }

    /**
     * 
     * @return type
     */
    public function getId_Consultation() {
        return $this->Id_Consultation;
    }

    /**
     * 
     * @return type
     */
    public function getDate_Consultation() {
        return $this->Date_Consultation;
    }

    /**
     * 
     * @return type
     */
    public function getCompte_Rendu_Consultation() {
        return $this->Compte_Rendu_Consultation;
    }

    /**
     * 
     * @return type
     */
    public function getId_Patient() {
        return $this->Id_Patient;
    }

    /**
     * 
     * @return type
     */
    public function getId_Medecin() {
        return $this->Id_Medecin;
    }

    /**
     * 
     * @param type $Id_Consultation
     */
    public function setId_Consultation($Id_Consultation) {
        $this->Id_Consultation = $Id_Consultation;
    }

    /**
     * 
     * @param type $Date_Consultation
     */
    public function setDate_Consultation($Date_Consultation) {
        $this->Date_Consultation = $Date_Consultation;
    }

    /**
     * 
     * @param type $Compte_Rendu_Consultation
     */
    public function setCompte_Rendu_Consultation($Compte_Rendu_Consultation) {
        $this->Compte_Rendu_Consultation = $Compte_Rendu_Consultation;
    }

    /**
     * 
     * @param type $Id_Patient
     */
    public function setId_Patient($Id_Patient) {
        $this->Id_Patient = $Id_Patient;
    }

    /**
     * 
     * @param type $Id_Medecin
     */
    public function setId_Medecin($Id_Medecin) {
        $this->Id_Medecin = $Id_Medecin;
    }

}
?>