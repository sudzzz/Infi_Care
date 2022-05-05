<?php

   //saving the username
  class stores
  { //Declaring variables, setters and getters
    private $id;
		private $name;
		private $address;
		private $lat;
		private $lng;
		private $conn;
		private $tableName = "stores"; //Has address of Pharmacies
    private $table     = "coustomer";  //Has address of coustomers
    private $tab       = "hospital";  //Has address of hospital

		function setId($id) { $this->id = $id; }
		function getId() { return $this->id; }
		function setName($name) { $this->name = $name; }
		function getName() { return $this->name; }
    function setUserName($username) { $this->username = $username; }
		function getUserName() { return $this->username; }
		function setAddress($address) { $this->address = $address; }
		function getAddress() { return $this->address; }
		function setLat($lat) { $this->lat = $lat; }
		function getLat() { return $this->lat; }
		function setLng($lng) { $this->lng = $lng; }
		function getLng() { return $this->lng; }

    //Constructor to establish connection
    public function __construct() {
			require_once('db/DbConnect.php');
			$conn = new DbConnect;
			$this->conn = $conn->connect();
		}

    // THE PHARMACY PART--STARTS HERE

    //Function to get address of stores with latitude and longitude value as NULL
    public function getStoresBlankLatLng() {
			$sql = "SELECT * FROM $this->tableName WHERE lat IS NULL AND lng IS NULL";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

    //Update the latitude and logitude in stores table
    public function updateStoresWithLatLng() {
			$sql = "UPDATE $this->tableName SET lat = :lat, lng = :lng WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':lat', $this->lat);
			$stmt->bindParam(':lng', $this->lng);
			$stmt->bindParam(':id', $this->id);

			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}

    //Get all the updated value from the stores table
    public function getAllStores() {
			$sql = "SELECT * FROM $this->tableName";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

    //THE PHARMACY PART---ENDS HERE


    //THE COUSTOMER PART----STARTS HERE


    //Function to get address of logged in coustomer if latitude and longitude value is NULL
    public function getCoustomerBlankLatLng() {
      $sql = "SELECT * FROM $this->table WHERE lat IS NULL AND lng IS NULL AND username='{$_SESSION['username']}'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Update the latitude and logitude in coustomer table
    public function updateCoustomerWithLatLng() {
			$sql = "UPDATE $this->table SET lat = :lat, lng = :lng WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':lat', $this->lat);
			$stmt->bindParam(':lng', $this->lng);
			$stmt->bindParam(':id', $this->id);

			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}

    //Get all the updated value of address from the coustomer table
    public function getCoustomer() {
      $sql = "SELECT * FROM $this->table WHERE username='{$_SESSION['username']}'";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //THE COUSTOMER PART---ENDS HERE
  }


 ?>
