<?php
include './components/navigation-with-linebreaks.php';
/*TODO: fix increment.*/
require("connect-db.php");
addRCForm();
function addRCForm(){
    echo"<p> Add a rental car </p>";
    echo "<html>
        <body>
        <form action = 'rentalcar.php' method='post'>
        Make: <input type='text' name='rc_make'><br>
        Model: <input type='text' name='rc_model'><br>
        Color: <input type='text' name='rc_color'><br>
        Seats: <input type='text' name='rc_seats'><br>
        <input type='submit'>
    </form>
        </body>
    </html>";
    if(isset($_POST['rc_make']))
    {
        addRC(
            $_POST['rc_make'],
            $_POST['rc_model'],
            $_POST['rc_color'],
            $_POST['rc_seats']
        );
    }
}
function addRC($make, $model, $color, $seats){
    global $db;
    $query = 
    "INSERT INTO RENTALCAR
        (RC_MAKE,
        RC_MODEL,	
        RC_COLOR,	
        RC_SEATS)
    VALUES (:make, :model, :color, :seats)";

    $statement = $db->prepare($query);
    $statement->bindValue(':make', $make);
    $statement->bindValue(':model', $model);
    $statement->bindValue(':color', $color);
    $statement->bindValue(':seats', $seats);
    $statement->execute();
    $statement->closeCursor();
}

?>