<?php
require_once '../cn.php';
class Getter extends DB {
      /*
      *     FUNCTION NAME: show()
      *      DESC: THIS FUNCTION SELECTS DATA
      *            AND RETURNS IT AS AN ARRAY
      *            FROM vacancies TABLE
      */ 
      
      protected $datas = [];
      public function show() {
            $sql = $this->pdo()->query("SELECT id, company_name, vacancy_name, publish_date FROM vacancies");
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $this->datas[] = $row;
            return $this->datas;
      }


      /*
      *     FUNCTION NAME: get_unique_id()
      *      DESC: THIS FUNCTION RETURNS Unique_id
      *            OF THE GIVEN NAME BY PARAMETER
      *            FROM Companies TABLE
      */ 

      protected function get_unique_id($cname) {
            $sql = $this->pdo()->query("SELECT company_name, unique_id FROM companies");
            while($row = $sql->fetch(PDO::FETCH_ASSOC)) if($row['company_name'] == $cname) return $row['unique_id'];
      }


      /*
      *     FUNCTION NAME : myvacas()
      *      DESC: THIS FUNCTION RETURNS COMPANY'S
      *            EVERY VACANCY FROM Vacancies TABLE     
      */ 
      protected $myvacas = [];

      public function myvacas() {
            $sql = $this->pdo()->query("SELECT id, company_name, vacancy_name, publish_date, company_id FROM VACANCIES");
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                  if($row['company_id'] === $this->get_unique_id($_SESSION['cmpn_name'])) {
                        array_pop($row);
                        $this->myvacas[] = $row;
                  }
            };
            return $this->myvacas;
      }
      
      /*
      *     FUNCTION NAME: vacashow()
      *     DESC: THIS FUNCTION SHOWS VACANCIES
      *           ON page.php
      */ 
      protected $vdata = [];

      public function vacashow($id) {
            $sql = $this->pdo()->query("SELECT company_name, vacancy_name, info FROM vacancies where id = " . $id);
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $this->vdata[] = $row;
            return $this->vdata;
      }


      /*
      *     FUNCTION NAME: vacaByKeywords()
      *     DESC: THIS FUNCTION TAKES TWO PARAMETERS
      *           (
      *            First Param = Actual Keywords,
      *           Second Param = Category
      *           )
      *           AND RETURNS MATCH VACANCIES
      *           WITH KEYWORDS THAT USER ENTERED
      *           (FROM vacancies TABLE) 
      */ 

      protected $vacas = [];

      public function vacaByKeywords($s = '', $c = '') {
            if($s != 0 && $c == 0) {
                  $sql = $this->pdo()->query("SELECT id, company_name, vacancy_name, keywords FROM vacancies");
                  $s = join(" ",explode("-", strtolower($s)));
                  while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $key = array_values(array_unique(explode(", ",join(" ",explode("-", $row['keywords'])))));
                        for($i = 0; $i < count($key); $i++) {
                              if($s == $key[$i]) $this->vacas[] = $row;
                        }
                  }
                  return $this->vacas;
            }
            else if($s == 0 && $c != 0) {
                  $sql = $this->pdo()->query("SELECT id, company_name, vacancy_name, keywords FROM vacancies WHERE '$c' = vacancy_category");
                  while($row = $sql->fetch(PDO::FETCH_ASSOC)) $this->vacas[] = $row;
                  return $this->vacas;
            }
            else {
                  $sql = $this->pdo()->query("SELECT id, company_name, vacancy_name, keywords FROM vacancies WHERE '$c' = vacancy_category");
                  $s = join(" ",explode("-", strtolower($s)));
                  while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $key = array_values(array_unique(explode(", ",join(" ",explode("-", $row['keywords'])))));
                        for($i = 0; $i < count($key); $i++) {
                              if($s == strtolower($key[$i])) $this->vacas[] = $row;
                        }
                  }
                  return $this->vacas;
            }
      }


      /*
      *     FUNCTION NAME: signin()
      *     DESC: THIS FUNCTION CHECKS
      *           USERS INPUT VALUES AND
      *           SEARCHES FOR THE MATCHES IN
      *           companies TABLE AND SETS SESSION
      */ 
      public function signin($cname, $cpass) {
            $pass = $this->pdo()->query("SELECT company_name, company_password FROM companies");
            while($row = $pass->fetch(PDO::FETCH_ASSOC)) {
                  if($row['company_name'] == $cname && $row['company_password'] == $cpass) {
                        return $_SESSION['cmpn_name'] = $row['company_name'];
                  }
            }
      }
}