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
  public $main_repairs;
  public $chem_fert;
  public $mort_insur;
  public $labor_contr;
  public $labor_in;
  public $misc;
  public $harvest;

  public function __construct($id, $address, $type, $image, $elect, $diesel, $water, $equip, $main_repairs, $chem_fert, $mort_insur, $labor_contr, $labor_in, $misc, $harvest){
    $this-> id=$id;
    $this-> address=$address;
    $this-> type= $type;
    $this-> image= $image;
    $this-> elect= $elect;
    $this-> diesel= $diesel;
    $this-> water= $water;
    $this-> equip= $equip;
    $this-> main_repairs=$main_repairs;
    $this-> chem_fert=$chem_fert;
    $this-> mort_insur=$mort_insur;
    $this-> labor_contr=$labor_contr;
    $this-> labor_in=$labor_in;
    $this-> misc=$misc;
    $this-> harvest=$harvest;
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
  $query = "INSERT INTO management (address, type, image, elect, diesel, water, equip, main_repairs, chem_fert, mort_insur, labor_contr, labor_in, misc, harvest) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14 )";
  $query_params = array(
    $month->address,
    $month->type,
    $month->image,
    intval($month->elect),
    intval($month->diesel),
    intval($month->water),
    intval($month->equip),
    intval($month->main_repairs),
    intval($month->chem_fert),
    intval($month->mort_insur),
    intval($month->labor_contr),
    intval($month->labor_in),
    intval($month->misc),
    intval($month->harvest)

  );
  pg_query_params($query, $query_params);
  return self::all();

}

static function update($updated_month){
  $query = "UPDATE management SET address = $1, type = $2, image = $3, elect =$4, diesel= $5, water =$6, equip =$7, main_repairs =$8, chem_fert =$9, mort_insur =$10, labor_contr =$11, labor_in =$12, misc =$13, harvest =$14 WHERE id = $15";
  $query_params = array(
    $updated_month->address,
    $updated_month->type,
    $updated_month->image,
    intval($updated_month->elect),
    intval($updated_month->diesel),
    intval($updated_month->water),
    intval($updated_month->equip),
    intval($updated_month->main_repairs),
    intval($updated_month->chem_fert),
    intval($updated_month->mort_insur),
    intval($updated_month->labor_contr),
    intval($updated_month->labor_in),
    intval($updated_month->misc),
    intval($updated_month->harvest));
  pg_query_params($query,$query_params);
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
        intval($row_object->main_repairs),
        intval($row_object->chem_fert),
        intval($row_object->mort_insur),
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
