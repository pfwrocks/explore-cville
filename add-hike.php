<?php
require("connect-db.php");
echo "add page!";
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
            $_POST['activity_name'],
            $_POST['hike_difficulty'], 
            $_POST['hike_length'],
            $_POST['hike_topo'],
            $_POST['hike_st'],
            $_POST['hike_zip']);
    }
        
}
function addHike($id, $name, $diff, $len, $top, $st, $zip)
{
    # example sql
    /*
    INSERT INTO `HIKE` (`ACTIVITY_ID`, `HIKE_NAME`, `HIKE_DIFFICULTY`, `HIKE_LENGTH`, `HIKE_TOPO_GAIN`, `HIKE_STREET`, `HIKE_ZIP`) VALUES
    (1, 'Old Rag Mountain Loop', 'Hard', '9.5', '2683', 'State Rte 600, Etlan, VA', '22719'),
    (2, 'Humpback Rocks Hike', 'Moderate', '4.0', '1240', 'Humpback Gap Overlook, Afton, VA', '22920'),
    (3, 'Riprap Trail', 'Hard', '9.3', '2116', 'Wildcat Ridge Parking Area, Crimora, VA', '24431');
    */
    global $db;
    $query = 
    "INSERT INTO HIKE
        (ACTIVITY_ID, 
        HIKE_NAME, 
        HIKE_DIFFICULTY, 
        HIKE_LENGTH, 
        HIKE_TOPO_GAIN,
        HIKE_STREET,
        HIKE_ZIP) 
    VALUES (:id, :name, :diff, :len, :top, :st, :zip)";

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':diff', $diff);
    $statement->bindValue(':len', $len);
    $statement->bindValue(':top', $top);
    $statement->bindValue(':st', $st);
    $statement->bindValue(':zip', $zip);
    $statement->execute();
    $statement->closeCursor();
}



?>
