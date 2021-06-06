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
        <hr />
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
        <input type="submit" name="btnaction" value="create" class="btn btn-light" />
        <input type="submit" name="btnaction" value="insert" class="btn btn-light" />
        <input type="submit" name="btnaction" value="select" class="btn btn-light" />
        <input type="submit" name="btnaction" value="update" class="btn btn-light" />
        <input type="submit" name="btnaction" value="delete" class="btn btn-light" />
        <input type="submit" name="btnaction" value="drop" class="btn btn-light" />
        <hr />
        </form>
      </div>
      <div class="col-8">
        2 of 3 (wider)
      </div>
      <div class="col-3">
        3 of 3
      </div>
    </div>
    </center>
  </div>

  <?php require('connect-db.php'); ?>

  <?php
  if (isset($_GET['btnaction']))
  {
    try
    {
        switch ($_GET['btnaction'])
        {
          case 'create': createTable(); break;
          case 'insert': insertData();  break;
          case 'select': selectData();  break;
          case 'update': updateData();  break;
          case 'delete': deleteData();  break;
          case 'drop':   dropTable();   break;
        }
    }
    catch (Exception $e)       // handle any type of exception
    {
        $error_message = $e->getMessage();
        echo "<p>Error message: $error_message </p>";
    }
  }
  ?>

  <?php
  /*************************/
  /** create table **/
  function createTable()
  {
  global $db;
  $query = "CREATE TABLE courses (
    course_ID VARCHAR(8) PRIMARY KEY,
    course_desc VARCHAR(255) NOT NULL
  )";

  $statement = $db->prepare($query);
  $statement->execute();

  $statement->closeCursor();
  }
  ?>

  <?php
  /*************************/
  /** drop table **/
  function dropTable()
  {
    global $db;
    $query = "DROP TABLE courses";

    $statement = $db->prepare($query);
    $statement->execute();

    $statement->closeCursor();
  }
  ?>

  <?php
  /*************************/
  /** insert data **/
  function insertData()
  {
    global $db;

    $course_id_form = 'cs1111';
    $course_desc_form = 'Intro';

    // $query = "INSERT INTO courses (course_ID, course_desc) VALUES ('cs4640', 'WEBPL')";
    $query = "INSERT INTO courses (course_ID, course_desc) VALUES (:course_id, :course_desc)";

    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id_form);
    $statement->bindValue(':course_desc', $course_desc_form);
    $statement->execute();

    $statement->closeCursor();
  }
  ?>

  <?php
  /*************************/
  /** get data **/
  function selectData()
  {
    // echo "select data init";
    global $db;

    $query = "SELECT * FROM EMPLOYEE";

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row
    echo 

    $statement->closeCursor();

    foreach ($results as $result) { 
      echo $result['EMPLOYEE_ID'] . ":" . $result['EMPLOYEE_LNAME'] . "<br/>"; 
    }
  }
  ?>

  <?php
  /*************************/
  /** update data **/
  function updateData()
  {
    global $db;

    // $query = "INSERT INTO courses (course_ID, course_desc) VALUES ('cs4640', 'WEBPL')";
    $query = "UPDATE courses SET course_ID = 'cs2150', course_desc = 'prog & data repr' WHERE course_ID = 'cs1111'";

    $statement = $db->prepare($query);
    $statement->execute();

    $statement->closeCursor();

  }
  ?>

  <?php
  /*************************/
  /** delete data **/
  function deleteData()
  {
    global $db;

    $query = "DELETE FROM courses WHERE course_ID = 'cs2150'";

    $statement = $db->prepare($query);
    $statement->execute();

    $statement->closeCursor();
  }
  ?>
</body>