<?php
mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement') or die("Error");
if(isset($_GET['dept']))    {
    if(!empty($_GET['dept']))  {
        
        $dept=trim(mysql_real_escape_string($_GET['dept']));
        $getCoursesSql="SELECT name, course_id FROM course WHERE department_deptid=$dept ORDER BY name ASC";
        if($coursesResult=mysql_query($getCoursesSql))  {
            $sentData="<select name=\"course\" class=\"form-control\" style='width: 250px'>";
            while($rowResult=  mysql_fetch_assoc($coursesResult))   {
                $sentData.="<option value=\"{$rowResult['course_id']}\">{$rowResult['name']}</option>";
            }
            $sentData.="</select>Select Course";
            echo $sentData;
        }
        
    }
}


?>
