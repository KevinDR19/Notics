<?php 

    class conexion {

        /** 
        * Clase para conexión con método PDO
        */

        private $host = 'localhost';
        private $db = 'Notics';
        private $username = 'kevin';
        private $password = '1234';
        private $atributos = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

        protected $conexion;

        public function conectar() {
            try {
                $this->conexion = new PDO("mysql:host={$this->host};dbname={$this->db};charset=utf8",$this->username,$this->password,$this->atributos);
                return $this->conexion;
            }catch(PDOException $e) {
                echo 'Error conectando con la base de datos: ' . $e.getMessage();
            }
        }

        public function desconectar() {
            $this->conexion = null;
        }
    }