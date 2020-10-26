<?php

$dbconn = pg_connect("host= localhost dbname=stats");

class Month {
  public $id;
  public $address;
  public $type;
  public $image;
  public $elect;
  public $diesel;
  public $water;
  public $equip;
  public $main;
  public $repairs;
  public $chem;
  public $fert;
  public $mort;
  public $insur;
  public $labor_contr;
  public $labor_in;
  public $misc;
  public $harvest;

  public function __construct($id, $address, $type, $image, $elect, $diesel, $water, $equip, $main, $repairs, $chem, $fert, $mort, $insur, $labor_contr, $labor_in, $misc, $harvest){
    $this->id=$id;
    $this->address=$address;
    $this->type= $type;
    $this->image= $image;
    $this->elect= $elect;
    $this->diesel= $diesel;
    $this->water= $water;
    $this->equip= $equip;
    $this->main=$main;
    $this->repairs=$repairs;
    $this->chem=$chem;
    $this->fert=$fert;
    $this->mort=$mort;
    $this->insur=$insur;
    $this->labor_contr=$labor_contr;
    $this->labor_in=$labor_in;
    $this->misc=$misc;
    $this->harvest=$harvest;
  }

}

class Months {
  static function delete($id){
  $query = "DELETE FROM management WHERE id = $1";
  $query_params = array($id);
  pg_query_params($query, $query_params);
  return self::all();
}


  static function create($month){
  $query = "INSERT INTO management (address, type, image, elect, diesel, water, equip, main, repairs, chem, fert, mort, insur, labor_contr, labor_in, misc, harvest) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17 )";
  $query_params = array(
    $month->address,
    $month->type,
    $month->image,
    intval($month->elect),
    intval($month->diesel),
    intval($month->water),
    intval($month->equip),
    intval($month->main),
    intval($month->repairs),
    intval($month->chem),
    intval($month->fert),
    intval($month->mort),
    intval($month->insur),
    intval($month->labor_contr),
    intval($month->labor_in),
    intval($month->misc),
    intval($month->harvest)

  );
  pg_query_params($query, $query_params);
  return self::all();

}

static function update($updated_month){
  $query = "UPDATE management SET address = $1, type = $2, image = $3, elect =$4, diesel= $5, water =$6, equip =$7, main =$8, repairs =$9, chem =$10, fert =$11, mort=$12, insur =$13, labor_contr =$14, labor_in =$15, misc =$16, harvest =$17 WHERE id = $18";
  $query_params = array(
    $updated_month->address,
    $updated_month->type,
    $updated_month->image,
    intval($updated_month->elect),
    intval($updated_month->diesel),
    intval($updated_month->water),
    intval($updated_month->equip),
    intval($updated_month->main),
    intval($updated_month->repairs),
    intval($updated_month->chem),
    intval($updated_month->fert),
    intval($updated_month->mort),
    intval($updated_month->insur),
    intval($updated_month->labor_contr),
    intval($updated_month->labor_in),
    intval($updated_month->misc),
    intval($updated_month->harvest),
    intval($updated_month->id));
  $result=pg_query_params($query,$query_params);
  return self::all();
}






  static function all(){
    $months = array();

    $results = pg_query("SELECT * FROM management");
    $row_object = pg_fetch_object($results);

    while($row_object !== false){

      $new_month = new Month(
        $row_object->id,
        $row_object->address,
        $row_object->type,
        $row_object->image,
        intval($row_object->elect),
        intval($row_object->diesel),
        intval($row_object->water),
        intval($row_object->equip),
        intval($row_object->main),
        intval($row_object->repairs),
        intval($row_object->chem),
        intval($row_object->fert),
        intval($row_object->mort),
        intval($row_object->insur),
        intval($row_object->labor_contr),
        intval($row_object->labor_in),
        intval($row_object->misc),
        intval($row_object->harvest)
      );

      $months[] = $new_month;

      $row_object = pg_fetch_object($results);
    }


    return $months;

  }
}








?>
