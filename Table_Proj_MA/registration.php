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



try {
    $pdo = new PDO('mysql://hostname=localhost;dbname=mytables', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    // $m=new PDO("select dr_id from doctors where username='oo'");
    //,,
} catch (PDOException $ex) {
    echo '<pre>';
    echo 'Sorry some thing goes wrong , please try again ';
    //echo $ex->getMessage();
    echo '<pre>';
}
$dr_id = 12;
$name = 'إيمان الديداموني';
$usern = "ed";
$pass = "123";

if (isset($_POST['submit'])) {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $sql = "INSERT INTO doctors (dr_fullname, username, password)
          VALUES ('$_POST[fullname]','$_POST[username]','$_POST[password]')";
    // use exec() because no results are returned
    if ($pdo->exec($sql)) {
        echo "New record created successfully";
    } else {
        echo "No Insertion";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registeration</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        
        
        
        <form class="login" method="post" >
            <h2 class="text-center">Create New Account</h2>
            <input class="form-control input-lg" type="text" name="fullname" placeholder="Full Name" onfocus="this.value = ''" />
            <input class="form-control input-lg" type="text" name="username" placeholder="Username" onfocus="this.value = ''"/>
            <input class="form-control input-lg" type="text" name="password" placeholder="Password" autocomplete="off" onfocus="this.value = ''"/>

            <input class="btn btn-primary btn-block input-lg" type="submit" value="Send" name="submit">


        </form>

    </body>
</html>
