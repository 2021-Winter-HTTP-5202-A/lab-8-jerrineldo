<?php

use Lab8\Models\{Cars, Database, manufacturers};
use Lab8\Library\{Functions};

//using autoload with composer
require_once 'vendor/autoload.php';

//establishing connection to the database
$dbcon = Database::getDb();
$cars = new Cars();

$manufacturers = new manufacturers();
$functions = new Functions();

$makers = $manufacturers->getManufacturers($dbcon);

//assigns the filter to the variable
$filter = $_GET['filterbymake'] ?? "";

//if the filter button is clicked , the cars are displayed according to the make selected.
if(isset($_GET['filterbymake'])) {

  $listofCars = $cars->getCarsByMake($dbcon, $filter);

} else {

  $listofCars = $cars->ListCars($dbcon);

}

//removing the make filter
if(isset($_GET['removefilter'])) {

  $filter = "";
  $listofCars = $cars->ListCars($dbcon);

}

?>

<html lang="en">
<head>
    <title>Cars</title>
</head>

<body>
  <h1>List of Cars</h1>
  <form action="" method="GET">
    <div>
      <label for="filterbymake">Program:</label>
      <select name = "filterbymake" id="filterbymake">
        <?php echo $functions->populateDropdown($makers) ?>
      </select>
    </div>
    <input type="submit" value="Filter By Make"/>
  </form>
  <form action="" method="GET">
    <input type="submit" value="Remove Filter" name = "removefilter" id="removefilter"/>
  </form>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach($listofCars as $car){ 
      ?>
          <tr>
            <th><?= $car->id; ?></th>
            <td><?= $car->Company; ?></td>
            <td><?= $car->model; ?></td>
            <td><?= $car->year; ?></td>
            <td>
              <form action="./update-car.php" method="POST">
                <input type="hidden" name="id" value="<?= $car->id ?>"/>
                <input type="submit" class="" name="updateCar" value="Update"/>
              </form>
            </td>
            <td>
              <form action="./delete-car.php" method="POST">
                <input type="hidden" name="id" value="<?= $car->id ?>"/>
                <input type="submit" class="" name="deleteCar" value="Delete"/>
              </form>
            </td>
          </tr>
      <?php 
        } 
      ?>
    </tbody>
  </table>
  <a href="./add-car.php" id="btn_addCar" class="">Add Car</a>
</body>

</html>

<script type='text/javascript'>
    document.querySelector('#filterbymake').value = '<?php echo $filter ; ?>';
</script>