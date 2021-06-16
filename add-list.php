<?php
include './components/navigation.php';
require('add-activity.php');
require("connect-db.php");
addListForm();
function addListForm(){
    echo"<p> Add activity </p>";
    echo "<html>
        <body>
        <form action = 'activities.php?btnaction=list' method='post'>
        List Name: <input type='text' name='activity_name'><br>
        Customer ID: <input type='text' name='activity_name'><br>
        List ID: <input type='text' name='activity_name'><br>
        <input type='submit'>
        </form>
        </body>
    </html>";
    if(isset($_POST['activity_name']))
    {
        addActivity($_POST['activity_name'], 
            $_POST['activity_opentime'],
            $_POST['activity_closetime'],
            $_POST['activity_type'],
            $_POST['activity_url']);
        addRestaurant(
            getNewActivitiesID(),
            $_POST['activity_name'],
            $_POST['mov_rating'], 
            $_POST['mov_price'],
            $_POST['mov_genre'],
            $_POST['mov_rating'],
            $_POST['mov_release_date']);
    }

}
function addList($cust_id, $list_id, $name){
    global $db;
    $query = 
    "INSERT INTO LIST
        (LIST_ID,
        CUST_ID,	
        LIST_NAME)
    VALUES (:cust_id, :list_id, :name)";

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':cust_id', $cust_id);
    $statement->bindValue(':list_id', $list_id);
    $statement->execute();
    $statement->closeCursor();
}
?>