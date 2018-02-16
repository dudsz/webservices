<?php



class DB_Connect {
	private $conn;

	// Connecting to the database
	public function connect() {
		$DB_Host = "localhost";
		$DB_Name = "wishlists";
		$DB_User = "root";
		$DB_Pw = "";
		// Connecting to mysql database using PDO
		$dsn = "mysql:host=$DB_Host;dbname=$DB_Name";
		$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

		try {
			$this->conn = new PDO($dsn, $DB_User, $DB_Pw, $options);	
		} catch (PDOException $e) {
			echo "Error connecting, " . $e->getMessage();
		}
		
		// Return database handler
		return $this->conn;
	}
}
?>
