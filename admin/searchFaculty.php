<?php
    mysql_connect('localhost', 'root') and mysql_select_db('resultmanagement') or die("Couldn't connect to DB");
    if(isset($_GET['q']))   {
        $key=trim(mysql_real_escape_string($_GET['q']));
        $searchSQL="select name, ssn, department_deptid, imgpath from teacher where ssn like '%$key%' or name like '%$key%' order by name ASC";
        if(empty($key)) {
            echo "No such records";
            die();
        }
        if(!$result=mysql_query($searchSQL))    {
            echo "Error1";
        }
        if(mysql_num_rows($result)==0)  {
            echo "No such records";
            die();
        }
        $str="<table class='table'>";
        while($row=  mysql_fetch_assoc($result))    {
            $deptSQL="select deptname from department where deptid={$row['department_deptid']}";
            if(!$deptResult=  mysql_query($deptSQL))    {
                die();
            }
            else    {
                $deptRow=  mysql_fetch_assoc($deptResult);
            }
            if(!empty($row['imgpath'])) {
                $imgpath="../".$row['imgpath'];
            }
            else    {
                $imgpath="../images/default.png";
            }
            $str.="<tr><td style='width:25%'><a href='viewFaculty.php?u={$row['ssn']}' target='blank'><img src='$imgpath' style='height:auto; width:30%'/></a></td><td style='width:25%;'><a href='viewFaculty.php?u={$row['ssn']}' target='blank'>{$row['name']}</a></td><td style='width:25%'><a href='viewFaculty.php?u={$row['ssn']}' target='blank'>{$row['ssn']}</a></td><td style='width:25%'>{$deptRow['deptname']}</td></tr>";
        }
        $str.="</table>";
        echo $str;
    }
 else {
     echo "error";
}
?>
