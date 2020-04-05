<?php
class AppointmentModel extends Model
{
    function __construct()
    {
      parent::__construct();
    }

    public function seeAllUserAppointments($id)
    {
      $result = pg_query($this->conn,"SELECT DISTINCT * FROM project.see_users_appointments('$id') ORDER BY appointment_date, appointment_hour;");
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
    public function deleteAppointment($appointment_id)
    {
      $result = pg_query($this->conn,"DELETE FROM project.appointments w WHERE w.appointment_id= '$appointment_id';");
      if(!$result)
      {
        echo "<hr>An error occured! <br/>\n";
        echo pg_last_error();
        echo '<br><br><a href="javascript:history.go(-1)" id="BackButton" >Wróć</a>';
        exit;
      }
      $val = pg_fetch_all($result);
      return "Pomyslnie usunieto wizyte";
    }
    public function seeAllDoctorAppointments($id)
    {
      $result = pg_query($this->conn,"SELECT DISTINCT * FROM project.see_doctors_appointments('$id') ORDER BY appointment_date, appointment_hour;");
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
    public function getAll()
    {
      $result = pg_query($this->conn,"SELECT DISTINCT * FROM project.see_all_appointments() ORDER BY appointment_date, appointment_hour;");
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
    public function seeAllTodaysAppointments()
    {
      $result = pg_query($this->conn,"SELECT DISTINCT * FROM project.see_all_appointments() today WHERE today.appointment_date = CAST(NOW() AS project.not_weekend) ORDER BY today.appointment_date, today.appointment_hour;");
      if(!$result)
      {
        echo "<hr>An error occured! <br/>";
        echo pg_last_error()."<br/>";
        echo "Nie pracujemy w weekend!!!";
        echo '<br><br><a href="javascript:history.go(-1)" id="BackButton" >Wróć</a>';
        exit;
      }
      $val = pg_fetch_all($result);
      return $val ;
    }
}
?>