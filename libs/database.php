<?php
    include_once('config.php');
    class Model{
        protected $db;
        public function __construct(){
// IMPLEMENTAR LA FORMA DE CONEXIÓN PDO
            // try{
            //    $this->db = new PDO(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            //    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //    return $this->db;
            // }catch(PDOException $e){
            //     echo 'Databse ERROR: '. $e->getMessage();
            // }
            $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if($this->db->connect_errno){
                exit();
            }
            $this->db->set_charset(DB_CHARSET);
        }
    }
?>