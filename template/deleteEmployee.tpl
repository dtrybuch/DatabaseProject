
<div>
 <center><p>Wybierz employeea do usuniecia:</p></center>
    <div id="appointments">
        <form name="delete_employeea" method="post" action="controllers.php?sub=Admin&action=deleteEmployeePost">
<?php
    if ($employees) { 
       foreach ( $employees as $row ) { 
        echo '<input type="radio" id="employee" name = "employee" value="'.$row['employee_id'].'">' ;
        echo '<label for="employee">'.$row['name'].' '.$row['surname'].' Zawod: '.$row['occupation'].'</label>';
        echo '<br>';
    }}
 ?> 
     <br><input type="submit" id="SubmitButton" value="Potwierdz">
 </form>
 </div>
