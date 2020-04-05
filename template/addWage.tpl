
 <div id="wages" >
     <form name="wages" method="post" action="controllers.php?sub=Admin&action=addWagePost">
     <input type="number" name="wyplata" id="wyplata" placeholder="Wysokość wypłaty"><br>
 <p>Wybierz placownika:</p><br>
  <?php
    if ($employees) { 
       foreach ( $employees as $row ) { 
        echo '<input type="radio" id="'.$row['employee_id'].'" name ="employee" value="'.$row['employee_id'].'">' ;
        echo '<label for="'.$row['employee_id'].'">'.$row['surname'].' '.$row['name'].' - '.$row['occupation'].'. Email: '.$row['email'].'. Nr konta: '.$row['account_number'].'</label>';
        echo '<br>';
    }}
 ?> 

 <br><br><input type="submit" id="SubmitButton" value="Potwierdz">
 </form>