Lawnchair.php is a port of PHP port of Lawnchair.js

See http://westcoastlogic.com/lawnchair/ for the original javascript library.

I mostly made this for something to try, and have tested with over 20,000 records in a table and had it work fast.

You have a choice of adapters, it can store it as text files on Amazon S3 or in a mySQL database, and you can build on that.

I'll do more documentation as I go..

This also works really nicely with underscore.php

Example
--------

	include("Lawnchair.php");
	/*	you can choose to use sql or file as a datastore:	*/
	/*	SQL:	*/
	//	$ppl = new Lawnchair( array("name"=>"people","store"=>"sql","dbhost"=>"localhost","dbuser"=>"","dbpass"=>"","dbname"=>"") );
	/*	S3:	*/
	//	$ppl = new Lawnchair( array("name"=>"people","store"=>"s3",'awsaccesskey'=>'Your AWS Access Key','awssecretkey'=>'Your AWS Secret Key','bucketname'=>'Your Bucket Name') );
	/*	File:	*/
	$ppl = new Lawnchair( array("name"=>"people","store"=>"file") );
	if( $ppl->count() < 1 ){
		for($i = 0; $i <= 15000;$i++){
			$ppl->save( array("value"=>array("name"=>$i,"age"=>($i+2),"address"=>"random street") ) );
		}
	}
	echo "<h1>List all Keys</h1>";
	if( $ppl->count() < 10 ){
		echo "<pre>".print_r($ppl->keys(),true)."</pre>";
	}else{
		echo "<p>Too many keys to list at once.. {$ppl->count()} keys found..</p>";
	}

	echo "<h1>Find all people with 'a' in the name </h1>";
	$list = $ppl->find(array("field"=>"name","q"=>"a","a"=>"eq"));
	echo "<pre>".print_r($list,true)."</pre>";

	echo "<h1>List All People</h1>";
	echo "<pre>".print_r($ppl->all(),true)."</pre>";

	echo "Last Record is: ".print_r($ppl->max(),true)."<br />";
	echo "Last Key is: ".$ppl->lastid();		

	echo "<h1>Max with callback</h1>";
	echo "----> ".$ppl->max( function($member) { return "My name is: ".$member['name']; } )."<br />";

	echo "<h1>Delete all records</h1>";
	$ppl->nuke();