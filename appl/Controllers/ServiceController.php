<?php
include __DIR__.'/../Models/DoctorsModel.php';
include __DIR__.'/../Models/PatientsModel.php';
include __DIR__.'/../Models/WagesModel.php';
class ServiceController extends Controller{
    protected $user;
    protected $doctors;
    protected $patients;
    protected $appointments;
    protected $wages;
    protected $attendances;
    function __construct(){
        parent::__construct();
        $this->layout = new View('main') ;
        $this->layout->css = $this->css ;
        $this->layout->title  = 'Obsługa' ;
        $this->layout->menu = $this->menu ;
        $this->user = new User();
        $this->doctors  = new DoctorsModel() ;
        $this->patients  = new PatientsModel() ;
        $this->appointments  = new AppointmentModel() ;
        $this->wages  = new WagesModel() ;
        $this->attendances  = new AttendanceModel() ;
        if (!$this->conn) {
            echo "<hr>An error occured! <br/>\n";
            echo pg_last_error($conn);
            exit;
        }
        if($this->user->_isAdmin())
        {
            $this->layout->nav = new View('nav_admin');
        }
        else if($this->user->_isService())
        {
            $this->layout->nav = new View('nav_service');
        }
        else if($this->user->_isDoctor())
        {
            $this->layout->nav = new View('nav_doctor');
        }
        else if($this->user->_isLogged())
        {
            $this->layout->nav = new View('nav_patient');
        }
    }
    function index()
    {
        if( ! $this->user->_isLogged() || ! $this->user->_isService())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content = new View("addPatient");
        $this->layout->header = "Dodaj pacjenta";
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    function addPatient(){
        if( ! $this->user->_isLogged() || !$this->user->_isService())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        
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
    //get
    function deletePatient()
    {
        if( ! $this->user->_isLogged() || !$this->user->_isService())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content = new View('deletePatient') ;
        $this->layout->user = $this->user->getEmail();
        $this->layout->header = "Usuń pacjenta";
        $this->layout->content->patients = $this->patients->getAll() ;
        return $this->layout;
    }   
    //post
    function deletePatientPost()
    {
        if( ! $this->user->_isLogged() || !$this->user->_isService())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $id = $_POST['pacjent'];
        $val = $this->patients->deletePatient($id);
        $this->layout->header = $val;
        $this->layout->title = $val;
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }   
    //get
    function addAppointment()
    {
        if( ! $this->user->_isLogged() || !$this->user->_isService())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content = new View('addAppointment') ;
        $this->layout->content->doctors = $this->doctors->getAll() ;
        $this->layout->content->patients = $this->patients->getAll() ;
        $this->layout->user = $this->user->getEmail();
        $this->layout->header = "Dodaj wizytę";
        return $this->layout;
    }
    //post
    function addAppointmentPost()
    {
        if( ! $this->user->_isLogged() || !$this->user->_isService())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $docID = $_POST['doctor'];
        $patID  = $_POST['patient'];
        $date  = $_POST['date'];
        $time  = $_POST['time'];
        $cause  = $_POST['cause'];
        $payment  = $_POST['amount'];
        $isPaid  = $_POST['is_paid'];
        echo $docID."<br>";
        echo $patID."<br>";
        echo $date."<br>";
        echo $time."<br>";
        echo $cause."<br>";
        echo $payment."<br>";
        echo $isPaid."<br>";
        if(empty($docID) || empty($patID) || empty($date) || empty($time) || !strlen(trim($cause)))
        {
            $this->layout->header = "Podaj wszystkie dane!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $result = pg_query($this->conn,"SELECT project.add_appointment(
            CAST ('$docID' as VARCHAR),
            CAST ('$patID' as VARCHAR),
            CAST ('$date' as project.not_weekend),
            CAST ('$time' as TIME WITHOUT TIME ZONE),
            CAST ('$cause' as VARCHAR),
            CAST ('$payment' as INTEGER),
            CAST ('$isPaid' as BOOLEAN)
            );");
        if(!$result)
        {
            $this->layout->header = "Błąd!!! <br>".pg_last_error();
    
            return $this->layout;
        }
        $val = pg_fetch_result($result,0);
        if($val == "Lekarz jest wtedy nieobecny! Podaj inna date!!!")
        {
            $this->layout->content = new View("seeAttendance");
            $this->layout->header = $val."<br> Obecnosci tego lekarza: ";
            $this->layout->title = $val;
            $this->layout->attendances = $this->attendances->seeAllDoctorAttendance($docID);
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->header = $val;
        $this->layout->title = $val;
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    //get
    function addPayment()
    {
        if( ! $this->user->_isLogged() || !$this->user->_isService())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content = new View('appointmentPayment') ;
        $this->layout->content->appointments = $this->appointments->getAll() ;
        $this->layout->header = "Dodaj zapłatę";
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }   
    //post
    function addPaymentPost()
    {
        if( ! $this->user->_isLogged() || !$this->user->_isService())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $id = $_POST['wizyta'];
        $payment = $_POST['payment'];
        $result = pg_query($this->conn,"SELECT w.isPaid FROM project.appointments w WHERE w.appointment_id= '$id';");
        if(!$result)
        {
            $this->layout->header = "Błąd!!! <br>".pg_last_error();
    
            return $this->layout;
        }
        if(pg_fetch_result($result,0) == "t")
        {
            $this->layout->header = "Ta wizyta jest opłacona!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout; 
        }
        if(empty($id) || empty($payment))
        {
            $this->layout->header = "Podaj wszystkie dane!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $result = pg_query($this->conn,"UPDATE project.appointments SET payment_count = CAST($payment AS INTEGER), isPaid = TRUE WHERE appointment_id= '$id';");
        if(!$result)
        {
            $this->layout->header = "Błąd!!! <br>".pg_last_error();
    
            return $this->layout;
        }
        $this->layout->header = "Poprawnie dodano zaplate";
        $this->layout->title = "Dodano zaplate";
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    //get
    function deleteAppointment()
    {
        if( ! $this->user->_isLogged() || !$this->user->_isService())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content = new View('deleteAppointment') ;
        $this->layout->content->appointments = $this->appointments->getAll() ;
        $this->layout->header = "Usuń wizytę";
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }   
    //post
    function deleteAppointmentPost()
    {
        if( ! $this->user->_isLogged() || !$this->user->_isService())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $id = $_POST['wizyta'];
        $val = $this->appointments->deleteAppointment($id);
        $this->layout->header = $val;
        $this->layout->title = $val;
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    function seeAppointments()
    {
        if( ! $this->user->_isLogged() || (!$this->user->_isService() && !$this->user->_isAdmin()))
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content = new View('appointments') ;
        $this->layout->header = "Zobacz wizyty";
        $this->layout->content->appointments = $this->appointments->getAll();
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    function seeTodaysVisits()
    {
        if( ! $this->user->_isLogged() || !$this->user->_isService())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content = new View('appointments') ;
        $this->layout->header = "Zobacz dzisiejsze wizyty";
        $this->layout->content->appointments = $this->appointments->seeAllTodaysAppointments();
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    function seeYourWages()
    {
        if( ! $this->user->_isLogged() || (!$this->user->_isService() && !$this->user->_isDoctor()))
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content = new View('employeeWages') ;
        $this->layout->content->wages = $this->wages->seeYourWages($this->user->getID());
        $this->layout->user = $this->user->getEmail();
        $this->layout->header = "Wypłaty";
        return $this->layout;
    }
    
}
?>