<?php
//require_once  'connection.php';
//$s=filter_input(INPUT_GET, 'id',FILTER_SANITIZE_NUMBER_INT);
//echo $s;

   $conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 
    
    function group_name($conn,$group_id)
    {
       $group_name_sql="SELECT st_group,dept FROM s_groups";   
       $group_name_q=mysqli_query($conn,$group_name_sql);
       $group_name_f=mysqli_fetch_all($group_name_q,MYSQLI_NUM);  // number
       $group_name=$group_name_f[1][0]."_".$group_name_f[1][1];
       return $group_name;
    }
    
    $group_name=group_name($conn,3);
 
    echo 'group_name  >>  '.$group_name;