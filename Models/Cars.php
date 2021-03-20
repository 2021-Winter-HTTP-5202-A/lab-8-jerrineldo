<?php

//defining a namespace
namespace Lab8\Models;

class Cars{

  //function to list all the cars in the db
  public function ListCars($db){

    $query = "Select c.id, c.model, c.year, m.Company FROM cars c
                JOIN manufacturers m
                  ON m.id = c.make order by c.id";

    //preparing the query
    $pdostm = $db->prepare($query);

    //executing the query
    $pdostm->execute();

    //Fetch all the data as objects.
    $cars = $pdostm->fetchAll(\PDO::FETCH_OBJ);
    return $cars;

  }

  //function to filter cars by Make
  public function getCarsByMake($db, $make){

    $query = "Select c.id, c.model, c.year, m.Company FROM cars c
                JOIN manufacturers m
                  ON m.id = c.make 
                where make = :make
                order by c.id";

    //preparing the query
    $pdostm = $db->prepare($query);

    $pdostm->bindParam(':make',$make);

    //executing the query
    $pdostm->execute();

    //Fetch all the data as objects.
    $cars = $pdostm->fetchAll(\PDO::FETCH_OBJ);
    return $cars;

  }


  //function to add a new car
  public function AddCar($make, $model, $year, $dbcon){

    //prevent SQL injection , use placeholders , so that the placeholders are binded later to their actual values.
    $query = "INSERT INTO cars(make, model, year) 
              values (:make, :model, :year)";

    $pdostm = $dbcon->prepare($query);

    //actual data is binded to the placeholders.
    $pdostm->bindParam(':make',$make);
    $pdostm->bindParam(':model',$model);
    $pdostm->bindParam(':year',$year);

    $count = $pdostm->execute();
    return $count;
  }

  //function to delete a car
  public function DeleteCar($dbcon,$id) {

    $query = "DELETE FROM cars
              WHERE id = :id";
    $pdostm = $dbcon->prepare($query);
    $pdostm->bindParam(':id',$id);

    $count = $pdostm->execute();
    return $count;

  }

  //function to get car by Id
  public function GetCarById($id, $dbcon){

    $query = "SELECT * FROM cars
              WHERE id = :id";
    $pdostm = $dbcon->prepare($query);
    $pdostm->bindParam(':id',$id);
    $pdostm->execute();
    return $pdostm->fetch(\PDO::FETCH_OBJ);

  }

  //function to update a car
  public function updateCar($id, $make, $model, $year, $dbcon) {

    $query = "UPDATE cars
              SET make = :make,
                  model = :model,
                  year = :year
              WHERE id = :id";

    $pdostm = $dbcon->prepare($query);

    $pdostm->bindParam(':id',$id);
    $pdostm->bindParam(':make',$make);
    $pdostm->bindParam(':year',$year);
    $pdostm->bindParam(':model',$model);

    $count = $pdostm->execute();
    return $count;

  }

}


?>