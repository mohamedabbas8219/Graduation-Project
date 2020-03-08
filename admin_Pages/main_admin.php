<?php// $admin=filter_input(INPUT_GET, 'admin',  FILTER_SANITIZE_STRING); if($admin=="22"){

//include_once 'userAccount.php';
include_once 'loginDrName.php';
$logged_username=$userData['username'];
$Logged_pass=$userData['password'];

if($Logged_pass=="admin")
{
//echo $logged_username;
  
echo'
<html>
<head>
<title>تنظيم الجداول الدراسية</title> 
</head>

  
   <frameset rows="15%,*" noresize name="f" >
         <frame name="head" src="header.php"></frame>
    
     <frameset cols="80%,20%">
    <frame name="left" src="left.php"></frame>
    <frame name="right" src="right.php">
    </frame>
    </frameset>
      
</html>

';
}else { header("Location:index.php");}


