<?php

use Lab8\Models\{Cars, Database, manufacturers};
use Lab8\Library\{Functions};

//using autoload with composer
require_once 'vendor/autoload.php';


//checks the element in the main form was set, to fetch the details of the car to be updated.
if(isset($_POST['updateCar'])){

  //id of the car to be updated ( By the use of a hidden element )
  $id = $_POST['id'];

  //establishes a connection to the database.
  $dbcon = Database::getDb();
  $cars = new Cars();

  $functions = new Functions();

  $manufacturers = new manufacturers();

  $makers = $manufacturers->getManufacturers($dbcon);

  //calling the function to retreive the details of the car to be updated.
  $cartobeUpdated = $cars->getCarById($id, $dbcon);
  
  //fetching the details of the car to be shown in the form.
  $make = $cartobeUpdated->make;
  $model = $cartobeUpdated->model;
  $year = $cartobeUpdated->year;

}

//checks if the user has finished updating and clicked the submit button
if(isset($_POST['update-Car'])){

  //retrieves the details of the car with the new information.
  $id= $_POST['carid'];
  $make = $_POST['manufacturer'];
  $model = $_POST['model'];
  $year = $_POST['year'];
 
  //establishing connection to the database.
  $dbcon = Database::getDb();
  $updatedCar = new Cars();

  //calling the function to update the details of the car selected
  $count = $updatedCar->updateCar($id, $make, $model, $year, $dbcon);

  if($count){

    header("Location:list-cars.php");

  } else {

    echo "problem updating car";

  }

}

?>

<html>
<head>
  <title>Update Car</title>
</head>
<body>
  <h1>Update Car</h1>
  <form action="" method="POST">
    <input type="hidden" name="carid" value="<?= $id; ?>"/>
    <div>
      <label for="manufacturer">Make:</label>
      <select type="text" name="manufacturer" id="manufacturer" >
        <?php echo $functions->populateDropdown($makers) ?>
      </select>
    </div>
    <div>
      <label for="model">Model:</label>
      <input type="text" name="model" id="model" value="<?= $model ?>"/>
    </div>
    <div>
      <label for="year">Year:</label>
      <input type="text" name="year" id="year" value="<?= $year ?>"/>
    </div>
    <div>
      <input type="submit" name="update-Car" value="Update Car"/>
    </div>
  </form>
</body>
</html>


<script type='text/javascript'>
    document.querySelector('#manufacturer').value = '<?php echo $make ; ?>';
</script>
