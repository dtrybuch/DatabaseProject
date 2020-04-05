
        <form name="delete_gabinetu" method="post" action="controllers.php?sub=Admin&action=deleteCabinetPost">
<?php
    if ($cabinets) { 
       foreach ( $cabinets as $row ) { 
        echo '<input type="radio" id="'.$row['cabinet_id'].'" name = "gabinet" value="'.$row['cabinet_id'].'">' ;
        echo '<label for="'.$row['cabinet_id'].'">Nr gabinetu: '.$row['cabinet_number'].' Piętro: '.$row['floor'].'</label>';
        echo '<br>';
    }}
 ?> 
     <br><input type="submit" id="SubmitButton" value="Potwierdz">
 </form>