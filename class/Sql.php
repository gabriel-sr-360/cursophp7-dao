<?php 

class Sql extends PDO{

private $conn;

public function __construct(){
	$this->conn = new PDO("mysql:dbname=dbphp7; host=localhost", "root","");
}

private function setParams($stantement, $parameters = array()){  
  foreach ($parameters as $key => $value) {
 	$this->setParam($stantement, $key, $value);
 }
}

private function setParam($stantement, $key, $value){
   $stantement->bindParam($key, $value);
}

public function query($rawQuery, $parans = array()){ 
$stmt = $this->conn->prepare($rawQuery);
$this->setParams($stmt, $parans);
$stmt->execute();
return $stmt;
}

public function select($rawQuery, $params=array()):array{
$stmt = $this->query($rawQuery, $params);
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}

 ?>	
