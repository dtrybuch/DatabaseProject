<?php
class PatientsModel extends Model
{
    function __construct()
    {
      parent::__construct();
    }
    public function getAll()
    {
      $result = pg_query($this->conn,"SELECT DISTINCT * FROM project.patients p ORDER BY p.surname ASC;");
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
    public function deletePatient($id)
    {
      $result = pg_query($this->conn,"DELETE FROM project.patients p WHERE p.patient_id = '$id';");
      if(!$result)
      {
        echo "<hr>An error occured! <br/>\n";
        echo pg_last_error();
        echo '<br><br><a href="javascript:history.go(-1)" id="BackButton" >Wróć</a>';
        exit;
      }
      return "Poprawnie usunieto pacjenta";
    }
}
?>