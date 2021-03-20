<?php

//defining a namespace
namespace Lab8\Models;

class manufacturers{

  public function getManufacturers($db){

    $query = "Select * FROM manufacturers";

    //preparing the query
    $pdostm = $db->prepare($query);

    //executing the query
    $pdostm->execute();

    //Fetch all the data as objects.
    $manufacturers = $pdostm->fetchAll(\PDO::FETCH_OBJ);
    return $manufacturers;

  }

}
