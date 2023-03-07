<?php

    /**
     * Description of Rendez_Vous
     * 
     * @author suprkco
     */
    class Rendez_Vous {
        /**
         * Attributs
         */
        public $Id_Rendez_Vous;
        public $Date_Rendez_Vous;
        public $Salle_Rendez_Vous;
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
        public function getId_Rendez_Vous() {
            return $this->Id_Rendez_Vous;
        }

        /**
         * 
         * @return type
         */
        public function getDate_Rendez_Vous() {
            return $this->Date_Rendez_Vous;
        }

        /**
         * 
         * @return type
         */
        public function getSalle_Rendez_Vous() {
            return $this->Salle_Rendez_Vous;
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
         * @param type $Id_Rendez_Vous
         */
        public function setId_Rendez_Vous($Id_Rendez_Vous) {
            $this->Id_Rendez_Vous = $Id_Rendez_Vous;
        }

        /**
         * 
         * @param type $Date_Rendez_Vous
         */
        public function setDate_Rendez_Vous($Date_Rendez_Vous) {
            $this->Date_Rendez_Vous = $Date_Rendez_Vous;
        }

        /**
         * 
         * @param type $Salle_Rendez_Vous
         */
        public function setSalle_Rendez_Vous($Salle_Rendez_Vous) {
            $this->Salle_Rendez_Vous = $Salle_Rendez_Vous;
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