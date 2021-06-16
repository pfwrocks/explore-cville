<?php
include './components/navigation-with-linebreaks.php';
require("connect-db.php");
require('add-activity.php');
addMovieForm();
# Add a new movie 
function addMovieForm(){
    echo"<p> Add activity </p>";
    echo "<html>
        <body>
        <form action = 'activities.php?btnaction=movie' method='post'>
        Name: <input type='text' name='activity_name'><br>
        URL: <input type='text' name='activity_url'><br>
        <br>
        Parental Rating: <input type='text' name='mov_parent'><br>
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
            "MOVIE",
            $_POST['activity_url']);
        addRestaurant(
            getNewActivitiesID(),
            $_POST['mov_parent'], 
            $_POST['mov_price'],
            $_POST['mov_genre'],
            $_POST['mov_rating'],
            $_POST['mov_release_date']);
    }
}
function addMovie($id, $parental, $pr, $gen, $rate, $rd){
    global $db;
    $query = 
    "INSERT INTO RESTAURANT
        (ACTIVITY_ID,
        MOVIE_PR,	
        MOVIE_GENRE,	
        MOVIE_RATING,
        MOVIE_RD)
    VALUES (:id, :parental, :pr, :gen, :rate, :rd)";

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':parental', $parental);
    $statement->bindValue(':pr', $pr);
    $statement->bindValue(':gen', $gen);
    $statement->bindValue(':rat', $rat);
    $statement->bindValue(':rd', $rd);
    $statement->execute();
    $statement->closeCursor();
}
?>