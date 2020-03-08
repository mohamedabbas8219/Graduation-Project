<!DOCTYPE html>
<html>
<head>
    <script src="js/jquery-3.2.1.min"></script>
     <script src="js/bootstrap.min.js"></script>
     
     
       <link href="css_admin/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="css_admin/adm.css" rel="stylesheet" type="text/css"/>
    <style>

#m{text-align: right; background-color: white;}
#n{text-align: right;}
#y{text-align: right;}
#z{text-align: right;}
#w{text-align: right;}

#selected{
    text-align: right; 
    background-color: #e4e2e2;}
   
    </style>
    
   	<title>تنظيم الجداول الدراسية</title> 
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link href="css/divv.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <?php
   echo '<b style="display:none;">';
   include_once 'loginDrName.php';
   echo '</b>';
$i=0;
//if($logged_username=="admin")
if($userData['username']&&$userData['username']=="admin"&&$userData['password']=="admin")
{
    //echo "<br /><br />".$userData['password']."   ".$userData['username']."<br /><br /><br /><br />";
    ?>
<div id="wraper" style="background-color: silver; height: 100px;" >
    <a href="http://localhost/Table_Proj_MA/userAccount.php?logoutSubmit=1" style="color: blue; border-top-right-radius:22% 100%; 
       background-color: #f8f8f8; font-size: 18px; position: fixed; top: -3px; text-decoration: none;" 
       onmouseover="this.style.background='#8aa5ec',this.style.color='white'"
       onmouseout="this.style.background='whitesmoke',this.style.color='blue'">
        <b>   تسجيل الخروج   &nbsp;&nbsp;</b></a>
    <div id="menutop">
       <iframe src="header2.php" width="100%" height="120px" float="top" id="zz"  ></iframe>
    </div>
    <div style="float:top; margin-bottom: 22px;  margin-top: 8px;">
        
     <div style="float: right; width: 23%; ">
     <!--<iframe src="right.php" id="x" style="float: right; height:100%; width: 23%;  margin-top: 22px;" ></iframe>
      -->  
      <a href="Home.php"  class="list-group-item" id="m" style="background-color: #8aa5ec; color: white; "><h4> إملأ البيانات </h4></a>
      <a href="adm_add_all_courses_h.php" class="list-group-item" id="m">المواد التي تدرس بالكلية<h4></h4></a>
      <a href="adm_insert_groups_h.php" class="list-group-item" id="m">اضافة فرق الكلية</a>
      <a href="adm_add_drs_h.php" class="list-group-item" id="m"> تسجيل بيانات الدكتور </a>
      <a href="adm_add_stand_h.php" class="list-group-item" id="m"> اضافه المدرجات  </a>
        <a href="http://localhost/sections/sec_adm_add_drs_h.php" class="list-group-item" id="m"> تنظيم السكاشن والمعيدين  </a>
      <!--<a href="left.html" target="left"> <a href="adm_insert_gr_in_stand.php" id="y" target="left" class="list-group-item" onclick="reeeeed();"> تعبئة الفرق بالمدرجات  </a></a>
      -->
      <div class="list-group-item" style="position:fixed; bottom: 12px; width: 23%; border-bottom-left-radius: 25% 100%; background-color: #8aa5ec;"></div>
      <script src="js/jquery-3.2.1.min.js"> </script>
        <script src="js/bootstrap.min.js"> </script>
      </div>  
        
        <div id="left">
            <iframe src="left.php"  style="position: fixed; left: 0px; width: 77%; height: 82%; " name="cont"></iframe>
        </div>
  </div>
   
    </div>

<?php
}
 else {
    header("Location:http://localhost/Table_Proj_MA/userAccount.php");
     }?>
</body>
</html>