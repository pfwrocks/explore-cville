<?php include './components/navigation.php';?>
  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Edit Movie</h1>
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
	require('add-activity.php');
	global $db;
	
	
	if (isset($_POST['id']) && isset($_POST['parent_rating']))
	{
		echo "Movie ID: " . $_POST['id'];
		$query = "UPDATE ACTIVITY SET ACTIVITY_URL='" . $_POST['url'] . "' , 
			ACTIVITY_NAME='" . $_POST['name'] . "'
			WHERE ACTIVITY.ACTIVITY_ID=" . $_POST['id'];
    	$statement = $db->prepare($query);
    	$statement->execute();
    	
    	$query = "UPDATE MOVIE SET 
    		MOVIE_PARENT_RATING='" . $_POST['parent_rating'] . "',
    		MOVIE_GENRE='" . $_POST['genre'] . "', MOVIE_RATING='" . $_POST['rating'] . "',
    		MOVIE_DIRECTOR='" . $_POST['director'] . "', MOVIE_RELEASE_DATE='" . $_POST['release'] . "'
    		WHERE ACTIVITY_ID=" . $_POST['id'];
    	$statement = $db->prepare($query);
    	$statement->execute();
	} 
	if (!isset($_POST['id'])) { header('Location: ./activities.php?btnaction=movie'); } 
	
	// pull data with a query
	// display as input fields
	// run query on submission and redirect
	
	// echo "select data init";

    $query = "SELECT * FROM ACTIVITY INNER JOIN MOVIE 
    	WHERE ACTIVITY.ACTIVITY_ID=MOVIE.ACTIVITY_ID AND ACTIVITY.ACTIVITY_ID=" . $_POST['id'];

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
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Parent Rating</span>
  			<input name='parent_rating' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['MOVIE_PARENT_RATING'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Genre</span>
  			<input name='genre' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['MOVIE_GENRE'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Rating</span>
  			<input name='rating' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['MOVIE_RATING'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Director</span>
  			<input name='director' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['MOVIE_DIRECTOR'] . "'>
		</div>
		<div class='input-group mb-3'>
  			<span class='input-group-text' id='basic-addon3' style='width:15%'>Release Date</span>
  			<input name='release' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['MOVIE_RELEASE_DATE'] . "'>
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