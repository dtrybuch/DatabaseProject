
 <div id="wages" >
<table border="1">
 <?php
    if ($wages) { 
        echo '<tr><th>Data wyplaty</th><th>Wysokosc wyplaty</th></tr>' ;
       foreach ( $wages as $row ) { 
       echo '<tr><td>'.date('Y-m-d H:i:s', strtotime(($row['wages_date']))).'</td><td>'.$row['wages_count'].'</td></tr>';
    }}
 ?> 
</table> 
 </div>
