<?php include './components/navigation.php';?>
  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Edit Restaurant</h1>
      </div>
  </header>

  <div class="container">
    <center>
      <div class="col-9">
      	<br>
      	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" style="line-height:50px">
      	

<?php
	require('add-activity.php');
	global $db;
	
	
	if (isset($_POST['id']) && isset($_POST['zip']))
	{
		echo "Restaurant ID: " . $_POST['id'];
		$query = "UPDATE ACTIVITY SET ACTIVITY_URL='" . $_POST['url'] . "' , 
			ACTIVITY_NAME='" . $_POST['name'] . "'
			WHERE ACTIVITY.ACTIVITY_ID=" . $_POST['id'];
    	$statement = $db->prepare($query);
    	$statement->execute();
    	
    	$query = "UPDATE RESTAURANT SET 
    		RESTAURANT_RATING='" . $_POST['rating'] . "',
    		RESTAURANT_PRICE_RANGE='" . $_POST['price'] . "', RESTAURANT_CUISINE='" . $_POST['cuisine'] . "',
    		RESTAURANT_STREET='" . $_POST['street'] . "', 
			RESTAURANT_CITY='" . $_POST['city'] . "', 
			RESTAURANT_STATE='" . $_POST['state'] . "', /*ERRROR*/
			RESTAURANT_ZIP='" . $_POST['zip'] . "'
    		WHERE ACTIVITY_ID=" . $_POST['id'];
    	$statement = $db->prepare($query);
    	$statement->execute();
	} 
	if (!isset($_POST['id'])) { header('Location: ./activities.php?btnaction=hike'); } 
	
	// pull data with a query
	// display as input fields
	// run query on submission and redirect
	
	// echo "select data init";

    $query = "SELECT * FROM ACTIVITY INNER JOIN RESTAURANT 
    	WHERE ACTIVITY.ACTIVITY_ID=RESTAURANT.ACTIVITY_ID AND ACTIVITY.ACTIVITY_ID=" . $_POST['id'];

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row

    $statement->closeCursor();
    
    
    foreach ($results as $result)
    {
    	echo "
    	<div class='container'>
    	
    	<input type='text' name='id' value='" . $result['ACTIVITY_ID'] . "' hidden />
    	
    	<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>URL</span>
  			<input name='url' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['ACTIVITY_URL'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Name</span>
  			<input name='name' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' 
  				value='" . $result['ACTIVITY_NAME'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Rating</span>
  			<input name='rating' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['RESTAURANT_RATING'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Price (1-3)</span>
  			<input name='price' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['RESTAURANT_PRICE_RANGE'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Cuisine</span>
  			<input name='cuisine' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['RESTAURANT_CUISINE'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Street</span>
  			<input name='street' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['RESTAURANT_STREET'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>City</span>
  			<input name='city' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['RESTAURANT_CITY'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>State</span>
  			<input name='state' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['RESTAURANT_STATE'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Zip</span>
  			<input name='zip' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['RESTAURANT_ZIP'] . "'>
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