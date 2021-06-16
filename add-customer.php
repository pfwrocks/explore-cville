<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Add Customer</h1>
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
          
          if (isset($_POST['areacode']))
          {
            $query = "INSERT INTO `CUSTOMER` (`CUST_FNAME`, `CUST_LNAME`, `CUST_AREACODE`, `CUST_PHONE`, `CUST_STREET`, `CUST_CITY`, `CUST_STATE`, `CUST_ZIP`, `HOTEL_ID`, `EMPLOYEE_ID`, `RC_ID`) VALUES ('" . $_POST['fname'] . "', '" . $_POST['lname'] . "', " . $_POST['areacode'] . ", " . $_POST['phone'] . ", '" . $_POST['street'] . "', '" . $_POST['city'] . "', '" . $_POST['state'] . "', " . $_POST['zip'] . ", " . $_POST['hotel'] . ", " . $_POST['employee'] . ", " . $_POST['rc'] . ")";

            $statement = $db->prepare($query);
            $statement->execute();

            echo "Customer created successfully";
            header('refresh:1; url=users.php?btnaction=customer');
          } 
          
          echo "
          <div class='container'>
          
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>First Name</span>
            <input name='fname' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Last Name</span>
            <input name='lname' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' 
              value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Areacode</span>
            <input name='areacode' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Phone Number</span>
            <input name='phone' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Street</span>
            <input name='street' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>City</span>
            <input name='city' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>State</span>
            <input name='state' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Zip</span>
            <input name='zip' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Employee ID</span>
            <input name='employee' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Hotel ID</span>
            <input name='hotel' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Rental Car ID</span>
            <input name='rc' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='d-grid gap-2'>
            <button class='btn btn-primary' type='submit'>Create</button>
          </div>
          ";
        ?>
        </form>
        <br /> 
</div>