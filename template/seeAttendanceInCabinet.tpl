
<table border="1">
 <?php
    if ($attendaces) { 
        echo '<tr><th>Dzień</th><th>Godzina rozpoczecia</th><th>Godzina zakończenia</th><th>Imie lekarza</th><th>Nazwisko lekarza</th></tr>' ;
       foreach ( $attendaces as $row ) { 
       echo '<tr><td>'.$row['day'].'</td><td>'.$row['start_time'].'</td><td>'.$row['finish_time'].'</td><td>'.$row['name'].'</td><td>'.$row['surname'].'</td></tr>';
    }}
 ?> 
</table> 