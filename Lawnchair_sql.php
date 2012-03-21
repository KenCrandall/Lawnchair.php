<?php

class Lawnchair_sql extends Lawnchair_Adapter{
	public $dbh;
	public function __construct($dbhost,$dbuser,$dbpass,$dbname){
$sql = "CREATE TABLE `datastore` (
`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,`name` varchar(255) NOT NULL,`value` TEXT NOT NULL,`tstamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`ID`), KEY `tstamp` (`tstamp`) 
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
		$this->dbh = mysql_connect($dbhost,$dbuser,$dbpass);
		mysql_select_db($dbname,$this->dbh);
		mysql_query($sql,$this->dbh);	//	insert the datastore table..
	}
	public function __destruct(){
		mysql_close($this->dbh);
	}
	function read($file){
		$ret = mysql_query("SELECT * FROM datastore WHERE name='{$file}'",$this->dbh);
		$row = mysql_fetch_assoc($row);
		return $row['value'];		
	}
	function write($file,$data){
		mysql_query("DELETE FROM datastore WHERE name='{$file}'",$this->dbh);
		mysql_query("INSERT INTO datastore SET name='{$file}',value='{$data}'",$this->dbh);
	}
}