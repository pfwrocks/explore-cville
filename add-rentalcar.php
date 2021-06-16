<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Add Rental Car</h1>
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
          
          if(isset($_POST['make']))
        {
            addRC(
                $_POST['make'],
                $_POST['model'],
                $_POST['color'],
                $_POST['seats']
            );
            echo "Rental car created successfully";
            header('refresh:1; url=rentalcar.php');
          } 
          echo "
          <div class='container'>
          
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Make</span>
            <input name='make' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Model</span>
            <input name='model' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' 
              value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Color</span>
            <input name='color' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Number of Seats</span>
            <input name='seats' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='d-grid gap-2'>
            <button class='btn btn-primary' type='submit'>Update</button>
          </div>
          ";

          function addRC($make, $model, $color, $seats){
            global $db;
            $query = "INSERT INTO `RENTALCAR` (`RC_MAKE`, `RC_MODEL`, `RC_COLOR`, `RC_SEATS`) VALUES ('". $make . "', '". $model . "', '". $color . "', ". $seats . ");";
        
            $statement = $db->prepare($query);
            $statement->execute();
        }
        ?>
        </form>
        <br /> 
</div>