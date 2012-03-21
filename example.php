<?php
include("Lawnchair.php");

/*	you can choose to use sql or file as a datastore:	*/
/*	SQL:	*/
//	$ppl = new Lawnchair( array("name"=>"people","store"=>"sql","dbhost"=>"localhost","dbuser"=>"","dbpass"=>"","dbname"=>"") );
/*	File:	*/
$ppl = new Lawnchair( array("name"=>"people","store"=>"file") );

if( $ppl->count() < 1 ){
	$ppl->save( array("value"=>array("name"=>"Roger") ) );
	$ppl->save( array("value"=>array("name"=>"Kaitlyn") ) );
	$ppl->save( array("value"=>array("name"=>"Patsy") ) );
	$ppl->save( array("value"=>array("name"=>"Bailey") ) );
	
	for($i = 0; $i <= 15000;$i++){
		$ppl->save( array("value"=>array("name"=>$i) ) );
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

#echo "<h1>List All People</h1>";
#echo "<pre>".print_r($ppl->all(),true)."</pre>";

echo "Last Record is: ".print_r($ppl->max(),true)."<br />";
echo "Last Key is: ".$ppl->lastid();

echo "<h1>Max with callback</h1>";
echo "----> ".$ppl->max( function($member) { return "My name is: ".$member['name']; } )."<br />";

#$ppl->nuke();
