<?php 

use Lab8\Models\{Cars, Database};

//using autoload with composer
require_once 'vendor/autoload.php';

//checks if the user has clicked on the delete button
if(isset($_POST['deleteCar'])){

  $id = $_POST['id'];

  //establishing connection to the database
  $dbcon = Database::getDb();
  $cars = new Cars();

  //calling the function which deletes the car selected
  $count = $cars->DeleteCar($dbcon,$id);

  if($count){

    header("Location:list-cars.php");

  } else {

    echo "problem deleting a car";

  }

}