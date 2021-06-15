<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Edit Customer</h1>
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
          require('connect-db.php');
          global $db;
          
          if (isset($_POST['id']) && isset($_POST['zip']))
          {
            $query = "UPDATE CUSTOMER SET  
              CUST_FNAME='" . $_POST['fname'] . "',
              CUST_LNAME='" . $_POST['lname'] . "',
              CUST_AREACODE=" . $_POST['areacode'] . ",
              CUST_PHONE=" . $_POST['phone'] . ", 
              EMPLOYEE_ID=" . $_POST['employee'] . ",
              HOTEL_ID=" . $_POST['hotel'] . ",
              RC_ID=" . $_POST['rc'] . ",
              CUST_STREET='" . $_POST['street'] . "',
              CUST_CITY='" . $_POST['city'] . "',
              CUST_STATE='" . $_POST['state'] . "',
              CUST_ZIP=" . $_POST['zip'] . "
              WHERE CUST_ID=" . $_POST['id'];

            $statement = $db->prepare($query);
            $statement->execute();

            echo "Update completed successfully";
            header('refresh:1; url=users.php?btnaction=customer');
          } 
          if (!isset($_POST['id'])) { header('Location: ./users.php?btnaction=customer'); } 

          $query = "SELECT * FROM CUSTOMER WHERE CUST_ID=" . $_POST['id'];

          $statement = $db->prepare($query);
          $statement->execute();

          $results = $statement->fetchAll();
          // fetch() returns an array of one row

          $statement->closeCursor();
          
          foreach ($results as $result)
          {
            echo "
            <div class='container'>
            
            <input type='text' name='id' value='" . $result['CUST_ID'] . "' hidden />
            
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>First Name</span>
              <input name='fname' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['CUST_FNAME'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Last Name</span>
              <input name='lname' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' 
                value='" . $result['CUST_LNAME'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Areacode</span>
              <input name='areacode' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['CUST_AREACODE'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Phone Number</span>
              <input name='phone' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['CUST_PHONE'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Street</span>
              <input name='street' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['CUST_STREET'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>City</span>
              <input name='city' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['CUST_CITY'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>State</span>
              <input name='state' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['CUST_STATE'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Zip</span>
              <input name='zip' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['CUST_ZIP'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Employee ID</span>
              <input name='employee' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['EMPLOYEE_ID'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Hotel ID</span>
              <input name='hotel' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['HOTEL_ID'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Rental Car ID</span>
              <input name='rc' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['RC_ID'] . "'>
            </div>
            <div class='d-grid gap-2'>
              <button class='btn btn-primary' type='submit'>Update</button>
            </div>
            ";
          }
        ?>
        </form>
        <br /> 
    </div>
</div>