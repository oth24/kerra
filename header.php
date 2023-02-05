
<?php
include('config/constants.php');  //include connection file
error_reporting(0);  // using to hide undefine undex errors
session_start(); //start temp session until logout/browser closed

?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>

    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <title>كراء  للتأجير</title>

    <link rel="stylesheet" href="css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php"> 
	  <img src="images/logo.jpg" alt=" Logo" class="img-rounded"  width="100" height="75"></a>
    </div>
	
    <ul class="nav navbar-nav " style="float: right;">
      <li ><a href="index.php"><h4>الرئيسية</h4></a></li>
	  <li ><a href="categories.php"><h4>الاقسام</h4></a></li>
      
      <li><a href="aboutus.php"><h4>من نحن؟</h4></a></li>
      <li><a href="contactus.php"><h4>اتصل بنا</h4></a></li>
	 
					<?php
						if(empty($_SESSION["user_id"])) // if user is not login
							{
								echo '<li ><a href="login_client.php" ><h4>تسجيل الدخول</h4></a> </li>';
						}else
							{
												$user_id=$_SESSION["user_id"];
												$user_name=$_SESSION["username"];
								echo  '	
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><h4>مرحباً : '.$user_name.' </h4><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="user_data.php?id='.$user_id.'" ><h4>بياناتي</h4></a></li>
          <li><a href="user-tool.php" ><h4>اعلاناتي</h4></a></li>
          <li><a href="request.php" ><h4> استقبال الطلبات </h4></a></li>
          <li><a href="user_orders.php" ><h4>طلباتي المرسله</h4></a></li>
          <li><a href="logout.php" ><h4>خروج</h4></a></li>
		 
        </ul>
      </li>	';		

							}

						?>
	   <li>
	  <form class="navbar-form navbar-left" action="tool-search.php" method="POST">
  <div class="input-group">
    <input type="text" class="form-control" name="search" placeholder="Search Tool">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
  </div>
</form>
</li>
    </ul>
	</h4>
  </div>
  <br>
  <br>
  
</nav>
  