<?php
//this is an experimental approach to unify the site management processes
//DatabaseHandler can do stuff and all she needs is just a call.
//She is not an object. She is a woman. She might behave the same but it is a
//great insult to think of her as an object.
//to instatiate her just create an bot-> new DatabaseHandler; and use one of her trics
class DatabaseHandler {
	private $conn;
	private function establishConnection(){
		// configuration of the database
		include 'config.php';
		// Create connection
		$this->conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->$conn->connect_error);
			throw new Exception('SQL Connection Error'.$sql.$this->$conn->error);
		}
	}
	private function executeQuerry($sql){
		if ($this->conn->query($sql) === TRUE){
			echo "Success!";
			$response = ['OK'];
			return $response;
		} else {
			throw new Exception('SQL Querry Error'.$sql.$this->$conn->error);
			$response = ['Connection Error',$this->conn->error];
			return $response;
		}
	}
	public function createObject($type,$objectName,$arguments) {
		$this->establishConnection();
		// values need to be separated by "','" and concatanated by .
		$sql= "CREATE $type $objectName ($arguments);";
		echo $sql;
		$this->executeQuerry($sql);
	}
	public function saveObject ($type,$arguments,$values) {
		$this->establishConnection();
		// values need to be separated by "','" and concatanated by .
		$sql= "INSERT INTO $type ($arguments) VALUES ('$values');";
		$this->executeQuerry($sql);
	}
	public function deleteObject($id,$type){
		$this->establishConnection();
		$sql = "DELETE FROM $type WHERE id ='$id' ";
		$this->executeQuerry($sql);
	}
	public function editObject($id,$type,$arguments,$values){
		$this->establishConnection();
		for ($i=0;$i<count($arguments);$i++) {
			$sql = "UPDATE $type SET $arguments[$i] = '$values[$i]' WHERE id='$id'";
			$this->executeQuerry($sql);
		}
	}
	// public function listenForInput($type,$operation,$input){
	// 	$object new $type;
	// 	$object->$peration+$type($input);
	// }
}
?>
