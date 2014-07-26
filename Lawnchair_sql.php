<?php

class Lawnchair_sql extends Lawnchair_Adapter{
	public $dbh;
	public function __construct(){
		$this->dbh = new PDO( 'sqlite:./data/lawnchair.sqlite' );
		$this->dbh->exec('CREATE TABLE IF NOT EXISTS  datastore (id INTEGER PRIMARY KEY, mkey TEXT,mvalue TEXT,tstamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP);');
		if (file_exists('./data/lawnchair.sqlite')){
#			echo 'Database and tables created.';
		}else {
			echo 'Database was not created. Please check to make sure this directory is writeable.';
		}
	}
	public function __destruct(){
//		mysql_close($this->dbh);
	}
	function read($file){
		$stmt = $this->dbh->prepare('SELECT mvalue FROM datastore WHERE mkey=?');
		$stmt->execute( array($file) );
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result['mvalue'];
	}
	function write($file,$data){
		$this->dbh->exec("DELETE datastore WHERE mkey='{$file}';");
		
		$stmt = $this->dbh->prepare('INSERT INTO datastore (mkey,mvalue) VALUES (?,?)');
		$stmt->execute( array($file,$data) );
	}
}