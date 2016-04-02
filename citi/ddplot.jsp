<%@ page contentType="text/html; charset=iso-8859-1" language="java" import="java.sql.*" errorPage="" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<p align="center" class="tophead"> View plot Information [Delete] Information </p> <table align ="center"  bgcolor="#ffffff" border="1" BORDERCOLOR="#E6E6FA" cellpadding="0" cellspacing="0"><%
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
<form name="f1" action="ddplot.jsp">
<input type="hidden" name="action" value="action">
<%
rs=s.executeQuery("select distinct(plotid) from plot");
%>
<font face="verdana" size="2" color="#000080"><b><i>Select the plotid &nbsp;&nbsp; </i></b></font> <select name="plotid" size="1" onChange="form.submit()">
<option value="-2" >Select </option>
<option value="-1" >All </option>
<%
while(rs.next())
{%>
<option><%=rs.getString("plotid")%></option>
<%
}
%>
</select>
</form>
<%
}
else
{
String plotid=request.getParameter("plotid");
rs=s.executeQuery("select distinct(plotid) from plot");
%>
<form name="f1" action="ddplot.jsp">
<input type="hidden" name="action" value="action">
<font face="verdana" size="2" color="#000080"> <b><i> Select the plotid </b></i></font> <select name="plotid" size="1" onChange="form.submit()">
<%if(plotid.equals("-2")) { %> <option value="-2" selected>Select</option> <% } else  { %> <option value="-2" >Select </option> <% }
if(plotid.equals("-1")) { %> <option value="-1" selected>All</option> <% } else  { %> <option value="-1" >All </option> <% }
while(rs.next())
{
String mplotid=rs.getString("plotid");
if(mplotid.equals(plotid))
{
%>
  <option selected><%=mplotid%></option>
<%
}
else
{
%> <option><%=mplotid%></option>
 <%
}
}
%>
 <tr><td> <table align ="center"  bgcolor="#ffffff" border="1" BORDERCOLOR="#E6E6FA" cellpadding="0" cellspacing="0">
<%
if(plotid.equals("-1"))
rs=s.executeQuery("select * from plot");
else
rs=s.executeQuery("select * from plot where plotid='"+plotid+"'");
%>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>plotid</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>layoutid</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>size</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="210"> <font face="Verdana" size="2" color="#FFFFFF"><b>price</b></font></td>
<td align="center" height="25" bgcolor="#4169E1" width="150"> <font face="Verdana" size="2" color="#FFFFFF"><b>availability</b></font></td>

<TD align="center" height="25" bgcolor="#4169E1"><font face="Verdana" size="2" color="#FFFFFF">&nbsp;<b>Delete</b>&nbsp;</font></td>
</tr>
<%
while(rs.next())
{
%>
<tr>
<%
 String ff=rs.getString("plotid");
%>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=ff%></td><td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("layoutid")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("size")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("price")%></td>
<td class="colss">&nbsp;&nbsp;&nbsp;<%=rs.getString("availability")%></td>

<td class="colss"><img src="image.jsp?imgid=<%=ff%>" width="200" height="200"> </td>

<td align="center"><a href="dplot.jsp?plotid=<%=ff%>" onClick="javascript:return confirm('Do you wish to delete?')">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/delete.gif" border="0" width="18" height="12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a></td>
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
