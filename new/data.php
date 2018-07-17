<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
setInterval(function() {
    $("#refresh").load(location.href+" #refresh>*","");
}, 1000); // seconds to wait, miliseconds

</script>

</head>
<body>
  <div id="refresh">
  <div id="time">
    <?php echo date('H:i:s');?>
  </div>
</div>
</body>
</html>
