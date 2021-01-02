<?php
class DB  {
      protected $dbname = "onlinejobsfinder";
      protected $username = "root";
      protected $password = "gabogio210";
      
      protected function pdo() {
            $pdo = New PDO("mysql:host=localhost;dbname=".$this->dbname, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
      }

}
