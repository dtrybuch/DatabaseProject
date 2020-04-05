
<table border="1">
 <?php
    if ($logi) { 
       echo '<tr><th>Data dodania</th><th>content</th></tr>' ;
       foreach ( $logi as $row ) { 
       echo '<tr><td>'.date('Y-m-d H:i:s', strtotime(($row['insertion_date']))).'</td><td>'.$row['content'].'</td></tr>' ;
    }}
 ?> 
</table> 
