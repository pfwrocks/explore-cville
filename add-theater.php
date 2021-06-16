<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->

          <h1 class="masthead-heading text-uppercase mb-0">Add Theater</h1>
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
include './components/navigation.php';
/* increment error */ 
require("connect-db.php");
addTheaterForm();
function addTheaterForm(){
    echo "
        <div class='container'>
        
        <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Name</span>
            <input name='thea_name' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
        </div>
        <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Cost</span>
            <input name='thea_cost' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
        </div>
        <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Street</span>
            <input name='thea_street' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
        </div>
        <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>City</span>
            <input name='thea_city' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
        </div>
        <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>State</span>
            <input name='thea_state' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
        </div>
        <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Zip</span>
            <input name='thea_zip' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
        </div>
        <div class='d-grid gap-2'>
            <button class='btn btn-primary' type='submit'>Update</button>
        </div>
        
        ";

    if(isset($_POST['thea_name']))
    {
        addTheater(
            $_POST['thea_name'],
            $_POST['thea_cost'],
            $_POST['thea_street'],
            $_POST['thea_city'],
            $_POST['thea_state'],
            $_POST['thea_zip']
        );
    }
}
function addTheater($name, $cost, $street, $city, $state, $zip){
    global $db;
    $query = 
    "INSERT INTO THEATER
        (THEATER_NAME,
        THEATER_TICK_COST,	
        THEATER_STREET,
        THEATER_CITY,
        THEATER_STATE,	
        THEATER_ZIP)
    VALUES (:name, :cost, :street, :city, :state, :zip)";

    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':cost', $cost);
    $statement->bindValue(':street', $street);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':state', $state);
    $statement->bindValue(':zip', $zip);
    $statement->execute();
    $statement->closeCursor();
    
    header('refresh:1; url=theaters.php');
}
?>

</form>
<br /> 
    </div>
</div>
