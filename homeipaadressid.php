<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8" />

	<link rel="stylesheet" type="text/css" href="stylefile.css">
  	
	<script src="projectscript.js"></script>

	<title>Eksam - v6rgurakendused</title>

</head>
<body>
	
	<div class="banner">
		<ul>
			<li class="banner_left"><a href="?">HOME</a></li>
		</ul>
	</div>

	<div class="body">
			
	  	<div class="column1">
	  		&nbsp;
	  	</div>
	  	<div class="column2">
	  		<h1>Kylastajate log t2nase p2eva kohta</h1>
	  		<p>
	  			
		    <?php
				    
					
				if (!empty($_SERVER['HTTP_CLIENT_IP'])){
				  $ip=$_SERVER['HTTP_CLIENT_IP'];
				
				}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
				  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
				}else{
				  $ip=$_SERVER['REMOTE_ADDR'];
				}
				
				    
			 	global $connection;
				$host="localhost";
				$user="test";
				$pass="t3st3r123";
				$db="test";
				$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
				mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));

				$sql= 'INSERT into saasma_eksam_ip(ip) values ("'.$ip.'") ';
				
							    
					$sqlselect='SELECT ip, timestamp FROM saasma_eksam_ip WHERE timestamp>= DATE_SUB(NOW(),INTERVAL 1440 MINUTE) ';

					$result1 = mysqli_query($connection, $sqlselect);
					if ($result1) {

						$ipquery = array();

						while($ips = mysqli_fetch_array($result1)) {
							$ipquery[] = $ips;
						}
					}


					$sqlcount = 'SELECT COUNT(*) FROM saasma_eksam_ip';

					$result2 = mysqli_query($connection, $sqlcount);

					if ($result2) {

						$countquery = array();

						while($count = mysqli_fetch_array($result2)) {
							$countquery[] = $count;
						}
					}
		
		    
			?>	

			<p>Oled lehel viibinud:</p>
   			<br/>
    		<label id="minutes">00</label>:<label id="seconds">00</label>

			<table>
				<tr>
					<td> IP aadress </td>
					<td> Kylastusaeg </td>
				</tr>
			<?php if (!empty($ipquery)) :?>
				<?php foreach ($ipquery as $ip) :?>
				<tr>
					<td>	
	  					<?php echo $ip['ip'] ?>
					</td>
					<td>
						<?php echo $ip['timestamp'] ?>
					</td>
				</tr>
				<?php endforeach; ?>
			<?php else:?>
				<p style="text-align: center;">No visitors.</p>
			<?php endif; ?>

			<p>
				Total visitors today: <?php foreach ($countquery as $count) :?>
				<?php echo $count[0]; ?>
				<?php endforeach; ?> 
			
			</table>

	  		</p>
		</div>
	  	<div class="column3">
	  		&nbsp;
	  	</div>
	</div>

<p id="html-validator">
	<a href="http://validator.w3.org/check?uri=referer" >
	<img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" style="position:absolute;bottom: 50px;left: 50px;"/>
	</a>
</p>
</body>
</html>