
 <center><p>Wybierz pacjenta:</p></center>
<form name="documentationForm" method="post" action="controllers.php?sub=Doctor&action=seeDocumentationPost">
   <?php
    if ($pacjenci) { 
       foreach ( $pacjenci as $row ) { 
        echo '<input type="radio" id="pacjent" name = "pacjent" value="'.$row['patient_id'].'">' ;
        echo '<label for="pacjent">'.$row['surname'].' '.$row['name'].'. PESEL: '.$row['pesel'].'</label>';
        echo '<br>';
    }}
 ?> 
 <br><br><input type="submit" id="SubmitButton" value="Potwierdz">
 </form>
