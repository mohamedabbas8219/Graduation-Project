<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css_admin/test.css">
	<link rel="stylesheet" href="css_admin/admin.css">
	<link rel="stylesheet" href="css_admin/bootstrap.min.css">
	<title></title>
</head>
<body>
 <?php
  $conn = new mysqli("localhost", "root","", "mytables");
   mysqli_set_charset($conn,"utf8");
  if ($conn->connect_error) 
   {
    die("Connection failed: " . $conn->connect_error);
   } 

   
  ///////////////////////////////////////////
   
   
      $result="";
    if (isset($_POST['save']))
     {
     $new_stand_name=$_POST['stand_name'];
     $capacity=$_POST['capacity'];
     $loc=$_POST['location'];

    if(!check_stand($conn,$new_stand_name,0))
      { 
         // $result="هذه الفرقة موجودة بالفعل";  
        if(add_stand($conn,$new_stand_name,$capacity,$loc))
        {
            $result="تم إضافة المدرج بنجاح";
           
         }
     else {
          $result="تم إضافة المدرج بنجاح";
        }
      }
      else {
        $result="هذا المدرج موجودة بالفعل";   
        }
    } 
       
    $stand_data_s2=stand_data($conn);
 $all_stands_id2=$stand_data_s2["stand_id"];
 $all_stands_name2=$stand_data_s2["stand_name"];
  for($i=0;$i<count($all_stands_id2);$i++)
  {
     if(isset($_POST["save$i"]))
     {
      $new_stand_id=$all_stands_id2[$i];
     $new_stand_name=$_POST["stand_name$i"];
     $capacity=$_POST["capacity$i"];
     $loc=$_POST["location$i"];
     $old_stand_name=$all_stands_name2[$i];
      if(!check_stand($conn,$new_stand_name,$new_stand_id))
      {
         if(modi_stand($conn,$old_stand_name,$new_stand_id,$new_stand_name,$capacity,$loc))
         {
         $result="تم التعديل بنجاح";
         }
         else {
            $result="تم التعديل بنجاح";
        //$result="عفوا لم يتم التعديل";  
             }
      } 
     else 
      {
       $result="هذا المدرج موجودة بالفعل";   
      }
     }
     
     if(isset($_POST["delete$i"]))
       {
          $new_stand_name=$_POST["stand_name$i"];
         delete_stand($conn,$new_stand_name);
          $result="تم حذف المدرج بنجاح";
         
      }
       if(isset($_POST["fill$i"]))
       {
          $new_stand_name=$_POST["stand_name$i"];
          
         // $upd_adm_q = "UPDATE admin_modi_states SET current_stand='$new_stand_name'";
           //   $conn->query($upd_adm_q);
               $redirectURL = "http://localhost/admin_Pages/adm_insert_gr_in_stand.php?action=fill&stand_name=$all_stands_name2[$i]";
                header("Location:" . $redirectURL);
              
      }
     } 
     
    // echo count($all_stands_id2);
 
   
   
   function check_stand($conn,$stand,$stand_id)
   {
       $result=0;
       $stands_c_sql="SELECT count(stand_id) FROM stands where stand_name='$stand' and stand_id<$stand_id or stand_name>$stand_id ";   
        $stands_c_q=mysqli_query($conn,$stands_c_sql);
        $stands_c_f= mysqli_fetch_all($stands_c_q,MYSQLI_NUM);
        $stand_id2=$stands_c_f[0][0];  
        
       
        if($stand_id2>0)
        {
          //  موجود
            $result=1;
        }
        return $result;
   }
   ///////////////////////////////////////////
    function modi_stand($conn,$old_stand_name,$new_stand_id,$new_stand_name,$capacity,$loc)
   {
        
      // $result=0;
       $upd_stands_q = "UPDATE stands SET stand_name='$new_stand_name',capacity=$capacity,location='$loc' where stand_id=$new_stand_id";
        $conn->query($upd_stands_q);
       $upd_show_q = "UPDATE showtables SET stand='$new_stand_name' where stand='$old_stand_name'";
         $conn->query($upd_show_q);
       $upd_drs_q = "UPDATE doctors SET current_stand='$new_stand_name' where current_stand='$old_stand_name'";
         $conn->query($upd_drs_q);
         
        
         
        
   }




