<!DOCTYPE html>
<html lang="en">
<head>
  <title>Explore CVille</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Preston Wright">
  <meta name="description" content="activites database for Charlottesville community">
  <meta name="keywords" content="activities charlottesville">

  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Font Awesome -->
  <!-- <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script> -->

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/styles.css">

</head>

<body id="page-top">

  <?php include './components/navigation.php';?>

  <!-- Masthead-->
  <header class="masthead bg-primary text-white text-center">
      <div class="container d-flex align-items-center flex-column">
          <!-- Masthead Heading-->
          <h1 class="masthead-heading text-uppercase mb-0">Users</h1>
      </div>
  </header>

  <div class="container">
    <center>
    <div class="row">
      <div class="col-1" style="line-height:75px">
        <br />
        <h4> Views </h4>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get" style="line-height:50px">
          <div class="btn-group-vertical">
          <input type="submit" name="btnaction" value="customer" class="btn text-white bg-<?php if(isset($_GET['btnaction'])&&$_GET['btnaction']=='customer'){echo "secondary";}else{echo "primary";} ?>" />
          <input type="submit" name="btnaction" value="employee" class="btn text-white bg-<?php if(isset($_GET['btnaction'])&&$_GET['btnaction']=='employee'){echo "secondary";}else{echo "primary";} ?>" />
          </div>
        </form>
        <br />
      </div>
      <div class="col-1" style="line-height:75px"> </div>
      <div class="col-9">
        <br /> 

  <?php require('connect-db.php'); ?>

  <?php
  
  try
  {
    if (isset($_GET['btnaction']))
    {
      switch ($_GET['btnaction'])
        {
          case 'customer': showUser("CUSTOMER");  break;
          case 'employee': showUser("EMPLOYEE");  break;
          case 'delete_customer': deleteUser("CUSTOMER", "CUST_ID", $_GET['id']); break;
          case 'delete_employee': deleteUser("EMPLOYEE", "EMPLOYEE_ID", $_GET['id']); break;
        }
    }
    else { showUser("CUSTOMER"); }
  }
  catch (Exception $e)
  {
    $error_message = $e->getMessage();
    echo "<p>Error message: $error_message </p>";
  }
  ?>

  <?php
  /*************************/
  /** get data **/
  function showUser($type)
  {
    global $db;

    $table_name = ($type == "CUSTOMER") ? "CUST_" : "EMPLOYEE_";
    // TODO: Add in rental car info once database has been cleaned
    // TODO: Add in city and state
    // TODO: Figure out how to show customers with no employee correctly
    $query = ($type == "CUSTOMER")
      ? "SELECT *
          FROM CUSTOMER, EMPLOYEE, HOTEL, RENTALCAR 
          WHERE CUSTOMER.EMPLOYEE_ID = EMPLOYEE.EMPLOYEE_ID
          OR CUSTOMER.EMPLOYEE_ID IS NULL
          AND CUSTOMER.HOTEL_ID = HOTEL.HOTEL_ID
          AND CUSTOMER.RC_ID = RENTALCAR.RC_ID"
      : "SELECT * FROM EMPLOYEE";
      
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();

    $additional_headers = ($type == "CUSTOMER") 
      ? "<th>EMPLOYEE</th>
      <th>HOTEL</th>
      <th>CAR</th>"
      : "<th>EMAIL</th>
      <th>TITLE</th>";

    echo "<h2> $type </h2>";
    echo "<table style='width:100%''>
          <tr>
            <th>NAME</th>
            <th>PHONE</th>" .
            $additional_headers .
          "</tr>";
    
    foreach ($results as $result)
    {
      $button_type = strtolower($type);
      $btndel = "<form action='" . $_SERVER['PHP_SELF'] . "' method='get' style='line-height:50px'>
        <input type='text' name='id' value='" . $result[$table_name.'ID'] . "' hidden />
        <input type='submit' name='btnaction' value='delete_$button_type' class='btn btn-danger'/>
      </form>";

      // TODO: Link to the appropriate edit pages
      $additional_data = ($type == "CUSTOMER") 
      ? "<td>" . $result['EMPLOYEE_FNAME'] . " " . $result['EMPLOYEE_LNAME'] . "</td>
      <td>" . $result['HOTEL_NAME'] . "</td>
      <td>" . $result['RC_COLOR'] . " " . $result['RC_MAKE'] . " " . $result['RC_MODEL'] . "</td>"
      : "<td>" . $result['EMPLOYEE_EMAIL'] . "</td>
      <td>" . $result['EMPLOYEE_TITLE'] . "</td>";

      echo "<tr>
      <td>" . $result[$table_name . 'FNAME'] . " " . $result[$table_name . 'LNAME'] . "</td>
      <td>(" . $result[$table_name . 'AREACODE'] . ") " . $result[$table_name . 'PHONE'] . "</td>" .
      $additional_data .
      "<td>" . $btndel . "<td>
      <td>" . $btndel . "<td>
      </tr>";
    }
    
    echo "</table>";
  }
  ?>

  <?php
  /*************************/
  /** delete data **/
  function deleteUser($type, $id_name, $id)
  {
    global $db;

    if ($id < 0) {
      echo "No ID";
      return;
    };

    try {
      if ($type == "EMPLOYEE") {
        $query = "UPDATE CUSTOMER SET EMPLOYEE_ID = NULL WHERE EMPLOYEE_ID = $id";
        $statement = $db->exec($query);
      } else {
        // TODO: Make all the things dependent on customers have a null value
      }

      $query = "DELETE FROM $type WHERE $type.$id_name = $id";
      $statement = $db->exec($query);

      echo $query, '<br>';
      echo "Record deleted successfully";
    } catch (Exception $e) {
      echo $query . "<br>" . $e->getMessage();
    }
  }
  ?>  
        </div>
    </div>
    </center>
  </div>
</body>
