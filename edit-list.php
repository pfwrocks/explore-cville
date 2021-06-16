<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Edit List</h1>
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
          
          if (isset($_POST['id']) && isset($_POST['updated']))
          {
            // TODO: Update the list
            // $query = "UPDATE"

            // $statement = $db->prepare($query);
            // $statement->execute();

            echo "Update completed successfully";
            header('refresh:1; url=activities.php?btnaction=list');
          } 

          // Get all the activities in that list
          $query = "SELECT * FROM ENROLL
            LEFT JOIN ACTIVITY ON ACTIVITY.ACTIVITY_ID = ENROLL.ACTIVITY_ID
            WHERE ENROLL.LIST_ID =" . $_POST['id'];

          foreach ()

          // $statement = $db->prepare($query);
          // $statement->execute();

          // $results = $statement->fetchAll();

          // $statement->closeCursor();

          $query = 
          
          foreach ($results as $result)
          {
            echo "
            <div class='container'>
            
            <input type='text' name='id' value='" . $result['LIST_ID'] . "' hidden />
            <input type='text' name='updated' value='true' hidden />
            
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Name</span>
              <input name='name' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['HOTEL_NAME'] . "'>
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