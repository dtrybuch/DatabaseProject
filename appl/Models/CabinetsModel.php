<?php
class CabinetsModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function getAll()
    {
      $result = pg_query($this->conn,"SELECT DISTINCT * FROM project.cabinets g ORDER BY g.floor;");
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
    public function deleteCabinet($id)
    {
      $result = pg_query($this->conn,"DELETE FROM project.cabinets g WHERE g.cabinet_id = '$id';");
      if(!$result)
      {
        echo "<hr>An error occured! <br/>\n";
        echo pg_last_error();
        echo '<br><br><a href="javascript:history.go(-1)" id="BackButton" >Wróć</a>';
        exit;;
      }
      return "Poprawnie usunieto gabinet";
    }
}
?>