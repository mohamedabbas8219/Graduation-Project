<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css_admin/test.css">
 
  <link href="css_admin/admin.css" rel="stylesheet" type="text/css"/>
  
  <link rel="stylesheet" href="css_admin/bootstrap.min.css">
	<title></title>
      
        <style>
            #table {
     
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
   
    width: 60%;
   /* height: 400px;*/
    direction: rtl;
    border: solid 2px #8aa5ec;  
  border-radius: 40em;
}
            
        </style>
        
</head>
<body>

 <?php
  
  
 $conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 
  
  
  
 function all_courses($conn)
 {
 $crsids_sql="SELECT crs_id FROM allcourses";   
 $crsids_q=mysqli_query($conn,$crsids_sql);
 $crs_ids_f=mysqli_fetch_all($crsids_q,MYSQLI_NUM);  // number

 $crs_count_sql="SELECT count(crs_id) FROM allcourses";   
 $crs_count_q=mysqli_query($conn,$crs_count_sql);
 $crs_count_f=mysqli_fetch_all($crs_count_q,MYSQLI_NUM);  //    crs id
 $crs_count=$crs_count_f[0][0];
  $crs_ids=array();               /////////////////////////// array
  for($i=0,$ii=$crs_count;$i<$ii;$i++)
  {
     $crs_ids[$i]=$crs_ids_f[$i][0];
   }
   ////////////////////////////////////////////////////////// courses names
  $coursename_sql="SELECT crs_name FROM allcourses";
  $coursename_q=mysqli_query($conn,$coursename_sql);
  $coursename_f=mysqli_fetch_all($coursename_q,MYSQLI_NUM);
  $all_courses=array();
  for($i=0,$ii=$crs_count;$i<$ii;$i++)
  {
    $all_courses[$i]=$coursename_f[$i][0];
  }
     $all_courses_data=array('crs_ids'=>$crs_ids,'all_courses'=>$all_courses);
     return $all_courses_data;
 }
 
 $all_courses=all_courses($conn);
  $crs_id=$all_courses['crs_ids'];
 $crs_names=$all_courses['all_courses'];
 //print_r($crs_id) ;
 //print_r($crs_names); 
   
  ?>  
    
<center>
<table  style="margin-top: 15px;width:55%; font-size: 15px;" id="table">
<tr>

    <th style="width:15%;">م</th>
   <th> إسم المادة</th>
 <th></th>
 </tr>
 <?php
   for ($i=1;$i<count($crs_names);$i++)
   {
   echo "
     <form method='post'>
       <tr>
         <td>
  	   <center><b name='$crs_id[$i]'>$crs_id[$i]</b></center>
  	</td>
  	<td>
        <center><input type='text' name='crs_name$i' value='$crs_names[$i]'></center>
  	</td>
      <td>
<center>
 <input type='submit' name='save$i'   id='h4' value='حفظ التعديلات ' />
 <input type='submit' name='cancel$i' id='h4' value='إلغاء' />
 <input type='submit' name='delete$i' id='h4' value='حذف' />
</center>
</td>
  </tr>
  </form>
  ";
 }
 
   ?>
  <form method='post'>
      <tr>
          <td><center><b></b></center></td>
          <td>
              <center><input type='text' name='new_crs_name' value=''></center>
          </td>
          <td>
      <center>
     <input type='submit' name='add_new_crs' id='h4' value=' إضافة' />
     <input type='submit' name='cancel_new_crs' id='h4' value='إلغاء' />
     <button name='' id='h4' value='' >حذف</button>
</center>
  </td>
      </tr> 
 </form>
 
</table>
    <form method="post">
        <input type='submit' name='cancel_new_crs' id='h4' value='عرض التعديلات ' />
    </form>
    
</center>


<?php
$result_upd="";
 for($i=1;$i<count($crs_id);$i++)
   {
     if(isset($_POST["save$i"]))
     {
      $new_crs_name=$_POST["crs_name$i"] ;
     // echo $new_crs_name;
      $crsid=$crs_id[$i];
      if($new_crs_name!="")
      {
       update_crs($conn,$new_crs_name,$crsid);
       if(update_crs($conn,$new_crs_name,$crsid))
       {
         $result_upd= 'تم التعديل بنجاح';
       }
       else {
         $result_upd= 'تم التعديل بنجاح';
       }
      }
      else {
          $result_upd= 'عفوا لم يتم التعديل ';   
       }
     }
   }
 
   
   for($i=1;$i<count($crs_id);$i++)
   {
     if(isset($_POST["delete$i"]))
     {
      $crsid=$crs_id[$i];
      $max_crs_id=max_crs_id($conn)+1;
      if($crsid<$max_crs_id&&$crsid>0)
      {
       if(delete_crs($conn,$crsid))
       {
         $result_upd= 'تم الحذف بنجاح';
       }
       else {
         $result_upd= 'تم الحذف بنجاح';
       }
      }
      else {
          $result_upd= 'عفوا لم يتم الحذف ';   
       }
     }
   }
   
   if(isset($_POST["add_new_crs"]))
     {
      $new_crs_name=$_POST["new_crs_name"] ;
      $new_crs_id=max_crs_id($conn)+1;
      if($new_crs_name!="")
      {
       if(new_crs($conn,$new_crs_id,$new_crs_name))
       {
         $result_upd= 'تمت الاضافة بنجاح';
       }
       else {
          $result_upd= 'تمت الاضافة بنجاح';  
       }
      }
      else {
          $result_upd= 'عفوا لم تتم الاضافة';  
       }
     }
   
    function max_crs_id($conn)
   { 
     $max_crsid_sql = "SELECT MAX(crs_id)FROM allcourses";
       $max_crsid_q=mysqli_query($conn,$max_crsid_sql);
      $max_crsid_f=mysqli_fetch_all($max_crsid_q,MYSQLI_NUM);
      $max_crsid=$max_crsid_f[0][0];
       return $max_crsid;
   }  
     
  function new_crs($conn,$new_crs_id,$new_crs_name)
   {
       $new_crs_q = "insert into allcourses(crs_id,crs_name) values($new_crs_id,'$new_crs_name')";
        $conn->query($new_crs_q);
   }

   function update_crs($conn,$new_crs_name,$crsid)
   {
     $upd_crs_q = "UPDATE allcourses SET crs_name='$new_crs_name' WHERE crs_id=$crsid";
        $conn->query($upd_crs_q);
   }
   
   function delete_crs($conn,$crsid)
   {
     $delete_crs_q = "DELETE from allcourses WHERE crs_id=$crsid";
        $conn->query($delete_crs_q);
   }
   
   
   ?>

<center><h1><?php echo $result_upd; ?></h1></center>
</body>
</html>