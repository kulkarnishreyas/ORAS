<title>Profile</title>
<?php 


session_start();
if (isset($_SESSION['change']))
if($_SESSION['change']=="Y")	{
echo '<script type=\"text/javascript"\>alert(\"Passwords Changed Successfully!\n\");</script>';
echo "Passwords Changed Successfully!";
$_SESSION['change']='N';
}
if(!isset($_SESSION['username']) && !isset($_SESSION['password']))	{
	session_destroy(); header('Location:index.php');
}
$username=$_SESSION['username'];
if($username!="coe")	{session_destroy(); header('Location:index.php');}	

?>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    
    <script type="text/javascript" src="jquery-1.11.3.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="bootstrap.js"></script>
    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap.css" rel="stylesheet">
    <link href="bootstrap-theme.css" rel="stylesheet">
    <link href="bootstrap-theme.min.css" rel="stylesheet">
    

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
   
   

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
      
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Online Result Analysis System</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
              <li><a href="profileCOE.php" style="font-size: 20;"><div class="glyphicon glyphicon-home"></div>Dashboard</a></li>
              <li><a href="settingsCOE.php" style="font-size: 20;"><div class="glyphicon glyphicon-cog"></div>Settings</a></li>
            <li><a href="logout.php" style="font-size: 20;">Logout</a></li>
            <li><a href="#" style="font-size: 20;">Help</a></li>
          </ul>
          
        </div>
      </div>
    </nav>
      
    <div class="container-fluid">
      <div class="row">
        <div style="background-color: #e5e5e5" class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar"><li></li></ul>
          <ul class="nav nav-sidebar">
              <li class="active" style="font-size: 20;"><a href="profileCOE.php">Profile<span class="sr-only">(current)</span></a></li>
              <li style="font-size: 20;"><a href="">Upload ESE marks</a></li>
              <li style="font-size: 20;"><a href=""> Publish Results</a></li>
            <li style="font-size: 20;"><a href="">Check Particular Student Performance</a></li>
            
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header"><?php echo "Welcome ".strtoupper($_SESSION['name']);?></h1>
