<?php
include_once 'cn.php';

function id($n) {
      $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $str = str_split($str, 1);
      shuffle($str);
      $str = array_slice($str, 0, $n);
      return  join("", $str);
}
id(8);

class Functions extends DB{
      protected function insert($fname, $lname, $cname,$cemail, $zcode, $pnumber, $vname, $category) {
            $sql = $this->pdo()->prepare("INSERT INTO vacancies (first_name, last_name, company_name, company_email, zip_code, phone_number, vacancy_name, vacancy_category, unique_id)
                                                       values (:fn, :ln, :cn, :ce, :zc, :pn, :vn, :vc, :ud);");
            $sql->bindValue(":fn", $fname);
            $sql->bindValue(":ln", $lname);
            $sql->bindValue(":cn", $cname);
            $sql->bindValue(":ce", $cemail);
            $sql->bindValue(":zc", $zcode);
            $sql->bindValue(":pn", $pnumber);
            $sql->bindValue(":vn", $vname);
            $sql->bindValue(":vc", $category);
            $sql->bindValue(":ud", id(8));
            $sql->execute();
      }
}