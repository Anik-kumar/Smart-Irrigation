<?php
 
class DB_CONNECT {

    private $con;
 
    // Constructor
    function __construct() {
        // Trying to connect to the database
        $this->connect();
    }
 
    // Destructor
    function __destruct() {
        // Closing the connection to database
        $this->close();
    }
 
   // Function to connect to the database
    private function connect() {
        $con = null;

        try{
            //importing dbconfig.php file which contains database credentials 
            $filepath = realpath (dirname(__FILE__));
     
            require_once($filepath."/dbconfigLocal.php");
            
            // Connecting to mysql (phpmyadmin) database
            $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

            // echo "connection -> ";
            // echo $filepath;
            if(!$con) {
                echo "connection failed.";
                echo mysqli_error($con);
            }
     
            // Selecing database
            // $db = mysqli_select_db($con,DB_DATABASE) or die(mysqli_error()) or die(mysqli_error());
        } catch(Exception $e) {
            echo "Exception in Connecting Database. " . $e->getMessage();
        }
 
        
 
        // returing connection cursor
        return $con;
    }

    public function getConnection(){
        if($this->con){
            return $this->con;
        }else{
            return $this->connect();
        }
    }
 
	// Function to close the database
    public function close() {
        // Closing data base connection
        mysqli_close(mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD));
    }
 
}
 
?>