
 <div id="wyplaty" >
<table border="1">
 <?php
    if ($wages) { 
        echo '<tr><th>Nazwisko employeea</th><th>Imie employeea</th><th>Data wyplaty</th><th>Wysokosc wyplaty</th><th>Nr konta</th></tr>' ;
       foreach ( $wages as $row ) { 
       echo '<tr><td>'.$row['surname'].'</td><td>'.$row['name'].'</td><td>'.date('Y-m-d H:i:s', strtotime(($row['wages_date']))).'</td><td>'.$row['wages_count'].'</td><td>'.$row['account_number'].'</td></tr>';
    }}
 ?> 
</table> 
 </div>
