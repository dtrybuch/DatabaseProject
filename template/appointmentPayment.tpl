
<div>
 <center><p>Wybierz wizyte do oplacenia:</p></center>
    <div id="appointments">
        <form name="delete_appointments" method="post" action="controllers.php?sub=Service&action=addPaymentPost" style="text-align:left;">
<?php
    if ($appointments) { 
       foreach ( $appointments as $row ) { 
        echo '<input type="radio" id="'.$row['appointment_id'].'" name = "wizyta" value="'.$row['appointment_id'].'">' ;
        echo '<label for="'.$row['appointment_id'].'">Data: '.$row['appointment_date'].'. Godz.'.$row['appointment_hour'].'. Imię i nazwisko pacjenta: '.$row['name_pat'].' '.$row['surname_pat'].'. Powód: '.$row['cause'].'. Imie i Nazwisko lekarza: '.$row['name_doc'].' '.$row['surname_doc'].'. Kwota zaplacona: '.$row['payment_count'].'. Czy opłacono: '.$row['is_paid'].'</label>';
        echo '<br>';
    }}
 ?> 
    <label for="amount">Podaj kwote: </label>
    <input type="number" id="amount" name="amount">
    <br><br><input type="submit" id="SubmitButton" value="Potwierdz">
 </form>
 </div>