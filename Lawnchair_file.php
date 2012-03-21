<?php

class Lawnchair_file extends Lawnchair_Adapter{
	function read($file){
		$file = realpath(dirname(__FILE__))."/data/".$file.".json";
		if( file_exists($file) ){
			return file_get_contents($file);
		}else{
			return "";
		}
	}
	function write($file,$data){
		$file = realpath(dirname(__FILE__))."/data/".$file.".json";
		file_put_contents($file,$data);
	}
}