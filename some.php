<?php 
  require_once 'C:/xampp/htdocs/vendor/autoload.php';
  $output = Array(); 
  $output['success']=0;
  $results = Array();  
  $name=$_POST['bdate'];
  $connection = new PDO('mysql:host=localhost;dbname=fp;charset=utf8','root');
  $sql = ("SELECT * FROM users WHERE firt_name LIKE :n OR last_name LIKE :n1 OR bdate LIKE :n2 ");
  $query = $connection->prepare($sql);
  if($query->execute(["n"=>$name,"n1"=>$name,"n2"=>$name]))
    $output['success']=1; 
  while($row = $query->fetch(PDO::FETCH_ASSOC)){
    array_push($results,$row);
  }    
  $output['results'] = $results; 
  echo json_encode($output);
?>
