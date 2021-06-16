
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
          case 'delete': deleteTheater();  break;
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
    
    echo "
    <form action='add-theater.php' method='post' style='line-height:50px'>
      <input type='submit' name='btnaction' value='Add Theater' class='btn btn-success' /></form>";
    echo "<table style='width:100%''>
          <tr>
            <th>NAME</th>
            <th>TICKET COST</th>
            <th>CITY</th>
          </tr>
          ";
    
    foreach ($results as $result)
    {
      $btndel = "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['THEATER_ID'] . "' hidden />
        <input type='submit' name='btnaction' value='delete' class='btn btn-danger' />
      </form>";
      
      $btnedit = "<form action='edit-theaters.php' method='post' style='line-height:50px'>
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
      $statement = $db->exec($query);

      echo "Record deleted successfully";
    } catch (Exception $e) {
      echo $query . "<br>" . $e->getMessage();
    }
    
    header('refresh:1; url=theaters.php');
    
  }
  ?>  
  
    </div>
    </center>
  </div>
</body>
