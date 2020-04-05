<?php

class User{
 
protected $conn;
   function __construct () {
      session_start() ;
      $this->conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=admin");
   }
   function get_mail(){
      if($this->_isLogged())
         return $_SESSION['user'];    
   }
   /*
 * Login uzytkownika do serwisu 
 */
 
function _loginPatient($email,$pass) {
    $access = false ; 
    if (!$this->conn) {
        echo "<hr>An error occured! <br/>";
        echo pg_last_error();
        exit;
    }
    $result = pg_query($this->conn,"SELECT * FROM project.patients where project.patients.email = '".$email."' AND project.patients.password = '".$pass."';");
    $val = pg_fetch_all($result);

    if($val == "")
    {
        return $val;
    }
    $_SESSION['auth'] = 'OK' ;
    $_SESSION['isService'] = false;
    $_SESSION['user'] = $email ;
    $_SESSION['userID'] = $val[0]['patient_id'] ;
    $access = true ; 
    $this->isService = false; 
    return $val;
    }

    function _loginService($email,$pass) {
        $access = false ; 
        if (!$this->conn) {
            echo "<hr>An error occured! <br/>\$db: ($db)\n";
            echo pg_last_error($conn);
            exit;
        }
        $result = pg_query($this->conn,"SELECT * FROM project.employees where project.employees.email = '".$email."' AND project.employees.password = '".$pass."';");
        $val = pg_fetch_all($result);
        if($val == "")
        {
            return $val;
        }
        $_SESSION['auth'] = 'OK' ;
        $_SESSION['user'] = $email  ; 
        $_SESSION['userID'] = $val[0]['employee_id'] ;  
        $id = $val[0]['employee_id'];
        $access = true ;  
        $_SESSION['isService'] = true;
        $is_doctor = pg_query($this->conn,"SELECT project.is_doctor(CAST($id AS VARCHAR))");
        $is_admin = pg_query($this->conn,"SELECT employee.is_admin FROM (SELECT * FROM project.employees p WHERE p.employee_id = '$id') AS employee;");
        if(pg_fetch_result($is_doctor,0) == 't')
        {
            $_SESSION['isService'] = false;
            $_SESSION['is_doctor'] = true;
        }
        if(pg_fetch_result($is_admin,0) == 't')
        {
            $_SESSION['isService'] = false;
            $_SESSION['is_doctor'] = false;
            $_SESSION['is_admin'] = true;
        }
        return $val;
    }
    function _isAdmin()
{
    if ( isset ( $_SESSION['is_admin'] ) ) { 
        $ret = $_SESSION['is_admin'] ? true : false ;
     } else { $ret = false ; }
     return $ret ;
}
function _isService()
{
    if ( isset ( $_SESSION['isService'] ) ) { 
        $ret = $_SESSION['isService'] ? true : false ;
     } else { $ret = false ; }
     return $ret ;
}
function _isDoctor()
{
    if ( isset ( $_SESSION['is_doctor'] ) ) { 
        $ret = $_SESSION['is_doctor'] ? true : false ;
     } else { $ret = false ; }
     return $ret ;
}

 function _isLogged() {
    if ( isset ( $_SESSION['auth'] ) ) { 
       $ret = $_SESSION['auth'] == 'OK' ? true : false ;
    } else { $ret = false ; }
    return $ret ;
 } 
 /*
 * Wylogowanie uzytkownika do serwisu 
 */
 
function _logout() {
    unset($_SESSION); 
    session_destroy();   
    $text =  'Uzytkownik wylogowany ' ;
    return $text ;
 }
function getID()
{
    if($this->_isLogged())
    {
        return $_SESSION['userID'];
    }
    else return -10;
}
function getEmail()
{
    if($this->_isLogged())
    {
        return $_SESSION['user'];
    }
    else return "Niezalogowano.";
}
}
?>