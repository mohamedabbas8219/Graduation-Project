<?php
require_once  'connection.php';
$group_id=filter_input(INPUT_GET, 'id',FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html>
<html>
  <head>
       <script src="javascript/select_filter.js" type="text/javascript" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="css_admin/test.css">
     <link href="css_admin/admin.css" rel="stylesheet" type="text/css"/>
     <link rel="stylesheet" href="css_admin/bootstrap.min.css">
     
    
     <title>إضافة مواد المجموعة </title>
        <script>
        $(document).ready(function(){
        $('[data-toggle="popover"]').popover();   
         });
     </script>
     
     <style>
          .variables_html{display: none;}
     </style>
    </head>
<body onpageshow="start_filter()">
    <?php
    $conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 
    
    function group_name($conn,$group_id)
    {
       $group_name_sql="SELECT st_group,dept FROM s_groups where group_id=$group_id";   
       $group_name_q=mysqli_query($conn,$group_name_sql);
       $group_name_f=mysqli_fetch_all($group_name_q,MYSQLI_NUM);  // number
       $group_name=$group_name_f[0][0]."_".$group_name_f[0][1];
       return $group_name;
    }
    
 $group_name=group_name($conn,$group_id);
 
  function allcourses()
 {
     $conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 
  
 $crsids_sql="SELECT crs_id FROM allcourses where crs_id>0";   
 $crsids_q=mysqli_query($conn,$crsids_sql);
 $crs_ids_f=mysqli_fetch_all($crsids_q,MYSQLI_NUM);  // number

 $crs_count_sql="SELECT count(crs_id) FROM allcourses where crs_id>0";   
 $crs_count_q=mysqli_query($conn,$crs_count_sql);
 $crs_count_f=mysqli_fetch_all($crs_count_q,MYSQLI_NUM);  //    crs id
 $crs_count=$crs_count_f[0][0];
  $crs_ids=array();               /////////////////////////// array
  for($i=0,$ii=$crs_count;$i<$ii;$i++)
  {
     $crs_ids[$i]=$crs_ids_f[$i][0];
   }
   ////////////////////////////////////////////////////////// courses names
  $coursename_sql="SELECT crs_name FROM allcourses where crs_id>0";
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
 $all_courses=allcourses();
  $crs_id=$all_courses['crs_ids'];
 $crs_names=$all_courses['all_courses'];
 
 //print_r($crs_id) ;
 //print_r($crs_names); 
function courses()
 {
     $gid=$GLOBALS['group_id'] ;
     $conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 
// select crs_name from allcourses inner join courses_groups on allcourses.crs_id=courses_groups.crs_id where courses_groups.s_group=11;
//       $groupids=$_SESSION['sgroupid'];
    $coursename_sql="select crs_name from allcourses inner join courses_groups on allcourses.crs_id=courses_groups.crs_id where courses_groups.s_group=$gid";
  $coursename_q=mysqli_query($conn,$coursename_sql);
  $coursename_f=mysqli_fetch_all($coursename_q,MYSQLI_NUM);
   $countcoursename_sql="select count(crs_name) from allcourses inner join courses_groups on allcourses.crs_id=courses_groups.crs_id where courses_groups.s_group=$gid";
  $countcoursename_q=mysqli_query($conn,$countcoursename_sql);
  $countcoursename_f=mysqli_fetch_all($countcoursename_q,MYSQLI_NUM);
  $allcourscount=$countcoursename_f[0][0];
   $courses=array();
   
  for($i=0,$ii=$allcourscount;$i<$ii;$i++)
  {
    $courses[$i]=$coursename_f[$i][0];
  }
     $all_courses_data=array('courses'=>$courses);
     return $all_courses_data;
 }
 
 function insert_courses($crs_name)
 {
     $all_courses=allcourses();
     //$crs_id=$all_courses['crs_ids'];
 //$crs_names=$all_courses['all_courses'];
 $conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 
  
  $crsid_sql="SELECT crs_id FROM allcourses where crs_id>0 and crs_name='$crs_name'";   
 $crsid_q=mysqli_query($conn,$crsid_sql);
 $crsid_f=mysqli_fetch_all($crsid_q,MYSQLI_NUM);  // number
$crs_id=$crsid_f[0][0];
  
  
    $cgid="SELECT max(cg_id)+1 FROM courses_groups";
    $crs_count_q=mysqli_query($conn,$cgid);
    $crs_count_f=mysqli_fetch_all($crs_count_q,MYSQLI_NUM);
     $crs_count=$crs_count_f[0][0];   
     $groupid=$GLOBALS['group_id'] ;
        // $allocated=11;
       // $crs_id1=$crs_id[$i];
     

// for ($i=1;$i<$crs_id;$i++)
    // { 
      $countcourseid_sql="select count(crs_name) from allcourses inner join courses_groups on allcourses.crs_id=courses_groups.crs_id where courses_groups.s_group=$groupid";
  $countcourseid_q=mysqli_query($conn,$countcourseid_sql);
  $countcourseid_f=mysqli_fetch_all($countcourseid_q,MYSQLI_NUM);
  $allcourscount=$countcourseid_f[0][0];
                 $crsids_sql="SELECT crs_id from courses_groups where courses_groups.s_group=$groupid";   
 $crsids_q=mysqli_query($conn,$crsids_sql);
 $crs_ids_f=mysqli_fetch_all($crsids_q,MYSQLI_NUM);
 $crsids=array();               /////////////////////////// array
  for($i=0,$ii=$allcourscount;$i<$ii;$i++)
  {
     $crsids[$i]=$crs_ids_f[$i][0];
   }
       $h=1;
        for($i=0,$ii=$allcourscount;$i<$ii;$i++)
  {
     if ($crsids[$i]==$crs_id) {

         $h=0;
     }

   }       
   if ($h==1) {
     # code...
         $insert_q="INSERT INTO courses_groups(cg_id, s_group, crs_id , alocated) VALUES ($crs_count,$groupid,$crs_id,0)";
     // }
     $conn->query($insert_q);
    }
   /*  if (isset($_POST['new_course_name'])) {
        for($i=0;$i<count($crs_id);$i++)
       {
        $i=5;
        if (isset($_POST["crs_id$i"])){
       $GLOBALS['z']=$i;
       }    
    }
   }
 $conn->close();*/
return $h;
    }
 
 function delet_courses($j)
 {
    // $all_courses=allcourses();
 // $crs_id=$all_courses['crs_ids'];
 //$crs_names=$all_courses['all_courses'];
     $conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 
  
  
             //  $cgid="SELECT max(cg_id)+1 FROM courses_groups";
               //  $crs_count_q=mysqli_query($conn,$cgid);
                // $crs_count_f=mysqli_fetch_all($crs_count_q,MYSQLI_NUM);
                // $crs_count=$crs_count_f[0][0];   
      
     // for ($i=1;$i<$crs_id;$i++)
     // {
                 $groupid=$GLOBALS['group_id'] ;

        $countcoursename_sql="select count(crs_name) from allcourses inner join courses_groups on allcourses.crs_id=courses_groups.crs_id where courses_groups.s_group=$groupid";
  $countcoursename_q=mysqli_query($conn,$countcoursename_sql);
  $countcoursename_f=mysqli_fetch_all($countcoursename_q,MYSQLI_NUM);
  $allcourscount=$countcoursename_f[0][0];
   $courses=array();
 

        $crsids_sql="SELECT crs_id from courses_groups where courses_groups.s_group=$groupid";   
 $crsids_q=mysqli_query($conn,$crsids_sql);
 $crs_ids_f=mysqli_fetch_all($crsids_q,MYSQLI_NUM);
 $crs_ids=array();               /////////////////////////// array
  for($i=0,$ii=$allcourscount;$i<$ii;$i++)
  {
     $crs_ids[$i]=$crs_ids_f[$i][0];
   }
     $delet_q="DELETE FROM `courses_groups` WHERE crs_id=$crs_ids[$j] and s_group=$groupid";
     // }
     $conn->query($delet_q);
     
     $update_shwtble_q="UPDATE showtables SET crs_id=0,dr_id=0,done=0 WHERE crs_id=$crs_ids[$j] and S_group=$groupid";
     // }
     $conn->query($update_shwtble_q);
     
     
         //   if (isset($_POST['new_course_name'])) {
       // for($i=0;$i<count($crs_id);$i++)
      // {
//                $i=5;
//               if (isset($_POST["crs_id$i"])){
//
//                   $GLOBALS['z']=$i;
//                   
//                   
//               }
    
                   
                   
                       
                       
               //    }
                //   }
 
  //  $conn->close();
 }
  $alcours=courses();
 $courses=$alcours['courses'];
 
 $result="";
   for ($i=0;$i<count($courses);$i++)
   {
    if(isset($_POST["delete_crs$i"]))
    {
         delet_courses($i);
         $result="تم حذف المادة من تعبئة الفرقة";
   }

 }
 if(isset($_POST["add_crs"]))
    {
     $dept_name=$_POST["select_name_ma"];
     //new_course_name
    $crs_name=$_POST["$dept_name"];
    if($crs_name!="")
    {
    if(insert_courses($crs_name))
    {
         $result="تم تعبئة المادة في الفرقة بنجاح";
    } 
    else{
         $result="لم تتم إضافة المادة ";
    }
    }
    else{
         $result="لم يتم إختيار المادة ";
    }
    
     }
 if(isset($_POST["cancel_crs"]))
    {
       header("Refresh");
        }
                   
                   
  //////////////////////////////////////////////////////////////////////
  //filter_select($conn);
  function select_filter($conn)
  {
  $groupscount_sql="SELECT count(distinct v_dept) FROM allcourses where crs_id>0";   
 $groupscount_q=mysqli_query($conn,$groupscount_sql);
 $groupscount_f=mysqli_fetch_all($groupscount_q,MYSQLI_NUM);
 $deptsscount=$groupscount_f[0][0];
  $deptsfordoc=array();
  
  ////////////////////////////////////////////// group names , dept name ,full group name
  $groupsdept_sql="SELECT distinct v_dept FROM allcourses where crs_id>0";   
  $groupsdept_q=mysqli_query($conn,$groupsdept_sql);
  $groupsdept_f=mysqli_fetch_all($groupsdept_q,MYSQLI_NUM);         
  echo"<select name='depts_list' id='depts_list'  onclick='filter(this.value)'>";
    // echo "<option disabled='disabled' value=''  selected >إختر القسم</option> ";   
  for($i=0;$i<$deptsscount;$i++)
  {
    $deptsfordoc[$i]=$groupsdept_f[$i][0];
    //echo $groupsdept_f[$i][0].'<br />';
     echo "<option>$deptsfordoc[$i]</option> ";   
   }
   echo '</select>';
    echo '  ';
// print_r($deptsfordoc);
   
   for($i=0;$i<$deptsscount;$i++)
  {
    $crss_ids_sql="SELECT crs_id FROM allcourses where crs_id>0 and v_dept='$deptsfordoc[$i]'";
 $crss_ids_q=mysqli_query($conn,$crss_ids_sql);
 $crss_ids_f= mysqli_fetch_all($crss_ids_q,MYSQLI_NUM);
   
   $crss_sql="SELECT crs_name FROM allcourses where crs_id>0 and v_dept='$deptsfordoc[$i]'";
 $crss_q=mysqli_query($conn,$crss_sql);
 $crss_f= mysqli_fetch_all($crss_q,MYSQLI_NUM);
 //count of groups
 $crss_count_sql="SELECT count(crs_name) FROM allcourses where crs_id>0 and v_dept='$deptsfordoc[$i]'";
$crss_count_q=mysqli_query($conn,$crss_count_sql);
 $crss_count_f=mysqli_fetch_all($crss_count_q,MYSQLI_NUM);
 $crss_count=$crss_count_f[0][0];

  $crss_ids=array();
  $crss_names=array();
  
  echo "<select name='$deptsfordoc[$i]' id='$deptsfordoc[$i]' >";
   echo "<option disabled='disabled' value=''  selected>مواد القسم: $deptsfordoc[$i] </option> ";   
  for($j=0;$j<$crss_count;$j++)
  {
     $crss_ids[$j]=$crss_ids_f[$j][0];
     $crss_names[$j]=$crss_f[$j][0];
     //echo "<br /> ".$crss_ids_f[$j][0]." : ".$crss_f[$j][0];
     
         echo "<option>$crss_names[$j]</option> ";   
     }
      echo '</select>';
  }
 
  }
 
 
      
                   
  //////////////////////////////////////////////////////////////////////
                   
                   
                   
                   
     ?>
    <center>
     
     <div style=" margin:auto; position: fixed; top:0;  font-family: -apple-system, BlinkMacSystemFont, 
          'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 
          'Segoe UI Symbol';">
  
   <table  style="position: fixed; margin-top: 0px; width:100%; border:2px #008dde solid;"  id="table">
   <tr>
       <th colspan="3">تعبئة مواد الفرقة : <?php echo "<b style='color:#003333; font-size:19px;'> $group_name</b>";  ?></th>
  </tr>
  <tr style="color:#003333">
 <th style="width:8%;">م</th>
   <th style="width:40%;"> إسم المادة</th>
<!--   <th style="width:20%;"> القسم</th>-->
   <th>
       
   </th>
 </tr>
<!--<center>
<table  style="margin-top: 15px;width:55%; font-size: 15px;" id="table">
<tr>

    <th style="width:15%;">م</th>
   <th> إسم المادة</th>
 <th></th>
 </tr>-->
 <form method='post'>
      <tr style='background-color:#f2f2f2;'>
          <td><center><b>+</b></center></td>
          <!--          <td>
          <center><input type='text' id='h1' style='color:black;' required
                             data-toggle="popover" data-trigger="hover" data-content="أكتب المادة هنا واضغط اضافة" 
                             name='new_crs_name' value=''></center>
          </td>-->
 <td style="font-size:18px;">
          <center>
            
              <?php 
  //////////////////////////////////////////////////////////////display: none;
  select_filter($conn);
  //////////////////////////////////////////////////////////////
    ?>
              <input type="text" value="" name="select_name_ma" id="select_name_ma" style="display: none;" />
             
          <!--  <select name="new_course_name"  data-toggle="popover" data-trigger="hover" data-content="select" style="font-size:16px;" >
                   <option selected disabled="disabled" value="">إختر مادتك الخاصة بالفرفة   </option>
                  <?php
                  for($j=0;$j<count($crs_names);$j++)
                  {
                     // echo "<option value='$j'>$crs_names[$j]</option>";
                  }
                ?>
              </select>
              -->              
     </center>
     </td>
     <td>
      <center>
     <input type='submit' name='add_crs'  
            data-toggle='popover' data-trigger='hover' data-content='إضغط لاضافة المادة' id='h4' value='&nbsp; إضافة المادة   &nbsp;&nbsp;' />
     <input type='submit' name='cancel_crs'
            data-toggle="popover" data-trigger="hover" data-content="إلغاء الاضافة" id='h4' value='  إلغاء الاختيار' />
     
     </center>
 </td>
 </tr>
 </form>
   </table>
     </div>
     <form method="post">
        <table id="table" style=" position: fixed; width: 100%; top:127px; font-size:18px;">
      <tr>
 <th style="width:8%;">م</th>
   <th style="width:40%; font-size:16px;"> إسم المادة</th>
   <th>
         <form method="post" action="">
             <input type='submit' style=" margin-bottom: 0px; margin-top: -100px; font-weight: bold;"
                     id="h4" value='  تحديث  '/>
              &nbsp;
              <b style="font-weight: bold; ">    <?php echo "$result"; ?></b>
             
     </form>
   </th>
<!--   <th>
        <form method="post" action="">
             <input type='submit' style=" margin-bottom: 0px; margin-top: -100px;
                    color:#151b8d; background-color: #F4F4F4; font-weight: bold; 
                    border-radius: 15px;" value='إظهار آخر التعديلات هنا  '/>
              &nbsp;
              <b style="font-weight: bold; ">    <?php //echo "$result_upd"; ?></b>
             
     </form>
   </th>-->
 </tr>
 <?php
 
      $alcours=courses();
      $courses=$alcours['courses'];
   if(count($courses)>0)
  {
   for ($i=0;$i<count($courses);$i++)
   {
    $c=$i+1;
   ?>
    <tr>
        <td><center><b><?php echo$c; ?></b></center></td>   
  	<td>
        <center><?php echo"$courses[$i]";?></center>
  	</td>
       <td>
       <center>
       <input type='submit' name='<?php echo "delete_crs$i"; ?>' id='h4' value='  حذف المادة من تعبئة الفرقة'
              onclick="if (!confirm('  هل تريد حذف المادة من تعبئة الفرقة!'))return false;"/></td>
       <center>
  </tr>

  <?php 
  }}
  else { ?>
  
  <tr>
      <td colspan="3">
  <center>
      <b>لم يتم تعبئة هذه الفرقة بعد </b>
  </center>
      </td> 
  </tr>
  
  <?php
       } ?>
  
     </table> 
   </form>
     <button id="h4" name="back" style="position: fixed; top:2px; left: 2px;"><a href="adm_insert_groups.php?action=fill&id=0" style="color: white;" > عودة لصفحة الفرق </a></button>
  
 
<!--<br />-->

<!--<input type="submit" id="h4" name="save" value="save"/> 
<input type="submit" name="cancel" value="cancel" id="h4"/>
<input type="submit"  name="deleteall"value="deleteall" id="h4"/>-->

<!--</form>-->
       
</center>

</body>
</html>