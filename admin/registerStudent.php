<?php
/*
 * Reads the students using the excel file provided by the admin.
 */
include '../Classes/PHPExcel/IOFactory.php';

if (isset($_POST['reguploadBtn'])) {
    $course_id=$_POST['course'];
    $sem=$_POST['sem'];
    $deptid=$_POST['dept'];
    $inputFileName = $_POST['regupload'];
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
                            $usnRow=  mysql_fetch_assoc($query);
                            $usn = $usnRow['usn'];
                            $year = date('Y')."-01-01";
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
            }else{
                echo "<div class=\"alert alert-danger\" align=\"center\"><div class=\"glyphicon glyphicon-ok-sign\"></div> Interrupt Occured while uploading records of ". $v[0]."! Check the spreadsheet format and try.</div>";
            
            }
        }
    }
    echo "<div class=\"alert alert-success\" align=\"center\"><div class=\"glyphicon glyphicon-exclamation-sign\"></div> Students Uploaded successfully.</div>";
}
?>
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
?>
</head>

<body>

    
            <div class="col-md-12">
                <h1 class="page-header">Register Students to courses:</h1>
                
                <form action="" method="POST" id="file_extension">
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
                            $semSql="SELECT * from department";
                            if($deptResult=  mysql_query($semSql)){
                                
                            while($result=  mysql_fetch_assoc($deptResult)) {
                                if($result['deptid']!=999)
                                echo "<option value=\"{$result['deptid']}\">{$result['deptname']}</option>";
                            }
                            }
                            else{
                                die(mysql_error());
                            }
                        ?>
                    </select>Department<br>
                    <div id="show_courses"></div>
                    
                    <hr width="0"/>
                    <input class="file btn btn-default form-control" type="file" name="regupload" id="upload" style="width: 300px;">
                    Enter the spreadsheet(only <color style="color: #6d9dff">.xls, .csv</color> format)
                    <hr align="left" style="width: 200px;">
                    <input type="submit" class="btn btn-info" name="reguploadBtn" value="Upload Student List" />
                </form>

                <div align="right" style="margin-right: 100px">

                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
<script src="jquery.validate.min.js"></script>
<script>
    $(function() {
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