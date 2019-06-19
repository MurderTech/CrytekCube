<?php

    require_once('configPF.php');
    
    class modeloCredencialesBD{
        protected $_db;
        
        public function __construct(){
            
            $this->_db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            if ($this->_db->connect_errno){
                echo "Ha fallado la conexion a la Base de Datos " . $this->db->connect_errno;
                return;
            }
        }
    }

?>