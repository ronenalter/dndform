<?php

require_once('connection.php');

class MySQLDatabase {

	private $connection;
	public $last_query;
	private $magic_quotes_active;
	private $real_escape_string;

	function __construct(){
		$this->magic_quotes_active = get_magic_quotes_gpc();
	}
	
	public function open_connection() {
		$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        if (mysqli_connect_errno($this->connection)) {
            echo "Database connection failed: " . mysqli_connect_error();
        }	
	}

	public function close_connection() {
		if(isset($this->connection)) {
			mysqli_close($this->connection);
			unset($this->connection);
		}
	}
	
	public function query($sql) {
		$this->last_query = $sql;
		$result = mysqli_query($this->connection,$sql);
		$this->confirm_query($result);
			
		return $result;
	}
	
	private function confirm_query($result) {
		if(!$result) {
			$output  = "Database query failed: ". mysqli_error($this->connection)."<br /><br />";
			$output .= "Last SQL query: " . $this->last_query;
			die($output);
		}
	}
	
	public function escape_value($value) {
		// undo any magic quotes effects so mysql_real_escape_string can do the work
		if($this->magic_quotes_active) {$value = stripslashes($value);}
		$value = mysqli_real_escape_string($this->connection,$value);
		return $value;
	}

	// Database neutral methods
	public function fetch_array($result_set) {
		return mysqli_fetch_array($result_set);
	}
	
	public function insert_id() {
		// get the last id inserted over the current db connection
		return mysqli_insert_id($this->connection);
	}
	
	public function affected_rows() {
		// how many rows were affected by the last change
		return mysqli_affected_rows($this->connection);
	}
}

$database = new MySQLDatabase();
$database->open_connection();
$db =& $database;


?>