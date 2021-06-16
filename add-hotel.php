<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Add Hotel</h1>
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
          
          if(isset($_POST['name']))
        {
            addHotel(
                $_POST['name'], 
                $_POST['street'], 
                $_POST['city'], 
                $_POST['state'], 
                $_POST['zip'], 
                $_POST['areacode'], 
                $_POST['phone']
            );
            echo "Hotel created successfully";
            header('refresh:1; url=hotel.php');
          } 
          echo "
          <div class='container'>
          
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Name</span>
            <input name='name' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Street</span>
            <input name='street' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' 
              value=''>
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
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Zip Code</span>
            <input name='zip' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Area Code</span>
            <input name='areacode' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Phone Number</span>
            <input name='phone' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='d-grid gap-2'>
            <button class='btn btn-primary' type='submit'>Update</button>
          </div>
          ";

          function addHotel($name, $street, $city, $state, $zip, $areacode, $phone){
            global $db;
            $query = "INSERT INTO `HOTEL` (`HOTEL_NAME`, `HOTEL_STREET`, `HOTEL_CITY`, `HOTEL_STATE`, `HOTEL_ZIP`, `HOTEL_AREACODE`, `HOTEL_PHONE`) VALUES ('" . $name . "', '" . $street . "', '" . $city . "', '" . $state . "', '" . $zip . "', " . $areacode . ", " . $phone . ");";
        
            echo $query;
            $statement = $db->prepare($query);
            $statement->execute();
        }
        ?>
        </form>
        <br /> 
</div>