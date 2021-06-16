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
          case 'delete': deleteUser($_GET['type'], $_GET['table_name'], $_GET['id']); break;
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
    // TODO: Link to edit pages
    $query = ($type == "CUSTOMER")
      ? "SELECT *
        FROM CUSTOMER
        LEFT JOIN EMPLOYEE ON CUSTOMER.EMPLOYEE_ID = EMPLOYEE.EMPLOYEE_ID
        LEFT JOIN HOTEL ON CUSTOMER.HOTEL_ID = HOTEL.HOTEL_ID
        LEFT JOIN RENTALCAR ON CUSTOMER.RC_ID = RENTALCAR.RC_ID"
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
    echo "<form action='add-". strtolower($type) . ".php' method='post' style='line-height:50px'>
    <input type='submit' name='btnaction' value='Add " . $type . "' class='btn btn-success' /></form>";
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
        <input type='text' name='type' value='" . $type . "' hidden />
        <input type='text' name='table_name' value='" . $table_name . "ID' hidden />
        <input type='submit' name='btnaction' value='delete' class='btn btn-danger'/>
      </form>";
      $btnedit = "<form action='edit-". strtolower($type) . ".php' method='post' style='line-height:50px'>
        <input type='text' name='id' value='" . $result[$table_name.'ID'] . "' hidden />
        <input type='submit' name='btnaction' value='edit' class='btn btn-info' /></form>";

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
      <td>" . $btnedit . "<td>
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
      $query = "DELETE FROM $type WHERE $type.$id_name = $id";
      $statement = $db->exec($query);

      echo $query, '<br>';
      echo "Record deleted successfully";
    } catch (Exception $e) {
      echo $query . "<br>" . $e->getMessage();
    }

    header('refresh:1; url=users.php');
  }
  ?>  
        </div>
    </div>
    </center>
  </div>
</body>
