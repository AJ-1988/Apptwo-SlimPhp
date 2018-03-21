<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app = new \Slim\App;

$app->get('/users', function (Request $request, Response $response, array $args) {

  try {
    $db = new db();
    $db = $db->connect();

    $query = $db->query("SELECT users.id, users.name, GROUP_CONCAT(DISTINCT phone_numbers.phone_number) AS phone_number, GROUP_CONCAT(DISTINCT deposits.amount) AS deposite_amount, GROUP_CONCAT(DISTINCT deposits.date) AS deposite_date FROM users LEFT JOIN phone_numbers ON users.id = phone_numbers.user_id LEFT JOIN deposits ON users.id = deposits.user_id GROUP BY users.id");

    $users = $query->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($users);

    $db = null;
  } catch (PDOException $e) {
    echo "Woops something went wrong" . $e->getMessage();
    die();
  }

});

$app->get('/user/{id}', function (Request $request, Response $response, array $args) {
  $id = $request->getAttribute('id');

  try {
    $db = new db();
    $db = $db->connect();

    $query = $db->query("SELECT users.id, users.name, GROUP_CONCAT(DISTINCT phone_numbers.phone_number) AS phone_number, GROUP_CONCAT(DISTINCT deposits.amount) AS deposite_amount, GROUP_CONCAT(DISTINCT deposits.date) AS deposite_date FROM users LEFT JOIN phone_numbers ON users.id = phone_numbers.user_id LEFT JOIN deposits ON users.id = deposits.user_id WHERE id = $id GROUP BY users.id");

    $users = $query->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($users);

    $db = null;
  } catch (PDOException $e) {
    echo "Woops something went wrong" . $e->getMessage();
    die();
  }

});


$app->run();
