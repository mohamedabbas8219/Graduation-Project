<html>
    <head>
      <title> تنظيم الجداول الدراسية دكتور</title>  
         
        <style>
        table, td {
          border: 1px solid black;
           width: 50px;
             height: 50px;
            }  
            .variables_html{display: none;}
            
        </style>
        
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
  
  <link href="css/RTableStyle.css" rel="stylesheet" type="text/css"/>
  <link href="css/RFormStyle.css" rel="stylesheet" type="text/css"/>
  <!-- ////////////////////////////////////////////////////////////////-->
  <meta charset="utf-8">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   
   <script src="scripts/forcellinsertion.js" type="text/javascript"></script>
    <script src="scripts/slideshow_js.js" type="text/javascript"></script>
    
   <!-- ////////////////////////////////////////////////////////////////     slide show 
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../sherbeiny/css/slideshow.css" rel="stylesheet" type="text/css"/>
     <!-- ////////////////////////////////////////////////////////////////-->
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ////////////////////   glyphicon    ///////////////////////////////////////-->
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
   <style>
 .header{
  background-color: #8aa5ec;
  width: 100%;
  height:30px ; 
  margin-bottom: 0px;
}
      .b{
  background-color:#f7f7f7; 
  width: 100%; 
  height: 100px; 
  margin-bottom: 0px;
}
.image{
  width: 90px;
  height: 90px;
  margin-top: 5px;
  margin-right: 10px;
}
.s{
  color: #5276d2;
  font-size: 30px;
  position: absolute;
  right: 100px;
  margin-top: 25px;
  margin-right:10px;
}
  
   </style>
   <script>
      // document.getElementById("g").value= "gr_no";
   </script>
    </head>

    
    
 <body onpageshow="fill(),showDivs(1)" >
     <center>
<div class="header">
</div>
    <div class="variables_html">
        <?php 
           include_once 'loginDrName.php';
           ?>
    </div>
         <div class="b" style="height:80px;"> 
             <a href="Home.php">
             <img src="images/logo.png" class="image" align="right" style="height:72px; border:1px; border-radius: 3px;">
          </a>
<center>
    <span class="s">جداول المحاضرات</span>
</center>
   
</div> 
  </div>  
   <div class="log_reg_home" style="color: black; top: 4px; right:25px; position:absolute;">
       <a href="userAccount.php?logoutSubmit=1" class="logout" style="color: white; "><b id="loggin">تسجيل الخروج</b></a>
             <b> |  </b>
          <b id="dr_name_sh" name="dr_name_sh" style="color:white;"></b>
         
   </div>
  
    <div name="line" style="background:black; margin-top: -10px;">
    <center>
        <hr>
    </center>
    </div>
 
   
    <div style="position:absolute; left:5px; top: 5px;">
              <a onclick="window.print()" target="_blank" style="color:white; font-weight: bold;
                 cursor: pointer; left: 5px; border-bottom-color: black;"> Print  &nbsp;
    <span class="glyphicon glyphicon-print" style="height: 5px; cursor: pointer; color: white;" 
              onclick="window.print()"target="_blank"></span>
      </a>
         </div> 
    
<div class="php_codes">    
   <!--connection   -->     
   <script>
       function fill()
       {
           document.getElementById("loggin").innerHTML="تسجيل الدخول";
          document.getElementById("dr_name_sh").innerHTML="لم يسجل ";
       }
       </script>
       
   <div>
<?php
 $br='<br />';
$logged_username=$userData['username'];
$Logged_pass=$userData['password'];
if(!$logged_username||!$Logged_pass)
{
    echo "
        
       <div class='is set Actions '>
    <h3 style='color:background; background-color: buttonface; margin-bottom: 1px; 
       margin-top: -8px;  border: 1px; border-radius:3px;  width:90%; '>
     لم يتم عرض اي بيانات لعدم  تسجيل الدخول </h3>
</div>




   ";
    Empty_table();
    goto eend;
}
//$stand="مدرج1";
 
 $conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 

  ?>
  
   <div style="margin-bottom:0px; margin-top: -10px;" class="w3-content w3-display-container"> 
       <center>
           <form action="" method="post" name="stands_btn" dir="rtl">
    <?php
    $stands=all_stands($conn);
  //echo "Stands : ";
  
    $inc_stand=0;
    echo '<div class="mySlides">';
  $c=0;
    for ($i=0,$cc=count($stands);$i<$cc;$i++)
    {
        $inc_stand=$i+1;
       $c++;
       echo"<input class='btn'  type='submit' value='$stands[$i]' id='stand_btn$inc_stand' name='stand$inc_stand'>";
       echo '&nbsp;';
      if($c==4&&$i< $cc-1)
      {
       echo '</div>';
       echo '<div class="mySlides">';
       $c=0;
      }
       if($i== $cc-1)
      {
       echo '</div>';
      
      }
      
      }
    ?>
      <b class="w3-button w3-gray w3-display-left" id="left_arr" onclick="plusDivs(-1)">&#10095;</b>
     <b class="w3-button w3-gray w3-display-right" id="right_arr" onclick="plusDivs(1)">&#10094; </b>      
             
     </form>
     </center>
  </div>  
     
  <?php
  
    
function all_stands($conn)
{
          $stand_sql="SELECT distinct stand FROM showtables";   
           $stand_q=mysqli_query($conn,$stand_sql);
           $stand_f= mysqli_fetch_all($stand_q,MYSQLI_NUM);
           /////////////
           $stands_c_sql="SELECT count(distinct stand) FROM showtables ";   
            $stands_c_q=mysqli_query($conn,$stands_c_sql);
           $stands_c_f= mysqli_fetch_all($stands_c_q,MYSQLI_NUM);
            $stands_count=$stands_c_f[0][0];  
            
            $stands=array();
            for($i=0;$i<$stands_count;$i++)
            {
              $stands[$i]= $stand_f[$i][0]; 
            }
            return $stands; 
}
 
  
  function get_stand($conn,$dr_id)
{
 $c_stand_sql="SELECT current_stand FROM doctors where dr_id=$dr_id";   
 $c_stand_q=mysqli_query($conn,$c_stand_sql);
 $c_stand_f=mysqli_fetch_all($c_stand_q,MYSQLI_NUM);
 $c_stand=$c_stand_f[0][0];
 return $c_stand;
}

?>
</div>
   
 <!-- select doctor information -->      
<div>
 
<?php

$dr_id=0;
$dr_name="";
$dr_periority=0;

