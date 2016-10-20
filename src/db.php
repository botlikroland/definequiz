<?php

class DB{

var $connection;
	
	
		
	function __construct() {
		$connection = mysql_connect('localhost','root','');
		if(!$connection) {
			die('Connection error: '.mysql_error());
		}
		
		$table = mysql_select_db('roli',$connection);
		if (!$table) {
			die('Select db error: '.mysql_error());	
		}
		
		// Todo check 
		mysql_query("SET NAMES 'utf8';", $connection);
				
		$this->connection = $connection;
	}
	
	function query($queryString) {
		$resultId = mysql_query($queryString, $this->connection);
		if(!$resultId) {
			die('Query error: '.mysql_error());
		}
		
		$rows=Array();
		while($record = mysql_fetch_assoc($resultId)){
			$rows[] = $record;
		}
		
		return $rows;
	}
	
	function update($queryString) {
		if(mysql_query($queryString, $this->connection)){
			//Sikerült az update
		}
		else{
			die('Update error: '.mysql_error());
		}	
	}
	
	function close(){
		$close = mysql_close($this->connection);
		if(!$close){
			die('Close error: '.mysql_error());
		}
	}
	
	function escape($str) {
		return mysql_real_escape_string($str, $this->connection);
	}
	
	
}
?>