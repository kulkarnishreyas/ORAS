<%@ page contentType="text/html; charset=iso-8859-1" language="java" import="java.sql.*" errorPage="" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<%
	int clientid=Integer.parseInt(request.getParameter("clientid"));
	String firstname=request.getParameter("firstname");
	String lastname=request.getParameter("lastname");
	String address1=request.getParameter("address1");
	String address2=request.getParameter("address2");
	String city=request.getParameter("city");
	String state=request.getParameter("state");
	int pincode=Integer.parseInt(request.getParameter("pincode"));
	int contactno=Integer.parseInt(request.getParameter("contactno"));
	 try
 {
  Connection c;
  Statement s;
  ResultSet rs;
  PreparedStatement psmt=null;
  Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
  c=DriverManager.getConnection("jdbc:odbc:info");
  s=c.createStatement();
String sql="insert into client(clientid,firstname,lastname,address1,address2,city,state,pincode,contactno) values(?,?,?,?,?,?,?,?,?)";
psmt=c.prepareStatement(sql);

psmt.setInt(1,clientid);
psmt.setString(2,firstname);
psmt.setString(3,lastname);
psmt.setString(4,address1);
psmt.setString(5,address2);
psmt.setString(6,city);
psmt.setString(7,state);
psmt.setInt(8,pincode);
psmt.setInt(9,contactno);

  int cs = psmt.executeUpdate();
  s.close();

 }
 catch(Exception e)
 {
  out.write(""+e);
 }
%>


</body>
</html>
