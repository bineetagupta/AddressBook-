<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php

class Database {
		private $host = DB_HOST;
		private $user = DB_USER;
		private $pass = DB_PASS;
		private $dbname = DB_NAME;
		
		private $dbh;
		private $error;
		private $stml; 
		
		
		
		public function __construct() {
			//Set DSN
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
			//Set Options
			$options = array (
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);
			//Create a new PDO instance
			try {
				$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
				//$this->dbh = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
				// set the PDO error mode to exception
				//$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			//Create any errors
			catch ( PDOException $e) {
				$this->error = $e->getMessage();
				print_r( $e );
			}
		}
		
		public function query ($query) {
			$this->stmt = $this->dbh->prepare($query);
		}
		
		
		public function bind ($param, $value, $type = null) {
			if (is_null ($type)) {
				switch(true) {
					case is_int ($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool ($value):
						$type = PDO::PARAM_BOOL;
						break;
					default :
						$type = PDO::PARAM_STR;
				}
			}
			$this->stmt->bindValue ($param, $value, $type );
		}
		
		public function execute() {
			return $this->stmt->execute();
		}
		
		public function resultset() {
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_OBJ);
		}
		
		public function single() {
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_OBJ);
		}
		
		public function rowCount() {
			return $this->stmt->rowCount();
		}
		
		public function lastInsertId() {
			return $this->dbh->lastInsertId();
		}
		
		public function beginTransaction() {
				return $this->dbh->beginTransaction();
		}
		
		public function endTrasanction() {
			return $this->dbh->commit();
		}
		
		public function cancelTransaction() {
			return $this->dbh->rollBack();
		}
		
}
			
				
				
			