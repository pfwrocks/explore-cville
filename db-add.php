<?php 
require('connect-db.php');

// Add activity functional on 'all' tab on activities.php
# Likely needs
# - Form validation, specifically with the date inputs since those are picky.
# - to be more pretty. 
# but maybe that's not necessarly all required b/c this is a db not a web course -_-

# Form that adds an activity into the database's ACTIVITY table. 
function addActivityForm()
{
echo"<p> Add activity </p>";
echo "<html>
    <body>
    <form action = 'activities.php' method='post'>
    Name: <input type='text' name='activity_name'><br>
    Opens: <input type='text' name='activity_opentime'><br>
    Closes: <input type='text' name='activity_closetime'><br>
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
    $_POST['activity_opentime'],
    $_POST['activity_closetime'],
    $_POST['activity_type'],
    $_POST['activity_url']
);
}
// Helper for addActivityForm with mySQL.
function addActivity($name, $open, $close, $type, $url)
{
    global $db;
    $query = 
    "INSERT INTO ACTIVITY
        (ACTIVITY_NAME, 
        ACTIVITY_OPENTIME, 
        ACTIVITY_CLOSETIME, 
        ACTIVITY_TYPE,
        ACTIVITY_URL) 
    VALUES (:name, :open, :close, :type, :url)";

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':open', $open);
    $statement->bindValue(':close', $close);
    $statement->bindValue(':type', $type);
    $statement->bindValue(':url', $url);
    $statement->execute();
    $statement->closeCursor();
}

?>