////////////////////////////////
   
  function add_stand($conn,$stand,$capacity,$loc)
  {
           $stands_c_sql="SELECT max(stand_id) FROM stands";   
            $stands_c_q=mysqli_query($conn,$stands_c_sql);
           $stands_c_f= mysqli_fetch_all($stands_c_q,MYSQLI_NUM);
            $stand_id=$stands_c_f[0][0]+1;  
            
       $stands_q = "insert into stands(stand_id,stand_name,capacity,location) values($stand_id,'$stand',$capacity,'$loc')";
       $conn->query($stands_q);     
            
           $sh_tbl_c_sql="SELECT max(doc_c_id) FROM showtables";   
            $sh_tbl_c_q=mysqli_query($conn,$sh_tbl_c_sql);
           $sh_tbl_c_f= mysqli_fetch_all($sh_tbl_c_q,MYSQLI_NUM);
            $sh_tbl_max_id=$sh_tbl_c_f[0][0];  
   for($d=1;$d<7;$d++)
    {
      for($l=1;$l<7;$l++)
      {
          $sh_tbl_max_id++;
             $fill_cell_q = "insert into showtables(doc_c_id,s_group,stand,day,lec) VALUES($sh_tbl_max_id,0,'$stand',$d,$l)";
            $conn->query($fill_cell_q);
      }
    }
}  

 function delete_stand($conn,$stand_name)
  {
               $upd_adm_q = "UPDATE doctors SET current_stand=' إختر مدرج' where current_stand='$stand_name'";
              $conn->query($upd_adm_q);
           
     
          $g_data_sql="SELECT S_group FROM showtables where stand='$stand_name' and done>0";   
           $g_data_q=mysqli_query($conn,$g_data_sql);
           $g_data_f= mysqli_fetch_all($g_data_q,MYSQLI_NUM);
           
           
           $c_data_sql="SELECT crs_id FROM showtables where stand='$stand_name' and done>0";   
           $c_data_q=mysqli_query($conn,$c_data_sql);
           $c_data_f= mysqli_fetch_all($c_data_q,MYSQLI_NUM);
           
            $count_sql="SELECT count(crs_id) FROM showtables where stand='$stand_name' and done>0";   
           $count_q=mysqli_query($conn,$count_sql);
           $count_f= mysqli_fetch_all($count_q,MYSQLI_NUM);
           $count=$count_f[0][0];
          for($i=0;$i<$count;$i++)
          {
              $crs_id=$c_data_f[$i][0];
              $s_group=$g_data_f[$i][0];
           $upd_crs_group_q = "UPDATE courses_groups SET alocated=0 WHERE crs_id=$crs_id and s_group=$s_group";
            $conn->query($upd_crs_group_q);
           
          }
     
      //$result=0;
       $stands_q = "delete from stands where stand_name='$stand_name'";
         $conn->query($stands_q);
       $sh_tbl_del_sql="delete  from showtables where stand='$stand_name'";   
          $conn->query($sh_tbl_del_sql);
    
}  

    //echo 'تم حذف المدرج نهائيا';
 function stand_data($conn)
  {
  $stand_sql="SELECT stand_id,stand_name,capacity,location FROM stands";   
 if ($result=mysqli_query($conn,$stand_sql))
  {
    $d_c=0;
    $stand_id=array();$stand_name=array();$capacity=array();$location=array();
    while ($row=mysqli_fetch_row($result))
    {
      $stand_id[$d_c]=$row[0];
      $stand_name[$d_c]=$row[1];
       $capacity[$d_c]=$row[2];
      $location[$d_c]=$row[3];
       $d_c++;
    }   
   }
$stand_data=array('stand_id'=>$stand_id,'stand_name'=>$stand_name,'capacity'=>$capacity,'location'=>$location);
return $stand_data;
 }

 $stand_data_s=stand_data($conn);
 $all_stands_id=$stand_data_s["stand_id"];
 $all_stands_name=$stand_data_s["stand_name"];
 $all_stands_capacity=$stand_data_s["capacity"];
 $all_stands_loc=$stand_data_s["location"];
 //echo '<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
// print_r($all_stands_name);

?>  
    
<center>
 <table  style="position: fixed;  top: 0px; width:100%; border:2px #008dde solid;"  id="table">
<tr><th colspan="5"><center>إضافة مدرج جديد </center></th></tr>
<tr>
   <th> م </th>
   <th>اسم المدرج</th>
   <th>سعة المدرج للطلاب</th>
   <th>مكان المدرج</th> 
