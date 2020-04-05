
 <center><p>Wybierz lekarza:</p></center>
  <?php
    echo '<form>';
    if ($doctors) { 
        echo '<select name = "doctor" id="doctor">';
       foreach ( $doctors as $row ) {
            echo '<option value="'.$row['employee_id'].'">'.$row['surname'].' '.$row['name'].' ' ;
           foreach($row['specializations'] as $specjalizacja)
           {
                echo $specjalizacja['specialization_name'].' ';
           }
        echo '</option><br>'; 
    }}
    echo '</select></form>';
 ?> 
 <center><p>Wybierz pacjenta:</p></center>
   <?php
    echo '<form>';
    if ($patients) { 
        echo '<select name = "patient" id="patient">';
       foreach ( $patients as $row ) { 
        echo '<option value="'.$row['patient_id'].'">'.$row['surname'].' '.$row['name'].'. PESEL: '.$row['pesel'];
        echo '</option><br>'; 
    }}
    echo '</select><br>';
 ?> 
    <p>Podaj date:</p><br>
    <input type="date" name="date" id="date">
    <br>
    <p>Podaj godzine:</p><br>
    <input type="time" name="time" id="time">
    <br><br>
    <textarea name="cause" id="cause" rows="4" cols="50" placeholder="Powód wizyty"></textarea>
    <br>
    <p>Kwota do zapłaty: </p><br>
    <input type="number" name="amount" id="amount" value="0">
    <br><br>
    <p>Zaznacz jesli zaplacono: </p><br>
    <input type="checkbox" name="is_paid" id="is_paid">
    <br><br>
    
</form>
<center><button id="SubmitButton" onclick="sendAnswer()">Prześlij</button></center>

<div id="hidden_form_container" style="display:none; clear:both;"></div>
<br>