$sql_drid = "SELECT dr_id, dr_fullname,priority FROM doctors where username='$logged_username' AND password='$Logged_pass'";
$result = $conn->query($sql_drid);
if ($result->num_rows>0) {
     while($row = $result->fetch_assoc()) {
       $dr_id=$row["dr_id"];
       $dr_name=$row["dr_fullname"];
       echo "<input type='text' value='$dr_name' style='display:none;' name='dr_name' id='dr_name' />";
       $dr_periority=$row["priority"];
     }
   }

   

  // echo $dr_periority;
   
    $stand=$stands[0];
  $count_stands= count($stands);
for($s=1;$s<=$count_stands;$s++)
{
 if(isset($_POST["stand$s"]))
  {
     $stand=$stands[$s-1];
     $update_stand_q = "UPDATE doctors SET current_stand='$stand' where dr_id=$dr_id";
        $conn->query($update_stand_q);
   }
}

   if($stand==$stands[0])
{
  $stand=get_stand($conn,$dr_id);
}
 
function set_stand($conn,$stand,$dr_id)   // useless not used
{
    $update_stand_q = "UPDATE doctors SET current_stand='$stand' where dr_id=$dr_id";
        $conn->query($update_stand_q);
}
//echo $stand;
   
//echo '>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>   '.$dr_id.' >>  '.$dr_name.$br;



 $dr_courses_data=dr_courses_data($conn,$dr_id);
 $coursesofdoc=$dr_courses_data['coursesofdoc'];
 $crs_idsofdoc=$dr_courses_data['crs_idsofdoc'];
 //print_r($crs_idsofdoc);

