<%@page import="java.sql.*"%>
<%@page import="java.util.Date"%>
<%@include file="header.jsp"%>
<HTML>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<BODY >
<p align="center" class="tophead"> View Transaction Information Information </p> <table align ="center"  bgcolor="#ffffff" border="1" BORDERCOLOR="#E6E6FA" cellpadding="0" cellspacing="0"><%
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
<form name="f1" action="vtransaction.jsp">
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
rs=s.executeQuery("select distinct(clientid) from transaction");
%>
<form name="f1" action="vtransaction.jsp">
<input type="hidden" name="action" value="action">
<font face="verdana" size="2" color="#000080"> <b><i> Select the layoutid </b></i></font> <select name="clientid" size="1" onChange="form.submit()">
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
rs=s.executeQuery("select * from transaction");
else
rs=s.executeQuery("select * from transaction where clientid='"+clientid+"'");
%>
<tr>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>clientid</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>plotid</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>layoutid</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>amtpaid</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="150"> <font face="Verdana" size="2" color="#FFFFFF"><b>paiddt</b></font></td>
</tr>
<%
while(rs.next())
{
%>
<tr>
<%
 String ff=rs.getString("clientid");
%>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=ff%></td><td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("plotid")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("layoutid")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("amtpaid")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("paiddt")%></td>
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


