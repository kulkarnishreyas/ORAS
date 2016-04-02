<%@page import="java.sql.*"%>
<%@page import="java.util.Date"%>
<%@include file="header.jsp"%>
<HTML>
<head><title>edit staff Information</title>
<script language="javascript">
function validate()
{
if(document.f1.layoutid.value=="")
{
alert("please enter the value for layoutid");
document.f1.layoutid.focus();
return false;
}
else if(document.f1.area.value=="")
{
alert("please enter the value for area");
document.f1.area.focus();
return false;
}
else if(document.f1.map.value=="")
{
alert("please enter the value for map");
document.f1.map.focus();
return false;
}
else if(document.f1.city.value=="")
{
alert("please enter the value for city");
document.f1.city.focus();
return false;
}
else if(document.f1.doj.state=="")
{
alert("please enter the value for state");
document.f1.state.focus();
return false;
}
else if(document.f1.facilities.value=="")
{
alert("please enter the value for facilities");
document.f1.facilities.focus();
return false;
}
else
{
return true;
}
}</script>
</head>
<link rel="stylesheet" type="text/css" href="mystyle.css"><%
String layoutid=request.getParameter("layoutid");
try
{
Connection c;
Statement s;
ResultSet rs;
ResultSet rs1;
Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
c=DriverManager.getConnection("jdbc:odbc:info");
s=c.createStatement();
Statement s2=c.createStatement();
Date dt=new Date();
rs=s.executeQuery("select * from layout where layoutid='"+layoutid+"'");
if(rs.next())
{
%>
<BODY>
<p align="center" ><font face="verdana" size="2" color="#000080"><b><u> Edit staff Information </u></b></p>
<table align="center" border="1" width="800"> <tr><td><FORM name="f1" action="mlayoutj.jsp" onSubmit="return validate()" >
<table>
<tr>
<td width="125" height="35" align="right" class="cols">layoutid&nbsp;&nbsp;&nbsp;</td>
<td height="35" > <input type="text" name="layoutid" size="35" value="<%=rs.getString("layoutid")%>"><img src="../images/ast.gif"> </td>
</tr>
<tr>
<td width="125" height="35" align="right" class="cols">area&nbsp;&nbsp;&nbsp;</td>
<td height="35" > <input type="text" name="area" size="35" value="<%=rs.getString("area")%>"><img src="../images/ast.gif"> </td>
</tr>
<tr>
<td width="125" height="35" align="right" class="cols">map&nbsp;&nbsp;&nbsp;</td>
<td height="35" > <input type="text" name="map" size="35" value="<%=rs.getString("map")%>"><img src="../images/ast.gif"> </td>
</tr>
<tr>
<td width="125" height="35" align="right" class="cols">city&nbsp;&nbsp;&nbsp;</td>
<td height="35" > <input type="text" name="city" size="35" value="<%=rs.getString("city")%>"><img src="../images/ast.gif"> </td>
</tr>
<tr>
<td width="125" height="35" align="right" class="cols">state&nbsp;&nbsp;&nbsp;</td>
<td height="35" > <input type="text" name="state" size="25" value="<%=rs.getString("state")%>"><img src="../images/ast.gif"> </td>
</tr>
<tr>
<td width="125" height="35" align="right" class="cols">facilities&nbsp;&nbsp;&nbsp;</td>
<td height="35" > <input type="text" name="facilities" size="35" value="<%=rs.getString("facilities")%>"><img src="../images/ast.gif"> </td>
</tr>

</table><tr><td width="800" > </td></tr><tr><td><img src="../images/ast.gif"> Mandatory Fields</td></tr><br>
<tr><td align="center"> <input type="submit" name="submit" value="submit"></td> &nbsp;&nbsp;&nbsp;</table>
</form>
</form>
</table>
</body>
<%
}
else
out.write("No such record exists");
s.close();

}
catch(Exception e)
{
out.write(""+e);
}
%>
</html>
