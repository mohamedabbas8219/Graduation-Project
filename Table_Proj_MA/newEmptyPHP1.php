
<html>
    <head>
         <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>LOGIN</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
<!--        <style>.container {
    width: 40%;
    margin: 0 auto;
    background-color: #f7f7f7;
    color: #757575;
    font-family: 'Raleway', sans-serif;
    text-align: left;
    padding: 30px;
}
h2 {
    font-size: 30px;
    font-weight: 600;
    margin-bottom: 10px;
}
.container p {
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 20px;
}
.regisFrm input[type="text"], .regisFrm input[type="email"], .regisFrm input[type="password"] {
    width: 94.5%;
    padding: 10px;
    margin: 10px 0;
    outline: none;
    color: #000;
    font-weight: 500;
    font-family: 'Roboto', sans-serif;
}
.send-button {
    text-align: center;
    margin-top: 20px;
}
.text-center{
    text-align: center;
    margin-top: 20px; 
}
.send-button input[type="submit"] {
    padding: 10px 0;
    width: 60%;
    font-family: 'Roboto', sans-serif;
    font-size: 18px;
    font-weight: 500;
    border: none;
    outline: none;
    color: #FFF;
    background-color: #2196F3;
    cursor: pointer;
}
.send-button input[type="submit"]:hover {
    background-color: #055d54;
}
a.logout{float: right;}
p.success{color:#34A853;}
p.error{color:#EA4335;}</style></head>-->
    <body>
    
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
            include_once 'user.php';
            $user = new User();
            $conditions['where'] = array(
                'dr_id' => $sessData['userID'],
            );
            $conditions['return_type'] = 'single';
            $userData = $user->getRows($conditions);
         #  echo $userData['username'];
         # $_SESSION["name"]=$userData['username'];
            
            header("Location:study_table.php");
            // header("Location:new.html");
            //header("Location:Tables.php");
        } 
        
          elseif(!empty($sessData['userLoggedIn'])==false && !empty($sessData['userID'])){
            include_once 'user.php';
            $user = new User();
            $conditions['where'] = array(
                'dr_id' => $sessData['userID'],
            );
            $conditions['return_type'] = 'single';
            $userData = $user->getRows($conditions);
        
            header("http://localhost/admin_Pages/main_admin.php");
            
        } 
       
        else{ ?>
        
    <div class="regisFrm">
        <form action="userAccount.php" method="post" class="login">
            <h2 class="text-center">Login </h2>
              <?php echo !empty($statusMsg)?'<div class="alert alert-danger" align="center"><b>'.$statusMsgType.'">'.$statusMsg.'</b></div>':'';?>
            <input class="form-control input-lg" type="username" name="username" placeholder="UserName" required="">
            <input class="form-control input-lg" type="password" name="password" placeholder="Password" required="">
            <input class="btn btn-primary btn-block input-lg" type="submit" name="loginSubmit" value="LOGIN">
            <h4 class="text-center"> <a href="forgotPassword.php">Forgot password?</a></h5>
            <h4 class="text-center"> <p>Don't have an account? <a href="registration.php">Register</a></p></h5>
        </form>
    </div>
    <?php } ?>
    
</div>
    </body>
</html>


