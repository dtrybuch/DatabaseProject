<?php
    class Model
    {
        protected $conn;
        function __construct()
        {
            $this->conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=admin");
            if (!$this->conn) {
                echo "<hr>An error occured! <br/>\n";
                echo pg_last_error();
                echo '<br><br><a href="javascript:history.go(-1)" id="BackButton" >Wróć</a>';
                exit;
            }
        }
    }
?>