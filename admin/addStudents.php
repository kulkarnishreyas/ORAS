<?php
/*
* Reads the students using the excel file provided by the admin.
*/
include '../Classes/PHPExcel/IOFactory.php' ;
if(isset($_POST['uploadBtn']))	{
$inputFileName =$_POST['upload'];
// Read Excel workbook
try {
$inputFileType = PHPExcel_IOFactory:: identify($inputFileName) ;
$objReader = PHPExcel_IOFactory:: createReader($inputFileType) ;
$objPHPExcel = $objReader->load($inputFileName) ;
} catch (Exception $e) {
die(' Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' ": ' . $e->getMessage() ) ;
}
// Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0) ;
$highestRow = $sheet->getHighestRow() ;
$highestColumn = $sheet->getHighestColumn() ;
// Loop through each row of the worksheet in turn
$name='Anonymous';
$password='Abc@';
$increment=1234;
$department=1;
for ($row = 2; $row <= $highestRow; $row++) {
// Read a row of data into an array
$rowData = $sheet->rangeToArray('A' . $row . ':' . 'C' . $row, NULL, TRUE, FALSE) ;
//print_r($rowData);
//echo "<br>";
foreach($rowData as $v)     {
                  $i=0;
				  $name=$v[1];
                                  $dept=$v[2];
                  if($v[0][$i]=='2' && $v[0][$i+1]=='S' && $v[0][$i+2]=='D')  {
                    if(mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement'))	{
                      $sql="SELECT `usn` FROM `student` WHERE `usn`='$v[0]'";
                      if($query=mysql_query($sql))	{
					 // echo "ss<br>";
					//echo $v[0];	
                           if(mysql_num_rows($query)==0)    {
                                  $j=rand()%10;
                                  $k=rand()%10;
                                  $l=rand()%10;
                                  $name1=$name;
                                  $password1=$password."$increment";
                                  $increment++;
                                  if(strtoupper ($dept)=='CSE')             {//As and when departments get added, add conditional stmts
                                          $department=1;
                                  }
                                  else if(strtoupper ($dept)=='ISE'){
                                          $department=2;
                                  }
                                  else if(strtoupper ($dept)=='MECH')   {
                                          $department=3;
                                  }
                                  else if(strtoupper ($dept)=='CHEM')   {
                                          $department=4;
                                  }
                                  else if(strtoupper ($dept)=='CIVIL' or strtoupper($dept)=='CIV')   {
                                          $department=5;
                                  }
                                  else if(strtoupper ($dept)=='ECE' or strtoupper($dept)=='EC')   {
                                          $department=6;
                                  }
                                  else if(strtoupper ($dept)=='EE' or strtoupper($dept)=='EEE')   {
                                          $department=7;
                                  }
                                  else {
                                      die("Error in spreadsheet! Correct and try uploading again");
                                  }
                                  $sql="Insert into `student` (`usn`, `name`, `department_deptid`, `password`) values ('$v[0]', '$name', '$department', '$password1')";
                                  if($query=mysql_query($sql));
                                else  {
					//			die("ERROR1");
                                  //echo "<script type=\"text/javascript\">alert(\"Error in SQL query.\");</script>";
                                }
                           }

                    }
                  }
                  else          {
                  die("Error connecting to database.");
                  }
                  $i++;
}
}
}
echo "<div class=\"alert alert-success\" align=\"center\"><div class=\"glyphicon glyphicon-ok-sign\"></div> Students Uploaded successfully.</div>";
}
?>
<title>Profile</title>
<?php 
//session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['password']))	{
	session_destroy(); header('Location:index.php');
}
$username=$_SESSION['username'];
if($username!="admin")	{session_destroy(); header('Location:index.php');}	
?>
  </head>

  <body>
      
          <div class="col-md-12">
              <h1 class="page-header">Add newly registered students:</h1>
              <form action="" method="POST" id="file_extension">
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
      </body>
      </html>
            <script src="../jquery.validate.min.js"></script>
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
      </script>