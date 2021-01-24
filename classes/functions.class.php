<?php
require_once 'cn.php';

class Functions extends DB {
      /*
      *     FUNCTION NAME: checkverify()
      *     DESC: THIS FUNCTION CHECKS IF ACCOUNT
      *           IS VERIFIED. IF ACCOUNT IS VERIFIED 
      *           FUNCTION WILL RETURN 1 ELSE, WILL RETURN 0
      */ 
      
      public function checkverify($cname) {
            $v = $this->cmp()->query("SELECT company_name, verified FROM companies");
            $res = 1;
            while($row = $v->fetch(PDO::FETCH_ASSOC)) {
                  if($cname == $row['company_name'] && $row['verified'] == 0) $res = 0;
            }
            return $res;
      }

      /*
      *     FUNCTION NAME: delete()
      *     DESC: THIS FUNCTION DELETES VACANCY AUTOMATICALLY 
      *           AFTER SPECIFIC AMOUNTS OF DAYS/IT GETS EXPIRED
      */ 
      public function delete() {
            $sql = $this->cmp()->query("SELECT id, expiration_date FROM vacancies");
            $date = date("Y-m-d");
            while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                  if($date == $row['expiration_date']) {
                        $this->cmp()->query("DELETE FROM vacancies WHERE id = " . $row['id']);
                  }
            }
      }
}