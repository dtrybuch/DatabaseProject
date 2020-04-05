
<table border="1">
 <?php
    if ($opinions) { 
        echo '<tr><th>Data contentania</th><th>surname pacjenta</th><th>Imię pacjenta</th><th>content</th>' ;
       foreach ( $opinions as $row ) { 
       echo '<tr><td>'.$row['insertion_date'].'</td><td>'.$row['surname'].'</td><td>'.$row['name'].'</td><td>'.$row['content'].'</td>';
    }}
 ?> 
</table> 