<?php
include './components/navigation-with-linebreaks.php';
require("connect-db.php");
require('add-activity.php');
addHikeForm(); 

function addHikeForm()
{
    echo"<p> Add activity </p>";
    echo "<html>
        <body>
        <form action = 'activities.php?btnaction=hike' method='post'>
        Name: <input type='text' name='activity_name'><br>
        URL: <input type='text' name='activity_url'><br>
        <br>
        Difficulty: <input type='text' name='hike_difficulty'><br>
        Length: <input type='text' name='hike_length'><br>
        Topological gain: <input type='text' name='hike_topo'><br>
        Street address: <input type='text' name='hike_st'><br>
        City: <input type='text' name='hike_city'><br>
        State : <input type='text' name='hike_state'><br>
        Zip: <input type='text' name='hike_zip'><br>
        <input type='submit'>
    </form>
        </body>
    </html>";

    if(isset($_POST['activity_name']))
    {
        addActivity($_POST['activity_name'], 
            "HIKE",
            $_POST['activity_url']);
        addHike(
            getNewActivitiesID(),
            $_POST['hike_difficulty'], 
            $_POST['hike_length'],
            $_POST['hike_topo'],
            $_POST['hike_st'],
            $_POST['hike_city'],
            $_POST['hike_state'],
            $_POST['hike_zip']);
    }
        
}
function addHike($id, $diff, $len, $top, $street, $city, $state, $zip)
{
    global $db;
    $query = 
    "INSERT INTO HIKE
        (ACTIVITY_ID, 
        HIKE_DIFFICULTY, 
        HIKE_LENGTH, 
        HIKE_TOPO_GAIN,
        HIKE_STREET,
        HIKE_CITY,
        HIKE_STATE,
        HIKE_ZIP) 
    VALUES (:id, :diff, :len, :top, :street, :city, :state, :zip)";

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':diff', $diff);
    $statement->bindValue(':len', $len);
    $statement->bindValue(':top', $top);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':street', $street);
    $statement->bindValue(':state', $state);
    $statement->bindValue(':zip', $zip);
    $statement->execute();
    $statement->closeCursor();
}
?>