<th> </th>
 </tr>

 <tr style="background-color: #e8e5e5;">
 <form method="post">
     <td style='width:8%;'>
         <center><b>+</b></center>
  	</td>
        
        <td style=' width:25%;'>
        <center>
        <input type='text' id='h1' style='color:black;' name='stand_name' required
               placeholder="مدرج جديد" ></center>
  	</td>
         <td style='width:20%;'>
         <center> <input required id="h1" type="number" min="30" max="3000"
                        name="capacity" value="150" style='color:black;'
                        data-toggle='popover' data-trigger='hover' data-content='سعة المدرج'/></center>
            </td>   
         
         <td style="width: 10%; background-color: #f2f2f2;"><center>
             <input  id="h1" type="text" name= "location"
                       placeholder='المكان '/></center>
            </td> 
   <td>
    <center>
        <input id="h4" type='submit' name="save" value="  حفظ المدرج " />
    <input id="h4" type='submit'value=" إلغاء التعديل " />
    </center>
   </td>
 </form>     
 </tr>
  
</table>
<hr />
<table id="table" style="margin:auto; position: fixed; width: 100%; top:121px; 
          font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue',Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">
<tr>
    <th style="width: 8%;"> م </th>
   <th style="width: 25%;">اسم المدرج</th>
   <th style="width: 20%;">سعة المدرج للطلاب</th>
   <th style="width: 10%;">مكان المدرج</th> 
   <th> <center>
        <form method="post" action="">
               <input type='submit' style=" margin-bottom: 0px; margin-top: -100px; font-weight: bold; color: white;"
                     id="h4" value='  تحديث  '/>
                 
    <b><?php echo"$result"; ?></b></form>
</center></th>
 </tr>
   </table>
<table  id="table" style="margin:auto; margin-top:140px; z-index: -1;  width: 100%; ">
<?php
//echo count($all_stands_id);
           function min_stand_id($conn)
           {
          $stands_min_sql="SELECT min(stand_id) FROM stands";   
            $stands_min_q=mysqli_query($conn,$stands_min_sql);
           $stands_min_f= mysqli_fetch_all($stands_min_q,MYSQLI_NUM);
            $stand_min_id=$stands_min_f[0][0];  
            return $stand_min_id;
           }
           $stand_min_id=min_stand_id($conn);
           $c_st=0;
  for ($i=count($all_stands_id)-1;$i>=0;$i--)
   {
      $c_st++;
   echo "
     <form method='post'>
       ";
   if($i%2!=0)
   {
   echo "<tr style='background-color: #f2f2f2;'>";
   }
   else {echo "<tr>";}
    ?>
         <td style='width:8%;'>
         <center><b name='<?php echo "stand_id$i" ?>' value="<?php echo "stand_id$i" ?>"><?php echo $c_st;//$all_stands_id[$i]?></b></center>
  	</td>
  	<td style='font-weight:bold; width:25%;'>
        <center>
        <input type='text' id='h1' style='color:black;' name='<?php echo "stand_name$i";?>' 
               value='<?php echo "$all_stands_name[$i]";?>' required
              data-toggle='popover' data-trigger='hover' data-content='تعديل المدرج' ></center>
  	</td>
         <td style='width:20%;'>
         <center>  <input required id="h1" type="number" min="30" max="3000" style='color:black;'
                        name="<?php echo "capacity$i";?>" value="<?php echo $all_stands_capacity[$i];?>" 
                        data-toggle='popover' data-trigger='hover' data-content='سعة المدرج'/></center>
            </td>   
         
         <td style="width: 10%; "><center>
             <input  id="h1" type="text" style='color:black;' name="<?php echo "location$i";?>"  value="<?php echo "$all_stands_loc[$i]";?>"
                        data-toggle='popover' data-trigger='hover' data-content='مكان المدرج'/></center>
            </td> 
<td>
<center>
    <input id="h4" type='submit' name="<?php echo"save$i" ?>" value=" حفظ التعديلات" />
    <input id="h4"type='submit' value="إلغاء " />
 <input type='submit' onclick="if (!confirm('هل تريد حذف المدرج'))return false;"  
         name="<?php echo"delete$i";?>" data-toggle='popover' data-trigger='hover'
         data-content='إضغط لحذف هذا المدرج' id='h4' value="حذف " />
 <input type='submit'  name="<?php echo"fill$i";?>" data-toggle='popover' data-trigger='hover'
        data-content='إضغط لتعبئة المدرج' id='h4' value="تعبئة المدرج"  />

</center>
</td>
 </tr>
 </form>
 <?php
   }
 ?>
   </table>

</center>

</body>
</html>