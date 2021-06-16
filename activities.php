
  <?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Activities</h1>
      </div>
  </header>

  <div class="container">
    <center>
    <div class="row">
      <div class="col-1" style="line-height:75px">
        <br />
        <h4> Views </h4>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get" style="line-height:50px">
          <div class="btn-group-vertical">
          <input type="submit" name="btnaction" value="all" class="btn text-white bg-<?php if(!isset($_GET['btnaction'])||$_GET['btnaction']=='all'){echo "secondary";}else{echo "primary";} ?>" />
          <input type="submit" name="btnaction" value="hike" class="btn text-white bg-<?php if(isset($_GET['btnaction'])&&$_GET['btnaction']=='hike'){echo "secondary";}else{echo "primary";} ?>" />
          <input type="submit" name="btnaction" value="restaurant" class="btn text-white bg-<?php if(isset($_GET['btnaction'])&&$_GET['btnaction']=='restaurant'){echo "secondary";}else{echo "primary";} ?>" />
          <input type="submit" name="btnaction" value="movie" class="btn text-white bg-<?php if(isset($_GET['btnaction'])&&$_GET['btnaction']=='movie'){echo "secondary";}else{echo "primary";} ?>" />
          <input type="submit" name="btnaction" value="list" class="btn text-white bg-<?php if(isset($_GET['btnaction'])&&$_GET['btnaction']=='list'){echo "secondary";}else{echo "primary";} ?>" />
          </div>
        </form>
        <br />
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
          case 'all': showActivity("ACTIVITY");  break;
          case 'hike': showHike();  break;
          case 'restaurant': showRestaurant();  break;
          case 'movie': showMovie();  break;
          case 'list': getList();  break;
          case 'delete_hike': deleteActivity("HIKE", $_GET['id']); break;
          case 'delete_restaurant': deleteActivity("RESTAURANT", $_GET['id']); break;
          case 'delete_movie': deleteActivity("MOVIE", $_GET['id']); break;
          case 'delete_list': deleteList($_GET['id']); break;
        }
    }
    else { showActivity("ACTIVITY"); }
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
  function showActivity($act)
  {
    // echo "select data init";
    global $db;

    $query = "SELECT * FROM $act";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row

    $statement->closeCursor();
    
    echo "<h2> $act </h2>";
    echo "<table style='width:100%''>
          <tr>
            <th>NAME</th>
            <th>TYPE</th>
          </tr>";
    
    foreach ($results as $result)
    {
      echo "<tr>
      <td> <a href='" . $result['ACTIVITY_URL'] . "' target='_blank'>" . $result['ACTIVITY_NAME'] . "</a></td>
      <td>" . $result['ACTIVITY_TYPE'] . "</td>
      </tr>";
    }
    
    echo "</table>";
  }
  ?>
  
  <?php
  function showHike()
  {
    // echo "select data init";
    global $db;

    $query = "SELECT ACTIVITY.ACTIVITY_ID, ACTIVITY.ACTIVITY_URL, ACTIVITY.ACTIVITY_NAME, HIKE.HIKE_DIFFICULTY, 
    HIKE.HIKE_LENGTH, HIKE.HIKE_TOPO_GAIN 
    FROM ACTIVITY INNER JOIN HIKE WHERE ACTIVITY.ACTIVITY_ID=HIKE.ACTIVITY_ID";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row

    $statement->closeCursor();
    
    echo "<h2> HIKE </h2>";
    echo "<form action='add-hike.php' method='post' style='line-height:50px'>
    <input type='submit' name='btnaction' value='Add Hike' class='btn btn-success' /></form>";
    echo 
    "<table style='width:100%''>
          <tr>
            <th>NAME</th>
            <th>DIFF</th>
            <th>LENGTH</th>
            <th>TOPO GAIN</th>
          </tr>
    ";
    foreach ($results as $result)
    {
      $btndel = "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['ACTIVITY_ID'] . "' hidden />
        <input type='submit' name='btnaction' value='delete_hike' class='btn btn-danger' />
      </form>";
      
      $btnedit = "<form action='edit-hike.php' method='post' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['ACTIVITY_ID'] . "' hidden />
      <input type='submit' name='btnaction' value='edit' class='btn btn-info' /></form>";

      echo "<tr>
      <td> <a href='" . $result['ACTIVITY_URL'] . "' target='_blank'>" . $result['ACTIVITY_NAME'] . "</a></td>
      <td>" . $result['HIKE_DIFFICULTY'] . "</td>
      <td>" . $result['HIKE_LENGTH'] . "</td>
      <td>" . $result['HIKE_TOPO_GAIN'] . "</td>
      <td>" . $btndel . "</td>
      <td>" . $btnedit . "</td>
      </tr>";

    }
    
    echo "</table>";
  }
  ?>
  
  <?php
  function showRestaurant()
  {
    // echo "select data init";
    global $db;

    $query = "SELECT ACTIVITY.ACTIVITY_ID, ACTIVITY.ACTIVITY_URL, ACTIVITY.ACTIVITY_NAME, RESTAURANT.RESTAURANT_RATING, RESTAURANT.RESTAURANT_PRICE_RANGE, RESTAURANT.RESTAURANT_CUISINE 
    FROM ACTIVITY INNER JOIN RESTAURANT WHERE ACTIVITY.ACTIVITY_ID=RESTAURANT.ACTIVITY_ID";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row

    $statement->closeCursor();
    
    echo "<h2> RESTAURANT </h2>";
    echo "<form action='add-restaurant.php' method='post' style='line-height:50px'>
    <input type='submit' name='btnaction' value='Add Restaurant' class='btn btn-success' /></form>";
    echo "
    <table style='width:100%''>
          <tr>
            <th>NAME</th>
            <th>CUISINE</th>
            <th>PRICE RANGE</th>
            <th>STARS</th>
          </tr>
          ";
    
    foreach ($results as $result)
    {
      $btndel = "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['ACTIVITY_ID'] . "' hidden />
        <input type='submit' name='btnaction' value='delete_restaurant' class='btn btn-danger' />
      </form>";
      $btnedit = "<form action='edit-restaurant.php' method='post' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['ACTIVITY_ID'] . "' hidden />
        <input type='submit' name='btnaction' value='edit' class='btn btn-info' /></form>";
      echo "<tr>
      <td> <a href='" . $result['ACTIVITY_URL'] . "' target='_blank'>" . $result['ACTIVITY_NAME'] . "</a></td>
      <td>" . $result['RESTAURANT_CUISINE'] . "</td>
      <td>" . $result['RESTAURANT_PRICE_RANGE'] . "</td>
      <td>" . $result['RESTAURANT_RATING'] . "</td>
      <td>" . $btndel . "</td>
      <td>" . $btnedit . "</td>
      </tr>";
    }
    
    echo "</table>";
  }
  ?>
  
  <?php
  function showMovie()
  {
    // echo "select data init";
    global $db;

    $query = "SELECT ACTIVITY.ACTIVITY_URL, ACTIVITY.ACTIVITY_ID, ACTIVITY.ACTIVITY_NAME, MOVIE.MOVIE_GENRE, 
    MOVIE.MOVIE_RATING, MOVIE.MOVIE_PARENT_RATING 

    FROM ACTIVITY INNER JOIN MOVIE WHERE ACTIVITY.ACTIVITY_ID=MOVIE.ACTIVITY_ID";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row

    $statement->closeCursor();
    
    
    echo "<h2> MOVIE </h2>";
    echo "<form action='add-movie.php' method='post' style='line-height:50px'>
    <input type='submit' name='btnaction' value='Add Movie' class='btn btn-success' /></form>";
    echo "<table style='width:100%''>
          <tr>
            <th>NAME</th>
            <th>RATING</th>
            <th>GENRE</th>
            <th>STARS</th>
          </tr>";
    
    foreach ($results as $result)
    {
      $btnedit = "<form action='edit-movie.php' method='post' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['ACTIVITY_ID'] . "' hidden />
        <input type='submit' name='btnaction' value='edit' class='btn btn-info' /></form>";
      
      $btndel = "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['ACTIVITY_ID'] . "' hidden />
        <input type='submit' name='btnaction' value='delete_movie' class='btn btn-danger' />
      </form>";

      echo "<tr>
      <td> <a href='" . $result['ACTIVITY_URL'] . "' target='_blank'>" . $result['ACTIVITY_NAME'] . "</a></td>
      <td>" . $result['MOVIE_PARENT_RATING'] . "</td>
      <td>" . $result['MOVIE_GENRE'] . "</td>
      <td>" . $result['MOVIE_RATING'] . "</td>
      <td>" . $btndel . "</td>
      <td>" . $btnedit . "</td>
      
      </tr>";
    }
    
    echo "</table>";
  }
  ?>
  
  <?php
  /*************************/
  /** get data **/
  function getList()
  {
    // echo "select data init";
    global $db;

    $query = "SELECT CUSTOMER.CUST_FNAME, CUSTOMER.CUST_LNAME, LIST.LIST_NAME, LIST.LIST_ID 
    FROM CUSTOMER INNER JOIN LIST WHERE CUSTOMER.CUST_ID=LIST.CUST_ID";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row

    $statement->closeCursor();
    
    echo "<h2> LIST </h2>";
    echo "<form action='add-list.php' method='post' style='line-height:50px'>
    <input type='submit' name='btnaction' value='Add List' class='btn btn-success' /></form>";
    echo "<table style='width:100%''>
          <tr>
            <th>NAME</th>
            <th>LIST NAME</th>
          </tr>";
    
    foreach ($results as $result)
    {
      $btnedit = "<form action='edit-list.php' method='post' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['LIST_ID'] . "' hidden />
        <input type='submit' name='btnaction' value='edit' class='btn btn-info' /></form>";
      
      $btndel = "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' style='line-height:50px'>
        <input type='text' name='id' value='" . $result['LIST_ID'] . "' hidden />
        <input type='submit' name='btnaction' value='delete_list' class='btn btn-danger' />
      </form>";

      echo "<tr>
      <td>" . $result['CUST_LNAME'] . ", " . $result['CUST_FNAME'] .
      "<td>" . $result['LIST_NAME'] . "</td>
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
  function deleteActivity($table_name, $id)
  {
    global $db;

    if ($id < 0) {
      echo "No ID";
      return;
    };

    try {
      $query = "DELETE FROM $table_name WHERE $table_name.ACTIVITY_ID = $id";
      echo $query, '<br>';
      $statement = $db->exec($query);

      if ($table_name == "HIKE" || $table_name == "MOVIE" || $table_name == "RESTAURANT") {
        $query = "DELETE FROM ACTIVITY WHERE ACTIVITY.ACTIVITY_ID = $id";
        echo $query, '<br>';
        $statement = $db->exec($query);
      }

      echo "Record deleted successfully";
    } catch (Exception $e) {
      echo $query . "<br>" . $e->getMessage();
    }
    
  }

  function deleteList($id)
  {
    global $db;

    if ($id < 0) {
      echo "No ID";
      return;
    };

    try {
      $query = "DELETE FROM LIST WHERE LIST_ID = $id";
      echo $query, '<br>';
      $statement = $db->exec($query);

      echo "Record deleted successfully";
    } catch (Exception $e) {
      echo $query . "<br>" . $e->getMessage();
    }
    
  }
  ?>  
  
        </div>
    </div>
    </center>
  </div>
</body>
