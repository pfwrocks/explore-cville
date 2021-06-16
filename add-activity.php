<?php 
require('connect-db.php');
include './components/navigation.php';


// Helper function that returns the latest activity ID
function getNewActivitiesID(){
    global $db;
    $query = "SELECT * FROM ACTIVITY";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $ret;
    foreach ($results as $result){
        $ret = $result['ACTIVITY_ID'];
    }
    $statement->closeCursor();
    return $ret; 
}

function addActivityForm()
{
echo"<p> Add activity </p>";
echo "<html>
    <body>
    <form action = 'activities.php' method='post'>
    Name: <input type='text' name='activity_name'><br>
    Type: <input type='text' name='activity_type'><br>
    URL: <input type='text' name='activity_url'><br>
    <input type='submit'>
</form>
    </body>
</html>";
echo "activity name is";
echo $_POST['activity_name'];
addActivity(
    $_POST['activity_name'], 
    $_POST['activity_type'],
    $_POST['activity_url']
);
}
// Helper for addActivityForm with mySQL.
function addActivity($name, $type, $url)
{
    global $db;
    $query = 
    "INSERT INTO ACTIVITY
        (ACTIVITY_NAME, 
        ACTIVITY_TYPE,
        ACTIVITY_URL) 
    VALUES (:name, :type, :url)";

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':type', $type);
    $statement->bindValue(':url', $url);
    $statement->execute();
    $statement->closeCursor();
}