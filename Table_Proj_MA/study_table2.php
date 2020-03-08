<html>
    <head>
        
       <title>موقع تنظيم الجداول الدراسية</title>  
        
        
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
   <!-- ////////////////////////////////////////////////////////////////     slide show -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

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
  
#left_arr,#right_arr
{
    background-color: #7474dc;
    color: white;
}
 
   </style>
   <script>
      // document.getElementById("left_arr").style.color= "red";
   </script>
    </head>

 <body onpageshow="fill(),showDivs(2)" >
     <center>
<div class="header">
</div>
    <div class="variables_html">
        <?php 
           include_once 'loginDrName.php';
           include_once 'study_table_code.php';
           ?>
    </div>
         <div class="b" style="height:80px;"> 
          <a href="study_table.php">
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
         <div>
       <b style="font-size: 16px;" class="w3-button w3-black w3-display-left" id="left_arr" onclick="plusDivs(-1)"> &#10095; </b>   
         </div>
           <?php
    $stands=all_stands($conn);
  //echo "Stands : ";
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
       <!--  <div onclick="plusDivs(1)" style="font-size: 26px; width: 50px; height: 30px; background-color: silver;color: black; position: fixed; margin-right: 10px; margin-top: -30px;">-->
       <div>
       <b style="font-size: 16px;" class="w3-button w3-black w3-display-right" onclick="plusDivs(1)"> &#10094; </b>
         </div>
     <!--&nbsp;&#10094;            class="w3-button w3-black w3-display-right" -->
     </form>
     </center>
  </div>  
</div>
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
  //   useless function
 
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
      
      
          if(isset($_POST['reset_table']))
          {
              Reset_table($conn,$stand,$dr_id);
          }
      ?>
    </div>
 </div>
 <div>
  <?php
 /////////////////////////////////////////////////////////// groups id
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
  $allowed_modi_groups=allowed_modi_groups($conn,$stand,$allowedmodi_day,$allowedmodi_lec);
  //////////////////////////////////////
     $all_groups_ids=all_groups_ids($conn,$stand);
      $crsidsforgroups=array();
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
    <?php
  $who_modi_cell=  who_modi_cell($conn,$stand);
 $redundant_data=doctor_lecs($conn,$dr_id,$stand);
$redundant_day=$redundant_data["day"];
$redundant_lec=$redundant_data["lec"];
    
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