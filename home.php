<?php

	require_once("session.php");
	
	require_once("class.user.php");
	$auth_user = new USER();
	
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>welcome - <?php print($userRow['user_email']); ?></title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style2 {font-weight: bold}
-->
</style>
</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand"> SMART CCTV RASPBERRY</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"></a></li>
            <li></a></li>
            <li></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['user_email']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="clearfix"></div>
    	
    
<div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">
    
    	<label class="h5">welcome : <?php print($userRow['user_name']); ?></label>
        <hr />
        
        <h2>
        <span class="glyphicon glyphicon-home"></span>  Welcome To The System Smart CCTV Raspberry</h2>
       	<hr />
		
        

        <p class="h4">User Home Page</p>


                <center>
<input type="submit" class="btn btn-info btn-lg" role="button"  value="TURN ON MOTION DETECTOR" onclick="myfunction1()"></a></button>
		<script>
    function myfunction1() {
    window.open("http://192.168.43.22/turnon.php", "_blank",  "toolbar=yes,scrollbars=no,resizable=yes,top=300,left=300,width=400,height=200");}
</script> </center>
		
		<br />
		<center>
<input type="submit" class="btn btn-info btn-lg" role="button"  value="TURN OFF MOTION DETECTOR" onclick="myfunction2()"></a></button>
		<script>
    function myfunction2() {
    window.open("http://192.168.43.22/turnoff.php", "_blank",  "toolbar=yes,scrollbars=no,resizable=yes,top=300,left=300,width=400,height=200");}
</script> </center>
		<br />
		<center>
		<form action="streamstar.php" method="post">
		<input type="submit" class="btn btn-info btn-lg" role="button" name="mati" value="VIEW VIDEO CCTV REALTIME"></a></button></form>
		</center>
		<br /><br />
		<center>
		 <a href="http://192.168.43.22/galeri/index2.php" class="btn btn-info btn-lg " role="button"><strong>VIEW PHOTO </strong></a></button>	
		</center>

        
	
        <p class="h4">&nbsp;</p>
        <p class="h4">&nbsp;</p>
        <p class="blockquote-reverse" style="margin-top:200px;"</p> 


     </p>
    </div>

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
//<?php

// Funciones PHP del pin GPIO 17
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

 // if ($_POST['hidup']) { 
  // $a- exec("sudo python /var/www/html/PIR_NOTIFCAP.py -p");
 //  echo $a;
  //}

 // if ($_POST['mati1']) { 
 //  $a- exec("sudo pkill -9 python");
 //  echo $a;
//  }

//  if ($_POST['mati2']) {
//   $a- exec("sudo pkill -9 python");
//   echo $a;
//  }
//
//?>

