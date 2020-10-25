
<?php

header('Content-Type: application/json');

include_once __DIR__ . '/../models/farm.php';

if($_REQUEST['action']==='index'){
  echo json_encode( Months::all());



  }else if ($_REQUEST['action'] === 'create'){
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $new_month = new Month(null, $body_object->address, $body_object->type, $body_object->image, $body_object->elect, $body_object->diesel, $body_object->water, $body_object->equip, $body_object->main_repairs, $body_object->chem_fert, $body_object->mort_insur, $body_object->labor_contr, $body_object->labor_in, $body_object->misc, $body_object->harvest);
    $all_months= Months::create($new_month);
    echo json_encode($all_months);


  }else if ($_REQUEST['action'] === 'update'){
    $request_body = file_get_contents('php://input');
    $body_object= json_decode($request_body);
    $updated_month = new Month($_REQUEST['id'],$body_object->address, $body_object->type, $body_object->image, $body_object->elect, $body_object->diesel, $body_object->water, $body_object->equip, $body_object->main_repairs, $body_object->chem_fert, $body_object->mort_insur, $body_object->labor_contr, $body_object->labor_in, $body_object->misc, $body_object->harvest);
    $all_months = Months::update($updated_month);
    echo json_encode($all_months);

  } else if ($_REQUEST['action'] === 'delete'){
  $all_months = Months::delete($_REQUEST['id']);
  echo json_encode($all_months);
}

?>
