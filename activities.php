<!DOCTYPE html>
<html lang="en">
<head>
  <title>Explore CVille</title>
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

<body id="page-top">

  <!-- Navigation TODO: Menu button doesn't work--> 
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
      <div class="container">
          <a class="navbar-brand" href="./index.php">Explore C'Ville</a>
          <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              Menu
              <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ms-auto">
                  <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#">Add</a></li>
                  <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="./activities.php">Activities</a></li>
              </ul>
          </div>
      </div>
  </nav>

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
            <th>HOURS</th>
            <th>TYPE</th>
          </tr>";
    
    foreach ($results as $result)
    {
      echo "<tr>
      <td> <a href='" . $result['ACTIVITY_URL'] . "' target='_blank'>" . $result['ACTIVITY_NAME'] . "</a></td>
      <td>" . $result['ACTIVITY_OPENTIME'] . "-" . $result['ACTIVITY_CLOSETIME'] . "</td>
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

    $query = "SELECT ACTIVITY.ACTIVITY_URL, ACTIVITY.ACTIVITY_NAME, HIKE.HIKE_DIFFICULTY, 
    HIKE.HIKE_LENGTH, HIKE.HIKE_TOPO_GAIN 
    FROM ACTIVITY INNER JOIN HIKE WHERE ACTIVITY.ACTIVITY_ID=HIKE.ACTIVITY_ID";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row

    $statement->closeCursor();
    
    echo "<h2> HIKE </h2>";
    echo "<table style='width:100%''>
          <tr>
            <th>NAME</th>
            <th>DIFF</th>
            <th>LENGTH</th>
            <th>TOPO GAIN</th>
          </tr>";
    
    foreach ($results as $result)
    {
      echo "<tr>
      <td> <a href='" . $result['ACTIVITY_URL'] . "' target='_blank'>" . $result['ACTIVITY_NAME'] . "</a></td>
      <td>" . $result['HIKE_DIFFICULTY'] . "</td>
      <td>" . $result['HIKE_LENGTH'] . "</td>
      <td>" . $result['HIKE_TOPO_GAIN'] . "</td>
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

    $query = "SELECT ACTIVITY.ACTIVITY_URL, ACTIVITY.ACTIVITY_NAME, RESTAURANT.RESTAURANT_RATING, RESTAURANT.RESTAURANT_PRICE_RANGE, RESTAURANT.RESTAURANT_CUISINE 
    FROM ACTIVITY INNER JOIN RESTAURANT WHERE ACTIVITY.ACTIVITY_ID=RESTAURANT.ACTIVITY_ID";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row

    $statement->closeCursor();
    
    echo "<h2> RESTAURANT </h2>";
    echo "<table style='width:100%''>
          <tr>
            <th>NAME</th>
            <th>CUISINE</th>
            <th>PRICE RANGE</th>
            <th>STARS</th>
          </tr>";
    
    foreach ($results as $result)
    {
      echo "<tr>
      <td> <a href='" . $result['ACTIVITY_URL'] . "' target='_blank'>" . $result['ACTIVITY_NAME'] . "</a></td>
      <td>" . $result['RESTAURANT_CUISINE'] . "</td>
      <td>" . $result['RESTAURANT_PRICE_RANGE'] . "</td>
      <td>" . $result['RESTAURANT_RATING'] . "</td>
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

    $query = "SELECT ACTIVITY.ACTIVITY_URL, ACTIVITY.ACTIVITY_NAME, MOVIE.MOVIE_GENRE, 
    MOVIE.MOVIE_RATING, MOVIE.MOVIE_PARENT_RATING 
    FROM ACTIVITY INNER JOIN MOVIE WHERE ACTIVITY.ACTIVITY_ID=MOVIE.ACTIVITY_ID";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row

    $statement->closeCursor();
    
    echo "<h2> MOVIE </h2>";
    echo "<table style='width:100%''>
          <tr>
            <th>NAME</th>
            <th>RATING</th>
            <th>GENRE</th>
            <th>STARS</th>
          </tr>";
    
    foreach ($results as $result)
    {
      echo "<tr>
      <td> <a href='" . $result['ACTIVITY_URL'] . "' target='_blank'>" . $result['ACTIVITY_NAME'] . "</a></td>
      <td>" . $result['MOVIE_PARENT_RATING'] . "</td>
      <td>" . $result['MOVIE_GENRE'] . "</td>
      <td>" . $result['MOVIE_RATING'] . "</td>
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

    $query = "SELECT CUSTOMER.CUST_FNAME, CUSTOMER.CUST_LNAME, LIST.LIST_NAME 
    FROM CUSTOMER INNER JOIN LIST WHERE CUSTOMER.CUST_ID=LIST.CUST_ID";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row

    $statement->closeCursor();
    
    echo "<h2> Lists </h2>";
    echo "<table style='width:100%''>
          <tr>
            <th>NAME</th>
            <th>LIST NAME</th>
          </tr>";
    
    foreach ($results as $result)
    {
      echo "<tr>
      <td>" . $result['CUST_LNAME'] . ", " . $result['CUST_FNAME'] .
      "<td>" . $result['LIST_NAME'] . "</td>
      </tr>";
    }
    
    echo "</table>";
  }
  ?>
  
  
  
        </div>
    </div>
    </center>
  </div>
</body>