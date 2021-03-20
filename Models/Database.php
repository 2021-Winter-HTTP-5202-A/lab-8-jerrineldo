<?php

//defining a namespace
namespace Lab8\Models;

//Singleton class with only static members , only one copy of class would be made.
class Database {

  //properties
  private static $user = "root";

  private static $pass = "root";

  //What type of database you are connecting to, host, database name
  private static $dsn = "mysql:host=localhost;dbname=phpdb";

  private static $dbcon;

  //only one copy of class made, so an instance of the object cannot access the constructor.
  private function __construct(){

  }

  //function to establish a PDO connection
  public static function getDb(){
    
    if(!isset(self::$dbcon)){

      self::$dbcon = new \PDO(self::$dsn, self::$user, self::$pass);
      self::$dbcon->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);

    }
    
    return self::$dbcon;

  }

}


?>