?>
</div>
 
 <!--                     is set Actions    -->
  
 <div class="is set Actions ">
    <h2 style="color:background; background-color: buttonface; margin-bottom: 1px; 
       margin-top: -8px;  border: 1px; border-radius:3px;  width:90%; ">
    <?php echo $stand ;?></h2>
         <!--   if set_actions         -->
         <div class="ifset_actions" style="color:background; background-color: buttonface;
              margin-bottom: 2px; border: 1px; border-radius:3px;  width:90%; ">
      
     <?php
     function update_table_cell($conn,$dr_id,$crs_realnum,$stand,$modified_day,$modified_lec,$current_cell_group)
      {
          $result="";
          $close_cell_q = "UPDATE courses_groups SET alocated=$dr_id WHERE crs_id=$crs_realnum and s_group=$current_cell_group";
                 $conn->query($close_cell_q);
                $update_cell_q = "UPDATE showtables SET dr_id=$dr_id,crs_id=$crs_realnum,done=$dr_id WHERE stand='$stand' and day=$modified_day and lec=$modified_lec";
                
                  // $conn->query($update_cell_q);
                if ($conn->query($update_cell_q) === TRUE) 
                {
                 $result= "تم التعديل بنجاح";
                 }
                else {
                   $result="خطأ في التعديل : " . $conn->error;
                }
                return $result;
        }
        
        function empty_table_cell($conn,$crs_realnum,$stand,$modified_day,$modified_lec,$current_cell_group)
      {
       
          $close_cell_q = "UPDATE courses_groups SET alocated=0 WHERE crs_id=$crs_realnum and s_group=$current_cell_group";
           $conn->query($close_cell_q);
          $update_cell_q = "UPDATE showtables SET dr_id=0,crs_id=0,done=0 WHERE stand='$stand' and day=$modified_day and lec=$modified_lec";
              // $conn->query($update_cell_q);
          $conn->query($update_cell_q);
               
        }
        
       function current_cell_group($conn,$stand,$day,$lec)
        {
          $groupsid_sql="SELECT S_group FROM showtables where stand='$stand' and day=$day and lec=$lec";   
           $groupsid_q=mysqli_query($conn,$groupsid_sql);
           $groupsid_f= mysqli_fetch_all($groupsid_q,MYSQLI_NUM);
            $current_cell_group=$groupsid_f[0][0];
              return $current_cell_group;
          }
           function current_cell_crs_empty($conn,$stand,$day,$lec)
        {
          $groupsid_sql="SELECT crs_id FROM showtables where stand='$stand' and day=$day and lec=$lec";   
           $groupsid_q=mysqli_query($conn,$groupsid_sql);
           $groupsid_f= mysqli_fetch_all($groupsid_q,MYSQLI_NUM);
            $current_cell_group=$groupsid_f[0][0];
              return $current_cell_group;
          }
         
       function current_cell_courses($conn,$current_cell_group)
         {
  $crss_ids_sql="SELECT crs_id FROM courses_groups where s_group=$current_cell_group and alocated=0";   
 $crss_ids_q=mysqli_query($conn,$crss_ids_sql);
 $crss_ids_f= mysqli_fetch_all($crss_ids_q,MYSQLI_NUM);
 //count of groups
 $crss_count_sql="SELECT count(crs_id) FROM courses_groups where s_group=$current_cell_group and alocated=0";   
$crss_count_q=mysqli_query($conn,$crss_count_sql);
 $crss_count_f=mysqli_fetch_all($crss_count_q,MYSQLI_NUM);
 $crss_count=$crss_count_f[0][0];

  $crss_ids=array();
  for($i=0,$ii=$crss_count;$i<$ii;$i++)
  {
     $crss_ids[$i]=$crss_ids_f[$i][0];
   }
 sort( $crss_ids);
 return $crss_ids ;
  }

  //   useless function
  function modify_gr_periority($conn,$group_id)
  {
   
  $gr_periority_sql="SELECT h_periority FROM s_groups where group_id=$group_id";   
 $gr_periority_q=mysqli_query($conn,$gr_periority_sql);
 $gr_periority_f=mysqli_fetch_all($gr_periority_q,MYSQLI_NUM);
 $gr_periority=$gr_periority_f[0][0];

  }
  
     $modified_day;$modified_lec;$modified_course=0;
        try{
            if(isset($_POST['save_modif']))
           {
               
             $modified_day=$_POST['rowshow'];
             $modified_lec=$_POST['cellshow'];
             $modified_course=$_POST['lec_name'];
             //echo 'lec name = '.$_POST['lec_name'];
             //echo 'bbbbbbbbb';
                 $crs_realnum=0;
              for($i=0,$ii= count($coursesofdoc);$i<$ii;$i++)
                {
                if($modified_course==$coursesofdoc[$i])
                     {
                       $crs_realnum=$crs_idsofdoc[$i];
                      // echo '$coursesofdoc[$i] : '.$crs_idsofdoc[$i].'  >>   '.$coursesofdoc[$i].$br;
                       //echo '$crs_realnum : '.$crs_realnum.$br;
                     }
                 }
                 
           if($modified_day!=null&&$modified_lec!=null&&$crs_realnum!=0)
             {
                 
              $current_cell_group=current_cell_group($conn,$stand,$modified_day,$modified_lec);
              $current_cell_courses=current_cell_courses($conn,$current_cell_group);
               /*echo 'crs >> '.$br;
             print_r($current_cell_courses);
              echo 'group >> '.$br;
             print_r($current_cell_group);
             echo $br;*/
              $matched=false;
             for($i=0,$ii= count($current_cell_courses);$i<$ii;$i++)
                {
                 if($crs_realnum==$current_cell_courses[$i])
                     {
                       $matched=true;
                     }
                }
                 
                 if($matched==TRUE)
                 {
               $current_cell_crs_empty=current_cell_crs_empty($conn,$stand,$modified_day,$modified_lec);/////////
                if($current_cell_crs_empty>0)
                {
                  empty_table_cell($conn,$current_cell_crs_empty,$stand,$modified_day,$modified_lec,$current_cell_group);
                }
                 $result= update_table_cell($conn,$dr_id,$crs_realnum,$stand,$modified_day,$modified_lec,$current_cell_group);
                 
                 $dr_groups_depts_f2=dr_groups_depts_f($conn,$dr_id);
                  $groupsidsfordoc2=$dr_groups_depts_f2['groupsidsfordoc'];
                  
                //  print_r($groupsidsfordoc2);
                 $found=0;
                  for($i=0;$i<count($groupsidsfordoc2);$i++)
                  {
                      if($groupsidsfordoc2[$i]==$current_cell_group)
                      {
                          $found=1;
                      }
                  }
                 // echo "<br />";
                  if($found===0)
                  {// if h_periority===dr_periority
                     // echo 'it is emptied ';
                      
                      
                      
                       

  $dr_groups_depts_f=dr_groups_periority($conn,$current_cell_group);
  $dr_ids=$dr_groups_depts_f["dr_ids"];
  $groupsidsfordoc=$dr_groups_depts_f["groupsidsfordocs"];
  $who_has_group=$dr_groups_depts_f["who_h_g"];
 
   for($d=1;$d<count($dr_ids);$d++)
  {      // echo 'dr'.$dr_ids[$d]." : ";
       foreach ($groupsidsfordoc["$dr_ids[$d]"] as $s)
       {
        //   echo $s ."  ";
       }
      // echo '<br />';
       
   }
 
   $periority=array();
   $next_max_periority=0;
    for($d=0;$d<count($who_has_group);$d++)
  { 
   $groups_sql="SELECT priority FROM doctors where dr_id=$who_has_group[$d]";   
 $groups_q=mysqli_query($conn,$groups_sql);
 $groups_f=mysqli_fetch_all($groups_q,MYSQLI_NUM);
 $w_hs_groups=$groups_f[0][0];
 $periority[$d]=$w_hs_groups;
  }
  foreach ($periority as $v) {
    if($v>$next_max_periority)
    {
      $next_max_periority=$v;
    }
}
 //echo 'periorities : '.$next_max_periority;
  //echo '<br />';
 // print_r($who_has_group);
 
                      
     $update_g_periority_q = "UPDATE s_groups SET h_periority=$next_max_periority where group_id=$current_cell_group";
        $conn->query($update_g_periority_q);
                      
                  }
                 //table_data($conn,$stand);
               // show_data_intable($conn,$deptsofdoc,$groupsofdoc,$dr_name,$table_data);
                 echo "<b id='resultt' style='color:green;'>";
                echo 'تم التعديل بنجاح';
                echo '</b>';
                 }
                  else {
                     echo "<b id='resultt' style='color:brown;'>";
                      echo"عفوا هذه المادة غير مخصصة  لهذه الفرقة .";
                      echo '</b>';
                       }
            }
            else {
                 echo "<b id='resultt' >";
                echo 'عفوا .  لم يتم ادخال مواد';
                echo '</b>';
            }
                 //echo 'allowed'.$br;
                // echo "day:$modified_day       >> lec: $modified_lec       >> crs:  $crs_realnum";
           }
             else {}//echo 'لم يتم ادخال مواد';}
             
             if(isset($_POST['empty']))
             {
               $modified_day=$_POST['rowshow'];
             $modified_lec=$_POST['cellshow'];
             //$modified_course=$_POST['lec_name'];
             //echo 'lec name = '.$_POST['lec_name'];
             //echo 'bbbbbbbbb';
           if($modified_day!=null&&$modified_lec!=null)
             {
               // هات الفرق و والكورس اول من الشو تابل
              $current_cell_group=current_cell_group($conn,$stand,$modified_day,$modified_lec);
              $current_cell_crs_empty=current_cell_crs_empty($conn,$stand,$modified_day,$modified_lec);/////////
              if($current_cell_crs_empty>0)
              {
              empty_table_cell($conn,$current_cell_crs_empty,$stand,$modified_day,$modified_lec,$current_cell_group);
              echo "<b id='resultt' style='color:green;'>";
                echo 'تم تفريغ الفترة بنجاح';
                echo '</b>';     
              }
               else 
                   {
                   echo "<b id='resultt'>";
                echo 'الفترة فارغة بالفعل';
                echo '</b>';     
                   }
                              
               }
             }
             
             $modified_day=null;
             $modified_lec=null;
             $modified_course!=0;
       
             } 
          catch (Exception $ex)
          {
            echo 'Sorry , Something go wrong in Your prcess';
      }
      
      function dr_groups_periority($conn,$group_id)
  {
    
    $who_has_group=array();
    $groupsidsfordocs=array();
    $drid=array();
     $drid_sql="SELECT dr_id  FROM doctors  ";   
 $drid_q=mysqli_query($conn,$drid_sql);
 $drid_f= mysqli_fetch_all($drid_q,MYSQLI_NUM);
      //count of groups
 $drcount_sql="SELECT count(dr_id) FROM doctors  ";
 $drcount_q=mysqli_query($conn,$drcount_sql);
 $drcount_f=mysqli_fetch_all($drcount_q,MYSQLI_NUM);
 $drcount=$drcount_f[0][0];
 
  for($i=0,$ii=$drcount;$i<$ii;$i++)
  {
    $drid[$i]=$drid_f[$i][0];
   }
    sort($drid);
   
   $c=0;
    for($d=1;$d<$drcount;$d++)
  {
   $groupsidsfordoc=array();     
  $groupsid_sql="SELECT distinct s_group FROM courses_groups where alocated=0 and crs_id in(SELECT crs_id FROM allcourses where dr_id=$drid[$d] and alocated=0)";   
 $groupsid_q=mysqli_query($conn,$groupsid_sql);
 $groupsid_f= mysqli_fetch_all($groupsid_q,MYSQLI_NUM);
      //count of groups
 $groupscount_sql="SELECT count(distinct s_group) FROM courses_groups where alocated=0 and crs_id in(SELECT crs_id FROM allcourses where dr_id=$drid[$d] and alocated=0)";   
 $groupscount_q=mysqli_query($conn,$groupscount_sql);
 $groupscount_f=mysqli_fetch_all($groupscount_q,MYSQLI_NUM);
 $groupscount=$groupscount_f[0][0];
 $ch=0;
  for($i=0,$ii=$groupscount;$i<$ii;$i++)
  {
    $groupsidsfordoc[$i]=$groupsid_f[$i][0];
    if($groupsidsfordoc[$i]==$group_id)
    {
        $ch=1;
    }
   }
   if($ch==1)
   {
       $who_has_group[$c]=$drid[$d];
       $c++;
   }
   
   
 //sort($groupsidsfordoc);
 $groupsidsfordocs["$drid[$d]"]=$groupsidsfordoc;
    
 }
 $data=array("dr_ids"=>$drid,"groupsidsfordocs"=>$groupsidsfordocs,"who_h_g"=>$who_has_group);
 return $data;
  }
      
   function Reset_table($conn,$stand,$dr_id)
    {
              $reset_sh_q = "UPDATE showtables SET dr_id=0,crs_id=0,done=0 WHERE stand='$stand' and dr_id=$dr_id";
              $conn->query($reset_sh_q);
             // $reset_cd_q = "UPDATE coursesofdoctor SET alocated=0 where dr_id=$dr_id";
             // $conn->query($reset_cd_q);
              $reset_cg_q = "UPDATE courses_groups SET alocated=0 where crs_id in(
             SELECT crs_id FROM allcourses where dr_id=$dr_id) and s_group in(
                    SELECT S_group FROM showtables where stand='$stand' and S_group>0)";
              $conn->query($reset_cg_q);
              
          }
        
          if(isset($_POST['reset_table']))
          {
              Reset_table($conn,$stand,$dr_id);
          }
      ?>
    </div>
 </div>
  
 
 
 <!--       courses id , names     -->
 <div>
 <?php
 function dr_courses_data($conn,$dr_id)
 {
 $crsids_sql="SELECT crs_id FROM allcourses where dr_id=$dr_id and crs_id in(select crs_id from courses_groups where alocated=0)";   
 $crsids_q=mysqli_query($conn,$crsids_sql);
 $crs_ids_f=mysqli_fetch_all($crsids_q,MYSQLI_NUM);  // number

 $crs_count_sql="SELECT count(crs_id) FROM allcourses where dr_id=$dr_id and crs_id in(select crs_id from courses_groups where alocated=0)";   
 $crs_count_q=mysqli_query($conn,$crs_count_sql);
 $crs_count_f=mysqli_fetch_all($crs_count_q,MYSQLI_NUM);  //    crs id
 $crs_count=$crs_count_f[0][0];
  $crs_ids=array();               /////////////////////////// array
  for($i=0,$ii=$crs_count;$i<$ii;$i++)
  {
     $crs_ids[$i]=$crs_ids_f[$i][0];
   }
   ////////////////////////////////////////////////////////// courses names
  $coursename_sql="SELECT crs_name FROM allcourses where dr_id=$dr_id and crs_id in(select crs_id from courses_groups where alocated=0)";
  $coursename_q=mysqli_query($conn,$coursename_sql);
  $coursename_f=mysqli_fetch_all($coursename_q,MYSQLI_NUM);
  $coursesofdoc=array();
  for($i=0,$ii=$crs_count;$i<$ii;$i++)
  {
    $coursesofdoc[$i]=$coursename_f[$i][0];
  }
     $dr_courses_data=array('crs_idsofdoc'=>$crs_ids,'coursesofdoc'=>$coursesofdoc);
     return $dr_courses_data;
 }

 //$dr_courses_data=dr_courses_data($conn,$dr_id)
 
 //printf($crs_idsofdoc[1]);
 //echo $br;
 //printf($coursesofdoc[1]);    
  ?>
 </div>  
   
 <!--       groups id , names , departments for doctor   -->
 <div>
  <?php
 /////////////////////////////////////////////////////////// groups id
  function dr_groups_depts_f($conn,$dr_id)
  {
  $groupsid_sql="SELECT distinct s_group FROM courses_groups where alocated=0 and crs_id in(SELECT crs_id FROM allcourses where dr_id=$dr_id and alocated=0)";   
 $groupsid_q=mysqli_query($conn,$groupsid_sql);
 $groupsid_f= mysqli_fetch_all($groupsid_q,MYSQLI_NUM);
      //count of groups
 $groupscount_sql="SELECT count(distinct s_group) FROM courses_groups where alocated=0 and crs_id in(SELECT crs_id FROM allcourses where dr_id=$dr_id and alocated=0)";   
 $groupscount_q=mysqli_query($conn,$groupscount_sql);
 $groupscount_f=mysqli_fetch_all($groupscount_q,MYSQLI_NUM);
 $groupscount=$groupscount_f[0][0];
 
  $groupsidsfordoc=array();
  for($i=0,$ii=$groupscount;$i<$ii;$i++)
  {
    $groupsidsfordoc[$i]=$groupsid_f[$i][0];
   }
 sort($groupsidsfordoc);
  ////////////////////////////////////////////// group names , dept name ,full group name
  $groupsdept_sql="SELECT dept FROM s_groups where group_id  in(
        SELECT s_group FROM courses_groups where alocated=0 and crs_id in(
            SELECT crs_id FROM allcourses where dr_id=$dr_id))";
  $groupsdept_q=mysqli_query($conn,$groupsdept_sql);
  $groupsdept_f=mysqli_fetch_all($groupsdept_q,MYSQLI_NUM);
  
  $groupsname_sql="SELECT st_group FROM s_groups where group_id in(
        SELECT s_group FROM courses_groups where  alocated=0 and crs_id in(
            SELECT crs_id FROM allcourses where dr_id=$dr_id))";
  $groupsname_q=mysqli_query($conn,$groupsname_sql);
  $groupsname_f=mysqli_fetch_all($groupsname_q,MYSQLI_NUM);
  
  $groupsofdoc=array(); 
  $deptsofdoc=array();
  for($i=0,$ii=$groupscount;$i<$ii;$i++)
  {
     $groupsofdoc[$i]=$groupsname_f[$i][0];
     $deptsofdoc[$i]=$groupsdept_f[$i][0];
  }
  //print_r($deptsofdoc);
  //echo '<br />';
  //print_r($groupsofdoc);
   $fullgroupname=array();
  for($i=0,$ii= count($groupsofdoc);$i<$ii;$i++)
  {
   $fullgroupname[$i]=$groupsofdoc[$i].' - '.$deptsofdoc[$i];
  }
  $dr_groups_depts_f=array('groupsidsfordoc'=>$groupsidsfordoc,'groupsofdoc'=>$groupsofdoc,'deptsofdoc'=>$deptsofdoc,'fullgroupname'=>$fullgroupname);
     return $dr_groups_depts_f;
 }
  
  $dr_groups_depts_f=dr_groups_depts_f($conn,$dr_id);
  $groupsidsfordoc=$dr_groups_depts_f['groupsidsfordoc'];
  $groupsofdoc=$dr_groups_depts_f['groupsofdoc'];
  $deptsofdoc=$dr_groups_depts_f['deptsofdoc'];
   $fullgroupname=$dr_groups_depts_f['fullgroupname'];
   //print_r($groupsidsfordoc); 
  // echo 'L 572';                              ////////////////////////////////////////////  
  ?>
 </div>  
  
 <!--                                   get table data -->  
 <div>
 <?php
 ///////////////////////////////////////////////////////////   table first show
  function table_data($conn,$stand)
  {
 $tablefill_sql="SELECT day,lec,S_group,dr_id,crs_id,done FROM showtables where stand='$stand' and S_group>0 ORDER BY day,lec ";
 // echo $br.$br.'/////////////////////////////'.$br;
if ($result=mysqli_query($conn,$tablefill_sql))
  {
  // Fetch one and one row
    $d_c=0;
    $d_arr=array();$l_arr=array();$v_arr=array();$celldr_arr=array();$cellcrs_arr=array();$celldone_arr=array();
    while ($row=mysqli_fetch_row($result))
    {
   
      $d_arr[$d_c]=$row[0];
      $l_arr[$d_c]=$row[1];
       $v_arr[$d_c]=$row[2];
      $celldr_arr[$d_c]=$row[3];
      $cellcrs_arr[$d_c]=$row[4];
      $celldone_arr[$d_c]=$row[5];
        $d_c++;
       
    }
   }
$table_data=array('d_arr'=>$d_arr,'l_arr'=>$l_arr,'v_arr'=>$v_arr,'celldr_arr'=>$celldr_arr,'cellcrs_arr'=>$cellcrs_arr,'celldone_arr'=>$celldone_arr);
return $table_data;
 }

 $table_data=table_data($conn,$stand);
 $d_arr=$table_data['d_arr'];
 $l_arr=$table_data['l_arr'];
 $v_arr=$table_data['v_arr'];
 $celldr_arr=$table_data['celldr_arr'];
 $cellcrs_arr=$table_data['cellcrs_arr'];
 $celldone_arr=$table_data['celldone_arr'];
 //print_r($celldone_arr);
 ?>
 </div>     
     
