
  <?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Hotels</h1>
      </div>
  </header>
  <div class = "container">
    <center> 
      <div class = "col-9">
        <br/>

<?php
require('connect-db.php');
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
    else {showHotel(); }
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
 $results = $statement->fetchAll();

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


  $btnedit = "<form action='edit-hotel.php' method='post' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['HOTEL_ID'] . "' hidden />
        <input type='submit' name='btnaction' value='Edit' class='btn btn-info' /></form>";
 // fetch() returns an array of one row
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
    header('refresh:1; url=hotel.php');
  }
  ?> 

      </div>
  </div>
 <div class = "container"> 
  </div>