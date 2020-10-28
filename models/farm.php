<?php
$dbconn = null;
if(getenv('DATABASE_URL')){ // if using the heroku database
	$connectionConfig = parse_url(getenv('DATABASE_URL'));
	$host = $connectionConfig['host'];
	$user = $connectionConfig['user'];
	$password = $connectionConfig['pass'];
	$port = $connectionConfig['port'];
	$dbname = trim($connectionConfig['path'],'/');
	$dbconn = pg_connect(
		"host=".$host." ".
		"user=".$user." ".
		"password=".$password." ".
		"port=".$port." ".
		"dbname=".$dbname
	);
} else { // if using the local database, change the dbname to be whatever your local database's name is
	$dbconn = pg_connect("host=localhost dbname=stats");
}

class Month {
  public $id;
	public $entry_date;
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

  public function __construct($id, $entry_date, $address, $type, $image, $elect, $diesel, $water, $equip, $main, $repairs, $chem, $fert, $mort, $insur, $labor_contr, $labor_in, $misc, $harvest){
    $this->id=$id;
		$this->entry_date=$entry_date;
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
  $query = "INSERT INTO management (entry_date, address, type, image, elect, diesel, water, equip, main, repairs, chem, fert, mort, insur, labor_contr, labor_in, misc, harvest) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17, $18)";
  $query_params = array(
		date($month->entry_date),
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
  $query = "UPDATE management SET entry_date=$1, address = $2, type = $3, image = $4, elect =$5, diesel= $6, water =$7, equip =$8, main =$9, repairs =$10, chem =$11, fert =$12, mort=$13, insur =$14, labor_contr =$15, labor_in =$16, misc =$17, harvest =$18 WHERE id = $19";
  $query_params = array(
		date($updated_month->entry_date),
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
				date($row_object->entry_date),
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
