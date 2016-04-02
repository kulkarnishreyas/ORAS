<title>Profile</title>
    <?php
session_start();
$successful=FALSE;
if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
    session_destroy();
    header('Location:../index.php');
}
$username = $_SESSION['username'];
if ($username != "admin") {
    session_destroy();
    header('Location:../index.php');
}
mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement') or die();
if(isset($_POST['deregisterbutton']) and isset($_POST['courses'])) {
    $course_id=trim(mysql_real_escape_string($_POST['courses']));
    $usn=trim(mysql_real_escape_string($_POST['usn']));
    if($course_id!='')  {
    $deleteSQL="DELETE from perceives where student_usn='$usn' and course_course_id='$course_id'";
    if(!mysql_query($deleteSQL))    {
        echo mysql_error();
        die();
        echo "<script type='text/javascript'>toastr.error('There was an error while performing the activity.');</script>";
    }
 else {
        $successful=true;
        //die();
    }
    }
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
<link href="../toastr.css" rel="stylesheet">
<script src="../toastr.js">
</script>
<script>
    function display_toastr()   {
        toastr.success("Student deregistered from course");
    }
</script>


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
                    <li class="active" style="font-size: 20;"><a href="students.php">Students</a></li>
                    <li style="font-size: 20;"><a href="addFaculty.php">Faculty</a></li>
                    <li style="font-size: 20;"><a href="">Department</a></li>
                    <li style="font-size: 20;"><a href="">Assign HOD</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <div class="body">
                    <?php
                        if($successful) {
                    ?>
                    <script>display_toastr();</script>
                    <?php }?>
                    <?php
                        mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement') or die();
                        if(isset($_GET['u']))   {
                            if(!empty($_GET['u']))  {
                                $usn=trim(mysql_real_escape_string($_GET['u']));
                                $fetchSQL="select course_course_id from perceives where student_usn='$usn' and ese is NULL";
                                if(!$result=mysql_query($fetchSQL)) {
                                    die("ERROR2");
                                }
                                $nameSQL="select * from student where usn='$usn'";
                                $row1=  mysql_fetch_assoc(mysql_query($nameSQL));
                                $courseList="<select name='courses' id='courses' class='form-control'>";
                                while($row=  mysql_fetch_assoc($result))    {
                                    $courseNameSQL="select name from course where course_id='{$row['course_course_id']}'";
                                    if(!$courseNameResult=  mysql_query($courseNameSQL))    {
                                        die("ERROR1");
                                    }
                                    $nameRow=  mysql_fetch_assoc($courseNameResult);
                                    $courseList.="<option value='{$row['course_course_id']}'>{$nameRow['name']}</option>";
                                }
                                $courseList.="</select>";
                                
                            }
                            
                        }
                    ?>
                    <form id="edition" action="" method="POST">
                        <div class="span12"><div class="span3"><img src="<?php if($row1['imgpath']=='') echo '../images/default.png'; else { echo '../'.$row1['imgpath'];}?>" style="height:30%; border-radius: 15%"/></div><div class="span8"></div></div><br><hr>
                    <div class="span12"><div class="col-md-6">Name:<input type="text" name="name" disabled class="form-control" value="<?php echo $row1['name']?>"></div>
                    <div class="col-md-6">USN:<input type="text" disabled name="usn" class="form-control" value="<?php echo $row1['usn']?>"></div></div>
                    <input type="hidden" name="usn" value="<?php echo $row1['usn']?>">
                    <div class="col-md-12">Courses:<?php echo $courseList;?></div>
                    <br><hr>
                    <div class="col-md-12">
                    <br><hr>
                        <input type="submit" class="form-control btn btn-danger" name="deregisterbutton" value="Deregister" style="width: 20%">
                    </div>
                    </form>
            </div>
            
            </div>
        </div>
</body>
    
