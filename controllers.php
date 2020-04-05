<?php
 
include 'appl/Views/View.php' ;
include 'appl/Controllers/Controller.php' ;
include 'appl/Controllers/ServiceController.php' ;
include 'appl/Controllers/LoginController.php' ;
include 'appl/Controllers/PatientController.php' ;
include 'appl/Controllers/DoctorController.php' ;
include 'appl/Controllers/AdminController.php' ;

function __autoload($class_name) {
   // print '{'.$class_name.'}' ;
   $path_to_class = __DIR__. '/' . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
   require_once($path_to_class);
}
            
 
try {
 
  if (empty ($_GET['sub']))    { $contr = 'Login' ;   }
  else                         { $contr = $_GET['sub'] ; }
 
  if (empty ($_GET['action'])) { $action     = 'index' ;  }
  else                         { $action     = $_GET['action'] ; } 

   
  switch ($contr) {           
    case 'Login' :
      $contr = "LoginController" ;   
    break;
    case 'Service' :
      $contr = "ServiceController";
    break ;  
    case 'Patient' :
      $contr = "PatientController";
    break ;  
    case 'Doctor' :
      $contr = "DoctorController";
    break ; 
    case 'Admin' :
      $contr = "AdminController";
    break ;   
  }
  $controller = new $contr ;
  echo $controller->$action() ;
}
catch (Exception $e) {
  // echo 'Blad -.- : [' . $e->getCode() . '] ' . $e->getMessage() . '</br>' ;
  // echo __CLASS__.':'.__LINE__.':'.__FILE__ ;
  // $contr = new info() ;
  // echo $contr->error ( $e->getMessage() ) ;
  echo 'Error: [' . $e->getCode() . '] ' . $e->getMessage() ;
 
}
 
?>