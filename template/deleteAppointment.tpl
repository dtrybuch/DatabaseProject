
<div>
 <center><p>Wybierz wizyte do usuniecia:</p></center>
    <div id="appointments">
        <form name="delete_appointments" method="post" action="controllers.php?sub=Service&action=deleteAppointmentPost" style="text-align: left;">
<?php
    if ($appointments) { 
       foreach ( $appointments as $row ) { 
        echo '<input type="radio" id="'.$row['appointment_id'].'" name = "wizyta" value="'.$row['appointment_id'].'">' ;
        echo '<label for="'.$row['appointment_id'].'">Data: '.$row['appointment_date'].'. Godz.'.$row['appointment_hour'].'. name i surname pacjenta: '.$row['name_pat'].' '.$row['surname_pat'].'. Powód: '.$row['cause'].'. name i surname lekarza: '.$row['name_doc'].' '.$row['surname_doc'].'. amount zaplacona: '.$row['payment_count'].'. Czy opłacono: '.$row['is_paid'].'</label>';
        echo '<br>';
    }}
 ?> 
     <br><input type="submit" id="SubmitButton" value="Potwierdz">
 </form>
 </div>
