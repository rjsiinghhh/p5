
<?php

header('Content-Type: application/json');

include_once __DIR__ . '/../models/regftr.php';

if($_REQUEST['action']==='index'){
  echo json_encode( Gifts::all());



  }else if ($_REQUEST['action'] === 'create'){
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $new_gift = new Gift(null, $body_object->name, $body_object->description, $body_object->price, $body_object->event, $body_object->gift_from); //create a new Person from $body_object
    //print_r($new_person);
    $all_gifts= Gifts::create($new_gift);
    echo json_encode($all_gifts);


  }else if ($_REQUEST['action'] === 'update'){
    $request_body = file_get_contents('php://input');
    $body_object= json_decode($request_body);
    $updated_gift = new Gift($_REQUEST['id'], $body_object->name, $body_object->description, $body_object->price, $body_object->event, $body_object->gift_from);
    $all_gifts = Gifts::update($updated_gift);
    echo json_encode($all_gifts);

  } else if ($_REQUEST['action'] === 'delete'){
  $all_gifts = Gifts::delete($_REQUEST['id']);
  echo json_encode($all_gifts);
}

?>
