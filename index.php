
<?php
include __DIR__.'/User.php';
echo "<title>Strona główna</title>";
 echo "<link rel=\"stylesheet\" href=\"css/style.css\" type=\"text/css\" media=\"screen\" >";
// function __autoload($class_name) {
//     include $class_name . '.php' ;
// }
$user = new User();
echo '<div id = "zalogowany">Zalogowano jako: '. $user->getEmail().'</div><br>';
echo '<header><h1>Witamy w naszej przychodni!!!</h1></header>';

if ( ! $user->_isLogged() )
{  
    
     echo '<header><h1>Zaloguj się.</h1></header>';
     echo '<center><a href="loginPatient.html" id="ReturnButton">Pacjenci</a></center><br>';
     echo '<center><a href="loginService.html" id="ReturnButton">Pracownicy</a><center><br>';
     echo '<center><a href="controllers.php?sub=Login&action=Register" id="SubmitButton">Nie masz konta? Zarejestruj się jako pacjent !</a><center>';
     echo'<footer style="clear:both;">project na Bazy Danych - Dominik Trybuch. &copy; Wszelkie prawa zastrzeżone.</footer>';

} 
else if($user->_isLogged() && $user->_isService())
{
    echo '<div class="topnav">';
     echo "<a href='controllers.php?sub=Service&action=index'>Dodaj pacjenta</a>" ;
     echo "<a href='controllers.php?sub=Service&action=deletePatient'>Usuń pacjenta</a>" ;
     echo "<a href='controllers.php?sub=Service&action=addAppointment'>Dodaj wizytę</a>" ;
     echo "<a href=\"controllers.php?sub=Service&action=seeAppointments\">Zobacz wizyty</a>" ;
     echo "<a href=\"controllers.php?sub=Service&action=seeTodaysVisits\">Zobacz dzisiejsze wizyty</a>" ;
     echo "<a href=\"controllers.php?sub=Service&action=deleteAppointment\">Usuń wizytę</a>" ;
     echo "<a href=\"controllers.php?sub=Service&action=addPayment\">Dodaj zapłatę za wizyte</a>" ;
     echo "<a href=\"controllers.php?sub=Service&action=seeYourWages\">Zobacz swoje wypłaty</a>" ;
     echo "<a href=\"controllers.php?sub=Login&action=logout\">Wyloguj</a>";
     echo "</div>";
     echo'<footer style="clear:both;">project na Bazy Danych - Dominik Trybuch. &copy; Wszelkie prawa zastrzeżone.</footer>';
}
else if($user->_isLogged() && $user->_isDoctor())
{
    echo '<div class="topnav">';
    echo "<a href=\"controllers.php?sub=Doctor&action=addAttendance\">Dodaj obecność</a>" ;
    echo "<a href=\"controllers.php?sub=Doctor&action=seeYourAppointments\">Zobacz swoje wizyty</a>" ;
    echo "<a href=\"controllers.php?sub=Doctor&action=seeYourOpinions\">Zobacz swoje opinie</a>" ;
    echo "<a href=\"controllers.php?sub=Doctor&action=seeYourAttendance\">Zobacz swoje obecności</a>" ;
    echo "<a href=\"controllers.php?sub=Service&action=seeYourWages\">Zobacz swoje wypłaty</a>" ;
    echo "<a href=\"controllers.php?sub=Doctor&action=addDocumentation\">Dodaj dokumentację do pacjenta</a>" ;
    echo "<a href=\"controllers.php?sub=Doctor&action=seeDocumentation\">Zobacz dokumentację pacjenta</a>" ;
    echo "<a href=\"controllers.php?sub=Login&action=logout\">Wyloguj</a>";
    echo "</div>";
    echo'<footer style="clear:both;">project na Bazy Danych - Dominik Trybuch. &copy; Wszelkie prawa zastrzeżone.</footer>';
}
else if ($user->_isLogged() && $user->_isAdmin()){
    echo '<div class="topnav">';
    echo "<a href='controllers.php?sub=Admin&action=addEmployee'>Dodaj pracownika</a>" ;
    echo "<a href='controllers.php?sub=Admin&action=deleteEmployee'>Usuń pracownika</a>" ;
    echo "<a href='controllers.php?sub=Admin&action=addSpecialization'>Dodaj specjalizację</a>" ;
    echo "<a href='controllers.php?sub=Admin&action=deleteSpecialization'>Usuń specjalizację</a>" ;
    echo "<a href='controllers.php?sub=Admin&action=addCabinet'>Dodaj gabinet</a>" ;
    echo "<a href='controllers.php?sub=Admin&action=deleteCabinet'>Usuń gabinet</a>" ;
    echo "<a href='controllers.php?sub=Admin&action=seeAllOpinions'>Zobacz opinie</a>" ;
    echo "<a href='controllers.php?sub=Admin&action=seeWages'>Zobacz wypłaty</a>" ;
    echo "<a href=\"controllers.php?sub=Service&action=seeAppointments\">Zobacz wizyty</a>" ;
    echo "<a href='controllers.php?sub=Admin&action=addWage'>Dodaj wypłate</a>" ;
    echo "<a href='controllers.php?sub=Admin&action=deleteWage'>Usuń wypłate</a>" ;
    echo "<a href='controllers.php?sub=Admin&action=seeLogs'>Zobacz logi</a>" ;
    echo "<a href='controllers.php?sub=Admin&action=deleteAllLogs' onclick=\"return confirm('Czy na pewno chcesz usunąć wszystkie logi?');\" >Usun wszystkie logi</a>" ;
    echo "<a href=\"controllers.php?sub=Login&action=logout\">Wyloguj</a>";
    echo "</div>";
    echo'<footer style="clear:both;">project na Bazy Danych - Dominik Trybuch. &copy; Wszelkie prawa zastrzeżone.</footer>';
}
else if($user->_isLogged()){
    echo '<div class="topnav">';
    echo "<a href=\"controllers.php?sub=Patient&action=seeYourAppointments\">Zobacz swoje wizyty</a>" ;
    echo "<a href=\"controllers.php?sub=Patient&action=addOpinion\">Dodaj opinię</a>" ;
    echo "<a href=\"controllers.php?sub=Login&action=logout\">Wyloguj</a>";
    echo "</div>";
    echo'<footer style="clear:both;">project na Bazy Danych - Dominik Trybuch. &copy; Wszelkie prawa zastrzeżone.</footer>';
}
?>
