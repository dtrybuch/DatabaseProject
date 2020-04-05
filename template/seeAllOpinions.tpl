
<table border="1" >
 <?php
    if ($opinions) { 
        echo '<tr><th>Data wpisania</th><th>Nazwisko lekarza</th><th>Imię lekarza</th><th>Nazwisko pacjenta</th><th>Imię pacjenta</th><th>Wpis</th>' ;
       foreach ( $opinions as $row ) { 
       echo '<tr><td>'.$row['insertion_date'].'</td><td>'.$row['surname_doc'].'</td><td>'.$row['name_doc'].'</td><td>'.$row['surname_pat'].'</td><td>'.$row['name_pat'].'</td><td>'.$row['content'].'</td>';
    }}
 ?> 
</table> 