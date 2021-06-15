<?php
require('add-activity.php');
addMovieForm();
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
?>