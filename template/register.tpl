
    <form name="test" method="post" action="controllers.php?sub=Login&action=RegisterPost">
        <input type="text" name="name" placeholder="Imię:"><br/>
        <input type="text" name="surname"placeholder="surname:"><br/>
        <input type="email" name="email"placeholder="E-mail:"><br/>
        <input type="password" name="password"placeholder="Hasło:"><br/>
        <input type="text" name="pesel" maxlength="11"placeholder="PESEL (musi składać sie z 11 cyfr):"><br/>
        <input type="number" name="wiek"placeholder="Wiek:"><br/>
        <input type="number" name="nr_telefonu"placeholder="Numer telefonu:"><br/>
        <input type="text" name="adres"placeholder="Adres:"><br/>
        <input type="text" name="kod_pocztowy"placeholder="Kod pocztowy:"><br/>
        <input type="text" name="miejscowosc"placeholder="Miejscowosc:"><br/>
        Płeć:<br><input type="radio" name="plec" value ="false"> Mężczyzna<br><br>
        <input type="radio" name="plec" value ="true"> Kobieta<br><br>
    <br><input type="submit" id="SubmitButton" value="Potwierdz">
    </form>