<!--                                                  Show data in table     -->
 <div>   
<?php
/////////////////////////////Show data in table

function show_data_intable($conn,$deptsofdoc,$groupsofdoc,$dr_name,$table_data,$dr_periority)
{
    
    $d_arr=$table_data['d_arr'];
 $l_arr=$table_data['l_arr'];
 $v_arr=$table_data['v_arr'];
 $celldr_arr=$table_data['celldr_arr'];
 $cellcrs_arr=$table_data['cellcrs_arr'];
 $celldone_arr=$table_data['celldone_arr'];
 
echo '<script>
           function fill() {
           var dr_name=document.getElementById("dr_name").value;  
           document.getElementById("dr_name_sh").innerHTML ="د / "+dr_name;
           document.getElementById("logged_Dr").value="'.$dr_name.'";               
           var y =document.getElementById("myTable");
        ';
$j_allow_counter=0;
//$l_cou_allow_g=0;
$allowedmodi_lec=array();$allowedmodi_day=array();$allowedmodi_dr=array();$allowedmodi_crs=array();$allowedmodi_done=array();
for($i=0;$i<count($d_arr);$i++)
 { ///////////////////////////////////////////////////////////////all table groups,depts
    $allgroupsdept_sql="SELECT dept,st_group FROM s_groups where group_id=$v_arr[$i]";
  $allgroupsdept_q=mysqli_query($conn,$allgroupsdept_sql);
  $allgroupsdept_f=mysqli_fetch_all($allgroupsdept_q,MYSQLI_NUM);
  $celldept_group=$allgroupsdept_f[0][1].' - '.$allgroupsdept_f[0][0];
  
  //////////////////////////////////////////////////////////////////All tables doctors
        
  $gr_periority_sql="SELECT h_periority FROM s_groups where group_id=$v_arr[$i]";   
 $gr_periority_q=mysqli_query($conn,$gr_periority_sql);
 $gr_periority_f=mysqli_fetch_all($gr_periority_q,MYSQLI_NUM);
 $gr_periority=$gr_periority_f[0][0];
   
  //////////////////////////////////////////////////////////////////////////////////
  $alldoctors_sql="SELECT dr_fullname FROM doctors where dr_id=$celldr_arr[$i] ";
  $alldoctors_q=mysqli_query($conn,$alldoctors_sql);
  $alldoctors_f=mysqli_fetch_all($alldoctors_q,MYSQLI_NUM); 
  $cellalldoctors=  $alldoctors_f[0][0];
  //print_r($cellalldoctors_crs);
  //////////////////////////////////////////////////////////////////  All tables courses
  $allcrs_sql="SELECT crs_name FROM allcourses where crs_id=$cellcrs_arr[$i]";
  $allcrs_q=mysqli_query($conn,$allcrs_sql);
  $allcrs_f=mysqli_fetch_all($allcrs_q,MYSQLI_NUM); 
  $cellallcrs=$allcrs_f[0][0];
  //$cellallcrs="vv";
  //$celldept_group.="<br>فارغة";
  /////////////////////////////////////////////////////////////////////////////////////////loop on depts,groups
  for($s=0;$s<count($groupsofdoc);$s++)
  {
  if($allgroupsdept_f[0][0]==$deptsofdoc[$s]&&$allgroupsdept_f[0][1]==$groupsofdoc[$s])
  {
      //$allowed_content=' y.rows['.$d_arr[$i].'].cells['.$l_arr[$i].'].style.color = "red"';
     //echo' y.rows['.$d_arr[$i].'].cells['.$l_arr[$i].'].style.color = "blue"';
     
      
     if($dr_periority>=$gr_periority)
     {
         $allowedmodi_day[$j_allow_counter]=$d_arr[$i];
        $allowedmodi_lec[$j_allow_counter]=$l_arr[$i];
         $allowedmodi_crs[$j_allow_counter]=$cellcrs_arr[$i];
         $allowedmodi_dr[$j_allow_counter]=$celldr_arr[$i];
     $allowedmodi_done[$j_allow_counter]=$celldone_arr[$i];
     $j_allow_counter++;
        
     }
      
     
     
  }
 }
 if($cellalldoctors!=""){
    echo'
        
        y.rows['.$d_arr[$i].'].cells['.$l_arr[$i].'].innerHTML="<center>'.$celldept_group."<br /> د/ ".$cellalldoctors."<br />".$cellallcrs.' </center>";
        ';
    }
 else {
        echo'
        
        y.rows['.$d_arr[$i].'].cells['.$l_arr[$i].'].innerHTML="<center>'.$celldept_group.' </center>";
        '; 
    }
  }
  echo '} </script>
            ';
 
  $allowed_modi_data=array('allowedmodi_day'=>$allowedmodi_day,'allowedmodi_lec'=>$allowedmodi_lec,'allowedmodi_crs'=>$allowedmodi_crs,'allowedmodi_dr'=>$allowedmodi_dr,'allowedmodi_done'=>$allowedmodi_done);
   return $allowed_modi_data ;
}



$allowed_modi_data=show_data_intable($conn,$deptsofdoc,$groupsofdoc,$dr_name,$table_data,$dr_periority);
$allowedmodi_day=$allowed_modi_data['allowedmodi_day'];
$allowedmodi_lec=$allowed_modi_data['allowedmodi_lec'];
$allowedmodi_crs=$allowed_modi_data['allowedmodi_crs'];
$allowedmodi_dr=$allowed_modi_data['allowedmodi_dr'];
$allowedmodi_done=$allowed_modi_data['allowedmodi_done'];
  ?>
 </div>

 <div id="variables_html" class="variables_html">    
<?php
/////////////////////////////////////////////////////////////////                    التحكم بالسيلكت 
 function allowed_modi_groups($conn,$stand,$allowedmodi_day,$allowedmodi_lec)
   {
     $grs_ids=array();
   for($i=0;$i<count($allowedmodi_day);$i++)
   {
  $grs_ids_sql="SELECT S_group FROM showtables where stand='$stand' and day=$allowedmodi_day[$i] and lec=$allowedmodi_lec[$i]";   
 $grs_ids_q=mysqli_query($conn,$grs_ids_sql);
 $grs_ids_f= mysqli_fetch_all($grs_ids_q,MYSQLI_NUM);
 $grs_ids[$i]=$grs_ids_f[0][0];
   }
    //sort( $grs_ids);
   return $grs_ids;
   }
   $allowed_modi_groups=allowed_modi_groups($conn,$stand,$allowedmodi_day,$allowedmodi_lec);
  // echo '<br />groups  > >  <br />';
  // print_r($allowed_modi_groups);
  for($i=0;$i<count($allowed_modi_groups);$i++)
  {
    //  echo "$allowed_modi_groups[$i] , ";
      if($i%4==0&&$i>0)
      {
        //  echo '<br />';
      }
    }

   function current_c_courses($conn,$current_cell_group)
   {
  $crss_ids_sql="SELECT crs_id FROM courses_groups where s_group=$current_cell_group and alocated=0";   
 $crss_ids_q=mysqli_query($conn,$crss_ids_sql);
 $crss_ids_f= mysqli_fetch_all($crss_ids_q,MYSQLI_NUM);
 //count of groups
 $crss_count_sql="SELECT count(crs_id) FROM courses_groups where s_group=$current_cell_group and alocated=0";   
$crss_count_q=mysqli_query($conn,$crss_count_sql);
 $crss_count_f=mysqli_fetch_all($crss_count_q,MYSQLI_NUM);
 $crss_count=$crss_count_f[0][0];

  $crss_ids=array();
  $cell_crss=array();
  for($i=0,$ii=$crss_count;$i<$ii;$i++)
  {
     $crss_ids[$i]=$crss_ids_f[$i][0];
    
     $cell_crss_sql="SELECT crs_name FROM allcourses where crs_id=$crss_ids[$i]";   
     $cell_crss_q=mysqli_query($conn,$cell_crss_sql);
      $cell_crss_f= mysqli_fetch_all($cell_crss_q,MYSQLI_NUM);
      $cell_crss[$i]=$cell_crss_f[0][0];
   }
 //sort( $crss_ids);
   //$cell_crs_data=array('crss_ids'=>$crss_ids,'cell_crss'=>$cell_crss);
 return $cell_crss ;
  }
 
  //////////////////////////////////////
     $all_groups_ids=all_groups_ids($conn,$stand);
      $crsidsforgroups=array();
   for($i=0;$i< count($all_groups_ids);$i++)
  {
       if($i%5==0)
       {
           echo '<br />';
       }
      // echo"$allowed_modi_groups[$i] => "; 
    
    $crsidsforgroups["$all_groups_ids[$i]"]=current_c_courses($conn,$all_groups_ids[$i]);
     }
     $kkk=0;
     for($i=1;$i< 7;$i++)
     {
      for($j=1;$j< 7;$j++)
     {   
       
      echo "<select name='cell_gr$i"."_"."$j"."s"."' id='cell_gr$i"."_"."$j"."s"."'>";
      foreach ($crsidsforgroups["$all_groups_ids[$kkk]"] as $ii)
      {
         echo "<option>$ii </option> ";   
      }  
    echo '</select>';
     $kkk++;   
     }
     }
     
  echo '<br /><br />';
/////////////////////////////////////////////////////////////////
 
  // all courses number        useless
  function all_crs_ids($conn,$stand)
  {
      $crs_id_c_sql="SELECT count(crs_id) FROM showtables where stand='$stand'";   
      $crs_id_c_q=mysqli_query($conn,$crs_id_c_sql);
      $crs_id_c_f= mysqli_fetch_all($crs_id_c_q,MYSQLI_NUM);
      $crs_id_count=$crs_id_c_f[0][0];
              
      $crs_id_sql="SELECT crs_id FROM showtables where stand='$stand'";   
      $crs_id_q=mysqli_query($conn,$crs_id_sql);
      $crs_id_f= mysqli_fetch_all($crs_id_q,MYSQLI_NUM);
      $all_crs_ids=array();
      for($i=0;$i<$crs_id_count;$i++)
      {
          $all_crs_ids[$i]=$crs_id_f[$i][0];
      }
      return $all_crs_ids;
  }
  
  function all_groups_ids($conn,$stand)
  {
      $crs_id_c_sql="SELECT count(S_group) FROM showtables where stand='$stand'";   
      $crs_id_c_q=mysqli_query($conn,$crs_id_c_sql);
      $crs_id_c_f= mysqli_fetch_all($crs_id_c_q,MYSQLI_NUM);
      $grs_id_count=$crs_id_c_f[0][0];
              
      $crs_id_sql="SELECT S_group FROM showtables where stand='$stand'";   
      $crs_id_q=mysqli_query($conn,$crs_id_sql);
      $crs_id_f= mysqli_fetch_all($crs_id_q,MYSQLI_NUM);
      $all_group_ids=array();
      for($i=0;$i<$grs_id_count;$i++)
      {
          $all_group_ids[$i]=$crs_id_f[$i][0];
      }
      return $all_group_ids;
  }
  
 //////////////////////////////////////////
  
 
  ////////////////////////////////////////
          
 //$all_crs_ids=all_crs_ids($conn,$stand);
 
 // // print_r($all_crs_ids);
//  echo "<select name='all_crs_ids' id='all_crs_ids'>";
//     $kk=0;
//  foreach ($all_crs_ids as $ii)
//   { $kk++;
//         echo "<option>$ii</option> ";   
//    }  
//    echo '</select>';
//  
  
  
  
  ?>
     
     <div class="select_state">
           <select name="lec_name" id="Course_name_state">
              <option selected disabled="disabled" value="">إختر مادتك الخاصة بالفرفة  ...</option>
             <?php
              for($i=0,$ii= count($coursesofdoc);$i<$ii;$i++)
                {
                  echo " <option name='' value='$coursesofdoc[$i]'>$coursesofdoc[$i]</option>";
                }
              ?>
           </select> 
             </div>
        <br />
     <b>group  </b>
<input type="text" name="current_group" id="current_group" value="m" />
<b>courses </b>
<input type="text" name="current_crs" id="current_crs" value="m" />

</div>




</div> 
<!--////////////////// Table Start ///////////////////////////////////////////////////-->


    <?php
  
 function who_modi_cell($conn,$stand)
  {
 $tablefill_sql="SELECT done FROM showtables where stand='$stand'";
 // echo $br.$br.'/////////////////////////////'.$br;
if ($result=mysqli_query($conn,$tablefill_sql))
  {
  // Fetch one and one row
    $d_c=0;
   $who_modi_cell=array();
    while ($row=mysqli_fetch_row($result))
    {
      $who_modi_cell[$d_c]=$row[0];
        $d_c++;
    }
   }
return $who_modi_cell;
 }
  $who_modi_cell=  who_modi_cell($conn,$stand);
 // print_r($who_modi_cell);
  
  
  
  
  
function doctor_lecs($conn,$dr_id,$stand)
{
    $d_arr=array();$l_arr=array();
    $dr_day_q="SELECT day FROM showtables where stand!='$stand' and dr_id=$dr_id ORDER BY day,lec ";
    $dr_day_sql=mysqli_query($conn,$dr_day_q);
    $dr_day_f=mysqli_fetch_all($dr_day_sql,MYSQLI_NUM);
    
    
    $dr_lecs_q="SELECT lec FROM showtables where stand!='$stand' and dr_id=$dr_id";
    $dr_lecs_sql=mysqli_query($conn,$dr_lecs_q);
    $dr_lecs_f=mysqli_fetch_all($dr_lecs_sql,MYSQLI_NUM);
    
    $dr_count_q="SELECT count(doc_c_id) FROM showtables where stand!='$stand' and dr_id=$dr_id";
    $dr_count_sql=mysqli_query($conn,$dr_count_q);
    $dr_count_f=mysqli_fetch_all($dr_count_sql,MYSQLI_NUM);
    $dr_count=$dr_count_f[0][0];
    for($i=0;$i<$dr_count;$i++)
       {
         $d_arr[$i]= $dr_day_f[$i][0]; 
         $l_arr[$i]=$dr_lecs_f[$i][0];
       }
    
    
   $redundant_lec=array("day"=>$d_arr,"lec"=>$l_arr);
   return $redundant_lec;
}
 $redundant_data=doctor_lecs($conn,$dr_id,$stand);
$redundant_day=$redundant_data["day"];
$redundant_lec=$redundant_data["lec"];

//print_r($redundant_day);
//echo '<br />';
//print_r($redundant_lec);
  
  
  
  
  
    ?>



    <?php
     function Empty_table()
   {
    ?>
    <form method="post" name="table">
    <table class="lec_table" id="myTable" style="width:90%; height:400px; direction: rtl;" >
     <tr class="firsttr">
         <th><center>الايام  </center></th>
    <?php
   
      for($i=1;$i<7;$i++)
        { 
          echo ' <th class="hhh"><center> المحاضرة  &nbsp;'.($i).'<center></th>';
        }
        ?>
        </tr>
       <?php
       ////////////////////////////////////////
      //$modi_day=1;$modi_lec=1;
       $Days_n=array("السبت","الاحد","الاثنين","الثلاثاء","الاربعاء","الخميس");
      for($i=0;$i<6;$i++)
      {
        echo '
        <tr>
           <td class="td1"><center> '.$Days_n[$i].' </center></td> ';
       //$counter_gr_no=0;
       
        for($j=1;$j<7;$j++)
       {
          echo '<td></td>';               
       }
       
       echo '</tr> ';
      } 
 ?>
 </table>
 </form>   
   <?php
   }
    
    
    
    
     function showtable($dr_id,$allowedmodi_day,$allowedmodi_lec,$allowedmodi_done,$who_modi_cell,$redundant_day,$redundant_lec)
   {
    ?>
    <form method="post" name="table">
    <table class="lec_table" id="myTable" style="width:90%; height:400px; direction: rtl;" >
     <tr class="firsttr">
         <th><center>الايام  </center></th>
    <?php
   
      for($i=1;$i<7;$i++)
        { echo ' <th class="hhh"><center> المحاضرة  &nbsp;'.($i).'<center></th>';}
        ?>
        </tr>
       <?php
       ////////////////////////////////////////
      //$modi_day=1;$modi_lec=1;
       $Days_n=array("السبت","الاحد","الاثنين","الثلاثاء","الاربعاء","الخميس");
       $inc=0; 
      for($i=0;$i<6;$i++)
      {
        echo '
        <tr onclick="row(this)">
               <td class="td1"><center> '.$Days_n[$i].' </center></td> ';
       //$counter_gr_no=0;
       
        for($j=1;$j<7;$j++)
       {$z=1;
          $rr=0;
        for($r=0;$r<count($redundant_day);$r++)
                      {
                         if($redundant_day[$r]==$i+1&&$redundant_lec[$r]==$j)
                         {
                           $rr=1;  
                         }
                         }
       
       if($rr==0)
       {
          for($k=0;$k< count($allowedmodi_day);$k++)
          {
              if($i+1==$allowedmodi_day[$k]&&$j==$allowedmodi_lec[$k])
              {
                  if($allowedmodi_done[$k]==0||$allowedmodi_done[$k]==$dr_id)
                  {
                           echo '<td  id="activecell" class="active"  onclick="cell(this)" data-toggle="modal" data-target="#myModal"></td>';               
                           $z=0;                      
                  }
                  
                  
              }
          }
             
       }
                  
       
       
       
       
          if($z==1)
             {
                
               if($who_modi_cell[$inc]==$dr_id)
               {
                    echo '<td  id="activecell" class="active"  onclick="cell(this)" data-toggle="modal" data-target="#myModal"></td>';               
               }
               else {
                    echo '<td> </td>'; 
                     }
               
               
              }
         $inc++;
      // echo '<td class="allowed" onclick="cell(this)" data-toggle="modal" data-target="#myModal">mmmm </td>';               
       }
       echo '</tr> ';
      } 
 ?>
 </table>
 </form>   
   <?php
   }
  $ch_found_stand=0;
   for($i=0;$i<count($stands);$i++)
   {
       if($stand===$stands[$i])
       {
           $ch_found_stand=1;
       }
   }
   
  if($count_stands===0||$ch_found_stand===0) 
  {
       Empty_table();
   //showtable($dr_id,$allowedmodi_day,$allowedmodi_lec,$allowedmodi_done,$who_modi_cell);
  }
 else {
   showtable($dr_id,$allowedmodi_day,$allowedmodi_lec,$allowedmodi_done,$who_modi_cell,$redundant_day,$redundant_lec);
   }
  
   ?>
    <!--///////////////     Modal      -->
   
   <!--////////////////// Start Modal1/////////////////////////////////////// --> 
   <div class="container">
    <div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog" >
     <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style="height:10px;">
              <button type="button" class="close" data-dismiss="modal" style="margin-top:-20px; ">X</button>
         </div>
        <div class="modal-body" style=" margin-bottom:0px; margin-top:-10px;">
         <!-- ///////////////////////////////////////////////////-->
         <form class="login" method="post" action=""  onsubmit="replace()"  >
	<h2 class="text-center">خصص المادة ثم اضغط حفظ</h2>
        <!--<input  type="text" id="" placeholder="إسم المادة" onfocus="this.value=''" autocomplete="on"/>-->
	<center>
            
        <div class="select_c">
           <!-- <input type="button" value='إظهار الكل'  style="color:#4e4e4e;background-color: buttonface; font-weight: bold; font-size: 16px;"
                   id='show_c_crs' name='selc_crs_btn' onclick="fill_select_list()" />
            -->
            <select name="lec_name" id="Course_name_rcv" dir="rtl" onclick="filter_select_list()" style="color:black; font-size: 20px;">
              <option selected disabled="disabled" value="">إختر مادتك الخاصة بالفرفة  ...</option>
             <?php
              for($i=0,$ii= count($coursesofdoc);$i<$ii;$i++)
                {
                  echo " <option name='' value='$coursesofdoc[$i]'>$coursesofdoc[$i]</option>";
                }
              ?>
           </select> 
             </div>
        <br />
        <div id="variables_html" class="variables_html">
    <input type="text" id="rowshow" name="rowshow"  />
    <input type="text" id="cellshow" name="cellshow"  />
    <input type="text" id="lec_name" name="lec_name"  />
    <br />
    <input type="text" id="logged_Dr" name="logged_Dr"  />
   <!-- <input type="text" id="g_no" name="g_no"  /> -->
    <br />
</div>
       
        <input type="submit" name="empty" class="btn" value=" تفريغ الفترة " style="width: auto; font-size: 16px; font-weight: bolder;" 
                onclick="if (!confirm(' هل تريد تفريغ الفترة !')) return false;" 
               />
        <input type="reset" name="reset" onclick="filter_select_list()" class="btn" data-dismiss="modal" value="  إلغاء التعديل  " style="width:auto ; font-size: 16px; font-weight: bolder;" />
        <input type="submit" name="save_modif"  class="btn" value="&nbsp; حفظ التعديل &nbsp;" 
               onclick="myFunction(1)" style="width: auto; font-weight: bolder; font-size: 16px;" /><!-- data-dismiss="modal"-->
        
        </center>
	</form>
        

        </div>
      </div>
    </div>
  </div>
</div>
<br />
<!--////////////////// End Modal1/////////////////////////////////////// -->
<!--//////////////////  Start H TML Variables/////////////////////////////////////// -->
<form method="post">
    <div id="variables_html" class="variables_html">
    <input type="text" id="rowshow" name="rowshow"  />
    <input type="text" id="cellshow" name="cellshow"  />
    <br />
    <input type="text" id="logged_Dr" name="logged_Dr"  />
    <input type="text" id="lec_name" name="lec_name" style="display:none;" />
   <br />
</div>
      <input type="submit"  class="btn" style="width: 160px; color: brown; background-color:buttonface; font-size: 15px; font-weight: bold; " name="reset_table" value="حذف التعديلات " 
              onclick="if (!confirm('تفريغ المدرج يلغي كل التعديلات الخاصة بك  في هذا المدرج فقط \nهل تريد تفريغ المدرج !')) return false;" 
             />
      <input type="submit" name="save_modif2" class="btn" style="width: 160px;" value="&nbsp; إظهار التعديلات &nbsp;" />

</form>


 </center>

<br />

<div class="footer" style="background-color: #7e9def; color:white; height: 100px">
  <center> 
  <br><br>@2017 Lecture Schedule - FCI Mansora University<br>
  </center>
</div>
 


</body>
</html>
  
  <?php
   
$conn->close();
eend: