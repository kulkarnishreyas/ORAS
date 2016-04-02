<%@page import="java.sql.*"%>
<%@page import="java.util.Date"%>
<%@include file="header.jsp"%>
<%@ page import="java.io.*"%>

<HTML>
<BODY>
<%
String layoutid=request.getParameter("layoutid");
String area=request.getParameter("area");
String map=request.getParameter("map");
String city=request.getParameter("city");
String state=request.getParameter("state");
String facilities=request.getParameter("facilities");
try
{
Connection c;
Statement s;
ResultSet rs;
  PreparedStatement psmt=null;
Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
c=DriverManager.getConnection("jdbc:odbc:info");
s=c.createStatement();
String sql="update layout set layoutid='"+layoutid+"',area='"+area+"',city='"+city+"',state='"+state+"',facilities='"+facilities+"' where layoutid='"+layoutid+"'";
s.executeUpdate(sql);

sql="update layout set map=? where layoutid=?";


  psmt=c.prepareStatement(sql);

  File image=new File("C:/Tomcat 5.5/webapps/ROOT/citi/images/"+map);
FileInputStream  fis=new FileInputStream(image);
  
  psmt.setBinaryStream(1, (InputStream)fis, (int)(image.length()));
  
  psmt.setString(2,layoutid);
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
