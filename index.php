<?php
$f = "visit.php";
//generate visit.php file if not found then write 0 to the generated file
if(!file_exists($f)){
	touch($f);
	$handle =  fopen($f, "w" ) ;
	fwrite($handle,0) ;
	fclose ($handle);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>JQuery Raffle Draw</title>
		<link href="img/favicon.ico" rel="icon" type="image">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="js/navbarclock.js"></script>
		<link rel="stylesheet" href="css/style.css">
    </head>
	<body onload="startTime()">
	<h1>HELLO BITCHES</h1>
		<nav class="navbar-inverse" role="navigation">
			<a href="https://www.facebook.com/MrNiemand03" target="_blank">
				<img src="img/niemand.png" class="hederimg">
			</a>
			<div id="clockdate">
				<div class="clockdate-wrapper">
					<div id="clock"></div>
					<div id="date"><?php echo date('l, F j, Y'); ?></div>
				</div>
			</div>
			<div class="pagevisit">
				<div class="visitcount">
					<?php
					$handle = fopen($f, "r");
					$counter = ( int ) fread ($handle,20) ;
					fclose ($handle) ;
					$counter++ ;
					echo "This Page is Visited ".$counter." Times";
					$handle =  fopen($f, "w" ) ;
					fwrite($handle,$counter) ;
					fclose ($handle) ;
					?>
				</div>
			</div>
		</nav>
		<div class="maincontent">
			<div id="output">START RAFFLE DRAW</div>
			<div id="alert"></div>
			<div><p id="instruction">Press <strong>'S'</strong> on your keyboard to Start Raffle</p></div>
			<script>
				var numvar = 0, //variable to prevent a key from pressing multiple times
					datafromform = ''; //make sure you have this variable empty to prevent empty modal showing
				$('body').keydown(function(e){
					//starts generating number if letter 'S' key is pressed
					if(e.keyCode == 83 && numvar == 0){
						if(datafromform != ''){
							$('#myModal').modal('toggle'); //closes modal if datafromform if is not empty
						}
						//random number animator here
						animationTimer = setInterval(function() {
							var randnum = Math.floor(Math.random() * 36),//generate random number
								strnum = ""+randnum+""; //convert number to string
							if(strnum.length == 2){//compare if length of generated number is equal to 2
								$('#output').text(''+randnum);
							}else{
								$('#output').text('0'+randnum);//add 0 if generated number is only 1 digit
							}
						}, 100);//milliseconds before generating new number again
						$('#instruction').text("Press 'X' to Stop Raffle");//set new instruction to the user
						
						numvar = numvar + 1;
					}
					
					
					//stops generating number if letter 'X' key is pressed
					if(e.keyCode == 88) {
						numvar = 0;//numvar is put back to zero
						clearInterval(animationTimer);//stops raffle
						//Ajax POST that sends the value of 'res' variable to send.php
						$.ajax({
						   type: "POST",
						   url: 'send.php',
						   data: 'res='+$('#output').text().trim(),
						   success: function(data){
							   //show query result from send.php back to #alert of this page
							   $('#queryresult').html(data);
						   }
						});
						$("#myModal").modal({backdrop: "static"});//show modalwith winner's name
						$('#instruction').text("Press 'S' to Start Raffle");//set new instruction to the user
						datafromform = 'good';//datafromform has now a value
					}
				});
			</script>
		</div>
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<p>And the Winner is <br><strong id="queryresult"></strong></p>
					</div>
				</div>
			</div>
		</div>
	</body>	
</html>