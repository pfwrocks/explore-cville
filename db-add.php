<?php 
require('connect-db.php');
global $db;

// Add activity functional on 'all' tab, activities.php
function addActivityForm()
{
echo"<p> Add activity </p>";
echo "<html>
    <body>
    <form action = 'activities.php' method='post'>
    Name: <input type='text' name='activity_name'><br>
    Opens: <input type='text' name='activity_opentime'><br>
    Closes: <input type='text' name='activity_closetime'><br>
    Type: <input type='text' name='activity_type'><br>
    URL: <input type='text' name='activity_url'><br>
    <input type='submit'>
</form>
    </body>
</html>";
echo "activity name is";
echo $_POST['activity_name'];
}


?>