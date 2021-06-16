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
        Genre: <input type='text' name='mov_genre'><br>
        Rating: <input type='text' name='mov_rating'><br>
        Director: <input type='text' name='mov_director'><br>
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
        addMovie(
            getNewActivitiesID(),
            $_POST['mov_parent'], 
            $_POST['mov_genre'],
            $_POST['mov_rating'],
            $_POST['mov_director'],
            $_POST['mov_release_date']);
    }
}
function addMovie($id, $parental, $gen, $rate, $director, $rd){
    global $db;
    $query = 
    "INSERT INTO MOVIE
        (ACTIVITY_ID,
        MOVIE_PARENT_RATING,	
        MOVIE_GENRE,	
        MOVIE_RATING,
        MOVIE_DIRECTOR,
        MOVIE_RELEASE_DATE)
    VALUES (:id, :parental, :gen, :rate, :director :rd)";

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':parental', $parental);
    $statement->bindValue(':gen', $gen);
    $statement->bindValue(':rate', $rate);
    $statement->bindValue(':director', $director);
    $statement->bindValue(':rd', $rd);
    $statement->execute();
    $statement->closeCursor();
}
?>