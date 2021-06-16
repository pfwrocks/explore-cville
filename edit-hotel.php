<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Edit Hotel</h1>
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
            $query = "UPDATE HOTEL SET  
              HOTEL_NAME='" . $_POST['name'] . "',
              HOTEL_STREET='" . $_POST['street'] . "',
              HOTEL_CITY='" . $_POST['city'] . "',
              HOTEL_STATE='" . $_POST['state'] . "', 
              HOTEL_ZIP='" . $_POST['zip'] . "',
              HOTEL_AREACODE='" . $_POST['areacode'] . "',
              HOTEL_PHONE='" . $_POST['phone'] . "'
              WHERE HOTEL_ID=". $_POST['id'];

            echo $query; 
            $statement = $db->prepare($query);
            $statement->execute();

            echo "Update completed successfully";
            header('refresh:1; url=hotel.php');
          } 
          if (!isset($_POST['id'])) { header('Location: ./hotel.php'); } 

          $query = "SELECT * FROM HOTEL WHERE HOTEL_ID=" . $_POST['id'];

          $statement = $db->prepare($query);
          $statement->execute();

          $results = $statement->fetchAll();
          // fetch() returns an array of one row

          $statement->closeCursor();
          
          foreach ($results as $result)
          {
            echo "
            <div class='container'>
            
            <input type='text' name='id' value='" . $result['HOTEL_ID'] . "' hidden />
            
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Name</span>
              <input name='name' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['HOTEL_NAME'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Street</span>
              <input name='street' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' 
                value='" . $result['HOTEL_STREET'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>City</span>
              <input name='city' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['HOTEL_CITY'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>State</span>
              <input name='state' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['HOTEL_STATE'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Zip Code</span>
              <input name='zip' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['HOTEL_ZIP'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Area Code</span>
              <input name='areacode' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['HOTEL_AREACODE'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Phone</span>
              <input name='phone' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['HOTEL_PHONE'] . "'>
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