<?php
class DoctorsModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function getAll()
    {
      $result = pg_query($this->conn,"SELECT DISTINCT * FROM project.doc_spec ls, project.specializations s, project.employees p where ls.specialization_id = s.specialization_id and p.employee_id = ls.employee_id ORDER BY p.surname ASC;");
      if(!$result)
      {
        echo "<hr>An error occured! <br/>\n";
        echo pg_last_error();
        echo '<br><br><a href="javascript:history.go(-1)" id="BackButton" >Wróć</a>';
        exit;
      }
      $val = pg_fetch_all($result);
      foreach($val as $row)
      {
        $employee_id = $row['employee_id'];
        if (!isset($doctors[$employee_id]))
        {
          $doctors[$employee_id] = array('employee_id' => $employee_id, 'name' => $row['name'], 'surname' => $row['surname'], 'specializations' => array());
        }
        if (!empty($row['specialization_id']))
          $doctors[$employee_id]['specializations'][] = array('specialization_name' => $row['specialization_name'], 'id'=>$row['specialization_id']);
      }
      return $doctors ;
    }
    
}
?>