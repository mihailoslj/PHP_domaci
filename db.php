<?php 

    class Database{
        private $dsn = "mysql:host = localhost; dbname = php_baza_korisnika";
        private $user = "root";
        private $pass = "";
        public $conn;

        public function __construct(){
            try{
                $this -> conn = new PDO($this -> dsn, $this ->user, $this -> pass);
                echo "Uspesna konekcija!";
            }
            catch(PDOException $e) {
                echo $e -> getMessage();
            }
        }
    }

    $ob = new Database();
?>