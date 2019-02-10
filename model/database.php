
<?php
/***
 * Name: Vladimir Herdia
 * Date: 2/20/2018
 * Desc: This class creates a database connection to MySQL
 */
    class DatabaseConnection {
        
        var $dbConnection;

        public function __construct(){
            $this->dbConnection = $this->getConnection();
        }

        //create and return the connection
        public function getConnection(){
            $dsn = 'mysql:host=localhost;dbname=cart';
            $username = 'cs602_user';
            $password = 'cs602_secret';
            try{
                $dbConnection = new PDO($dsn, $username, $password);
            }catch(PDOException $e){
                $error_message = $e->getMessage();
                include('database_error.php');
                exit();
            }
            return $dbConnection;
        }
    }
?>