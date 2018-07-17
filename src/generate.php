<?php
	require_once("../EASYbitcoin/EASYbitcoin.php"); // The library to ask EASYbitcoin nodes
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "GET"){
		$_SESSION["address"] = $_SESSION["client"]->getnewaddress();
		$_SESSION["key"] = $_SESSION["client"]->dumpprivkey($_SESSION["address"]);
	}
	header('Location: ../warning.php');
?>
