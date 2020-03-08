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
             direction: rtl;
             border: solid 2px #8aa5ec;  
              border-radius: 40em;
             }
            #table td:hover {background-color: #ddd;}
            
             .variables_html{display: none;}
  </style>
       
  <script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});


</script>
</head>
<body> 
    <?php
  include_once "queries_ma.php";
 $conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 
  
  ////////////////////////////////////////////is set 

  function all_courses($conn)
 {
 $crsids_sql="SELECT crs_id FROM allcourses";   
 $crsids_q=mysqli_query($conn,$crsids_sql);
 $crs_ids_f=mysqli_fetch_all($crsids_q,MYSQLI_NUM);  // number

 $crsdepts_sql="SELECT v_dept FROM allcourses";   
 $crsdepts_q=mysqli_query($conn,$crsdepts_sql);
 $crsdepts_f=mysqli_fetch_all($crsdepts_q,MYSQLI_NUM);  // number

// 
// $ddepts_sql="SELECT distinct dept FROM s_groups where group_id>0";   
// $ddepts_q=mysqli_query($conn,$ddepts_sql);
// $ddepts_f=mysqli_fetch_all($ddepts_q,MYSQLI_NUM);  // number
//
// 
 
 $alldepts_sql="SELECT distinct dept FROM s_groups where group_id>0";   
 $alldepts_q=mysqli_query($conn,$alldepts_sql);
 $alldepts_f=mysqli_fetch_all($alldepts_q,MYSQLI_NUM);  // number

 //$alldeptsc_sql="SELECT count(dept) FROM s_groups where group_id>0";   
  $alldeptsc_sql="SELECT count( distinct dept) FROM s_groups where group_id>0";   
 $alldeptsc_q=mysqli_query($conn,$alldeptsc_sql);
 $alldeptsc_f=mysqli_fetch_all($alldeptsc_q,MYSQLI_NUM);  // number
$alldeptscount=$alldeptsc_f[0][0];

$alldepts=array();
 $distdepts=array(); 
for($i=0,$ii=$alldeptscount;$i<$ii;$i++)
  {
     $alldepts[$i]=$alldepts_f[$i][0];
  }
  /////////////////////////////////////distinct
  
  /*$alldepts[0]=$distdepts[0];
  $k=0;
   $found=0;
 for($i=0,$ii=$alldeptscount;$i<$ii;$i++)
  {  
    $found=0;
     for($j=0;$j<count($alldepts);$j++)
     {
         if($distdepts[$i]==$alldepts[$j])
         {
             $found=1;
         }
         else
        {
        
         }
     }
     if($found==0)
     {$k++;
         $alldepts[$k]=$distdepts[$i];
     }
  }
  */
 
 
 
 
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
  $all_crsdepts=array();
  for($i=0,$ii=$crs_count;$i<$ii;$i++)
  {
    $all_courses[$i]=$coursename_f[$i][0];
    $all_crsdepts[$i]=$crsdepts_f[$i][0];
  }
     $all_courses_data=array('crs_ids'=>$crs_ids,'all_courses'=>$all_courses,'all_crsdepts'=>$all_crsdepts,'alldepts'=>$alldepts);
     return $all_courses_data;
 }
 
 
   ?>
    <div id="variables_html" class="variables_html">
        <div>
 <?php
 //print_r($crs_id) ;
 //print_r($crs_names); 
   $all_courses2=all_courses($conn);
  $crs_id2=$all_courses2['crs_ids'];
  
  $result_upd="";
 for($i=1;$i<count($crs_id2);$i++)
   {
     if(isset($_POST["save$i"]))
     {
      $new_crs_name=$_POST["crs_name$i"] ;
      $new_dept_name=$_POST["dept_name$i"] ;
     // echo $new_crs_name;
      $crsid=$crs_id2[$i];
      //echo $crs_id2[$i];
      
      if($new_crs_name!=""&&!check_crs_found($conn, $new_crs_name,$new_dept_name))
      {
       if(update_crs($conn,$new_crs_name,$new_dept_name,$crsid))
       {
         $result_upd= 'تم التعديل بنجاح';
       }
       else {
         $result_upd= 'تم التعديل بنجاح';   
       }
      }
      else {
          //$result_upd= 'عفوا لم يتم التعديل ';  
          //if(check_crs_found($conn,$new_crs_name,$new_dept_name))
         // {
            $result_upd="المادة موجودة بالفعل";  
          //}
       }
     }
   }
    for($i=1;$i<count($crs_id2);$i++)
   {
     if(isset($_POST["delete$i"]))
     {
      $crsid=$crs_id2[$i];
      $max_crs_id=max_crs_id($conn)+1;
      if($crsid<$max_crs_id&&$crsid>0)
      {
       if(delete_crs($conn,$crsid))
       {
         $result_upd= 'تم الحذف بنجاح';
        // echo'onclick="if(!confirm("هل تريد حذف المادة")return false;"';
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
      $new_dept_name=$_POST["new_dept_name"] ;
      $new_crs_id=max_crs_id()+1;
      if(!(check_crs_found($conn,$new_crs_name,$new_dept_name)))
      {
         //refresh_server($conn);
       if(new_crs($conn,$new_crs_id,$new_crs_name,$new_dept_name))
       {
         $result_upd= 'تمت الاضافة بنجاح';
        }
       else {
          $result_upd= 'تمت الاضافة بنجاح'; 
       }
      }
      else {
//          $result_upd= 'عفوا لم تتم الاضافة';
//          if(check_crs_found($conn,$new_crs_name)==1)
//          {
            $result_upd="المادة موجودة بالفعل";  
          //}
       }
     }
   
    ?>
   </div>
    </div>
   <?php
   function check_crs_found($conn,$crs_name,$new_dept_name)
     {
         $crsname_sql="SELECT count(crs_id) FROM allcourses where crs_name='$crs_name' and v_dept='$new_dept_name'";   
         $crsname_q=mysqli_query($conn,$crsname_sql);
        $crs_name_f=mysqli_fetch_all($crsname_q,MYSQLI_NUM);  // number
        return $crs_name_f[0][0];
        //return 1;
     }
     
  
  //////////////////////////////////////////////////////////////// 
  $all_courses=all_courses($conn);
  $crs_id=$all_courses['crs_ids'];
 $crs_names=$all_courses['all_courses'];
 $all_crsdepts=$all_courses['all_crsdepts'];
 $alldepts=$all_courses['alldepts'];
  ?>  
    
    
    
<center>
     
     <div style=" margin:auto; position: fixed; top:0;  font-family: -apple-system, BlinkMacSystemFont, 
          'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 
          'Segoe UI Symbol';">
  
   <table  style="position: fixed; margin-top: 0px;width:100%; border:2px #008dde solid;"  id="table">
   <tr>
    <th colspan="4"> اضافة المواد بالكلية</th>
  </tr>
   <tr>
 <th style="width:8%;">م</th>
   <th style="width:25%;"> إسم المادة</th>
   <th style="width:20%;"> القسم</th>
   <th>
      
   </th>
 </tr>
  <form method='post'>
      <tr style='background-color:#f2f2f2;'>
          <td><center><b>+</b></center></td>
          <td>
          <center><input type='text' id='h1' style='color:black;' required
                            placeholder="مادة جديدة"  data-toggle="popover" data-trigger="hover" data-content="أكتب المادة هنا واضغط اضافة" 
                             name='new_crs_name' value=''></center>
          </td>
          <td>
          <center>
              <select name="new_dept_name"  data-toggle="popover" data-trigger="hover" data-content="إختر القسم" >
                  
                  <?php
                  for($i=0;$i<count($alldepts);$i++)
                  {
                      echo "
                       <option>$alldepts[$i]</option>
                     ";
                  }
                ?>
              </select>
              </center>
          </td>
          <td>
      <center>
          <input type='submit' name='add_new_crs' data-toggle='popover'
                 data-trigger='hover' data-content='إضغط لاضافة المادة' id='h4'
                 value='&nbsp; إضافة المادة &nbsp;&nbsp;' />
     <input type='submit' name='cancel_new_crs'
            data-toggle="popover" data-trigger="hover" data-content="إلغاء الاضافة" id='h4' value='إلغاء الاضافة' />
     
   </center>
   </td>
  </tr> 
 </form>
 
   </table>
   </div>
     
    
    
    <table id="table" style=" position: fixed; width: 100%; top:121px;">
      <tr>
 <th style="width:8%;">م</th>
   <th style="width:25%;"> إسم المادة</th>
   <th style="width:20%;"> القسم</th>
   <th>
      
        <form method="post" action="">
               <input type='submit' style=" margin-bottom: 0px; margin-top: -100px; font-weight: bold; color: white;"
                     id="h4" value='  تحديث  '/> &nbsp;&nbsp;&nbsp;
            <b style="font-weight: bold; ">    <?php echo "$result_upd"; ?></b>
     </form>
   </th>
 </tr>
                   
     </table> 

     <hr />
  
     <table style="margin-top: 144px; width:100%;"  id="table">
 <?php
 $c3=0;
   for ($i=count($crs_names)-1;$i>0;$i--)
   {
     $c3++;  
   echo "
     <form method='post'>
       ";
   if($i%2!=0)
   {
   echo "<tr style='background-color: #f2f2f2;'>";
   }
   else {echo "<tr>";}
   //$crs_id[$i]
    echo "
         <td style='width:8%;'>
  	   <center><b name='$crs_id[$i]'>$c3</b></center>
  	</td>
  	<td style='align:center; font-weight:bold; width:25%;'>
        <center>
        <input type='text' id='h1' style='color:black;' name='crs_name$i' value='$crs_names[$i]' required
             data-toggle='popover' data-trigger='hover' data-content='تعديل المادة' ></center>
  	</td>
         <td style='width:20%;'>
         <center>
              <select name='dept_name$i'  data-toggle='popover' data-trigger='hover' data-content='إختر القسم' >
                 
         ";
        
                  for($j=0;$j<count($alldepts);$j++)
                  {
                      if($alldepts[$j]==$all_crsdepts[$i])
                      {
                      echo "<option selected value='$alldepts[$j]'>$alldepts[$j]</option> ";
                      }
                       else 
                           {
                            echo "<option value='$alldepts[$j]'>$alldepts[$j]</option> ";
                           }
                  }
    echo "
        
      </select>
      </center>
      </td>
       <td>
<center>
 <input type='submit' name='save$i' data-toggle='popover' data-trigger='hover' data-content='إضغط لحفظ التعديلات'  id='h4' value='حفظ التعديلات ' />
 <input type='submit' name='' data-toggle='popover' data-trigger='hover' data-content='إضغط لالغاء التعديلات' id='h4' value='إلغاء' />
 ";
    ?>
 <button type='submit' onclick="if (!confirm('  حذف المادة يحذف اي تخصيص للدكاترة لهااو اي استخدام لها\n هل تريد حذف هذه المادة !'))return false;"  name='<?php echo"delete$i";?>' data-toggle='popover' data-trigger='hover' data-content='إضغط لحذف هذه الماد\n ة' id='h4'> حذف</button>
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