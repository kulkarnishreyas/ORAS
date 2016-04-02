<title>Profile</title>
<?php
session_start();
mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement') or die();
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
<script type="text/javascript" src="../toastr.js"></script>
<link href="../toastr.css" rel="stylesheet">
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
                    <li class="active" style="font-size: 20;"><a href="students.php">Students</a></li>
                    <li style="font-size: 20;"><a href="addFaculty.php">Faculty</a></li>
                    <li style="font-size: 20;"><a href="">Department</a></li>
                    <li style="font-size: 20;"><a href="">Assign HOD</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <div class="body">
                    <?php
                    $uploadImgpath='';
                    $password='';
                    $bdate='';
                    $phno='';
                    $address='';
                    $email='';
                    if(isset($_POST['edit_details']))   {
                            if(!empty($_POST['prof']))  {
                                $uploadImgpath=  trim(mysql_real_escape_string($_POST['prof']));
                            }
                            if(!empty($_POST['name']))  {
                                $name=  trim(mysql_real_escape_string($_POST['name']));
                            }
                            if(!empty($_POST['password']))  {
                                $password=  trim(mysql_real_escape_string($_POST['password']));
                            }
                            if(!empty($_POST['bdate']))  {
                                $bdate=  trim(mysql_real_escape_string($_POST['bdate']));
                            }
                            if(!empty($_POST['phno']))  {
                                $phno=  trim(mysql_real_escape_string($_POST['phno']));
                            }
                            if(!empty($_POST['address']))  {
                                $address=  trim(mysql_real_escape_string($_POST['address']));
                            }
                            if(!empty($_POST['emailid']))  {
                                echo $_POST['emailid'];
                                die();
                                $email=  trim(mysql_real_escape_string($_POST['emailid']));
                            }
                            $updateSQL="UPDATE student SET imgpath='$uploadImgpath', name='$name', password='$password', bdate='$bdate',
                            phno='$phno', address='$address', email='$email' where usn='{$_POST['usn1']}'";
                            if(!$result=  mysql_query($updateSQL))  {
                                die(mysql_error());
                            }
                            else    {
                                echo "<script>toastr.success('Profile Updated Successfully');</script>";
                            }
                            
                            
                            
                            

                        }
                        if(isset($_GET['u']))   {
                            if(!empty($_GET['u']))  {
                                $usn=trim(mysql_real_escape_string($_GET['u']));
                                mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement') or die();
                                $fetchSQL="select * from student where usn='$usn'";
                                if(!$result=mysql_query($fetchSQL)) {
                                    die();
                                }
                                $row=  mysql_fetch_assoc($result);
                                
                            }
                            $deptid=$row['department_deptid'];
                            $deptSQL="select deptname from department where deptid=$deptid";
                            if(!$deptResult=  mysql_query($deptSQL))    {
                                die();
                            }
                            $deptRow=  mysql_fetch_assoc($deptResult);
                        }
                    ?>
                    <form id="edition" action="" method="POST">
                        <div class="span12"><div class="span3"><input type="file" name="prof" id="prof" style="display: none"><img src="<?php if($row['imgpath']=='') echo '../images/default.png'; else { echo '../'.$row['imgpath'];}?>" style="height:30%; border-radius: 15%" onclick="upload();"/></div><div class="span8"></div></div><br><hr>
                    <div class="span12"><div class="col-md-6">Name:<input type="text" name="name" class="form-control" value="<?php echo $row['name']?>"></div>
                    <div class="col-md-6">USN:<input type="text" disabled name="usn" class="form-control" value="<?php echo $row['usn']?>"></div></div>
                    <div class="col-md-6"><br>Department:<br><input type="text" disabled name="dept" class="form-control" value="<?php echo $deptRow['deptname']?>"></div>
                    <div class="col-md-6"><br>Password:<br><input type="password"  name="password" id="password" class="form-control" value="<?php echo $row['password']?>"><input type="checkbox" name="showchar" id="showchar" onchange="showcharacter();"> Show Characters</div>
                    <div class="col-md-4"><br>Date of Birth:<br><input type="date"  name="bdate" id="bdate" class="form-control datepicker" value="<?php echo $row['bdate']?>"><br>PhNo:<br><input type="text" name="phno" id="phno" class="form-control"></div>
                    
                    <div class="col-md-8"><br>Address:<br><textarea rows="5" name="address" id="address" class="form-control"><?php echo $row['address']?></textarea>
                    
                    </div>
                    <div class="col-md-6"><br>E-mail:<br><input type="email" name="emailid" id="email" class="form-control"></div>
                    <input type="hidden" name="usn1" value="<?php echo $row['usn']?>">
                    <div class="col-md-12">
                        <hr>
                    <input type="submit" class="form-control btn btn-info" name="edit_details" value="Update" style="width: 20%">
                    </div>
                    </form>
            </div>
            
            </div>
        </div>
</body>
    <script>
    function display()  {
        
        document.getElementById("profile").style.opacity="0.5";
    }
        function dontdisplay()  {
        
        document.getElementById("profile").style.opacity="1";
    }
    function upload()   {
        document.getElementById("prof").click();
    }
    function showcharacter()    {
        if(document.getElementById("showchar").checked) {
            document.getElementById("password").type="text";
        }
        else    {
            document.getElementById("password").type="password";
        }
    }
</script>


