<html>
    <head>
        <title>LOGIN</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css_admin/login.css">
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    
        <!--  for home  -->
        <link href="css/Home.css" rel="stylesheet" type="text/css"/>
        
        <script>
        function empty_input()
        {
           // document.getElementById("un").value ="";
            //document.getElementById("pss").value ="";
            document.getElementById("un").focus();
        }
        </script>
    
    </head>
    <body onpageshow="empty_input()">
    
   <?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>
<div class="container">
    <?php
       
        if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
            include 'user.php';
            $user = new User();
            $conditions['where'] = array(
                'dr_id' => $sessData['userID'],
              );
            $conditions['return_type'] = 'single';
            $userData = $user->getRows($conditions);
            
             header("Location:study_table.php");
            //header("userAccount.php");
            //header("Location:Tables.php");
        }
        else{ 
            ?>
        
     <header>
            <div class="row">
                <ul class="nav">
                    <li class="active"><a href="http://localhost/Table_Proj_MA/Home.php"
                                          onmouseover="style='color:black;'">Home</a></li>
                </ul>
            </div>
     </header>
    
    
    <div class="b" id="b">
        <form action="userAccount.php" method="post" >
            <a href="#"><img src="images/logo.png"></a> 
           <h2>تسجيل الدخول للجداول الدراسية</h2> 
             
            <div class="i">
                <input  type="text" name="username" value='' id="un" required="">
		<label>username</label>
	    </div>
            
           <div class="i">
               <input  type="password" value='' name="password"  id="pss" required="" />
		<label>password</label>	
	</div>
           <center>
               <input type="reset"  name="" value="إلغاء التسجيل" 
                      style="margin-right: 8px; height: 40px; width: 100px; border:0px; border-radius: 8px;
                      color: #ffffff;  font-weight: bold; background-color:#09acdf;" onclick="empty_input()" />
               
            <input  type="submit" name="loginSubmit" value="تسجيل الدخول" onclick="init()" 
                    style="  font-weight: bold; background-color:#09acdf;  border-radius: 8px;"/>
             <?php echo !empty($statusMsg)?'<div class="alert alert-danger" align="center"><b>'.$statusMsgType.'">'.$statusMsg.'</b></div>':'';?>
           
            <br><br />
	<label><a href="">Forget password?</a></label>
          </center>
           
        </form>
    </div>
    
    <?php }
    
    ?>
    
</div>
    </body>
</html>

