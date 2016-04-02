<title>Profile</title>
<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
    session_destroy();
    header('Location:index.php');
}
$username = $_SESSION['username'];
if ($username != "admin") {
    session_destroy();
    header('Location:index.php');
}
if (isset($_POST['add_faculty'])) {
//    print_r($_POST);die();

    mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement') or die("Error connecting to database");
    $dept = $_POST['dept'];
    $getSSNSql = "SELECT max(ssn) as ssn1 from teacher where department_deptid=$dept order by ssn DESC";
    if ($getSSNResult = mysql_query($getSSNSql)) {
        $ssnRow = mysql_fetch_assoc($getSSNResult);
        $i = strlen($ssnRow['ssn1']);
        $j = 0;
        $ssn = '';
        while ($i > 0) {
            $ssn.=$ssnRow['ssn1'][$j];
            $j++;
            $i--;
        }
        $counter = intval($ssn);
        $counter++;
        $ssn = $ssnRow['ssn1'][0] . $ssnRow['ssn1'][1] . strval($counter);
        if (!empty($_POST['name']) and !empty($_POST['dept']) and !empty($_POST['phone']) and !empty($_POST['email'])) {
            $name = trim(mysql_real_escape_string($_POST['name']));
            $phone = trim(mysql_real_escape_string($_POST['phone']));
            $email = trim(mysql_real_escape_string($_POST['email']));
            $deptid = $_POST['dept'];
            $insertFacultySql = "INSERT INTO `teacher` (`ssn`, `name`, `department_deptid`, `phno`, `email`) VALUES ('$ssn', '$name', '$deptid', '$phone', '$email')";

            if (!$insertResult = mysql_query($insertFacultySql)) {
                echo "<div class='alert alert-danger' align='center'>An error occured during registering $name</div>";
            } else {
                echo "<div class='alert alert-success' align='center'>$name added Successfully.</div>";
            }
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
                    <li><img id="profile" src="<?php if (isset($imgpath)) echo $imgpath; else echo "../images/default.png"; ?>" style="width:100%; height:40%;border-radius: 50%;" onmouseover="display();" onmouseout="dontdisplay();" onclick="location.href='../logout.php'"></li>
                    <li style="font-size: 20;"><a href="students.php">Students</a></li>
                    <li class="active" style="font-size: 20;"><a href="addFaculty.php">Faculty</a></li>
                    <li style="font-size: 20;"><a href="">Department</a></li>
                    <li style="font-size: 20;"><a href="">Assign HOD</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <!--<h1 class="page-header">Add Faculty</h1>-->
                <div class="body">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#listfaculty" data-toggle="tab">List Faculty</a>
                                </li>

                                <li><a href="#addfaculty" data-toggle="tab">Add faculty</a>
                                </li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="listfaculty">
                                    <h4>Faculty List</h4>
                                    <input type="text" id="key" class="form-control" placeholder="Search Faculty..." onkeyup="search_key();">
                                    <div class="span12" id="searchResults"></div>
                                </div>
                                <div class="tab-pane fade" id="addfaculty">
                                    <form  id="add_faculty_form" method="POST">
                                        Name: <input type="text" name="name" id="name" class="form-control" style="width: 300px;" placeholder="Name of the faculty"/>
                                        Department: <select name="dept" id="dept" class="form-control" style="width: 300px" onchange="displayCourses();">
                                            <option value="">select...</option>
                                            <?php
                                            mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement') or die("Error");
                                            $semSql = "SELECT * from department";
                                            if ($deptResult = mysql_query($semSql)) {

                                                while ($result = mysql_fetch_assoc($deptResult)) {
                                                    if ($result['deptid'] != 999)
                                                        echo "<option value=\"{$result['deptid']}\">{$result['deptname']}</option>";
                                                }
                                            }
                                            else {
                                                die(mysql_error());
                                            }
                                            ?>
                                        </select>
                                        Phone: <input type="text" name="phone" class="form-control" id="phone" style="width: 300px" placeholder="Phone Number"/>
                                        Email: <input type="text" name="email" class="form-control" id="email" style="width: 300px" placeholder="Email Id"/>
                                        <hr style="width: 50px">
                                        <input type="submit" name="add_faculty" class="btn btn-success form-control" style="width: 300px" value="Add Faculty"/>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    function search_key()  {
        var input=document.getElementById('key').value;
        var xmlhttp;
        //alert(input);
        if(input.length<1)  {
            document.getElementById("searchResults").innerHTML="";
            return false;
        }
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();

        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            //alert("active");
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("searchResults").innerHTML=xmlhttp.responseText;
            }

        }
        url="searchFaculty.php?q="+input;
        xmlhttp.open("GET",url,true);
        xmlhttp.send();
    }
</script>