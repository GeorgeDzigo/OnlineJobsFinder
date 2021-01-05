<?php
include_once 'cn.php';
function id($n) {
      $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $str = str_split($str, 1);
      shuffle($str);
      $str = array_slice($str, 0, $n);
      return join("", $str);
}
id(8);



class Functions extends DB{
      public function insert($fname, $lname, $cname,$cemail, $zcode, $pnumber, $vname, $category, $keywords, $info) {
            $date = date("Y")."-".date("m")."-".date("d");
            $sql = $this->pdo()->prepare("INSERT INTO vacancies (first_name, last_name, company_name, company_email, zip_code, phone_number, vacancy_name, vacancy_category, keywords, info, publish_date, expiration_date, unique_id)
                                                       values (:fn, :ln, :cn, :ce, :zc, :pn, :vn, :vc, :kw, :info, :pud, :expd,:ud)");
            $sql->bindValue(":fn", $fname);
            $sql->bindValue(":ln", $lname);
            $sql->bindValue(":cn", $cname);
            $sql->bindValue(":ce", $cemail);
            $sql->bindValue(":zc", $zcode);
            $sql->bindValue(":pn", $pnumber);
            $sql->bindValue(":vn", $vname);
            $sql->bindValue(":vc", $category);
            $sql->bindValue(":kw", $keywords);
            // DATE
                  $sql->bindValue(":pud", $date);
                  $sql->bindValue(":expd", date('Y-m-d', strtotime($date. ' + 1 days')));
            $sql->bindValue(":info",htmlentities($info));
            $sql->bindValue(":ud", id(8));
            $sql->execute();
      }
      // SHOW VACANCIES
      protected $datas = [];

      public function show() {
            $sql = $this->pdo()->query("SELECT id, company_name, vacancy_name, publish_date FROM vacancies");
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $this->datas[] = $row;
            
            return $this->datas;
      }
      // Show Vacancy On Page
      protected $vdata = [];

      public function vacashow($id) {
            $sql = $this->pdo()->query("SELECT company_name, vacancy_name, info FROM vacancies where id = " . $id);
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) $this->vdata[] = $row;
            return $this->vdata;
      }
      // GET KEYWORDS
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

      public function delete() {
            $sql = $this->pdo()->query("SELECT expiration_date FROM vacancies");
            $date = date("Y-m-d");
            while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                  if($date == $row['expiration_date']) {
                        $del = $this->pdo()->query("DELETE FROM vacancies");
                        $del->execute();
                  }
            }
      }
}