<?php
class DB {
      // companies db
      protected $cmpdbname = "onlinejobsfindercompanies";
      protected $cmpusername = "root";
      protected $cmppassword = "gabogio210";
      
      protected function cmp() {
            $pdo = New PDO("mysql:host=localhost;dbname=".$this->cmpdbname, $this->cmpusername, $this->cmppassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
      }

      // users db
      protected $usrdbname = "onlinejobsfinderusers";
      protected $usrusername = "root";
      protected $usrpassword = "gabogio210";

      protected function usr() {
            $pdo = New PDO("mysql:host=localhost;dbname=".$this->usrdbname, $this->usrusername, $this->usrpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
      }

}