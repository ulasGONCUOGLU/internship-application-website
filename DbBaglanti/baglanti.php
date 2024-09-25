<?php 
	
	try{
		$db = new PDO("mysql:host=localhost;dbname=yazlab1;charset=utf8","root","");
		
	} catch (PDOException $e){
		echo $e->getMessage();
		
	}

?>