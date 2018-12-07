<?php
	
	function isLoggedIn (){
		
		session_start ();
		if(empty($_SESSION[username])){
			
			header("Location: index.php");
			
		}
	}

	function findNameProduct( $array){
		
		foreach($array['emri'] as $key => $v){
			
			$vek[$key] = $v ;
		}
		
		return $vek ;
		
	}

	function arrayToString( $array){
		
		$str = ' ';
		foreach($array as $key => $v){
		
			$str = $str."'";
			
			$str = $str.$v;
			$str = $str."'," ;
			
		}
		$str = trim( $str,",");
		return $str ;
		
	}



?>