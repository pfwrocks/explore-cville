<?php
// hostname
$hostname = 'localhost:3307';

// database name
$dbname = 'explore-cville';

// database credentials
$username = 'cville-user';
$password = 'daEKR9EjDujaQqW7';

// DSN (Data Source Name) specifies the host computer for the MySQL database
// and the name of the database. If the MySQL database is running on the same server
// as PHP, use the localhost keyword to specify the host computer

// $dsn = "mysql:host=$hostname;dbname=$dbname";
$dsn = "mysql:dbname=$dbname;host=127.0.0.1";


/** connect to the database **/

// Create an instance of PDO (PHP Data Objects) which connects to a MySQL database
try { $db = new PDO($dsn, $username, $password); } 
catch (PDOException $e)     // handle a PDO exception (errors thrown by the PDO library)
{
   // Call a method from any object, use the object's name followed by -> and then method's name
   // All exception objects provide a getMessage() method that returns the error message
   $error_message = $e->getMessage();
   echo "<p>An error occurred while connecting to the database: $error_message </p>";
}
catch (Exception $e)       // handle any type of exception
{
   $error_message = $e->getMessage();
   echo "<p>Error message: $error_message </p>";
}

?>
