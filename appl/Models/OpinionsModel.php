<?php
class OpinionsModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }
    function seeAllDoctorOpinions($id)
    {
      $result = pg_query($this->conn,"SELECT DISTINCT o.insertion_date, p.name as pat_name, p.surname as pat_surname, e.name as doc_name, e.surname as doc_surname, o.content FROM project.opinions o, project.employees e, project.patients p WHERE o.employee_id = '$id' AND e.employee_id = '$id'  AND p.patient_id = o.patient_id ORDER BY insertion_date ;");
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
    function getAll()
    {
      $result = pg_query($this->conn,"SELECT DISTINCT * FROM project.see_all_opinions();");
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