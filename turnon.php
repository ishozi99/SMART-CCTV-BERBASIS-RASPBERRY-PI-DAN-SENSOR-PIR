<html>
<head>
<title>TURN ON MONITORING MOTION</title>
<title>Untitled Document</title>
</head>
<form action="#" method="post">
<body>
<center>Apakah Anda Ingin Menghidupkan Motion Detector?</center></br>
<center>
  
    <input type="submit" name="hidup" value="YES" onclick="alert('Motion Detector Active !');"></button>
	<input type="button" value="NO" onclick="self.close()">
</center>
</body>
</form>
</html>
<?php

// Funciones PHP del pin GPIO 17
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

  if ($_POST['hidup']) { 
   $a- exec("sudo python /var/www/html/PIR_NOTIFCAP.py -p");
   echo $a;
  }

  if ($_POST['apagar17']) { 
   $a- exec("sudo python /var/www/leds/gpio/17/apaga.py");
   echo $a;
  }

  if ($_POST['parpadear17']) { 
   $a- exec("sudo python /var/www/leds/gpio/17/parpadea.py");
   echo $a;
  }

 
?>
