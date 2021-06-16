<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Add Movie</h1>
      </div>
  </header>

  <div class="container">
    <center>
      <div class="col-9">
        <br>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" style="line-height:0px">

<?php
require("connect-db.php");
require('add-activity.php');
addMovieForm();
# Add a new movie 
function addMovieForm(){
    echo "<html>
    <div class = 'container'>
        <form action = 'activities.php?btnaction=movie' method='post'>

          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Name</span><input type='text' name='activity_name' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
</div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>URL</span><input type='text' name='activity_url' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
        </div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Parental Rating</span><input type='text' name='mov_parent' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>

</div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Genre</span><input type='text' name='mov_genre' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
</div>

          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Rating</span><input type='text' name='mov_rating' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
</div>

          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Director</span><input type='text' name='mov_director' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
</div>

          <div class='input-group mb-3'>
       <span class='input-group-text' id='basic-addon3' style='width:15%'>Release Date</span><input type='text' name='mov_release_date' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>

       </div>
        <div class='d-grid gap-2'>
            <button class='btn btn-primary' type='submit'>Create</button>
          </div>
    </div>
    </form>
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