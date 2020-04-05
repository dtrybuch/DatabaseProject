
<table border="1">
 <?php
    if ($dokumentacja) { 
        echo '<tr><th>Data wpisania</th><th>Imię pacjenta</th><th>Nazwisko pacjenta</th><th>Wpis</th>' ;
       foreach ( $dokumentacja as $row ) { 
       echo '<tr><td>'.date('Y-m-d H:i:s', strtotime($row['insertion_date'])).'</td><td>'.$row['name'].'</td><td>'.$row['surname'].'</td><td>'.$row['content'].'</td>';
    }}
 ?> 
</table> 

