
  <?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Theaters</h1>
      </div>
  </header>

  <div class="container">
    <center>
    <div class="row">
      <div class="col-1" style="line-height:75px">
      </div>
      <div class="col-1" style="line-height:75px"> </div>
      <div class="col-9">
        <br /> 

  <?php require('connect-db.php'); ?>

  <?php
  
  try
  {
    if (isset($_GET['btnaction']))
    {
      switch ($_GET['btnaction'])
        {
          case 'delete_theater': deleteTheater();  break;
          // case 'hike': showHike();  break;
          // case 'restaurant': showRestaurant();  break;
          // case 'movie': showMovie();  break;
          // case 'list': getList();  break;
          // case 'delete_hike': deleteActivity("HIKE", $_GET['id']); break;
          // case 'delete_restaurant': deleteActivity("RESTAURANT", $_GET['id']); break;
          // case 'delete_movie': deleteActivity("MOVIE", $_GET['id']); break;
        }
    }
    else { showTheater(); }
  }
  catch (Exception $e)
  {
    $error_message = $e->getMessage();
    echo "<p>Error message: $error_message </p>";
  }
  ?>

  <?php
  /*************************/
  /** get data **/
  function showTheater()
  {
    // echo "select data init";
    global $db;

    $query = "SELECT * FROM THEATER";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row

    $statement->closeCursor();
    
    echo "<table style='width:100%''>
          <tr>
            <th>NAME</th>
            <th>TICKET COST</th>
            <th>CITY</th>
          </tr>
          <div style='text-align: center;'>
          <form action='add-theater.php' method='post' style='line-height:50px'>
              <input type='submit' name='btnaction' value='Add' class='btn btn-outline-success btn-block' /></form>
          </div> 
          ";
    
    foreach ($results as $result)
    {
      $btndel = "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['THEATER_ID'] . "' hidden />
        <input type='submit' name='btnaction' value='delete_theater' class='btn btn-danger' />
      </form>";
      
      $btnedit = "<form action='edit-theater.php' method='post' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['THEATER_ID'] . "' hidden />
      <input type='submit' name='btnaction' value='edit' class='btn btn-info' /></form>";
      
      echo "<tr>
      <td>" . $result['THEATER_NAME'] . "</td>
      <td>" . $result['THEATER_TICK_COST'] . "</td>
      <td>" . $result['THEATER_CITY'] . "</td>
      <td>" . $btndel . "</td>
      <td>" . $btnedit . "</td>
      </tr>";
    }
    
    echo "</table>";
  }
  ?>

  <?php
  /*************************/
  /** delete data **/
  function deleteTheater()
  {
    global $db;
    
    $id = $_GET['id'];

    if ($id < 0) {
      echo "No ID";
      return;
    };

    try {
      $query = "DELETE FROM THEATER WHERE THEATER_ID = $id";
      // echo $query, '<br>';
      $statement = $db->exec($query);

      $query = "DELETE FROM ACTIVITY WHERE ACTIVITY.ACTIVITY_ID = $id";
      echo $query, '<br>';
      $statement = $db->exec($query);

      echo "Record deleted successfully";
    } catch (Exception $e) {
      echo $query . "<br>" . $e->getMessage();
    }
    
    header('refresh:3; url=theaters.php');
    
  }
  ?>  
  
        </div>
    </div>
    </center>
  </div>
</body>
