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
            // delete all activities
            for ($count = 0; $count <= $_POST['act_count']; $count++) {
              $query = "DELETE FROM `ENROLL` WHERE `ENROLL`.`LIST_ID` = " . $_POST['id'] . " AND `ENROLL`.`ACTIVITY_ID` = " . $count;
              $statement = $db->prepare($query);
              $statement->execute();
            }

            $activities = $_POST["enrolled_activity"];
            if (count($activities) > 0) {
              foreach ($activities as $activity) {
                $query = "INSERT INTO `ENROLL` (`LIST_ID`, `ACTIVITY_ID`) VALUES (" . $_POST['id'] . ", " . $activity . ");";
                $statement = $db->prepare($query);
                $statement->execute();
              }
            }

            echo "Update completed successfully";
            header('refresh:1; url=activities.php?btnaction=list');
          } 

          // Get all the activities in that list
          $query = "SELECT ENROLL.ACTIVITY_ID FROM ENROLL
            LEFT JOIN ACTIVITY ON ACTIVITY.ACTIVITY_ID = ENROLL.ACTIVITY_ID
            WHERE ENROLL.LIST_ID =" . $_POST['id'];

          $statement = $db->prepare($query);
          $statement->execute();
          $results = $statement->fetchAll();
          $statement->closeCursor();

          // store all the activity ids in a list
          $list_id = $_POST['id'];
          $enrolled = array();
          foreach ($results as $result)
          {
            array_push($enrolled, $result['ACTIVITY_ID']);
          }

          $query = "SELECT * FROM ACTIVITY";

          $statement = $db->prepare($query);
          $statement->execute();
          $results = $statement->fetchAll();
          $statement->closeCursor();

          echo "
            <div class='container'>
            <input type='text' name='id' value='" . $list_id . "' hidden />
            <input type='text' name='updated' value='true' hidden />
            <input type='text' name='act_count' value='" . count($results) . "' hidden />";
          
          // iterate through all activities
          foreach ($results as $result) 
          {
            $checked = (in_array($result['ACTIVITY_ID'], $enrolled)) ? "checked" : "";
            echo "<input type='checkbox' name='enrolled_activity[]' value='   ". $result['ACTIVITY_ID'] ."' " . $checked . ">   " . $result['ACTIVITY_NAME']. " - " . $result['ACTIVITY_TYPE'] . "<br>";
          }
          
          echo "
          <div class='d-grid gap-2'>
            <button class='btn btn-primary' type='submit'>Update</button>
          </div>
          ";
        
        ?>
        </form>
        <br /> 
</div>