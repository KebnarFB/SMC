<?php 
class Conexion {
    private $host = "127.0.0.1";
    private $user = "root";
    private $pwd = "";
    private $db = "smc_db";
    public $pdo;
    public $connect = false;

    public function __construct(){
        try{
            $dsn = "mysql:host={$this-> host};dbname={$this -> db}";
            $this -> pdo = new PDO($dsn, $this -> user, $this -> pwd);
            $this -> pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this -> connect = true;
        }catch(PDOexception $e){
            $this -> connect = false;
        }
    }
}
?>
