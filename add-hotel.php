<!-- TODO:
- link to main page header.
- format add, edit. -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hotels</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Preston Wright">
  <meta name="description" content="activites database for Charlottesville community">
  <meta name="keywords" content="activities charlottesville">

  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Font Awesome -->
  <!-- <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script> -->

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/styles.css">

</head>



<body>
  <!-- TODO: fix navbar-->
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
      <div class="container">
          <a class="navbar-brand" href="./index.php">Explore C'Ville</a>
          <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              Menu
              <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ms-auto">
                  <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="./activities.php">Activities</a></li>
              </ul>
          </div>
      </div>
  </nav>
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