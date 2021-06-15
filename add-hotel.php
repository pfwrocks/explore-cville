
  <?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Add Hotel</h1>
      </div>
  </header>
  <div class = "container">
    <center> 
      <div class = "col-1">
      </div>
      <div class = "col-9">
        <br/>

</body>

<?php
require('connect-db.php');
addHotelForm()
?>

<?php
require('connect-db.php');
function getNewHotelID(){
    global $db;
    $query = "SELECT * FROM HOTEL";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return sizeof($results);
}


function addHotelForm()
{
    echo "<html>
        <body>
        <form action = 'add-hotel.php?btnaction=hotel' method='post'>
        Name: <input type='text' name='hotel_name'><br>
        Street Address: <input type='text' name='hotel_street'><br>
        <br>
        City: <input type='text' name='hotel_city'><br>
        State: <input type='text' name='hotel_state'><br>
        Zip Code: <input type='text' name='hotel_zip'><br>
        Area Code: <input type='text' name='hotel_areacode'><br>
        Phone Number: <input type='text' name='hotel_phone'><br>
        <input value = 'Add' type='submit'>
    </form>
        </body>
    </html>";

    if(isset($_POST['hotel_name']))
    {
      addHotel(getNewHotelID(),
        $_POST['hotel_name'], 
          $_POST['hotel_street'],
          $_POST['hotel_city'],
          $_POST['hotel_state'],
          $_POST['hotel_zip'],
          $_POST['hotel_areacode'],
          $_POST['hotel_phone']);
    }
        
}

function addHotel($id, $name, $street, $city, $state, $zip, $areacode, $phone)
{
    global $db;
    $query = 
    "INSERT INTO HOTEL
        (HOTEL_ID, 
        HOTEL_NAME, 
        HOTEL_STREET,
        HOTEL_CITY, 
        HOTEL_STATE, 
        HOTEL_ZIP, 
        HOTEL_AREACODE, 
        HOTEL_PHONE) 
    VALUES (:id, :name, :street, :city, :state, :zip, :areacode, :phone)";

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':street', $street);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':state', $state);
    $statement->bindValue(':zip', $zip);
    $statement->bindValue(':areacode', $areacode);
    $statement->bindValue(':phone', $phone);
    $statement->execute();
    $statement->closeCursor();
}
?>

      </div>
  </div>