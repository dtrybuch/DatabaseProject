 <script>
    function pokaz()
    {
        var reszta = document.getElementById('reszta');
        console.log(document.querySelector('input[name="occupation"]:checked').value);
        if(document.querySelector('input[name="occupation"]:checked').value == "Doctor")
        {
            reszta.style.display = "block";
        }
        else
        {
            reszta.style.display = "none";
        }
    }
    </script>
 <form name="addEmployee" method="post" action="controllers.php?sub=Admin&action=addEmployeePost">
        <input type="text" placeholder = "Imię:" name="name"><br/>
        <input type="text" placeholder = "Nazwisko:" name="surname"><br/>
        <input type="email" placeholder = "E-mail:" name="email"><br/>
        <input type="password" placeholder = "Hasło:" name="password"><br/>
        Zawód:<br/>
        <input type="radio" name="occupation" onchange ="pokaz()" value="Doctor" checked> Lekarz<br/>
        <input type="radio" name="occupation" onchange ="pokaz()" value="Sekretarka"> Sekretarka<br/>
        Nume konta (musi składać się z 26 cyfr):<br><input type="text" name="account_number" maxlength="26" style="width:200px;"><br><br>
        Numer telefonu:<br><input type="number" name="phone_number"><br/>
        <input type="text" name="address" placeholder="Adres:"><br/>
        <input type="text" name="zip_code" placeholder="Kod pocztowy:"><br/>
        <input type="text" name="locality" placeholder="Miejscowosc:"><br/>
<div id="reszta">
<p>Wybierz gabinet oraz specjalizacje</p>
<br>
   <?php
   
    if ($cabinets) { 
        echo'<select id = "cabinet" name = "cabinet">';
       foreach ( $cabinets as $row ) { 
        echo '<option value="'.$row['cabinet_id'].'">Nr gabinetu: '.$row['cabinet_number'].'. Piętro gabinetu: '.$row['floor'].'</option>' ;
        echo '<br>';
    }}
 ?> 
 </select>
 <br><br>
    <?php
    if ($specializations) { 
       foreach ( $specializations as $row ) { 
        echo '<input type="checkbox" id="specialization" name = "specialization[]" value="'.$row['specialization_id'].'">' ;
        echo '<label for="specjalizacja">Nazwa specjalizacji: '.$row['specialization_name'].'</label>';
        echo '<br>';
    }}
 ?> 
  <br>
 </div>
    <br><input type="submit" id="SubmitButton" value="Potwierdz">