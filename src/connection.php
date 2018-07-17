<?php
	require_once '../AltcoinsECDSA/AltcoinsECDSA.php'; // The library to gen keys of EASYbitcoin
	use AltcoinsECDSA\AltcoinsECDSA as EASYbitcoin;
	
	require_once("../EASYbitcoin/EASYbitcoin.php"); // The library to ask EASYbitcoin nodes 
	require_once("../settings.php");
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//Get the key and the instance of the object to manipulate it
		$key = $_POST["key"];
		$easybitcoin = new EASYbitcoin();
		//If the key is a valid one, we set it and get the address
		if($easybitcoin->validateWifKey($key)){
			$easybitcoin->setPrivateKeyWithWif($key);
			$address = $easybitcoin->getAddress();
			//And then set up the vars with the appropriate values
			if($easybitcoin->validateAddress($address)){
				$_SESSION["address"] = $address;
				$_SESSION["key"] = $easybitcoin->getWif();
				$_SESSION["error"] = NULL;
				header('Location: ../index.php');
			}
			else{
				echo "546uhlkjl";
			}
			
		}else{
			$_SESSION["error"] = "Error, Invalid key";
			 header('Location: ../login.php'); 
		}
	}
	//We redirect the user in any case
?>
