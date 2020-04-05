
 <div style="float:left; margin-left:40px; margin-top:0px;">
 <div id="wages" >
<form name="delete_wages" method="post" action="controllers.php?sub=Admin&action=deleteWagePost">
 <?php
    if ($wages) { 
       foreach ( $wages as $row ) { 
        echo '<input type="radio" id="'.$row['wage_id'].'" name = "wyplata" value="'.$row['wage_id'].'">' ;
        echo '<label for="'.$row['wage_id'].'"><b>Nazwisko:</b> '.$row['surname'].'. <b>Imie: </b>'.$row['name'].'. <b>Data wystawienia:</b> '.$row['wages_date'].'. <b>Wysokosc: </b>'.$row['wages_count'].'.</label>';
        echo '<br>';
    }}
 ?> 
 <br>
    <br><input type="submit" id="SubmitButton" value="Potwierdz">
</form>