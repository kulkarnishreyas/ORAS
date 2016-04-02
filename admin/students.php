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
mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement') or die("Error fetching data");
$getimageSQL="select imgpath from teacher where ssn='$username'";
if(!$result=  mysql_query($getimageSQL))    {
    die();
}
$imgRow=  mysql_fetch_assoc($result);
$imgpath="../".$imgRow['imgpath'];
include '../Classes/PHPExcel/IOFactory.php';
if (isset($_POST['uploadBtn'])) {
    $file=$_FILES['upload']['tmp_name'];
    
    copy($file, "../".$_FILES['upload']['name']);
    $inputFileName = "../".trim($_FILES['upload']['name']);
// Read Excel workbook
    
    
    try {
        $inputFileType = PHPExcel_IOFactory:: identify($inputFileName);
        $objReader = PHPExcel_IOFactory:: createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
    } catch (Exception $e) {
        die(' Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' ": ' . $e->getMessage());
    }
// Get worksheet dimensions
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();
// Loop through each row of the worksheet in turn
    $name = 'Anonymous';
    $password = 'Abc@';
    $increment = 1234;
    $department = 1;
    for ($row = 2; $row <= $highestRow; $row++) {
// Read a row of data into an array
        $rowData = $sheet->rangeToArray('A' . $row . ':' . 'C' . $row, NULL, TRUE, FALSE);
//print_r($rowData);
//echo "<br>";
        foreach ($rowData as $v) {
            $i = 0;
            $name = $v[1];
            $dept = $v[2];
            if ($v[0][$i] == '2' && $v[0][$i + 1] == 'S' && $v[0][$i + 2] == 'D') {
                if (mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement')) {
                    $sql = "SELECT `usn` FROM `student` WHERE `usn`='$v[0]'";
                    if ($query = mysql_query($sql)) {
                        // echo "ss<br>";
                        //echo $v[0];	
                        if (mysql_num_rows($query) == 0) {
                            $j = rand() % 10;
                            $k = rand() % 10;
                            $l = rand() % 10;
                            $name1 = $name;
                            $password1 = $password . "$increment";
                            $increment++;
                            if (strtoupper($dept) == 'CSE') {//As and when departments get added, add conditional stmts
                                $department = 1;
                            } else if (strtoupper($dept) == 'ISE') {
                                $department = 2;
                            } else if (strtoupper($dept) == 'MECH') {
                                $department = 3;
                            } else if (strtoupper($dept) == 'CHEM') {
                                $department = 4;
                            } else if (strtoupper($dept) == 'CIVIL' or strtoupper($dept) == 'CIV') {
                                $department = 5;
                            } else if (strtoupper($dept) == 'ECE' or strtoupper($dept) == 'EC') {
                                $department = 6;
                            } else if (strtoupper($dept) == 'EE' or strtoupper($dept) == 'EEE') {
                                $department = 7;
                            } else {
                                die("Error in spreadsheet! Correct and try uploading again");
                            }
                            $sql = "Insert into `student` (`usn`, `name`, `department_deptid`, `password`) values ('$v[0]', '$name', '$department', '$password1')";
                            if ($query = mysql_query($sql))
                                ;
                            else {
                                //			die("ERROR1");
                                //echo "<script type=\"text/javascript\">alert(\"Error in SQL query.\");</script>";
                            }
                        }
                    }
                } else {
                    die("Error connecting to database.");
                }
                $i++;
            }
        }
    }
    echo "<div class=\"alert alert-success\" align=\"center\"><div class=\"glyphicon glyphicon-ok-sign\"></div> Students Uploaded successfully.</div>";
}
if (isset($_POST['reguploadBtn'])) {
    
    $course_id = $_POST['course'];
    $sem = $_POST['sem'];
    $deptid = $_POST['dept'];
    if($deptid=="") {
        header('Location:students.php');
    }
    $file=$_FILES['regupload']['tmp_name'];
    copy($file, "../".$_FILES['regupload']['name']);
    $inputFileName = "../".$_FILES['regupload']['name'];
// Read Excel workbook
    
    //die();
    try {
        $inputFileType = PHPExcel_IOFactory:: identify($inputFileName);
        $objReader = PHPExcel_IOFactory:: createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
    } catch (Exception $e) {
        die(' Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' ": ' . $e->getMessage());
    }
// Get worksheet dimensions
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();
// Loop through each row of the worksheet in turn
    $name = 'Anonymous';


    for ($row = 2; $row <= $highestRow; $row++) {
// Read a row of data into an array
        $rowData = $sheet->rangeToArray('A' . $row . ':' . 'A' . $row, NULL, TRUE, FALSE);
//print_r($rowData);
//echo "<br>";
        foreach ($rowData as $v) {
            $i = 0;
            if ($v[0][$i] == '2' && $v[0][$i + 1] == 'S' && $v[0][$i + 2] == 'D') {
                if (mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement')) {
                    $sql = "SELECT `usn` FROM `student` WHERE `usn`='$v[0]'";
                    if ($query = mysql_query($sql)) {
                        // echo "ss<br>";
                        //echo $v[0];	
                        if (mysql_num_rows($query) != 0) {
                            $usnRow = mysql_fetch_assoc($query);
                            $usn = $usnRow['usn'];
                            $year = date('Y') . "-01-01";
                            $sql = "Insert into `perceives` (`student_usn`, `course_course_id`, `sem`, `year`) values ('$v[0]', '$course_id', '$sem', '$year')";
                            if ($query = mysql_query($sql))
                                ;
                            else {
                                //			die("ERROR1");
                                //echo "<script type=\"text/javascript\">alert(\"Error in SQL query.\");</script>";
                            }
                        }
                    }
                } else {
                    die("Error connecting to database.");
                }
                $i++;
            } else {
                
                echo "<div class=\"alert alert-danger\" align=\"center\"><div class=\"glyphicon glyphicon-ok-sign\"></div> Interrupt Occured while uploading records of " . $v[0] . "! Check the spreadsheet format and try.</div>";
            }
        }
    }
    echo "<div class=\"alert alert-success\" align=\"center\"><div class=\"glyphicon glyphicon-exclamation-sign\"></div> Students Uploaded successfully.</div>";
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
                    <li><img id="profile" src="<?php if (isset($imgpath)) echo $imgpath; else echo "../images/default.png"; ?>" style="width:100%; height:40%;border-radius: 50%;" onmouseover="display();" onmouseout="dontdisplay();" onclick="location.href='settingsAdmin.php'"></li>
                    <li class="active" style="font-size: 20;"><a href="students.php">Students</a></li>
                    <li style="font-size: 20;"><a href="addFaculty.php">Faculty</a></li>
                    <li style="font-size: 20;"><a href="">Department</a></li>
                    <li style="font-size: 20;"><a href="">Assign HOD</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <div class="body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">List Students</a>
                                </li>
                                <li><a href="#addstudent" data-toggle="tab">Add Students to system</a>
                                </li>
                                <li><a href="#messages" data-toggle="tab">Register Students to courses</a>
                                </li>
                                <li><a href="#settings" data-toggle="tab">Deregister students</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active span12" id="home">
                                    <h4>Student List</h4>

                                    <input type="text" id="key" class="form-control" placeholder="Search Student..." onkeyup="search_key();">
                                    <div class="span12" id="searchResults"></div>

                                </div>
                                <div class="tab-pane fade" id="addstudent">
                                    <div class="col-md-12">
                                        <h1 class="page-header">Add newly registered students:</h1>
                                        <form action="" method="POST" id="file_extension" enctype="multipart/form-data">
                                            <input class="file btn btn-default form-control" type="file" name="upload" id="upload" style="width: 300px;">
                                            Enter the spreadsheet(only <color style="color: #6d9dff">.xls, .csv</color> format)
                                            <hr align="left" style="width: 200px;">
                                            <input type="submit" class="btn btn-info" name="uploadBtn" value="Upload Student List" />
                                        </form>

                                        <div align="left" style="margin-right: 100px">
                                            <h3>Format of the spreadsheet that is to be uploaded:</h3>
                                            <p>The spreadsheet must contain three columns, 1) USN(i.e. University Seat Number) and 2) Name of Student. 3) Department (Use codes. For Lookup table, <a href="#" data-target="lookup_table" onclick="modalopen();">click here</a>)</p>
                                            <img src="../images/add_students.jpg" style="margin-right: 100px; width: 600px;height: 400px;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="messages">
                                    <div class="col-md-12">
                                        <h1 class="page-header">Register Students to courses:</h1>

                                        <form action="" method="POST" id="file_extension1" enctype="multipart/form-data">
                                            <select name="sem" id="sem" class="form-control" style="width: 100px">
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>Enter Semester<br>
                                            <select name="dept" id="dept" class="form-control" style="width: 200px" onchange="displayCourses();">
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
                                            </select>Department<br>
                                            <div id="show_courses"></div>

                                            <hr width="0"/>
                                            <input class="file btn btn-default form-control" type="file" name="regupload" id="regupload" style="width: 300px;">
                                            Enter the spreadsheet(only <color style="color: #6d9dff">.xls, .csv</color> format)
                                            <hr align="left" style="width: 200px;">
                                            <input type="submit" class="btn btn-info" name="reguploadBtn" value="Upload Student List" />
                                        </form>

                                        <div align="right" style="margin-right: 100px">

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="settings">
                                    <h4>Deregister Students from Subjects</h4>
                                    <input type="text" id="deregisterkey" class="form-control" placeholder="Search Student..." onkeyup="deregister();">
                                    <div class="span12" id="deregister_div"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <div class="modal fade" id="lookup_table" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #68d0de">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white">&times;</button>
                                    <h4 class="modal-title" align="center" style="color: white" ><div class="glyphicon glyphicon-info-sign"></div>&nbsp;&nbsp;LookUp Table</h4>
                                </div>
                                <div class="modal-body">

                                    <table class="table">
                                        <tr style="background-color: lightgray"><th>Department</th><th>Acronym</th></tr>
                                        <tr><td>Computer Science Engineering</td><td>CSE</td></tr>
                                        <tr><td>Information Science Engineering</td><td>ISE</td></tr>
                                        <tr><td>Mechanical Engineering</td><td>MECH</td></tr>
                                        <tr><td>Chemical Engineering</td><td>CHEM</td></tr>
                                        <tr><td>Civil Engineering</td><td>CIVIL</td></tr>
                                        <tr><td>Electronics Engineering</td><td>ECE</td></tr>
                                        <tr><td>Electrical Engineering</td><td>EE</td></tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" style="background-color: #68d0de" data-dismiss="modal">Close</button>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="../jquery.validate.min.js"></script>
    <script>
        function display()  {
        
            document.getElementById("profile").style.opacity="0.5";
        }
        function dontdisplay()  {
        
            document.getElementById("profile").style.opacity="1";
        }
        
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
            url="search.php?q="+input;
            xmlhttp.open("GET",url,true);
            xmlhttp.send();
        }
        function deregister()  {
            var input=document.getElementById('deregisterkey').value;
            var xmlhttp;
            //alert(input);
            if(input.length<1)  {
                document.getElementById("deregister_div").innerHTML="";
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
                    
                    document.getElementById("deregister_div").innerHTML=xmlhttp.responseText;
                }

            }
            url="search.php?d="+input;
            xmlhttp.open("GET",url,true);
            xmlhttp.send();
        }
        $(function() {
            $("#file_extension1").validate({
                  
            // Specify the validation rules
            rules: {
                      
                regupload: {
                    required:true,
                    extension: "xls|xlsx"
                },
                dept:   {
                    required: true,
                    notEqual: ""
                }
                      
            },
            // Specify the validation error messages
            messages: {
                      
                regupload: {
                    required: "<div style=\"color: red; font-size: 12\">This field is required.</div>",
                    extension: "<div style=\"color: red; font-size: 12\">Enter a valid spreadsheet.</div>"
                },
                dept:   {
                    required: "",
                    notEqual: "<div style=\"color: red; font-size: 12\">Enter a valid department.</div>"
                }
            },
                  
            submitHandler: function(form) {
                form.submit();
            }
        });
            $("#file_extension").validate({
                  
                // Specify the validation rules
                rules: {
                      
                    upload: {
                        required:true,
                        extension: "xls|xlsx"
                    }
                      
                },
                // Specify the validation error messages
                messages: {
                      
                    upload: {
                        required: "<div style=\"color: red; font-size: 12\">This field is required.</div>",
                        extension: "<div style=\"color: red; font-size: 12\">Enter a valid spreadsheet.</div>"
                    }
                },
                  
                submitHandler: function(form) {
                    form.submit();
                }
            });
              
              
        });
        function modalopen()  {
            $("#lookup_table").modal('show');
        }
        function displayCourses()  {
        var sem=document.getElementById("sem").value;
        var dept=document.getElementById("dept").value;
        if(dept=="")    {
            document.getElementById("show_courses").innerHTML="";
            return;
        }
        var xmlhttp;
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
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                //alert(xmlhttp.responseText);
                document.getElementById("show_courses").innerHTML=xmlhttp.responseText;
            }
        }
        senturl="fetchCourses.php?dept="+dept;
        xmlhttp.open("GET",senturl,true);
        xmlhttp.send();
    }
    </script>


