<?php

$dbconn = pg_connect("host= localhost dbname=regift");

class Gift {
  public $id;
  public $name;
  public $description;
  public $price;
  public $event;
  public $gift_from;

  public function __construct($id, $name, $description, $price, $event, $gift_from){
    $this-> id=$id;
    $this-> name= $name;
    $this-> description= $description;
    $this-> price= $price;
    $this-> event= $event;
    $this-> gift_from= $gift_from;
  }

}

class Gifts {
  static function delete($id){
  $query = "DELETE FROM gifts WHERE id = $1";
  $query_params = array($id);
  pg_query_params($query, $query_params);
  return self::all();
}


  static function create($gift){
  $query = "INSERT INTO gifts (name, description, price, event, gift_from) VALUES ($1, $2, $3, $4, $5)";
  $query_params = array(
    $gift->name,
     $gift->description,
     intval($gift->price),
     $gift->event,
    $gift->gift_from
  );
  pg_query_params($query, $query_params);
  return self::all();

}

static function update($updated_gift){
  $query = "UPDATE gifts SET name = $1, description = $2, price = $3, event =$4, gift_from = $5 WHERE id = $6";
  $query_params = array(
    $updated_gift->name,
     $updated_gift->description,
     intval($updated_gift->price),
     $updated_gift->event,
    $updated_gift->gift_from,
    $updated_gift->id);
  pg_query_params($query, $query_params);
  return self::all();
}






  static function all(){
    $gifts = array();

    $results = pg_query("SELECT * FROM gifts");
    $row_object = pg_fetch_object($results);

    while($row_object !== false){

      $new_gift = new Gift(
        $row_object->id,
        $row_object->name,
        $row_object->description,
        intval($row_object->price),
        $row_object->event,
        $row_object->gift_from
      );

      $gifts[] = $new_gift;

      $row_object = pg_fetch_object($results);
    }


    return $gifts;

  }
}








?>
