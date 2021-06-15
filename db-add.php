<?php 
require('connect-db.php');


// Helper function that returns the latest activity ID
function getNewActivitiesID(){
    global $db;
    $query = "SELECT * FROM ACTIVITY";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return sizeof($results);
}
// Add activity functional on 'all' tab, activities.php
# Likely needs
# - Form validation, specifically with the date inputs since those are picky.
# - to be more pretty. 
# but maybe she won't grade hard because this is a db not a web course -_-
# Form that adds an activity into the database's ACTIVITY table. 
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


# Add a new movie 
function addMovieForm(){
    echo"<p> Add activity </p>";
    echo "<html>
        <body>
        <form action = 'activities.php?btnaction=hike' method='post'>
        Name: <input type='text' name='activity_name'><br>
        Opens: <input type='text' name='activity_opentime'><br>
        Closes: <input type='text' name='activity_closetime'><br>
        Type: <input type='text' name='activity_type'><br>
        URL: <input type='text' name='activity_url'><br>
        <br>
        Rating: <input type='text' name='mov_rating'><br>
        Price: <input type='text' name='mov_price'><br>
        Genre: <input type='text' name='mov_genre'><br>
        Rating: <input type='text' name='mov_rating'><br>
        Release Date: <input type='text' name='mov_release_date'><br>
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
function addMovie($id, $name, $rate, $pr, $gen, $rat, $rd){
    global $db;
    $query = 
    "INSERT INTO RESTAURANT
        (ACTIVITY_ID,
        MOVIE_NAME,	
        MOVIE_PR,	
        MOVIE_GENRE,	
        MOVIE_RATING,
        MOVIE_RD)
    VALUES (:id, :name, :rate, :pr, :gen, :rat, :rd)";

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':rate', $rate);
    $statement->bindValue(':pr', $pr);
    $statement->bindValue(':gen', $gen);
    $statement->bindValue(':rat', $rat);
    $statement->bindValue(':rd', $rd);
    $statement->execute();
    $statement->closeCursor();
}

function addListForm(){
    echo"<p> Add activity </p>";
    echo "<html>
        <body>
        <form action = 'activities.php?btnaction=hike' method='post'>
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
