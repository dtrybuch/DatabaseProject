<?php
class LoginController extends Controller{
    protected $layout ;
    protected $model ;
    protected $user;
    function __construct() {
       parent::__construct();
       $this->layout = new View('main') ;
       $this->layout->css = $this->css ;
       $this->layout->title  = 'Logowanie' ;
       $this->layout->header  = 'Witamy w naszej przychodni!!!' ;
       $this->layout->menu = $this->menu ;
           if (!$this->conn) {
        echo "<hr>An error occured! <br/>\n";
        //echo pg_last_error();
    }
        $this->user = new User();
    }
    function index() {
        $this->layout->title = "Logowanie";
        $this->layout->header = "Witamy w naszej przychodni. Proszę się zalogować";
        $this->layout->user = $this->user->getEmail();
        return $this->layout ;
    }
    function Register()
    {
        $this->layout->content = new View("register");
        $this->layout->header = "Zarejestruj się!";
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    function RegisterPost()
    {
        $email = $_POST['email'];
        $password  = $_POST['password'];
        $name  = $_POST['name'];
        $surname  = $_POST['surname'];
        $PESEL  = $_POST['pesel'];
        $wiek  = $_POST['wiek'];
        $plec = $_POST['plec'];
        $nr_telefonu = $_POST['nr_telefonu'];
        $adres = $_POST['adres'];
        $kod_pocztowy = $_POST['kod_pocztowy'];
        $miejscowosc = $_POST['miejscowosc'];
        if(empty($email) || empty($password) || empty($name) || empty($surname) || empty($PESEL) || empty($wiek) || empty($plec) || empty($nr_telefonu) || empty($adres) || empty($kod_pocztowy)|| empty($miejscowosc))
        {
            $this->layout->header = "Podaj wszystkie dane!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $result = pg_query($this->conn,"SELECT project.add_patient(
        CAST ('$name' as VARCHAR),
        CAST ('$surname' as VARCHAR),
        CAST ('$email' as VARCHAR),
        CAST ('$password' as VARCHAR),
        CAST ('$PESEL' as project.good_pesel),
        CAST ('$wiek' as INTEGER),
        CAST ('$plec' as BOOLEAN),
        CAST ('$nr_telefonu' as project.good_phone_number),
        CAST ('$adres' as VARCHAR),
        CAST ('$kod_pocztowy' as project.good_ZIP_code),
        CAST ('$miejscowosc' as VARCHAR)
        );");
        if(!$result)
        {
            $this->layout->header = "Błąd!!! <br>".pg_last_error();
            return $this->layout;
        }
        $val = pg_fetch_result($result,0);
        // echo $val;
        $this->layout->header = $val;
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    function LoginPatient()
    {
        $email = $_POST['email'];
        $pass  = $_POST['pass'];
        $val = $this->user->_loginPatient($email,$pass);
        if($val == "")
        {
            $this->layout->title = "Logowanie nieudane";
            $this->layout->header = "Logowanie nieudane. Spróbuj jeszcze raz!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->title = "Zalogowano";
        $this->layout->header = "Zalogowano!";
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    function LoginService()
    {
        $email = $_POST['email'];
        $pass  = $_POST['pass'];
        $val = $this->user->_loginService($email,$pass);
        if($val == "")
        {
            $this->layout->title = "Logowanie nieudane";
            $this->layout->header = "Logowanie nieudane. Spróbuj jeszcze raz!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->title = "Zalogowano";
        $this->layout->header = "Zalogowano!";
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    function is_logged() {
        return $this->user->_isLogged();
    } 
    function logout() {
        $this->user->_logout();
        $this->layout = new View("logout");
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
}
?>