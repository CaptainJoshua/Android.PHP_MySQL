<?php 

// Connect to the database
 class DBConnect {
    private $con;
    // Class constructor
    function __construct()
    {
        
    }

    // Connecting to database
    function connect() {
        include_once dirname(__FILE__) . "/constants.php";
            $this->con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            
            if (mysqli_connect_errno()) {
                echo "Failed to connect with database " . mysqli_connect_error();
            }
            return $this->con;
        }
 }

 // 02 - PHP Database Connection