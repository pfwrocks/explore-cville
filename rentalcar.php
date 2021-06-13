<!-- TODO:
- link to main page header.
- format add, edit. -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rental cars</title>
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
          <h1 class="masthead-heading text-uppercase mb-0">Rental cars</h1>
      </div>
  </header>

<?php
require('connect-db.php');
showRentalCar();
?>
</body>


<?php 
function showRentalCar(){
 global $db;

 $query = "SELECT * FROM RENTALCAR";

 $statement = $db->prepare($query);
 $statement->execute();

 $results = $statement->fetchAll();
 // fetch() returns an array of one row

 $statement->closeCursor();
 
 echo "<table style='width:100%''>
       <tr>
         <th>VIN</th>
         <th>MAKE</th>
         <th>MODEL</th>
         <th>COST/DAY</th>
         <th>COLOR</th>
         <th>SEATS</th>
         <th>TRANSMISSION</th>
         <th>COMPANY</th>
         <th>PICKUP ADDRESS </th>
         <th>STATUS</th>
       </tr>";
 
 foreach ($results as $result)
 {
   echo "<tr>
   <td>" . $result['RC_VIN'] . "</td>
   <td>" . $result['RC_MAKE'] . "</td>
   <td>" . $result['RC_MODEL'] . "</td>
   <td>" . $result['RC_COSTPERDAY'] . "</td>
   <td>" . $result['RC_COLOR'] . "</td>
   <td>" . $result['RC_SEATS'] . "</td>
   <td>" . $result['RC_TRANSMISSION'] . "</td>
   <td>" . $result['RC_RENTAL_COMPANY'] . "</td>
   <td>" . $result['RC_PICKUP_STREET'] . ", " . $result['RC_PICKUP_CITY'] . ", " . $result['RC_PICKUP_STATE'] . ", " . $result['RC_PICKUP_ZIP'] . "</td>   
   <td>" . isRCAvailable($result['RC_AVAILABLE'], $result['RC_VIN']) . "</td>
   </tr>";
 }
 
 echo "</table>";
}

function isRCAvailable($num, $vin){
    if($num)
    {
        return "Available";
    }

    $ret = getCustID($vin);

    if($ret === -1)
    {
        return "ERROR.";
    }
    return "Rented: " . $ret;
}

function getCustID($vin)
{
    global $db;

    $query = "SELECT * FROM RENT";
   
    $statement = $db->prepare($query);
    $statement->execute();
   
    $results = $statement->fetchAll();
   
    $statement->closeCursor();

    foreach ($results as $result)
    {
        if ($result['RC_VIN']  === $vin){
            return $result['CUST_ID'];
        }
    }
    return -1;

}

/* header can go here. */

/* body starts here. */

    /* Table to VIEW car attributes: */

        /* From mySQL. 
            RC_VIN	RC_MAKE	RC_MODEL	RC_COSTPERDAY	RC_AVAILABLE	RC_COLOR	RC_SEATS	RC_RENTAL_COMPANY	RC_TRANSMISSION	RC_PICKUP_STREET	RC_PICKUP_ZIP	
            1	GMC	Yukon	261	0	Black	7	Hertz	Automatic	1900 Rio Hill Center, Charlottesville, USA		
            2	Mitsubishi	Mirage	64	1	Grey	4	Enterprise	Automatic	1650 Seminole Trl, Charlottesville, USA		
            3	Chrysler 	300	124	1	White	5	Enterprise	Automatic	CHO Airport, Charlottesville, Virginia	
        */ 	


    /* ADD a car. Have an option for a customer to rent */

    /* EDIT a car (including customer if any who is renting it */ 
     



?> 



