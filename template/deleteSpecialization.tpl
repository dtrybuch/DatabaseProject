<div >
 <center><p>Wybierz specjalizacje do usuniecia:</p></center>
    <div id="appointments">
        <form name="delete_specjalizacji" method="post" action="controllers.php?sub=Admin&action=deleteSpecializationPost">
<?php
    if ($specializations) { 
       foreach ( $specializations as $row ) { 
        echo '<input type="radio" id="'.$row['specialization_id'].'" name = "specjalizacja" value="'.$row['specialization_id'].'">' ;
        echo '<label for="'.$row['specialization_id'].'">'.$row['specialization_name'].'</label>';
        echo '<br>';
    }}
 ?> 
     <br><input type="submit" id="SubmitButton" value="Potwierdz">
 </form>
 </div>
