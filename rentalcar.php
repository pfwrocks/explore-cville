<?php include './components/navigation.php';?>
  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Rental Cars</h1>
      </div>
  </header>
</body>

<div class="container">
    <center>
      <div class="col-9">
        <br /> 

        <form action='add-rentalcar.php' method='post' style='line-height:50px'>
    <input type='submit' name='btnaction' value='Add Rental Car' class='btn btn-success' /></form>

<?php 
require("connect-db.php");
try
{
  if (isset($_POST['btnaction']) == "delete")
  {
    delete_rc($_POST['id']); 

    header('refresh:1; url=rentalcar.php');
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


 foreach ($results as $result)
 {
    $rc_id =  $result['RC_ID'];

    $btnedit = "<form action='edit-rentalcar.php' method='post' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['RC_ID'] . "' hidden />
        <input type='submit' name='btnaction' value='edit' class='btn btn-info' /></form>";
    $btndel = "<form action='" . $_SERVER['PHP_SELF'] . "' method='post' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['RC_ID'] . "' hidden />
        <input type='submit' name='btnaction' value='delete' class='btn btn-danger' />";

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
    </div>
    </center>
  </div>
</body>



