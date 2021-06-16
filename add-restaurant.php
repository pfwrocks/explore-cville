<?php
include './components/navigation-with-linebreaks.php';
require('add-activity.php');
require("connect-db.php");
addRestaurantForm(); 
// Form for inserting new restaurants. 
function addRestaurantForm(){
    /* activities.php?btnaction=restaurant*/
    echo"<p> Add activity </p>";
    echo "<html>
        <body>
        <form action = '' method='post'>
        Name: <input type='text' name='activity_name'><br>
        URL: <input type='text' name='activity_url'><br>
        <br>
        Rating: <input type='text' name='res_rating'><br>
        Price: <input type='text' name='res_price'><br>
        Cuisine: <input type='text' name='res_cuisine'><br>
        Street address: <input type='text' name='res_street'><br>
        City: <input type='text' name='res_city'><br>
        State: <input type='text' name='res_state'><br>
        Zip: <input type='text' name='res_zip'><br>
        <input type='submit'>
    </form>
        </body>
    </html>";
    if(isset($_POST['activity_name']))
    {
        addActivity($_POST['activity_name'], 
            "RESTAURANT",
            $_POST['activity_url']);
        addRestaurant(
            getNewActivitiesID(),
            $_POST['res_rating'], 
            $_POST['res_price'],
            $_POST['res_cuisine'],
            $_POST['res_street'],
            $_POST['res_city'],
            $_POST['res_state'],
            $_POST['res_zip']);
    }
}
function addRestaurant($id, $rate, $pr, $cui, $street, $city, $state, $zip){
    global $db;
    $query = 
    "INSERT INTO RESTAURANT
        (ACTIVITY_ID,	
        RESTAURANT_RATING,	
        RESTAURANT_PRICE_RANGE,	
        RESTAURANT_CUISINE,
        RESTAURANT_STREET,	
        RESTAURANT_CITY,
        RESTAURANT_STATE,
        RESTAURANT_ZIP) 
    VALUES (:id, :rate, :pr, :cui, :street, :city, :state, :zip)";

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':rate', $rate);
    $statement->bindValue(':pr', $pr);
    $statement->bindValue(':cui', $cui);
    $statement->bindValue(':street', $street);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':state', $state);
    $statement->bindValue(':zip', $zip);
    $statement->execute();
    $statement->closeCursor();

    echo $query; 
}

?>