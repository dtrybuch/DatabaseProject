
<table border="1">
 <?php
    if ($appointments) { 
        echo '<tr><th>Data</th><th>Godzina</th><th>Powód</th><th>Imie lekarza</th><th>Nazwisko lekarza</th><th>Nr Gabinetu</th><th>Pietro na ktorym znajduje sie gabinet</th></tr>' ;
       foreach ( $appointments as $row ) { 
       echo '<tr><td>'.$row['appointment_date'].'</td><td>'.$row['appointment_hour'].'</td><td>'.$row['cause'].'</td><td>'.$row['name'].'</td><td>'.$row['surname'].'</td><td>'.$row['cabinet_number'].'</td><td>'.$row['floor'].'</td></tr>' ;
    }}
 ?> 
</table> 
