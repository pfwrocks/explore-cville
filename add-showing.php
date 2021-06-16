<?php
/*
example input
INSERT INTO SHOWTIME (ACTIVITY_ID, THEATER_ID, SHOW_TIME) VALUES (:activity_id, :theater_id :showtime)8 3 2021-06-02 20:15:47
*/
include './components/navigation-with-linebreaks.php';
require("connect-db.php");
addShowingForm();
// showings.php
function addShowingForm(){
    echo"<p> Add a showing </p>";
    echo "<html>
        <body>
        <form action = '' method='post'>
        Activity ID#: <input type='text' name='activity_id'><br>
        Theater ID#: <input type='text' name='theater_id'><br>
        Showtime: <input type='text' name='showtime'><br>
        <input type='submit'>
    </form>
        </body>
    </html>";
    if(isset($_POST['activity_id']))
    {
        addShowing(
            $_POST['activity_id'],
            $_POST['theater_id'],
            $_POST['showtime']
        );
    }
}
function addShowing($activity_id, $theater_id, $showtime){
    global $db;
    $query = 
    "INSERT INTO SHOWTIME
        (ACTIVITY_ID,
        THEATER_ID,		
        SHOW_TIME)
    VALUES (:activity_id, :theater_id :showtime)";

    echo $query; 
    echo $activity_id ." ". $theater_id ." ". $showtime;

    $statement = $db->prepare($query);
    $statement->bindValue(':activity_id', $activity_id);
    $statement->bindValue(':theater_id', $theater_id);
    $statement->bindValue(':showtime', $showtime);
    $statement->execute();
    $statement->closeCursor();
}

?>