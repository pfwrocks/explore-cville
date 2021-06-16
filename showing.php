
  <?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Showings</h1>
      </div>
  </header>

  <div class="container">
    <center>
    <div class="row">
      <div class="col-1" style="line-height:75px">
      </div>
      <div class="col-10">
        <br />
        <form action="add-showing.php" method="post" style="line-height:50px">
        <input type="submit" name="btnaction" value="Add Showing" class="btn btn-success"></form>
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
    else { showShowing(); }
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
  function showShowing()
  {
    // echo "select data init";
    global $db;

    $query = "SELECT * FROM (((SHOWING 
      INNER JOIN MOVIE ON SHOWING.ACTIVITY_ID=MOVIE.ACTIVITY_ID)
      INNER JOIN ACTIVITY ON ACTIVITY.ACTIVITY_ID=MOVIE.ACTIVITY_ID)
      INNER JOIN THEATER ON SHOWING.THEATER_ID=THEATER.THEATER_ID)";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row

    $statement->closeCursor();
    
    echo "<table style='width:100%''>
          <tr>
            <th>Movie</th>
            <th>Theater</th>
            <th>Show Time</th>
          </tr>";
    
    foreach ($results as $result)
    {
      $btndel = "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' style='line-height:50px'>
        <input type='text' name='movie' value='" . $result['ACTIVITY_ID'] . "' hidden />
        <input type='text' name='theater' value='" . $result['THEATER_ID'] . "' hidden />
        <input type='submit' name='btnaction' value='delete' class='btn btn-danger' />
      </form>";
      
      $btnedit = "<form action='edit-showing.php' method='post' style='line-height:50px'>
        <input type='text' name='movie' value='" . $result['ACTIVITY_ID'] . "' hidden />
        <input type='text' name='theater' value='" . $result['THEATER_ID'] . "' hidden />
      <input type='submit' name='btnaction' value='edit' class='btn btn-info' /></form>";
      
      echo "<tr>
      <td>" . $result['ACTIVITY_NAME'] . "</td>
      <td>" . $result['THEATER_NAME'] . "</td>
      <td>" . $result['SHOW_TIME'] . "</td>
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
    
    $id = $_GET['movie'];
    $id2 = $_GET['theater'];

    if ($id < 0) {
      echo "No ID";
      return;
    };

    try {
      $query = "DELETE FROM SHOWING WHERE THEATER_ID = $id2 AND ACTIVITY_ID=$id";
      // echo $query, '<br>';
      $statement = $db->exec($query);

      echo "Record deleted successfully";
    } catch (Exception $e) {
      echo $query . "<br>" . $e->getMessage();
    }
    
    header('refresh:1; url=showing.php');
    
  }
  ?>  
  
        </div>
    </div>
    </center>
  </div>
</body>
