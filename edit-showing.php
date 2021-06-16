<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Edit Showing</h1>
      </div>
  </header>

  <div class="container">
    <center>
      <div class="col-9">
      	<br>
      	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" style="line-height:50px">
      	

<?php
	require('connect-db.php');
	global $db;
	
	if (isset($_POST['movie']) && isset($_POST['time']))
	{
		echo "Theater ID: " . $_POST['theater'] . ", Movie ID: " . $_POST['movie'];    	
    	$query = "UPDATE SHOWING SET 
    		ACTIVITY_ID='" . $_POST['movie'] . "', THEATER_ID='" . $_POST['theater'] . "',
    		SHOW_TIME='" . $_POST['time'] . "'
    		WHERE ACTIVITY_ID=" . $_POST['ogmovie'] . " AND THEATER_ID=" . $_POST['ogtheater'];
    	$statement = $db->prepare($query);
    	$statement->execute();
    	echo $query;
	} 
	if (!isset($_POST['movie'])) { header('Location: ./activities.php'); } 
	
	// pull data with a query
	// display as input fields
	// run query on submission and redirect
	
	// echo "select data init";

    $query = "SELECT * FROM SHOWING 
    	WHERE THEATER_ID=" . $_POST['theater'] . " AND ACTIVITY_ID=" . $_POST['movie'];

    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();
    // fetch() returns an array of one row

    $statement->closeCursor();
    
    
    foreach ($results as $result)
    {
	    $q = "SELECT * FROM ACTIVITY INNER JOIN MOVIE 
    	WHERE ACTIVITY.ACTIVITY_ID=MOVIE.ACTIVITY_ID";

	    $s = $db->prepare($q);
	    $s->execute();

	    $r1 = $s->fetchAll();
	    // fetch() returns an array of one row

	    $s->closeCursor();
	    
	    $q = "SELECT * FROM THEATER";

	    $s = $db->prepare($q);
	    $s->execute();

	    $r2 = $s->fetchAll();
	    // fetch() returns an array of one row

	    $s->closeCursor();
    	
    	
    	echo "
    	<div class='container'>
    	
    	<input type='text' name='ogtheater' value='" . $result['THEATER_ID'] . "' hidden />
    	<input type='text' name='ogmovie' value='" . $result['ACTIVITY_ID'] . "' hidden />
    	
    	<select name='movie' class='form-select form-select-lg mb-3' aria-label='.form-select-lg example'>";
    		
    		foreach ($r1 as $rs1)
    		{
    			if ($rs1['ACTIVITY_ID']==$result['ACTIVITY_ID'])
    				echo "<option selected value='" . $rs1['ACTIVITY_ID'] . "'>" . $rs1['ACTIVITY_NAME'] . "</option>";
    			else
    				echo "<option value='" . $rs1['ACTIVITY_ID'] . "'>".$rs1['ACTIVITY_NAME']."</option>";
    		}
    		
		  	echo "
			</select>
    	
    	
    	<select name='theater' class='form-select form-select-lg mb-3' aria-label='.form-select-lg example'>";
    		
    		foreach ($r2 as $rs2)
    		{
    			if ($rs2['THEATER_ID']==$result['THEATER_ID'])
    				echo "<option selected value='" . $rs2['THEATER_ID'] . "'>" . $rs2['THEATER_NAME'] . "</option>";
    			else
    				echo "<option value='" . $rs2['THEATER_ID'] . "'>".$rs2['THEATER_NAME']."</option>";
    		}
    		
		  	echo "
			</select>
			
			<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Show Time</span>
  			<input name='time' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' 
  				value='" . $result['SHOW_TIME'] . "'>
			</div>
	
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