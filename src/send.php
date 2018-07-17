<?php
	require_once("../EASYbitcoin/EASYbitcoin.php"); // The library to ask EASYbitcoin nodes 
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//For clarity and for the eyes
		$address = $_SESSION["address"];
		$key = $_SESSION["key"];
		//The form values
		$amount = $_POST["amount"];
		$receiver = $_POST["receiver"];
		//Checking address pattern validity (basically)
		$regex = '/^B[a-zA-Z0-9]{25,36}$/';
		if(preg_match($regex, $address) == 0){
			if(!$_SESSION["client"]->sendfrom($key, $receiver, (float)$amount)){
				//If there was a problem, we stock the error and redir
				$_SESSION["error"] =  $_SESSION["client"]->error;
				header('Location: ../index.php?error=1');
			}
			else{
				$_SESSION["txSuccess"] = True;
				header('Location: ../index.php?txSuccess=true');
			}
		}
		else{
			//Same here, there was a problem
			$_SESSION["error"] = "Please check the address (which must be of the form G [...])";
			header('Location: ../index.php?error=1');
		}
	}
	else{
		header('Location: ../index.php');
	}
?>
