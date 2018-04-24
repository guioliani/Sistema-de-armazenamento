<?php
//bloqueia usuario nivel 1 acessar a url de admin
	
	function protegerUser(){
		if($_SESSION["nivel"] != 1){
				echo "<script>location.href='../../index.php'</script>";
				
		}
	}

	function protegerAdmin(){
		if($_SESSION["nivel"] != 2){
			echo "<script>location.href='../../index.php'</script>";
		
		}
				
	}

	function protegerMaster(){
		if($_SESSION["nivel"] != 3){
			echo "<script>location.href='../../index.php'</script>"; 
		}
	}

	function protegerAll(){
		if($_SESSION["nivel"] != 1 AND $_SESSION["nivel"] != 2 AND $_SESSION["nivel"] != 3){
			echo "<script>location.href='../../index.php'</script>";
		}
	}

?>