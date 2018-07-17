<!DOCTYPE html>

    <?php
        require_once "./EASYbitcoin/EASYbitcoin.php"; // The library to ask EASYbitcoin nodes
        require_once "settings.php";
        session_start();
        //For each client we create an instance to connect to the node
        if (!isset($_SESSION["client"]) || $_SESSION["client"] == null) {
            $_SESSION["client"] = new EASYbitcoin($rpc_user, $rpc_pass,$rpc_host, $rpc_port);
        }
    ?>

<html lang="en">
    <head>
        <title><?php echo $fullname;?> wallet</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="assets/css/index.css">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/all.css">

		<!-- Boostrap Css Link -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous"><title><?php echo $fullname;?> wallet</title>
		
	</head>
    <body>
        <nav class="navbar navbar-dark">
		<div class="mr-auto">
			<a class="navbar-brand" href="#"><?php echo $fullname;?> wallet</a>
		</div>
	</nav>
        
        <main class="mt-4">
<div class="container-fluid">
      <div class="row" id="warning">
				<div class="col-md-12 text-center">
					<h2 class="message text-danger">
						Warning
					</h2>
					<h4 class="text-capitalize">
						you Must Save This Key NOW!
					</h4>
				</div>
				<div class="col-md-12">
					<div class="jumbotron jumbotron-fluid bg-white">
						<div class="container">
							
						<h1 class="display-4">Your key : </h1>
							<div class="input-group mb-4">
								<input type="text" class="form-control" id="copyKeys" value="<?php echo $_SESSION["key"]; ?>" readonly /> 
								<button type="button" class="btn btn-outline-primary" onclick="myFunction()">Copy key</button>
							</div>
							
							<div class="col-md-12 text-center">
							<p class="h3"> <input type="checkbox" id="checkme"> I secure the key</p>
								<button type="submit" class="btn btn-outline-success" id="saved" onClick="document.location.href='index.php'">continue</button>
							</div>
						</div>
					</div>

				</div>

			</div> <!-- warning -->
               </div> 
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
	
    </body>

</html>
