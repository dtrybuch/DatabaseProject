<?php
class WagesModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function getAll()
    {
      $result = pg_query($this->conn,"SELECT * FROM project.wages w JOIN project.employees p ON w.employee_id = p.employee_id ORDER BY p.surname, w.wages_date");
      if(!$result)
      {
          echo "<hr>An error occured! <br/>\n";
          echo pg_last_error();
          echo '<br><br><a href="javascript:history.go(-1)" id="BackButton" >Wróć</a>';
          exit;
      }
      $val = pg_fetch_all($result);
      return $val ;
    }
    public function seeYourWages($id)
    {
      $result = pg_query($this->conn,"SELECT * FROM project.wages w WHERE w.employee_id = '$id' ORDER BY wages_date;");
      if(!$result)
      {
          echo "<hr>An error occured! <br/>\n";
          echo pg_last_error();
          echo '<br><br><a href="javascript:history.go(-1)" id="BackButton" >Wróć</a>';
          exit;
      }
      $val = pg_fetch_all($result);
      return $val ;
    }
}
?>