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
                  <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="./activities.php">Theaters</a></li>
              </ul>
          </div>
      </div>
  </nav>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Edit THEATER</h1>
      </div>
  </header>

  <div class="container">
    <center>
    <div class="row">
      <div class="col-1" style="line-height:75px"> </div>
      <div class="col-1" style="line-height:75px"> </div>
      <div class="col-9">
      	<br>
      	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" style="line-height:50px">
      	

<?php
	require('db-add.php');
	global $db;
	
	
	if (isset($_POST['id']) && isset($_POST['zip']))
	{
		echo "Theater ID: " . $_POST['id'];    	
    	$query = "UPDATE THEATER SET 
    		THEATER_NAME='" . $_POST['name'] . "', THEATER_TICK_COST='" . $_POST['price'] . "',
    		THEATER_STREET='" . $_POST['street'] . "', THEATER_CITY='" . $_POST['city'] . "',
    		THEATER_STATE='" . $_POST['state'] . "', THEATER_ZIP='" . $_POST['zip'] . "'
    		WHERE THEATER_ID=" . $_POST['id'];
    	$statement = $db->prepare($query);
    	$statement->execute();
	} 
	if (!isset($_POST['id'])) { header('Location: ./activities.php'); } 
	
	// pull data with a query
	// display as input fields
	// run query on submission and redirect
	
	// echo "select data init";

    $query = "SELECT * FROM THEATER WHERE THEATER_ID=" . $_POST['id'];

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row

    $statement->closeCursor();
    
    
    foreach ($results as $result)
    {
    	echo "
    	<div class='container'>
    	
    	<input type='text' name='id' value='" . $result['THEATER_ID'] . "' hidden />
    	
    	<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Name</span>
  			<input name='name' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['THEATER_NAME'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Tkt Cost</span>
  			<input name='price' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' 
  				value='" . $result['THEATER_TICK_COST'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Address</span>
  			<input name='street' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['THEATER_STREET'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>City</span>
  			<input name='city' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['THEATER_CITY'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>State</span>
  			<input name='state' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['THEATER_STATE'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Zip</span>
  			<input name='zip' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['THEATER_ZIP'] . "'>
    </div>
		<div class='d-grid gap-2'>
  			<button class='btn btn-primary' type='submit'>Update</button>
		</div>
    	";
    }
	
	
	// <input type='text' name='id' value='" . $result['ACTIVITY_ID'] . "' hidden />
	// echo $_POST['id']; 
	// echo "test success!!";
	// print_r($_POST);
	// echo $_POST['id'];
?>
</form>
<br /> 
    </div>
</div>