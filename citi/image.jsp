<%@ page import="java.sql.*,java.io.*,java.util.*" %> 
<%

String connectionURL = "jdbc:mysql://localhost:3306/userdetails";
if(request.getParameter("imgid")!=null && request.getParameter("imgid")!="")
{
	String id =  request.getParameter("imgid");

	Connection con=null;
	try{      
		Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
		con=DriverManager.getConnection("jdbc:odbc:info");      
		Statement st1=con.createStatement();
		String strQuery = "select map from layout where layoutid='"+id+"'";
		
		ResultSet rs1 = st1.executeQuery(strQuery);
	
		String imgLen="";
		if(rs1.next()){
			imgLen = rs1.getString(1);
	   	}  
		rs1 = st1.executeQuery(strQuery);
		if(rs1.next()){
			int len = imgLen.length();
			byte [] rb = new byte[len];
			InputStream readImg = rs1.getBinaryStream(1);
			int index=readImg.read(rb, 0, len);  
			st1.close();
			response.reset();
			response.setContentType("image/jpg");
			//response.setHeader("Content-disposition","attachment; filename=" +filename);
			response.getOutputStream().write(rb,0,len); 
			response.getOutputStream().flush();        
		}
	}
	catch (Exception e){
		e.printStackTrace();
	}
}
%>
