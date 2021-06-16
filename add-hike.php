<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Add Hike</h1>
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
addHikeForm(); 

function addHikeForm()
{
    echo "<html>

    <div class = 'container'>
        <form action = 'activities.php?btnaction=hike' method='post'>

          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Name</span><input type='text' name='activity_name' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
  </div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>URL</span><input type='text' name='activity_url' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
  </div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Difficulty</span><input type='text' name='hike_difficulty' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
  </div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Length</span><input type='text' name='hike_length' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
  </div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Topological Gain</span><input type='text' name='hike_topo' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
  </div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Street Address</span><input type='text' name='hike_st' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
  </div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>City</span><input type='text' name='hike_city' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
  </div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>State</span><input type='text' name='hike_state' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
  </div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Zip</span><input type='text' name='hike_zip' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
        </div>
        <div class='d-grid gap-2'>
            <button class='btn btn-primary' type='submit'>Create</button>
          </div>
    </form>
    </html>";

    if(isset($_POST['activity_name']))
    {
        addActivity($_POST['activity_name'], 
            "HIKE",
            $_POST['activity_url']);
        addHike(
            getNewActivitiesID(),
            $_POST['hike_difficulty'], 
            $_POST['hike_length'],
            $_POST['hike_topo'],
            $_POST['hike_st'],
            $_POST['hike_city'],
            $_POST['hike_state'],
            $_POST['hike_zip']);
    }
        
}
function addHike($id, $diff, $len, $top, $street, $city, $state, $zip)
{
    global $db;
    $query = 
    "INSERT INTO HIKE
        (ACTIVITY_ID, 
        HIKE_DIFFICULTY, 
        HIKE_LENGTH, 
        HIKE_TOPO_GAIN,
        HIKE_STREET,
        HIKE_CITY,
        HIKE_STATE,
        HIKE_ZIP) 
    VALUES (:id, :diff, :len, :top, :street, :city, :state, :zip)";

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':diff', $diff);
    $statement->bindValue(':len', $len);
    $statement->bindValue(':top', $top);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':street', $street);
    $statement->bindValue(':state', $state);
    $statement->bindValue(':zip', $zip);
    $statement->execute();
    $statement->closeCursor();
}
?>
