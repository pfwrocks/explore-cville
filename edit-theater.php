<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Edit Theater</h1>
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
    		THEATER_TICK_COST='" . $_POST['diff'] . "',
    		THEATER_STREET='" . $_POST['length'] . "', THEATER_CITY='" . $_POST['topo'] . "',
    		THEATER_STATE='" . $_POST['street'] . "', THEATER_ZIP='" . $_POST['city'] . "'
    		WHERE ACTIVITY_ID=" . $_POST['id'];
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
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>URL</span>
  			<input name='name' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['THEATER_NAME'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Name</span>
  			<input name='price' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' 
  				value='" . $result['THEATER_TICK_COST'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Difficulty</span>
  			<input name='street' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['THEATER_STREET'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Length</span>
  			<input name='city' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['THEATER_CITY'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Topo Gain</span>
  			<input name='state' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['THEATER_STATE'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Street</span>
  			<input name='zip' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['THEATER_ZIP'] . "'>
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