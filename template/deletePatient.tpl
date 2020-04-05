
<div>
 <p>Wybierz pacjenta do usuniecia:</p>
    <div id="appointments">
        <form name="delete_paitent" method="post" action="controllers.php?sub=Service&action=deletePatientPost" style="text-align:left;">
<?php
    if ($pacjenci) { 
       foreach ( $pacjenci as $row ) { 
        echo '<input type="radio" id="'.$row['patient_id'].'" name = "pacjent" value="'.$row['patient_id'].'">' ;
        echo '<label for="'.$row['patient_id'].'">'.$row['name'].' '.$row['surname'].' PESEL: '.$row['pesel'].'</label>';
        echo '<br>';
    }}
 ?> 
     <br><input type="submit" id="SubmitButton" value="Potwierdz">
 </form>
 </div>
