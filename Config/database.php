<?php
class Database {
  private $username = "jljbzxjcxicvvn";
  private $password = "f608bcd12574fc48e322dcc08ca5dc6829404f3cb598eb36812439392ad2b4d7";
  private $host = "ec2-176-34-237-141.eu-west-1.compute.amazonaws.com";
  private $database_name = "d1b4oe0cmou81i";

  public $conn;

  public function getConnection(){
    $this->conn = null;
    try{
      $this->conn = new PDO("pgsql:host=".$this->host.";dbname=".$this->database_name, $this->username, $this->password, array(
        PDO::ATTR_PERSISTENT => true));
      $this->conn->exec("set names utf8");
    }catch(PDOException $exception){
      echo "Database could not be connected: " . $exception->getMessage();
    }
    return $this->conn;
  }
}
?>