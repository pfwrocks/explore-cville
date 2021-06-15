<?php
include './components/navigation-with-linebreaks.php';
/* increment error */ 
require("connect-db.php");
addTheaterForm();
function addTheaterForm(){
    echo"<p> Add a showing </p>";
    echo "<html>
        <body>
        <form action = 'theaters.php' method='post'>
        Name: <input type='text' name='thea_name'><br>
        Cost/Ticket: <input type='text' name='thea_cost'><br>
        Street: <input type='text' name='thea_street'><br>
        City: <input type='text' name='thea_city'><br>
        State: <input type='text' name='thea_state'><br>
        Zip: <input type='text' name='thea_zip'><br>
        <input type='submit'>
    </form>
        </body>
    </html>";
    if(isset($_POST['thea_name']))
    {
        addTheater(
            $_POST['thea_name'],
            $_POST['thea_cost'],
            $_POST['thea_street'],
            $_POST['thea_city'],
            $_POST['thea_state'],
            $_POST['thea_zip']
        );
    }
}
function addTheater($name, $cost, $street, $city, $state, $zip){
    global $db;
    $query = 
    "INSERT INTO THEATER
        (THEATER_NAME,
        THEATER_TICK_COST,	
        THEATER_STREET,
        THEATER_CITY,
        THEATER_STATE,	
        THEATER_ZIP)
    VALUES (:name, :cost, :street, :city, :state, :zip)";

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':cost', $cost);
    $statement->bindValue(':street', $street);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':state', $state);
    $statement->bindValue(':zip', $zip);
    $statement->execute();
    $statement->closeCursor();
}

?>