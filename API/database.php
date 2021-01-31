<?php

class DB
{
  private $username = "jljbzxjcxicvvn";
  private $password = "f608bcd12574fc48e322dcc08ca5dc6829404f3cb598eb36812439392ad2b4d7";
  private $host = "ec2-176-34-237-141.eu-west-1.compute.amazonaws.com";
  private $port = "5432";
  private $database_name = "d1b4oe0cmou81i";

  public function dbConnect(){

    try
    {
      $dbConnect = new PDO("pgsql:host = ".$this->host."; dbname = ".$this->database_name, $this->username, $this->password);
    }
    catch(PDOException $e)
    {
      echo "Connection error ".$e->getMessage();
      exit;
    }
  }
}


?>