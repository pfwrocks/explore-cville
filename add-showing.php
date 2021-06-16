<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->

          <h1 class="masthead-heading text-uppercase mb-0">Add Showing</h1>
      </div>
  </header>

  <div class="container">
    <center>
    <div class="row">
      <div class="col-1" style="line-height:75px"> </div>
      <div class="col-1" style="line-height:75px"> </div>
      <div class="col-9">
        <br>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" style="line-height:50px">

<?php
/*
example input
INSERT INTO SHOWTIME (ACTIVITY_ID, THEATER_ID, SHOW_TIME) VALUES (:activity_id, :theater_id :showtime)8 3 2021-06-02 20:15:47
*/
include './components/navigation.php';
require("connect-db.php");
addShowingForm();
// showings.php
function addShowingForm(){
    global $db;
    $query = "SELECT * FROM THEATER";
        $statement = $db->prepare($query);
        $statement->execute();
        $r1 = $statement->fetchAll();
        $statement->closeCursor();
    $query = "SELECT * FROM MOVIE INNER JOIN ACTIVITY ON ACTIVITY.ACTIVITY_ID=MOVIE.ACTIVITY_ID";
        $statement = $db->prepare($query);
        $statement->execute();
        $r2 = $statement->fetchAll();
        $statement->closeCursor();
    
    echo"        
        <div class='container'>
        
        <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Movie</span>
            <select name='activity_id' class='form-select form-select-lg mb-3' aria-label='.form-select-lg example'>";
            foreach ($r2 as $rs2)
                    echo "<option value='" . $rs2['ACTIVITY_ID'] . "'>".$rs2['ACTIVITY_NAME']."</option>";
    echo "
        </select></div>
        
        <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Theater</span>
        <select name='theater_id' class='form-select form-select-lg mb-3' aria-label='.form-select-lg example'>";
            foreach ($r1 as $rs1)
                    echo "<option value='" . $rs1['THEATER_ID'] . "'>".$rs1['THEATER_NAME']."</option>";
    echo "</select></div>

        <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Show Time</span>
            <input name='showtime' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' 
                value=''>
        </div>
        
        </div>
        <div class='d-grid gap-2'>
            <button class='btn btn-primary' type='submit'>Update</button>
        </div>
    ";
            
    if(isset($_POST['activity_id']))
    {
        addShowing(
            $_POST['activity_id'],
            $_POST['theater_id'],
            $_POST['showtime']
        );
    }
}
function addShowing($activity_id, $theater_id, $showtime){
    global $db;
    $query = 
    "INSERT INTO SHOWING
        (ACTIVITY_ID,
        THEATER_ID,		
        SHOW_TIME)
    VALUES (". $activity_id .", ". $theater_id .", '". $showtime ."')";
    
    echo $query;
    $statement = $db->prepare($query);
    // $statement->bindValue(':activity_id', $activity_id);
    // $statement->bindValue(':theater_id', $theater_id);
    // $statement->bindValue(':showtime', $showtime);
    $statement->execute();
    $statement->closeCursor();
}

?>

</form>
<br /> 
    </div>
</div>
