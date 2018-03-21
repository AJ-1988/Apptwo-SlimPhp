<?php

class db{
  private $user = 'root';
  private $pwd = 'tiger321';
  private $host= 'localhost';
  private $db_name = 'user_api';

  public function connect() {
    try {
      $dsn = "mysql:host=$this->host;dbname=$this->db_name";

      $pdo = new PDO($dsn, $this->user, $this->pwd);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $pdo;
    } catch (PDOException $e) {
      echo 'Opps something went wrong' . $this->e;
    }
  }
}
