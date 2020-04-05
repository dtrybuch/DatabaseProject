<?php
class EmployeesModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function getAll()
    {
      $result = pg_query($this->conn,"SELECT DISTINCT * FROM project.employees p ORDER BY p.surname ASC;");
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
    public function deleteEmployee($id)
    {
      $result = pg_query($this->conn,"DELETE FROM project.employees p WHERE p.employee_id = '$id';");
      if(!$result)
      {
        echo "<hr>An error occured! <br/>\n";
        echo pg_last_error();
        echo '<br><br><a href="javascript:history.go(-1)" id="BackButton" >Wróć</a>';
        exit;
      }
      return "Poprawnie usunieto employeea";
    }
    public function takeLastRecord()
    {
      $result = pg_query($this->conn,
      "SELECT employee_id
      FROM project.employees 
      ORDER BY employee_id::INTEGER DESC
      LIMIT 1");
      if(!$result)
      {
        echo "<hr>An error occured! <br/>\n";
        echo pg_last_error();
        echo '<br><br><a href="javascript:history.go(-1)" id="BackButton" >Wróć</a>';
        exit;
      }
      $val = pg_fetch_result($result,0);
      return $val;
    }
}
?>