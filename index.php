<!DOCTYPE html>
<?php
require_once "./EASYbitcoin/EASYbitcoin.php"; // The library to ask EASYbitcoin nodes 
require_once "settings.php";
session_start();
if (isset($_GET["deco"])) { // See the disconnection button
    session_unset();
    header('Location: index.php');
}
//For each client we create an instance to connect to the node
if (!isset($_SESSION["client"]) || $_SESSION["client"] == null) {
    $_SESSION["client"] = new EASYbitcoin($rpc_user, $rpc_pass,$rpc_host, $rpc_port);
}
?>

<html>
	<head>
		<title><?php echo $fullname;?> wallet</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width">

		<link rel="stylesheet" href="assets/css/index.css">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/all.css">

		<!-- Boostrap Css Link -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
         
	</head>

	<body class=" ">

	<nav class="navbar navbar-dark">
		<div class="mr-auto">
			<a class="navbar-brand" href="#"><?php echo $fullname;?> wallet</a>
		</div>
		
		<?php if(isset($_SESSION["address"])){ ?>
			<ul style="list-style-type: none;">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-align-right"></i>
					</a>
					<div class="dropdown-menu" style="left: -117px;" aria-labelledby="navbarDropdown">
					
						<button type="button" class="btn btn-link text-info dropdown-item" data-toggle="modal" data-target="#generate">Keys</button>
						
						<button type="button" class="btn btn-link text-info dropdown-item" data-toggle="modal" data-target="#support">Support</button>
						
						<form method="GET" action="index.php">
								<button type="submit" class="btn btn-link text-danger dropdown-item" id="deco" name="deco">Sign Out</button>
						</form>
					</div>
				</li>
			</ul>
			<div class="modal fade" id="support" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					    <div class="modal-header">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<div class="modal-body">
											<h2 class="display-4">Contact us: </h2>
											<div class="input-group mb-4">
												<input type="text" class="form-control" id="copyKeys" value="<?php echo $support; ?>" readonly /> 
												<button type="button" class="btn btn-outline-primary" onclick="myFunction()">Copy Email</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				     </div>
				</div>
			</div>
			
			<div class="modal fade" id="generate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<div class="container">
								<div class="row">
									<div class="col-md-12 text-center">
										<h2 class="message text-danger">
											Warning
										</h2> 
									</div>

									<div class="col-md-12 text-center">

										<h4 class="text-capitalize">
											This Is Your Recovery Key
										</h4>
									</div>
								</div>
							</div>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body text-center">
							<h1 class="display-4 text-center">Your key : </h1>
							<div class="input-group mb-4">
								<input type="text" class="form-control" id="copyKeys" value="<?php echo $_SESSION["key"]; ?>" readonly /> 
								<button type="button" class="btn btn-outline-primary" onclick="myFunction()">Copy text</button>
							</div>
						</div>
						<div class="modal-footer">
							<div class="col-md-12 text-center">
<p class="h3"> <input type="checkbox" id="checkme">  I secure the key</p>
<button type="submit" class="btn btn-outline-secondary" data-dismiss="modal" id="saved">Carry on</button> 
</div>
						</div>
						
					</div>
				</div>
			</div>

		<?php } ?>
		
	</nav>

	<main>
		<div class="container-fluid">

		<?php if (!isset($_SESSION["address"])) { //If nobody's connected ?>
		
			<section>
				<div class="jumbotron jumbotron-fluid bg-white">
					<div class="container-fluid text-center">
						<div class="row">
							<div class="col-md-12">
								<img src="assets/images/bitcoin.png" style="width: 200px; height: 200px;" class="mb-4">
								<h1 class="display-4">Welcome to <?php echo $fullname;?> wallet</h1>
								<p class="lead">The easier, safer and faster <?php echo $fullname; ?> wallet</p>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</section>

			<div class="row">
				<div class="col-md-12">

					<ul class="nav justify-content-center mb-4" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="btn btn-link text-danger btn-lg" href="./login.php">Log in</a>
						</li>
						<li class="nav-item">
							<form method="GET" action="src/generate.php" class="form" id="createAccount">					
								<button type="submit" class="btn btn-danger btn-lg">Create an account</button>

										
							</form>
						</li>
					</ul>
				</div>	<!-- col md 12 -->
			</div>
		<?php } else { //If connected
		//	$_SESSION["balance"] = $_SESSION["client"]->getbalance($_SESSION["address"]); 
			$address = $_SESSION["address"];
		    $key = $_SESSION["key"];
			$_SESSION["client"]->setaccount($address, $key);
			$_SESSION["balance"] = $_SESSION["client"]->getbalance($_SESSION["key"]); ?>
			

			<div class="row" id="main">
				<div class="col-md-12 p-0">
				<ul class="nav nav-pills nav-fill mb-4" id="myTab" role="tablist">
						<li class="nav-item pills">
							<a class="nav-link btn-lg text-capitalize" id="receive-tab" data-toggle="tab" href="#receive" role="tab" aria-controls="home" aria-selected="false">Receive</a>
						</li>
						<li class="nav-item pills">
							<a class="nav-link btn-lg text-capitalize active" id="activity-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="profile" aria-selected="true">Activity</a>
						</li>
						<li class="nav-item pills">
							<a class="nav-link btn-lg text-capitalize" id="send-tab" data-toggle="tab" href="#send" role="tab" aria-controls="profile" aria-selected="false">Send</a>
						</li>
					</ul>

					<div class="tab-content col-md-12 p-4" id="myTabContent">
						<div class="tab-pane fade" id="receive" role="tabpanel" aria-labelledby="home-tab">
								<div class="row" id="accountInfos">
									<div class="col-md-12">
										<h3 class="dont-break-out">
											Your address : <?php echo $_SESSION["address"]; ?>
										</h3>
										<h3 class="dont-break-out">
											Your key : <?php echo $_SESSION["key"]; ?>
										</h3> 
									</div>
								</div>

								<div class="row">
									<div class="col-md-12 text-center">
										<div id="qrCode">
											<img src='https://chart.googleapis.com/chart?cht=qr&chl=<?php echo($_SESSION["address"]); ?>&chs=180x180&choe=UTF-8&chld=L|2' alt='' class="mr-auto ml-auto">
										</div>
									</div>
								</div>
						</div>
						<div class="tab-pane fade show active" id="activity" role="tabpanel" aria-labelledby="home-tab">
							<div class="col-md-12">
								<div id="balance">
  	                                <h3>You have : <?php echo $_SESSION["balance"]; ?></span>
										<span id="coinName"><?php echo $short;?></span>
									</h3>
								</div>
<br></br>
								<!-- transaction history starts here for deposit-->
								<?php 
    $address = $_SESSION["address"];
    $key = $_SESSION["key"];
    $json=$_SESSION["client"]->listtransactions($_SESSION["key"]); 
?>
<?php 
    for($i=count($json)-1; $i>=0; $i--){
?>

<div id="transaction" class="col-md-12 pl-0"> 
	<div class="row">
		<?php if($json[$i]['category'] === "send") { ?>
			<div class="col-md-12 p-0">
			<div class="alert alert-info" role="alert">
				<?php 
					echo "<button type='button' class='btn btn-link text-left pl-0' data-toggle='modal' data-target='#".$json[$i]['address']."'>";
					echo "<span>Sent to: ".$json[$i]['address']."</span><br>";
					echo "<span>Amount: ".$json[$i]['amount']."</span>";
					echo "</button>"
				?>
			</div></div>
		
		<?php } else { ?>
			<div class="col-md-12 p-0">
			<div class="alert alert-danger" role="alert">
				<?php 
					echo "<button type='button' class='btn btn-link text-left pl-0' data-toggle='modal' data-target='#".$json[$i]['address']."'>";
					echo "<span>Received from: ".$json[$i]['address']."</span><br>";
					echo "<span>Amount: ".$json[$i]['amount']."</span>";
					echo "</button>"
				?>
			</div></div>

		<?php } ?>
	</div>	
</div>


<!-- history modal starts -->

<div class="modal fade" id="<?php echo $json[$i]['address'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h2 class="message text-info">
									Transaction History
								</h2> 
							</div>
						</div>
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php 
						echo "<div class='col-md-12'>Address: ".$json[$i]['address']."</div>";
						echo "<div class='col-md-12'>Category: ".$json[$i]['category']."</div>";
						echo "<div class='col-md-12'>Amount: ".$json[$i]['amount']."</div>";
						echo "<div class='col-md-12'>Confirmations: ".$json[$i]['confirmations']."</div>";
						echo "<div class='col-md-12'>TxDetail: <a href= ' ".$blockchain_tx_url."".$json[$i]['txid']." ' class='headernavlink'>Info</a></div>";
					?>
				</div>
			</div>
		</div>
	</div>


<!-- history modal ends -->


<?php } ?>
								<!-- transaction history ends here for deposit -->

								<!-- transaction history starts here for voucher-->
								<!-- <div class="col-md-12">
									<div class="alert alert-info" role="alert">
										A simple info to alert deposit
									</div>
								</div> -->
								<!-- transaction history ends here for voucher -->


							</div>	
						</div>

						<div class="tab-pane fade" id="send" role="tabpanel" aria-labelledby="home-tab">

							<?php
							//Sending error handling
								if (isset($_GET["error"]) && $_GET["error"] == 1) {
									$_GET["error"] = 0;
							?>
							<div class="alert alert-warning alert-danger fade show m-4" role="alert">
									An error occurred during the transaction :
									<?php
										echo $_SESSION["error"];
										$_SESSION["error"] = null;
									?>
									<?php
echo "<script language='javascript'>alert('An error occurred during the transaction')</script>";
?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>


							<?php
								} //Error handling end
									//If transaction succeeded
								if (isset($_GET["txSuccess"]) && $_GET["txSuccess"] == true) {
								?>
								<div class="alert alert-warning alert-sucess fade show m-4" role="alert">
										The transaction was successfully completed
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php } ?>

							<div id="send" class="p-4">
								<h3>Send <?php echo $short;?></h3>
								<form method="POST" action="src/send.php" class="form">
									<div class="formPart form-group">
										<label for="receiver">Recipient : </label>
										<input type="text" class="form-control" id="receiver" name="receiver"  placeholder="Enter <?php echo $fullname;?> address here"/>
									</div>
									<div class="formPart form-group">
										<label for="amount">Amount :</label>
										<input type="number" class="form-control" id="amount" name="amount" step='0.0001' placeholder="Mininmum 0.0001 <?php echo $short;?>"/>
									</div>
									<button class="btn btn-outline-success" id="submitSend" type="submit">send !</button>
								</form>
							</div>
						</div>

					</div>
				</div>
			</div>


		<?php } //If not connected{ [..] } else{ [..] } ends here ?>

		</div> <!-- container -->
	</main>



	<!-- Script file of boostrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
		var checker = document.getElementById('checkme');
		var sendbtn = document.getElementById('saved');
		sendbtn.disabled = true
		checker.onchange = function() {
			sendbtn.disabled = !this.checked;
		};
	</script>

	<script>
		function myFunction() {
			/* Get the text field */
			var copyText = document.getElementById("copyKeys");

			/* Select the text field */
			copyText.select();

			/* Copy the text inside the text field */
			document.execCommand("copy");

			/* Alert the copied text */
			alert("Copied the text: " + copyText.value);
		}
	</script>
 

<script>
setInterval(function() {
    $("#balance").load(location.href+" #balance>*","");
}, 1000); // seconds to wait, miliseconds

</script>

<script>
setInterval(function() {
    $("#transaction").load(location.href+" #transaction>*","");
}, 1000); // seconds to wait, miliseconds

</script>
  
	</body>
</html>

