<?php
require('../../inc/init.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];

if (isset($_GET['id'])) {
  $id = $_GET['id'];
}

$Transaction = new Element('transactions_data');

switch ($method) {

  case 'POST':
    $data = file_get_contents('php://input');

    $transactionData = json_decode($data);

    $r = $Transaction->insert($transactionData);

    echo json_encode($r);
    break;

  case 'PUT':
    $data = file_get_contents('php://input');

    $transactionData = json_decode($data);

    $r = $Transaction->update($transactionData);

    echo json_encode($r);
    break;

  case 'GET':

    if (isset($id)) {
      $p = $Transaction->get($id);
    } else {
      $p = $Transaction->getAll();
    }

    $r['data'] = $p;
    $r['total'] = isset($id) ? 1 : count($p);
    echo json_encode($r);
    break;

  default:
    $r = false;
    echo json_encode($r);
    break;
}
