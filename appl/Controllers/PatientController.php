<?php
include __DIR__.'/../Models/AppointmentModel.php';
class PatientController extends Controller{
    protected $user;
    protected $lekarze;
    function __construct(){
        parent::__construct();
        $this->layout = new View('main') ;
        $this->layout->css = $this->css ;
        $this->layout->title  = 'Pacjent' ;
        $this->appointments  = new AppointmentModel();
        $this->user = new User();
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
        if( ! $this->user->_isLogged() || $this->user->_isDoctor() || $this->user->_isService() || $this->user->_isAdmin())
        {

            $this->layout->title = "Nie masz dostępu do tej treści!!!";
            $this->layout->header = "Nie masz dostępu do tej treści!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        return $this->seeYourAppointments();
    }
    function seeYourAppointments()
    {
        if( ! $this->user->_isLogged())
        {

            $this->layout->title = "Nie masz dostępu do tej treści!!!";
            $this->layout->header = "Nie masz dostępu do tej treści!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content = new View('patientAppointments') ;
        $this->layout->header = "Zobacz swoje appointments";
        $this->layout->content->appointments = $this->appointments->seeAllUserAppointments($this->user->getID());
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    function addOpinion()
    {
        if( ! $this->user->_isLogged() || $this->user->_isDoctor() || $this->user->_isService() || $this->user->_isAdmin())
        {

            $this->layout->title = "Nie masz dostępu do tej treści!!!";
            $this->layout->header = "Nie masz dostępu do tej treści!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $this->layout->content = new View('addOpinion') ;
        $this->layout->header = "Dodaj opinię";
        $this->layout->user = $this->user->getEmail();
        return $this->layout;
    }
    function addOpinionPost()
    {
        if( ! $this->user->_isLogged() || $this->user->_isDoctor() || $this->user->_isService() || $this->user->_isAdmin())
        {

            $this->layout->title = "Nie masz dostępu do tej treści!!!";
            $this->layout->header = "Nie masz dostępu do tej treści!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $opinia = $_POST['opinia'];
        if (empty($name) || empty($surname) || !strlen(trim($opinia)))
        {
            $this->layout->header = "Podaj wszystkie dane!!!";
            $this->layout->user = $this->user->getEmail();
            return $this->layout;
        }
        $employee_id = pg_fetch_result($ID_result,0);
        $user_id = $this->user->GetID();
        $result = pg_query($this->conn,"SELECT project.add_opinion(
            CAST('$name' AS VARCHAR),
            CAST('$surname' AS VARCHAR),
            CAST('$user_id' AS VARCHAR),
            CAST('$opinia' AS VARCHAR)
        )");
        if (empty($result)) {
            $this->layout->header = "Błąd!!! <br>".pg_last_error();
            return $this->layout;
        }        
        $val = pg_fetch_result($result,0);
        $this->layout->header = $val;
        $this->layout->title = $val;
        return $this->layout; 
    }
    
}
?>