<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->get('/{name}', function (Request $request, Response $response, $args) {
$output = Array(); 
  $output['success']=0;
  $results = Array();
  $name=$args['name'];
  $connection = new PDO('mysql:host=localhost;dbname=fp;charset=utf8','root');
  $sql = ("SELECT * FROM users WHERE firt_name LIKE :n OR last_name LIKE :n1 OR bdate LIKE :n2 ");
  $query = $connection->prepare($sql);
  if($query->execute(["n"=>$name,"n1"=>$name,"n2"=>$name]))
    $output['success']=1; 
  while($row = $query->fetch(PDO::FETCH_ASSOC)){
    array_push($results,$row);
  }
  $output['results'] = $results;

    $response->getBody()->write(json_encode($output));
    return $response;});

$app->run();