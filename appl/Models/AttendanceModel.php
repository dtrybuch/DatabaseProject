<?php
class AttendanceModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function seeAllDoctorAttendance($id)
    {
      $result = pg_query($this->conn,"SELECT DISTINCT * FROM project.attendances o, project.employees p WHERE o.employee_id = '$id' AND p.employee_id = '$id' ORDER BY day, start_time ;");
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
    function seeAllInCabinet($id_lekarza)
    {
        $result = pg_query($this->conn,"SELECT * FROM project.see_all_attendance_in_cabinet(cast ('$id_lekarza' AS VARCHAR))");
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