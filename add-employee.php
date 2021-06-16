<?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Add Employee</h1>
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
            $query = "INSERT INTO `EMPLOYEE` (`EMPLOYEE_FNAME`, `EMPLOYEE_LNAME`, `EMPLOYEE_AREACODE`, `EMPLOYEE_PHONE`, `EMPLOYEE_TITLE`, `EMPLOYEE_EMAIL`) VALUES ('" . $_POST['fname'] . "', " . $_POST['lname'] . ", " . $_POST['areacode'] . ", " . $_POST['phone'] . ", '" . $_POST['title'] . "', '" . $_POST['email'] . "')";

            $statement = $db->prepare($query);
            $statement->execute();
            echo "Employee created successfully";
            header('refresh:1; url=users.php?btnaction=employee');
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
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Email</span>
            <input name='email' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='input-group mb-3'>
            <span class='input-group-text' id='basic-addon3' style='width:15%'>Title</span>
            <input name='title' type='text' class='form-control' id='basic-url' aria-describedby='basic-addon3' value=''>
          </div>
          <div class='d-grid gap-2'>
            <button class='btn btn-primary' type='submit'>Update</button>
          </div>
          ";
        ?>
        </form>
        <br /> 
</div>