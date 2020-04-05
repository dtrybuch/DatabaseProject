
<table border="1">
 <?php
    if ($appointments) { 
        echo '<tr><th>Data</th><th>Godzina</th><th>Powód</th><th>Imię lekarza</th><th>Nazwisko lekarza</th><th>name pacjenta</th><th>surname pacjenta</th><th>Nr telefonu</th><th>Adres</th><th>Kod pocztowy</th><th>Miejscowosc</th><th>Nr Gabinetu</th><th>floor na ktorym znajduje sie gabinet</th><th>Czy zaplacono</th><th>Zapłacona amount: </th></tr>' ;
       foreach ( $appointments as $row ) { 
       echo '<tr><td>'.$row['appointment_date'].'</td><td>'.$row['appointment_hour'].'</td><td>'.$row['cause'].'</td><td>'.$row['name_doc'].'</td><td>'.$row['surname_doc'].'</td><td>'.$row['name_pat'].'</td><td>'.$row['surname_pat'].'</td><td>'.$row['phone_number'].'</td><td>'.$row['address'].'</td><td>'.$row['zip_code'].'</td><td>'.$row['locality'].'</td><td>'.$row['cabinet_number'].'</td><td>'.$row['floor'].'</td><td>'.$row['is_paid'].'</td><td>'.$row['payment_count'].'</td></tr>' ;
    }}
 ?> 
</table> 