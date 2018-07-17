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
		
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

	</head>
    <body>
        <nav class="navbar navbar-dark">
            <span class="navbar-brand mb-0">
                <h2>
                    <?php echo $fullname;?> wallet
                </h2>
            </span>
        </nav>

        <main>
	<?php if(isset($_SESSION["error"])) { ?>
<div class="col-md-6 offset-md-3 mt-4 alert alert-danger alert-dismissible fade show" role="alert">
  <?php echo $_SESSION["error"]; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
	<?php } ?>
            <div class="jumbotron col-md-6 offset-md-3 text-center mt-4 bg-white">
                <?php if (!isset($_SESSION["address"])) { //If nobody's connected ?>
                                
                    <h2>Login Here</h2>
                    <form method="POST" action="src/connection.php" class="form" >
                        <div class="form-group" id="connection">
                            <input type="text" name="key" id="key" class="form-control" placeholder="Enter your private key here" required/>
                        </div>
                        <button type="submit" class="btn btn-outline-success">Click to login!</button>
                    </form>

                <?php } else{ ?>
            </div>

            <div class="container-fluid text-center">
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center">
                        <h2>
                            Already Loggedin!
                        </h2>
                    </div>
                </div>
            </div>

                <?php } ?>
                
        </main>

	<!-- Script file of boostrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
    </body>

</html>
