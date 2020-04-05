
 <form name="dokumentacjaForm" method="post" action="controllers.php?sub=Doctor&action=addDocumentationPost">
   <?php
    if ($pacjenci) { 
       foreach ( $pacjenci as $row ) { 
        echo '<input type="radio" id="pacjent" name = "pacjent" value="'.$row['patient_id'].'">' ;
        echo '<label for="pacjent">'.$row['surname'].' '.$row['name'].'. PESEL: '.$row['pesel'].'</label>';
        echo '<br>';
    }}
 ?> 
 <textarea rows="10" cols="100" name="dokumentacja" style="margin-left:30px;" placeholder="Wpisz dokumentację">
 </textarea>
 <br><br><input type="submit" id="SubmitButton" value="Potwierdz" value="Potwierdz">
 </form>