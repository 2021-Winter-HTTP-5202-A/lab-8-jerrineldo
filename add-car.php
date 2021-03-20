<?php

use Lab8\Models\{Cars, Database, manufacturers};
use Lab8\Library\{Functions};

//using autoload with composer
require_once 'vendor/autoload.php';

//establishes connection to the database
$dbcon = Database::getDb();
$cars = new Cars();

$manufacturers = new manufacturers();

$makers = $manufacturers->getManufacturers($dbcon);
$functions = new Functions();

//checking if the user has clicked the Add car submit button
if(isset($_POST['addCar'])){

  //fetch the elements of the form ( details of the new car )
  $make = $_POST['manufacturer'];
  $model = $_POST['model'];
  $year = $_POST['year'];


  $cars = new Cars();

  //calling the function to add a new car 
  //The function returns the number of rows effected.
  $count = $cars->addCar($make,$model,$year,$dbcon);

  if($count){

    header("Location:list-cars.php");

  } else {

    echo "problem adding a car";

  }
}

?>

<html>
<head>
  <title>Add Car</title>
</head>
<body>
  <h1>Add Car</h1>
  <form action="" method="POST">
    <div>
      <label for="make">Make:</label>
      <select type="text" name="manufacturer" id="manufacturer">
        <?php echo $functions->populateDropdown($makers) ?>
      </select>
    </div>
    <div>
      <label for="model">Model:</label>
      <input type="text" name="model" id="model"/>
    </div>
    <div>
      <label for="year">Year:</label>
      <input type="text" name="year" id="year"/>
    </div>
    <div>
      <input type="submit" name="addCar" value="Add Car"/>
    </div>
  </form>
</body>
</html>

