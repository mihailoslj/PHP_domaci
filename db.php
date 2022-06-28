<?php 

    class Database{
        private $dsn = "mysql:host = localhost; dbname = php_baza_korisnika";
        private $user = "root";
        private $pass = "";
        public $conn;

        public function __construct(){
            try{
                $this -> conn = new PDO($this -> dsn, $this ->user, $this -> pass);
            }
            catch(PDOException $e) {
                echo $e -> getMessage();
            }
        }


        public function insert($fname, $lname, $email, $phone){
            $sql = "INSERT INTO php_baza_korisnika.users(first_name, last_name, email, phone) VALUES 
            (:fname, :lname, :email, :phone)";

            //statment 
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute(['fname' => $fname, 'lname' => $lname, 'email' => $email, 'phone' => $phone]);

            return true;
        }

        //vraca sve Record-e iz baze i prikazuje na main pejdzu
        public function read() {
            $data = array();
            $sql = "SELECT * FROM php_baza_korisnika.users";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $row) {
                $data[] = $row;
            }

            return $data;
        }
        //vraca korisnika na osnovu ID
        public function getUserById($id) {
            $sql = "SELECT * FROM php_baza_korisnika.users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt -> execute(['id'=>$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        }


        public function update($id, $fname, $lname, $email, $phone) {
            $sql = "UPDATE php_baza_korisnika.users SET first_name = :fname, last_name = :lname, email = :email, phone = :phone
            WHERE id = :id";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute(['fname' => $fname, 'lname' => $lname, 'email' => $email, 'phone' => $phone,
                            'id' => $id]);

            return true;
        } 

        public function delete($id) {
            $sql = "DELETE FROM  php_baza_korisnika.users WHERE id = :id";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute(['id' => $id]);

            return true;
        }

        //vraca broj unosa u tabelu(broj korisnika u bazi)
        public function totalRowCount() {
            $sql = "SELECT * FROM php_baza_korisnika.users";
            $stmt = $this -> conn -> prepare($sql);
            $stmt -> execute();
            $t_rows = $stmt -> rowCount();

            return $t_rows;
        }

    }

    $ob = new Database();
?>