<?php

try 
{
   $pdo = new PDO('mysql://hostname=localhost;dbname=mytables','root','',
           array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8',PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
   
}
catch (PDOException $ex)
{
    echo '<pre>';
    echo 'Sorry some thing goes wrong , please try again ';
    //echo $ex->getMessage();
    echo '<pre>';
}
$dr_id=12;
$name='إيمان الديداموني';
$usern="ed";
$pass="123";

if(isset($_POST['submit']))
{
    $name= filter_input(INPUT_POST,'name', FILTER_SANITIZE_STRING);
    $sql = "INSERT INTO doctors (dr_fullname, username, password)
          VALUES ('$name', '$usern', '$pass')";
    // use exec() because no results are returned
   if( $pdo->exec($sql))
   {
     echo "New record created successfully";
   }
 else 
     {
        echo "No Insertion"; 
     }
}







/*echo '<pre>';
var_dump(get_loaded_extensions());

echo '</pre>';

*/



// inerting in db by form 
// Register code
/*
try 
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
 
   // echo "<pre>$mid</pre>";
    mysql_close($con);
    
              // $result = mysqli_query($conn,$query);
		//$row = mysqli_fetch_row($result);
 
} 
catch (PDOException $e) 
{
    echo 'Sorry some thing goes wrong , please try again ';
}
*/
