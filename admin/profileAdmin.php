<title>Profile</title>
<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
    session_destroy();
    header('Location:../index.php');
}
$username = $_SESSION['username'];
if ($username != "admin") {
    session_destroy();
    header('Location:../index.php');
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">

<script type="text/javascript" src="../jquery-1.11.3.js"></script>
<script src="../bootstrap.min.js"></script>
<script src="../bootstrap.js"></script>
<title></title>

<!-- Bootstrap core CSS -->
<link href="../bootstrap.min.css" rel="stylesheet">
<link href="../bootstrap.css" rel="stylesheet">
<link href="../bootstrap-theme.css" rel="stylesheet">
<link href="../bootstrap-theme.min.css" rel="stylesheet">


<!-- Custom styles for this template -->
<link href="../dashboard.css" rel="stylesheet">

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
                    <li><a href="profileAdmin.php" style="font-size: 20;">Welcome <?php echo $_SESSION['name']; ?></a></li>
                    <li><a href="profileAdmin.php" style="font-size: 20;"><div class="glyphicon glyphicon-home"></div>Dashboard</a></li>
                    <li><a href="settingsAdmin.php" style="font-size: 20;"><div class="glyphicon glyphicon-cog"></div>Settings</a></li>
                    <li><a href="logout.php" style="font-size: 20;">Logout</a></li>
                    <li><a href="#" style="font-size: 20;">Help</a></li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div style="background-color: #333333"class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar" style="color: white">
                    <li><img id="profile" src="<?php if(isset($imgpath)) echo $imgpath; else echo "../images/default.png";?>" style="width:100%; height:40%;border-radius: 50%;" onmouseover="display();" onmouseout="dontdisplay();" onclick="location.href='../logout.php'"></li>
                    <li style="font-size: 20;"><a href="students.php">Students</a></li>
                    <li style="font-size: 20;"><a href="addFaculty.php">Faculty</a></li>
                    <li style="font-size: 20;"><a href="">Department</a></li>
                    <li style="font-size: 20;"><a href="">Assign HOD</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <div class="body">
<!--                <ul class="nav nav-tabs">
                    <li data-toggle="tab"><a>Students</a></li>
                    <li data-toggle="tab"><a>Faculty</a></li>
                    
                </ul>-->
                    
                </div>
            </div>
            
            </div>
        </div>
    </div>
    <script>
    function display()  {
        
        document.getElementById("profile").style.opacity="0.5";
    }
        function dontdisplay()  {
        
        document.getElementById("profile").style.opacity="1";
    }
</script>


