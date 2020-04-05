<?php
include __DIR__.'/../Models/OpinionsModel.php';
include __DIR__.'/../Models/AttendanceModel.php';
class DoctorController extends Controller{
    protected $user;
    protected $appointments;
    protected $opinions;
    protected $attendances;
    function __construct(){
        parent::__construct();
        $this->layout = new View('main') ;
        $this->layout->css = $this->css ;
        $this->layout->title  = 'Lekarz';
        $this->layout->menu = $this->menu ;
        $this->user = new User();
        $this->appointments  = new AppointmentModel() ;
        $this->opinions  = new OpinionsModel() ;
        $this->attendances = new AttendanceModel() ;
        $this->pacjenci = new PatientsModel() ;
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
    function seeYourAppointments()
    {
        if( ! $this->user->_isLogged() || ! $this->user->_isDoctor())
        {
            
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content =  new View('doctorAppointments') ;
        $this->layout->header = "Zobacz swoje appointments";
        $this->layout->content->appointments = $this->appointments->seeAllDoctorAppointments($this->user->getID());
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    public function seeYourOpinions()
    {
        if( ! $this->user->_isLogged() || ! $this->user->_isDoctor())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content =  new View('seeAllOpinions') ;
        $this->layout->header = "Zobacz swoje opinie";
        $this->layout->content->opinions = $this->opinions->seeAllDoctorOpinions($this->user->getID());
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    public function seeYourAttendance()
    {
        if( ! $this->user->_isLogged() || ! $this->user->_isDoctor())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content =  new View('seeAttendance') ;
        $this->layout->content->attendances = $this->attendances->seeAllDoctorAttendance($this->user->getID());
        $this->layout->user = $this->user->getEmail();
        $this->layout->title = "Twoje obecnosci";
        $this->layout->header = "Twoje obecnosci";

        return $this->layout;
    }
    public function addAttendance()
    {
        if( ! $this->user->_isLogged() || ! $this->user->_isDoctor())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content =  new View('addAttendance') ;
        $this->layout->header = "Dodaj obecność";
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    public function addAttendancePost()
    {
        if( ! $this->user->_isLogged() || ! $this->user->_isDoctor())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        
        $day = $_POST['day'];
        $start_time = $_POST['start_time'];
        $finish_time = $_POST['finish_time'];
        $userID = $this->user->GetID();
        if(empty($day) || empty($start_time) || empty($finish_time))
        {
            $this->layout->header = "Podaj wszystkie dane!!!";
            return $this->layout;
        }
        $result = pg_query($this->conn,"SELECT project.add_attendance(
            CAST ('$day' AS project.not_weekend),
            CAST ('$start_time' AS TIME),
            CAST ('$finish_time' AS TIME),
            CAST ('$userID' AS VARCHAR)
            )");

        if(!$result)
        {
            $this->layout->header = "Błąd!!! <br>".pg_last_error();
    
            return $this->layout;
        }
        $val = pg_fetch_result($result,0);
        if($val == "O tej porze w tym gabinecie przebywa inny lekarz!!!")
        {
            $val = pg_fetch_result($result,0);
            $this->layout->header = "O tej porze w tym gabinecie przebywa inny lekarz!!!<br><br><a href=\"controllers.php?sub=Doctor&action=seeAttendanceGabinet\" id=\"ReturnButton\">Zobacz obecności w tym gabinecie</a><br>";
            $this->layout->title = $val;
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->header = $val;
        $this->layout->title = $val;
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    function seeAttendanceInCabinet()
    {
        if( ! $this->user->_isLogged() || ! $this->user->_isDoctor())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content =  new View('seeAttendanceInCabinet') ;
        $this->layout->user = $this->user->getEmail();
        $this->layout->header = "Zobacz obecności gabinecie";
        $this->layout->content->attendances = $this->attendances->seeAllInCabinet($this->user->getID());
        return $this->layout;
    }
    function addDocumentation()
    {
        if( ! $this->user->_isLogged() || ! $this->user->_isDoctor())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            $this->layout->header = "Zaloguj sie!!!";
            return $this->layout;
        }
        $this->layout->content =  new View('addDocumentation') ;
        $this->layout->content->pacjenci = $this->pacjenci->getAll();
        $this->layout->header = "Dodaj dokumentację";
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    function addDocumentationPost()
    {
        if( ! $this->user->_isLogged() || ! $this->user->_isDoctor())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $dokumentacja = $_POST['dokumentacja'];
        $patient_id = $_POST['pacjent'];
        if( empty($patient_id) || !strlen(trim($dokumentacja)))
        {
            $this->layout->header = "Podaj wszystkie dane!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        echo $dokumentacja."dok";
        $result = pg_query($this->conn,"INSERT INTO project.patients_documentation(patient_id,insertion_date,content) VALUES ('$patient_id',NOW(),'$dokumentacja');");
        if(!$result)
        {
            $this->layout->header = "Błąd!!! <br>".pg_last_error();
    
            return $this->layout;
        }
        $this->layout->header = "Dodano dokumentację!";
        $this->layout->title = "Dodano dokumentację!";
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    function seeDocumentation()
    {
        if( ! $this->user->_isLogged() || ! $this->user->_isDoctor())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            return $this->layout;
        }
        $this->layout->content =  new View('seeDocumentation') ;
        $this->layout->content->pacjenci = $this->pacjenci->getAll();
        $this->layout->header = "Zobacz dokumentację pacjenta";
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    function seeDocumentationPost()
    {
        if( ! $this->user->_isLogged() || ! $this->user->_isDoctor())
        {
            
            $this->layout->title = "Zaloguj sie!!!";
            $this->layout->header = "Zaloguj sie!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content =  new View('documentation') ;
        $patient_id = $_POST['pacjent'];
        if(empty($patient_id))
        {
            $this->layout->header = "Podaj wszystkie dane!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $result = pg_query($this->conn,"SELECT * FROM project.patients_documentation d  JOIN project.patients p ON d.patient_id = '$patient_id' AND p.patient_id = '$patient_id';");
        if(!$result)
        {
            $this->layout->header = "Błąd!!! <br>".pg_last_error();
    
            return $this->layout;
        }
        $val = pg_fetch_all($result);
        $this->layout->content->dokumentacja = $val;
        $this->layout->header = "Zobacz dokumentację";
        return $this->layout;
    }
}
?>