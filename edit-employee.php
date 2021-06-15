<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Edit Employee</h1>
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
          
          if (isset($_POST['id']) && isset($_POST['areacode']))
          {
            $query = "UPDATE EMPLOYEE SET  
              EMPLOYEE_FNAME='" . $_POST['fname'] . "',
              EMPLOYEE_LNAME='" . $_POST['lname'] . "',
              EMPLOYEE_AREACODE=" . $_POST['areacode'] . ",
              EMPLOYEE_PHONE=" . $_POST['phone'] . ", 
              EMPLOYEE_EMAIL='" . $_POST['email'] . "',
              EMPLOYEE_TITLE='" . $_POST['title'] . "'
              WHERE EMPLOYEE_ID=" . $_POST['id'];

            $statement = $db->prepare($query);
            $statement->execute();

            echo "Update completed successfully";
            header('refresh:1; url=users.php?btnaction=employee');
          } 

          $query = "SELECT * FROM EMPLOYEE WHERE EMPLOYEE_ID=" . $_POST['id'];

          $statement = $db->prepare($query);
          $statement->execute();

          $results = $statement->fetchAll();
          // fetch() returns an array of one row

          $statement->closeCursor();
          
          foreach ($results as $result)
          {
            echo "
            <div class='container'>
            
            <input type='text' name='id' value='" . $result['EMPLOYEE_ID'] . "' hidden />
            
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>First Name</span>
              <input name='fname' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['EMPLOYEE_FNAME'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Last Name</span>
              <input name='lname' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' 
                value='" . $result['EMPLOYEE_LNAME'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Areacode</span>
              <input name='areacode' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['EMPLOYEE_AREACODE'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Phone Number</span>
              <input name='phone' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['EMPLOYEE_PHONE'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Email</span>
              <input name='email' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['EMPLOYEE_EMAIL'] . "'>
            </div>
            <div class='input-group mb-3'>
              <span class='input-group-text' id='basic-addon3' style='width:15%'>Title</span>
              <input name='title' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value='" . $result['EMPLOYEE_TITLE'] . "'>
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