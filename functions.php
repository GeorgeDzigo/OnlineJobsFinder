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
            $sql = $this->pdo()->prepare("INSERT INTO vacancies (first_name, last_name, company_name, company_email, zip_code, phone_number, vacancy_name, vacancy_category, keywords, info, unique_id)
                                                       values (:fn, :ln, :cn, :ce, :zc, :pn, :vn, :vc, :kw, :info, :ud)");
            $sql->bindValue(":fn", $fname);
            $sql->bindValue(":ln", $lname);
            $sql->bindValue(":cn", $cname);
            $sql->bindValue(":ce", $cemail);
            $sql->bindValue(":zc", $zcode);
            $sql->bindValue(":pn", $pnumber);
            $sql->bindValue(":vn", $vname);
            $sql->bindValue(":vc", $category);
            $sql->bindValue(":kw", $keywords);
            $sql->bindValue(":info",htmlentities($info));
            $sql->bindValue(":ud", id(8));
            $sql->execute();
      }
      // SHOW VACANCIES
      protected $datas = [];

      public function show() {
            $sql = $this->pdo()->query("SELECT id, company_name, vacancy_name FROM vacancies");
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

      public function vacaByKeywords($query) {
            $sql = $this->pdo()->query("SELECT id, company_name, vacancy_name, keywords FROM vacancies");
            $query = explode("+", join(" ",explode("-", join("",$query))));
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
                  $keys = explode(",", join(" ", explode("-",$row['keywords'])));
                  for ($i = 0; $i < count($query); $i++)  {
                        for($o = 0; $o < count($keys); $o++){
                              if(strtolower($query[$i]) == strtolower($keys[$i])) $this->vacas[] = $row;
                        }
                  }
            }
            return $this->vacas;
      }
}