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

</body>


<?php 
require("connect-db.php");
try
{
  if (isset($_POST['btndelete']))
  {
    delete_rc($_POST['id']); 
  }
   showRentalCar();
}
catch (Exception $e)
{
  $error_message = $e->getMessage();
  echo "<p>Error message: $error_message </p>";
}

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
         <th>ID</th>
         <th>MAKE</th>
         <th>MODEL</th>
         <th>COLOR</th>
         <th>SEATS</th>
         <th>STATUS</th>
       </tr>";
 
       $btnedit = "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' style='line-height:50px'>
       <input type='submit' name='btnaction' value='edit' class='btn btn-info' /></form>";


 foreach ($results as $result)
 {
      
    $btnedit = "<form action='edit-rentalcar.php' method='post' style='line-height:50px'>
    <input type='text' name='id' value='" . $result['RC_ID'] . "' hidden />
  <input type='submit' name='btnaction' value='edit' class='btn btn-info' /></form>";


    $rc_id =  $result['RC_ID'];
    $btndel = "<form action='" . $_SERVER['PHP_SELF'] . "' method='post' style='line-height:50px'>
    <input type='text' name='id' value='" . $result['RC_ID'] . "' hidden />
    <input type='submit' name='btndelete' value='delete' class='btn btn-danger' />";

   echo "<tr>
   <td>" . $result['RC_ID'] . "</td>
   <td>" . $result['RC_MAKE'] . "</td>
   <td>" . $result['RC_MODEL'] . "</td>
   <td>" . $result['RC_COLOR'] . "</td>
   <td>" . $result['RC_SEATS'] . "</td>
   <td>" .isRCAvailable($result['RC_ID']) . "</td>
   <td>" . $btndel . "</td>
   <td>" . $btnedit . "</td>
   </tr>";
 }
 
 echo "</table>";
}

    /*TODO:*/ 
function isRCAvailable($rc_id){
    global $db;

    $query = "SELECT * FROM CUSTOMER";
   
    $statement = $db->prepare($query);
    $statement->execute();
   
    $results = $statement->fetchAll();
   
    $statement->closeCursor();

    foreach ($results as $result)
    {
        if ($result['RC_ID']  === $rc_id){
            return $result['CUST_ID'];
        }
    }
    return "Available";

}
function delete_rc($rc_id)
{
    global $db; 
    $query = 
        "DELETE FROM `RENTALCAR` 
        WHERE `RENTALCAR`.`RC_ID` = :id";

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $rc_id);
    $statement->execute();
    $statement->closeCursor();
}
?> 



