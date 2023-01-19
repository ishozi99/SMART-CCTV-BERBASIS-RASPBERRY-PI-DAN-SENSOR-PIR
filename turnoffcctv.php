<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>TURN OFF MONITORING MOTION</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<form action="#" method="post">
<body>
<center>Apakah Anda Ingin Mematikan CCTV ?</center></br>
<center>
  
    <input type="submit" name="mati" value="YES" onclick="alert('CCTV TURN OFF !');"></button>
	<input type="button" value="NO" onclick="self.close()">
</center>
</body>
</form>
</html>
<?php

// Funciones PHP del pin GPIO 17
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

  if ($_POST['mati']) { 
   $a- exec("sudo pkill -9 python");
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
