
<table border="1">
 <?php
    if ($appointments) { 
       echo '<tr><th>Data</th><th>Godzina</th><th>Imie pacjenta</th><th>Nazwisko pacjenta</th><th>Powód</th></tr>' ;
       foreach ( $appointments as $row ) { 
       echo '<tr><td>'.$row['appointment_date'].'</td><td>'.$row['appointment_hour'].'</td><td>'.$row['name'].'</td><td>'.$row['surname'].'</td><td>'.$row['cause'].'</td></tr>' ;
    }}
 ?> 
</table> 
