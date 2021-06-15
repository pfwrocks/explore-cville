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
          <h1 class="masthead-heading text-uppercase mb-0">Hotels</h1>
      </div>
  </header>
  <div class = "container">
    <center> 
      <div class = "col-1">
      </div>
      <div class = "col-9">
        <br/>

<?php
require('connect-db.php');
showHotel();
?>

  <?php
  
  try
  {
    if (isset($_GET['btnaction']))
    {
      switch ($_GET['btnaction'])
        {
          case 'Delete': deleteHotel("HIKE", $_GET['id']); break;
        }
    }
    else {showHotel("ACTIVITY"); }
  }
  catch (Exception $e)
  {
    $error_message = $e->getMessage();
    echo "<p>Error message: $error_message </p>";
  }
  ?>

</body>


<?php 
function showHotel(){
 global $db;

 $query = "SELECT * FROM HOTEL";

 $statement = $db->prepare($query);
 $statement->execute();

  $btnedit = "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' style='line-height:50px'>
    <input type='submit' name='btnaction' value='Edit' class='btn btn-info' /></form>";

 $results = $statement->fetchAll();
 // fetch() returns an array of one row

 $statement->closeCursor();
 
 echo "<table style='width:100%''>
       <tr>
         <th>Hotel ID</th>
         <th>Hotel Name</th>
         <th>Address</th>
         <th>Phone Number</th>
       </tr>";
 
 foreach ($results as $result)
 {
      $btndel = "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['HOTEL_ID'] . "' hidden />
        <input type='submit' name='btnaction' value='Delete' class='btn btn-danger' />
      </form>";
   echo "<tr>
   <td>" . $result['HOTEL_ID'] . "</td>
   <td>" . $result['HOTEL_NAME'] . "</td>
   <td>" . $result['HOTEL_STREET'], ", ", $result['HOTEL_CITY'], " ", $result['HOTEL_STATE'], ", ", $result['HOTEL_ZIP'] . "</td>
   <td>" . $result['HOTEL_AREACODE'], $result['HOTEL_PHONE'] . "</td>
   <td>" . $btndel . "</td>
   <td>" . $btnedit . "</td>
   </tr>";
 }
}
?> 

 <?php
  /*************************/
  /** delete data **/
  function deleteHotel($table_name, $id)
  {
    global $db;

    if ($id < 0) {
      echo "No ID";
      return;
    };

    try {
      $query = "DELETE FROM HOTEL WHERE HOTEL.HOTEL_ID = $id";
      echo $query, '<br>';
      $statement = $db->exec($query);

      $query = "DELETE FROM ACTIVITY WHERE HOTEL.HOTEL_ID = $id";
      $statement = $db->exec($query);

      echo "Record deleted successfully";
    } catch (Exception $e) {
      echo $query . "<br>" . $e->getMessage();
    }
    
  }
  ?> 


      </div>
  </div>
 <div class = "container"> 
    <a href="add-hotel.php" class="btn btn-success" role="button">Add Hotel</a>
  </div>