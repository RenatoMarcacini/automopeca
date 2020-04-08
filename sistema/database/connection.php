<?php 
    class Support{

        public $localhost = "localhost";
        public $username = "root";
        public $password = "";
        public $dbname = "automopeca_servico";
    
        public  $connect;
    
        function __construct()
        {
            $this->connect = new mysqli($this->localhost,$this->username,$this->password,$this->dbname);

            if($this->connect->connect_error){
                die("Falha na conexão com o banco de dados, erro: " . $this->connect->connect_error);
            }
        }
    }
?>