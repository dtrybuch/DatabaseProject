
 <div id="wages" >
<table border="1">
 <?php
    if ($attendances) { 
        echo '<tr><th>Dzień</th><th>Godzina rozpoczecia</th><th>Godzina zakończenia</th><th>Imie lekarza</th><th>Nazwisko lekarza</th></tr>' ;
       foreach ( $attendances as $row ) { 
       echo '<tr><td>'.$row['day'].'</td><td>'.$row['start_time'].'</td><td>'.$row['finish_time'].'</td><td>'.$row['name'].'</td><td>'.$row['surname'].'</td></tr>';
    }}
 ?> 
</table> 
 </div>
