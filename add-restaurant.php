<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Add Restaurant</h1>
      </div>
  </header>

  <div class="container">
    <center>
      <div class="col-9">
        <br>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" style="line-height:0px">

<?php
require('add-activity.php');
require("connect-db.php");
addRestaurantForm(); 
// Form for inserting new restaurants. 
function addRestaurantForm(){
    /* activities.php?btnaction=restaurant*/
    echo "<html>
    <div class = 'container'>
        <form action = '' method='post'>
          <div class='input-group mb-3'>
          <span class='input-group-text' id='basic-addon3' style='width:15%'>Name</span>
          <input type='text' name='activity_name' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
          </div>

          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>URL</span><input type='text' name='activity_url' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
        <br>
</div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Rating</span><input type='text' name='res_rating' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
</div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Price</span><input type='text' name='res_price' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
</div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Cuisine</span><input type='text' name='res_cuisine' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
</div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Street Address</span><input type='text' name='res_street' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
</div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>City</span><input type='text' name='res_city' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
</div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>State</span><input type='text' name='res_state' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
        </div></div>
          <div class='input-group mb-3'>
        <span class='input-group-text' id='basic-addon3' style='width:15%'>Zip</span><input type='text' name='res_zip' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''><br>
        </div>
          <div class='d-grid gap-2'>
            <button class='btn btn-primary' type='submit'>Create</button>
          </div>
        </div>
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