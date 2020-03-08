<html><head>
<meta charset="utf-8">
	<title>Registeration</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
    </head>
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

<?php
// Register code

/* try 
  {
  // good work
  echo '<head><meta charset="utf-8"></head>';

  $con = mysql_connect("localhost","root","");
  if(!$con)
  {
  die('Can not connect: ' . mysql_error());
  }

  mysql_select_db("mytables",$con);
  //$mid="select dr_id from doctors where username='mk'";
  $query = "insert into doctors(dr_fullname,username,password)
  VALUES('$_POST[fullname]','$_POST[username]','$_POST[password]')";       //$_POST[password]
  //if(!mysql_query($mid,$con))
  if(!mysql_query($query,$con))
  {
  die('Error: '.mysql_error());
  }
  echo 'Your data Send';
  mysql_close($con);
  // $result = mysqli_query($conn,$query);
  //$row = mysqli_fetch_row($result);
  }
  catch (PDOException $e)
  {
  echo 'Sorry some thing goes wrong , please try again ';
  } */
/* //////////////////////////////////////////////////////// */

$conn = new mysqli("localhost", "root","", "mytables");
// Change character set to utf8
 mysqli_set_charset($conn,"utf8");

   // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 




$allcount_users_sql="SELECT count(username) FROM doctors";
 $allcount_users_q=mysqli_query($conn,$allcount_users_sql);
 $allcount_users_f=mysqli_fetch_all($allcount_users_q,MYSQLI_NUM);  //    crs id
 $allcount_users=$allcount_users_f[0][0];
 echo ''.$allcount_users;
$allpasswordsarray=array();
$allusersarray=array();
$current_user;
$current_pass;
 $allusersarray_sql="SELECT username FROM doctors";
 $allusersarray_q=mysqli_query($conn,$allusersarray_sql);
 $allusersarray_f=mysqli_fetch_all($allusersarray_q,MYSQLI_NUM);  //    crs id
 
 
  
  
$allpasswordsarray_sql="SELECT password FROM doctors";
 $allpasswordsarray_q=mysqli_query($conn,$allpasswordsarray_sql);
 $allpasswordsarray_f=mysqli_fetch_all($allpasswordsarray_q,MYSQLI_NUM);  //    crs id
 
  for($i=0,$ii=6;$i<$ii;$i++)
  {
    $allusersarray[$i]=$allusersarray_f[0][$i];
     $allpasswordsarray=$allpasswordsarray_f[0][$i];
  }
 if(isset($_POST['username']))
 { for($i=0,$ii=6;$i<$ii;$i++)
  {
        if($_POST['username']===$allpasswordsarray[$i]&&$_POST['password']===$allusersarray[$i])
        {
            $current_user=$allusersarray[$i];
            $current_pass=$allpasswordsarray[$i];
            
        }
 }
 
        
 
 if($current_user==null) {
          
     }
    
 }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>login</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        
        
        
        <form class="login" method="post" >
            <h2 class="text-center">Log in</h2>
            <input class="form-control input-lg" type="text" name="username" placeholder="Username" onfocus="this.value = ''"/>
            <input class="form-control input-lg" type="text" name="password" placeholder="Password" autocomplete="off" onfocus="this.value = ''"/>

            <input class="btn btn-primary btn-block input-lg" type="submit" value="Send" name="submit">
           <br /> 
           <b id="message"></b>

        </form>

    </body>
</html>
