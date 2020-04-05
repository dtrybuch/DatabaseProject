<?php
include __DIR__.'/../Models/Model.php';
abstract class Controller {
  
   protected $css ; 
   protected $menu ; 
   protected $conn;
   function __construct() {
      $this->css  = "<link rel=\"stylesheet\" href=\"css/style.css\" type=\"text/css\" media=\"screen\" >" ;
      $this->conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=admin");
   }
 
   static function http404() {
      header('HTTP/1.1 404 Not Found') ;
      print '<!doctype html><html><head><title>404 Not Found</title></head><body><p>Invalid URL</p></body></html>' ;
      exit ;
   }
 
   function __call($name, $arguments)
   {
        self::http404();
   }
 
}
 
?>