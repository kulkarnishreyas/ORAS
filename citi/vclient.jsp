<%@page import="java.sql.*"%>
<%@page import="java.util.Date"%>
<%@include file="header.jsp"%>
<HTML>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<BODY >
<p align="center" class="tophead"> View client Information Information </p> <table align ="center"  bgcolor="#ffffff" border="1" BORDERCOLOR="#E6E6FA" cellpadding="0" cellspacing="0"><%
 try
 {
  Connection c;
  Statement s;
  ResultSet rs;
  Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
  c=DriverManager.getConnection("jdbc:odbc:info");
  s=c.createStatement();
if(request.getParameter("action")==null || request.getParameter("action").equals(""))
{
%>
<form name="f1" action="vclient.jsp">
<input type="hidden" name="action" value="action">
<%
rs=s.executeQuery("select distinct(clientid) from client");
%>
<font face="verdana" size="2" color="#000080"><b><i>Select the clientid &nbsp;&nbsp; </i></b></font> <select name="clientid" size="1" onChange="form.submit()">
<option value="-2" >Select </option>
<option value="-1" >All </option>
<%
while(rs.next())
{%>
<option><%=rs.getString("clientid")%></option>
<%
}
%>
</select>
</form>
<%
}
else
{
String clientid=request.getParameter("clientid");
rs=s.executeQuery("select distinct(clientid) from client");
%>
<form name="f1" action="vclient.jsp">
<input type="hidden" name="action" value="action">
<font face="verdana" size="2" color="#000080"> <b><i> Select the plotid </b></i></font> <select name="clientid" size="1" onChange="form.submit()">
<%if(clientid.equals("-2")) { %> <option value="-2" selected>Select</option> <% } else  { %> <option value="-2" >Select </option> <% }
if(clientid.equals("-1")) { %> <option value="-1" selected>All</option> <% } else  { %> <option value="-1" >All </option> <% }
while(rs.next())
{
String mclientid=rs.getString("clientid");
if(mclientid.equals(clientid))
{
%>
  <option selected><%=mclientid%></option>
<%
}
else
{
%> <option><%=mclientid%></option>
 <%
}
}
%>
 <tr><td> <table align ="center"  bgcolor="#ffffff" border="1" BORDERCOLOR="#E6E6FA" cellpadding="0" cellspacing="0">
<%
if(clientid.equals("-1"))
rs=s.executeQuery("select * from client");
else
rs=s.executeQuery("select * from client where clientid='"+clientid+"'");
%>
<tr>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>clientid</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>First Name</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>Last Name</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>Address1</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="150"> <font face="Verdana" size="2" color="#FFFFFF"><b>Address2</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="150"> <font face="Verdana" size="2" color="#FFFFFF"><b>City</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="150"> <font face="Verdana" size="2" color="#FFFFFF"><b>State</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="150"> <font face="Verdana" size="2" color="#FFFFFF"><b>Pincode</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="150"> <font face="Verdana" size="2" color="#FFFFFF"><b>Contact No.</b></font></td>
</tr>
<%
while(rs.next())
{
%>
<tr>
<%
 String ff=rs.getString("clientid");
%>


<td class="colss">&nbsp;&nbsp;&nbsp;<%=ff%></td><td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("clientid")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("firstname")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("lastname")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("address1")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("address2")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("city")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("state")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("pincode")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("contactno")%></td>
<td align="center"></td>
</tr>
<%
}%>
</table>
</table>
<%
s.close();
c.close();
}

}
catch(Exception e)
{
out.write(""+e);
}
%>
</body>
</html>



