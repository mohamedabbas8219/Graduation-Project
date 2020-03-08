<!DOCTYPE html>
<html>
<head>
       <link href="css_admin/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css_admin/test.css" rel="stylesheet" type="text/css"/>
	<title></title>
        
     <script>

    function myFunction() {
    if (window.top === window.self)  
    {                 
        // location.replace('http://localhost/Table_Proj_MA/index.php?logoutSubmit=1',"_self");
       //  window.open('http://localhost/Table_Proj_MA/index.php?logoutSubmit=1', '');
            window.close();
            window.open('index.php?logoutSubmit=1', "");
       // parent.window.close();
       } 
       else { 
      // location.replace('http://localhost/Table_Proj_MA/index.php?logoutSubmit=1', '');
      window.open('index.php?logoutSubmit=1', '');
      parent.window.close();
     // window.self.close();
    } 
}
</script>


        
</head>
<body>
   
    <div class="variables_html">
 
    </div>
    <div style="height: 60px;"> 
<div class="header" style="height: 22px;">
</div>
<div class="b" style="height: 94px; margin-bottom: 0px;"> 
    <img src="admin.jpg" class="img"  align="right" style="height:78px;">
<span class="s">ADMIN PAGE</span>
</div>
<!--<div class="log_reg_home" style="color: black; top: -2px; font-size: 18px; right:25px; position:absolute;">
   <a href=""  class="logout" style="color: white; "  name="log" onclick="myFunction()">Logout</a>
    <a href="http://localhost/Table_Proj_MA/index.php?logoutSubmit=1" class="logout" style="color: white; " >تسجيل الخروج</a>
      ,parent.window.close(),window.open('http://localhost/Table_Proj_MA/index.php?logoutSubmit=1', '')
      
      <a href="" class="logout" style="color: white; " onclick="javascript:var win = window.open('http://localhost/Table_Proj_MA/index.php?logoutSubmit=1', '_self');win.close();return false;">Logout</a>
      
      http://localhost/Table_Proj_MA/index.php?logoutSubmit=1 
      javascript:var win = window.open('', '_self');win.close();return false;
     
   </div> -->
    </div>
</body>
</html>
