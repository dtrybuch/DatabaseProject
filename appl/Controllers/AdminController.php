<?php
include __DIR__.'/../Models/EmployeesModel.php';
include __DIR__.'/../Models/SpecializationsModel.php';
include __DIR__.'/../Models/CabinetsModel.php';
class AdminController extends Controller{
    protected $user;
    protected $appointments;
    protected $opinions;
    protected $attendances;
    protected $employees;
    protected $specializations;
    protected $cabinets;
    protected $wages;
    function __construct(){
        parent::__construct();
        $this->layout = new View('main') ;
        $this->layout->css = $this->css ;
        $this->layout->title  = 'Przychodnia specjalistyczna' ;
        $this->layout->menu = $this->menu ;
        $this->layout->header = "Witamy w przychodni!!!" ;
        $this->user = new User();
        $this->appointments  = new AppointmentModel() ;
        $this->opinions  = new OpinionsModel() ;
        $this->attendances = new AttendanceModel() ;        
        $this->employees  = new EmployeesModel() ;
        $this->specializations  = new SpecializationsModel() ;
        $this->cabinets  = new CabinetsModel() ;
        $this->wages  = new WagesModel() ;
        $this->layout->user = $this->user->getEmail();
        if (!$this->conn) {
            echo "<hr>An error occured! <br/>";
            echo pg_last_error();
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
    function addEmployee()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie !!!";
    
            return $this->layout;
        }
        $this->layout->content = new View("addEmployee");
        $this->layout->content->cabinets = $this->cabinets->getAll();
        $this->layout->content->specializations = $this->specializations->getAll();
        $this->layout->header = "Dodaj pracownika";
        return $this->layout;
    }
    function addEmployeePost(){
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie jako administrator!!!";
            return $this->layout;
        }
        $is_doctor = false;
        $email = $_POST['email'];
        $password  = $_POST['password'];
        $name  = $_POST['name'];
        $surname  = $_POST['surname'];
        $account_number  = $_POST['account_number'];
        $occupation  = $_POST['occupation'];
        $cabinet_id = $_POST['cabinet'];
        $specialization = $_POST['specialization'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $zip_code = $_POST['zip_code'];
        $locality = $_POST['locality'];
        if($email == "" || $password == "" || $name=="" || $surname=="" || empty($account_number) || empty($phone_number) || empty($address) || empty($zip_code) || empty($locality))
        {
            $this->layout->header = "Podaj wszystkie dane!!!";
            return $this->layout;
        }
        echo "Specjalizacja:".$specialization;
        if((empty($cabinet_id) || empty($specialization)) && $occupation == 'Doctor')
        {
            $this->layout->header = "Podaj wszystkie dane!!!";
            return $this->layout;
        }
        $result = pg_query($this->conn,"SELECT project.add_employee(
        CAST ('$name' as VARCHAR),
        CAST ('$surname' as VARCHAR),
        CAST ('$email' as VARCHAR),
        CAST ('$password' as VARCHAR),
        CAST ('$account_number' as project.good_account_number),
        CAST ('$occupation' as VARCHAR),
        CAST ('$phone_number' as project.good_phone_number),
        CAST ('$address' as VARCHAR),
        CAST ('$zip_code' as project.good_ZIP_code),
        CAST ('$locality' as VARCHAR)
        );");
        if(!$result)
        {
            $this->layout->header = "Błąd!!! <br>".pg_last_error();
    
            return $this->layout;
        }   
        $val =  pg_fetch_result($result,0);
        if($occupation == 'Doctor')
        {
            $employee_id = $this->employees->takeLastRecord();
            $result2 = pg_query($this->conn,"INSERT INTO project.doctors VALUES(CAST ('$employee_id' AS VARCHAR), CAST ('$cabinet_id' AS VARCHAR));");
            if(!$result2)
            {
                $this->layout->header = "Błąd!!! <br>".pg_last_error();
                return $this->layout;
            }
            $N = count($specializations);
            for($i = 0;$i < $N; $i++)
            {
                $result3 = pg_query($this->conn,"INSERT INTO project.doc_spec VALUES(CAST ('$employee_id' AS VARCHAR), CAST ('$specializations[$i]' AS VARCHAR));");
                if(!$result3)
                {
                    $this->layout->header = "Błąd!!! <br>".pg_last_error();
                    return $this->layout;
                }
            }
        } 
        $this->layout->header = $val;
        return $this->layout;
    }
    function deleteEmployee()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie jako administrator!!!";
    
