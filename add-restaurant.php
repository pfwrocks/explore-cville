<?php
require('add-activity.php');
addRestaurantForm(); 
// Form for inserting new restaurants. 
function addRestaurantForm(){
    echo"<p> Add activity </p>";
    echo "<html>
        <body>
        <form action = 'activities.php?btnaction=restaurant' method='post'>
        Name: <input type='text' name='activity_name'><br>
        URL: <input type='text' name='activity_url'><br>
        <br>
        Rating: <input type='text' name='res_rating'><br>
        Price: <input type='text' name='res_price'><br>
        Cuisine: <input type='text' name='res_cuisine'><br>
        Street address: <input type='text' name='res_st'><br>
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
            $_POST['activity_name'],
            $_POST['res_rating'], 
            $_POST['res_price'],
            $_POST['res_cuisine'],
            $_POST['res_st'],
            $_POST['res_zip']);
    }
}
function addRestaurant($id, $name, $rate, $pr, $cui, $st, $zip){
    global $db;
    $query = 
    "INSERT INTO RESTAURANT
        (ACTIVITY_ID,
        RESTAURANT_NAME,	
        RESTAURANT_RATING,	
        RESTAURANT_PRICE_RANGE,	
        RESTAURANT_CUISINE,
        RESTAURANT_STREET,	
        RESTAURANT_ZIP) 
    VALUES (:id, :name, :rate, :pr, :cui, :st, :zip)";

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':rate', $rate);
    $statement->bindValue(':pr', $pr);
    $statement->bindValue(':cui', $cui);
    $statement->bindValue(':st', $st);
    $statement->bindValue(':zip', $zip);
    $statement->execute();
    $statement->closeCursor();
}

?>