            return $this->layout;
        }
        $this->layout->content = new View('deleteEmployee') ;
        $this->layout->content->employees = $this->employees->getAll() ;
        $this->layout->header = "Usuń employeea";
        return $this->layout;
    }   
    //post
    function deleteEmployeePost()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie jako administrator!!!";
    
            return $this->layout;
        }
        $id = $_POST['employee'];
        if(empty($id))
        {
            $this->layout->header = "Podaj wszystkie dane!!!";
    
            return $this->layout;
        }
        $val = $this->employees->deleteEmployee($id);

        $this->layout->header = $val;
        $this->layout->title = $val;
        return $this->layout;
    }   
//get
    function addSpecialization()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie jako administrator!!!";
    
            return $this->layout;
        }
        $this->layout->content = new View("addSpecialization");
        $this->layout->header = "Dodaj specjalizację";
        return $this->layout;
    }
    //post
    function addSpecializationPost(){
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie jako administrator!!!";
    
            return $this->layout;
        }
        $nazwa = $_POST['nazwa'];
        if($nazwa == "")
        {
            $this->layout->header = "Nie podano nazwy!!!";
    
            return $this->layout;
        }
        $result = pg_query($this->conn,"SELECT project.add_specialization(CAST ('$nazwa' AS VARCHAR))");
        if(!$result)
        {
            $this->layout->header = "Błąd!!! <br>".pg_last_error();
            return $this->layout;
        }
        $val = pg_fetch_result($result,0);
        $this->layout->header = $val;

        return $this->layout;
    }
    //get
    function deleteSpecialization()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie jako administrator!!!";
            return $this->layout;
        }
        $this->layout->content = new View('deleteSpecialization') ;
        $this->layout->content->specializations = $this->specializations->getAll() ;
        $this->layout->header = "Usuń specjalizację";
        return $this->layout;
    }   
    //post
    function deleteSpecializationPost()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie jako administrator!!!";
    
            return $this->layout;
        }
        $id = $_POST['specjalizacja'];
        $val = $this->specializations->deleteSpecialization($id);
        $this->layout->header = $val;
        $this->layout->title = $val;
        return $this->layout;
    }
    //get
    function addCabinet()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie jako administrator!!!";
            return $this->layout;
        }
        $this->layout->content = new View("addCabinet");
        $this->layout->header = "Dodaj gabinet";
        return $this->layout;
    }
    //post
    function addCabinetPost(){
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie jako administrator!!!";
    
            return $this->layout;
        }
        $nr = $_POST['nr'];
        $floor = $_POST['floor'];
        if(empty($nr) || empty($floor))
        {
            $this->layout->header = "Podaj wszystkie dane!!!";
            return $this->layout;
        }
        $result = pg_query($this->conn,"SELECT project.add_cabinet
        (CAST ('$nr' AS INTEGER),
        CAST ('$floor' AS INTEGER)
        )");
        $val = pg_fetch_result($result,0);
        $this->layout->header = $val;

        return $this->layout;
    }
    //get
    function deleteCabinet()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie jako administrator!!!";
    
            return $this->layout;
        }
        $this->layout->content = new View('deleteCabinet');
        $this->layout->header = "Usuń gabinet";
        $this->layout->content->cabinets = $this->cabinets->getAll() ;

        return $this->layout;
    }   
    //post
    function deleteCabinetPost()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie jako administrator!!!";
    
            return $this->layout;
        }
        $id = $_POST['gabinet'];
        if(empty($id))
        {
            $this->layout->header = "Podaj wszystkie dane!!!";
    
            return $this->layout;
        }
        $val = $this->cabinets->deleteCabinet($id);

        $this->layout->header = $val;
        $this->layout->title = $val;
        return $this->layout;
    }
    function seeAllOpinions()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie jako administrator!!!";
            return $this->layout;
        }
        $this->layout->content = new View('seeAllOpinions') ;

        $this->layout->header = "Opinie";
        $this->layout->content->opinions = $this->opinions->getAll() ;
        return $this->layout;
    }
    function seeWages()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie jako administrator!!!";
            return $this->layout;
        }
        $this->layout->content = new View('allWages') ;
        $this->layout->header = "Wypłaty";
        $this->layout->content->wages = $this->wages->getAll() ;
        return $this->layout;
    }
    //get
    function addWage()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
    
            $this->layout->header = "Zaloguj sie jako administrator!!!";
            return $this->layout;
        }
        $this->layout->content = new View('addWage') ;
        $this->layout->header = "Dodaj wypłatę";
        $this->layout->content->employees = $this->employees->getAll() ;
        return $this->layout;
    }
    //post
    function addWagePost()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
    
            $this->layout->header = "Zaloguj sie jako administrator!!!";
            return $this->layout;
        }
        $employee_id = $_POST['employee'];
        $wyplata = $_POST['wyplata'];
        if(empty($wyplata) || empty($employee_id))
        {
            $this->layout->header = "Podaj wszystkie dane!!!";
    
            return $this->layout;
        }
        $result = pg_query($this->conn,"INSERT INTO project.wages(employee_id,wages_date,wages_count)
            VALUES (CAST ('$employee_id' AS VARCHAR),NOW(),CAST ('$wyplata' AS INTEGER))");
        if(!$result)
        {
            $this->layout->header = "Błąd!!! <br>".pg_last_error();
            return $this->layout;
        }
        $this->layout->header = "Wyplata zostala dodana";
        $this->layout->title = "Wyplata zostala dodana";

        return $this->layout;
    }   
    //get
    function deleteWage()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
            $this->layout->header = "Zaloguj sie jako administrator!!!";
    
            return $this->layout;
        }
        $this->layout->content = new View('deleteWage') ;
        $this->layout->header = "Usuń wypłatę";
        $this->layout->content->wages= $this->wages->getAll() ;
        return $this->layout;
    }
    //post
    function deleteWagePost()
    {
        if( ! $this->user->_isLogged()  || ! $this->user->_isAdmin())
        {
    
            $this->layout->header = "Zaloguj sie jako administrator!!!";
            return $this->layout;
        }
        $wage_id = $_POST['wyplata'];
        if(empty($wage_id))
        {
            $this->layout->header = "Podaj wszystkie dane!!!";
    
            return $this->layout;
        }
        $result = pg_query($this->conn,"DELETE FROM project.wages w WHERE w.wage_id = '$wage_id';");
        if(!$result)
        {
            $this->layout->header = "Błąd!!! <br>".pg_last_error();
    
            return $this->layout;
        }
        $this->layout->header = "Wyplata zostala usunieta";
        $this->layout->title = "Wyplata zostala usinieta";

        return $this->layout;
    }   
    function seeLogs()
    {
        $result = pg_query($this->conn,"SELECT * FROM project.logs ORDER BY insertion_date;");
        if(!$result)
        {
            $this->layout->header = "Błąd!!! <br>".pg_last_error();  
            return $this->layout;
        }
        $this->layout->content = new View('seeLogs');
        $this->layout->header = "Zobacz logi";
        $this->layout->content->logi = pg_fetch_all($result);
        return $this->layout;
    }
    function deleteAllLogs()
    {
        $result = pg_query($this->conn,"DELETE FROM project.logs;");
        if(!$result)
        {
            $this->layout->header = "Błąd!!! <br>".pg_last_error();
            return $this->layout;
        }

        $this->layout->header = "Logi zostaly usunięte!";
        $this->layout->title = "Logi zostaly usunięte!";
        return $this->layout;
    }
}
?>