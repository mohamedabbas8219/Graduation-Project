<html>
    <head>
         
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
     <!-- ////////////////////////////////////////////////////////////////-->
   <meta name="viewport" content="width=device-width, initial-scale=1">
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
    </head>
 
<body onpageshow="fill()">
<div class="header">
</div>
    <div class="variables_html">
        <?php 
           include_once 'loginDrName.php';
         
         ?>
    </div>
    
<div class="b"> 
<img src="1.PNG" class="image" align="right">
<center><span class="s">جداول المحاضرات</span></center>
</div> 
  </div>      
   <div class="log_reg_home" style="top: 8px; right:25px; position:absolute;">
        
          <a href="userAccount.php?logoutSubmit=1" class="logout">Logout</a>
          <b> |  </b>
        
         <a href="#" data-toggle="modal" data-target="#myModalR">Register  </a>
          
        </div> 
    <div name="line" style="background:black;">
    <center><hr>
    </center>
    </div>
  <div style="margin-bottom:-10px;"> <center>
            <form action="" method="post" name="stands_btn">
            <input class="btn" type="submit" value="مدرج 4 " id="stand_btn4" name="stand4">
            <input class="btn" type="submit" value="مدرج 3 " id="stand_btn3"  name="stand3">
            <input class="btn" type="submit" value="مدرج 2 " id="stand_btn2" name="stand2">
            <input class="btn " type="submit" value="مدرج 1 " id="stand_btn1" name="stand1">
             
               <!--<input type="text" name="standname" value="مدرج1" style="" />
              <input type="submit" name="st2" value="مدرج2" />-->
           </form>
          </center>
</div>
    
    
<div class="php_codes">    
   <!--connection   -->     
   <div>
<?php
 $br='<br />';
$logged_username=$userData['username'];
$Logged_pass=$userData['password'];
//$stand="مدرج1";
 
 $conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 
  
  
 
//echo $stand;
  
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
$doc_c_id=0;
for($i=1;$i<5;$i++)
{$doc_c_id++;
    $standn="مدرج$i";
   for($d=1;$d<=6;$d++)
    {
      for($l=1;$l<7;$l++)
      {
            //$fill_cell_q = "delete from showtables where stand='مدرج5' ";   // to empty table
           //$update_cell_q = "UPDATE showtables SET dr_id=$dr_id,crs_id=$crs_realnum,done=$dr_id WHERE stand='$stand' and day=$modified_day and lec=$modified_lec";
               // اضافة الجدول القديم في الجديد 
              // $fill_cell_q = "insert into showtables(doc_c_id,s_group,stand,day,lec) VALUES($doc_c_id,0,'$standn',$d,$l)";
            // $conn->query($fill_cell_q);
        $doc_c_id++;
      }
      $doc_c_id++;
    }
}



$dr_id=0;
$dr_name="";
$sql_drid = "SELECT dr_id, dr_fullname FROM doctors where username='$logged_username' AND password='$Logged_pass'";
$result = $conn->query($sql_drid);
if ($result->num_rows>0) {
     while($row = $result->fetch_assoc()) {
       $dr_id=$row["dr_id"];
       $dr_name=$row["dr_fullname"];
     }
   }
   
   
   
   
    $stand="مدرج1";
  $count_stands=4;
for($s=1;$s<=$count_stands;$s++)
{
 if(isset($_POST["stand$s"]))
  {
     $stand="مدرج$s";
     $update_stand_q = "UPDATE doctors SET current_stand='$stand' where dr_id=$dr_id";
        $conn->query($update_stand_q);
   }
}
   
   if($stand=="مدرج1")
{
$stand=get_stand($conn,$dr_id);
}
   
//echo $stand;
   
//echo '>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>   '.$dr_id.' >>  '.$dr_name.$br;
?>
</div>
 
 <!--       courses id , names     -->
 <div>
 <?php
 function dr_courses_data($conn,$dr_id)
 {
 $crsids_sql="SELECT crs_id FROM coursesofdoctor where dr_id=$dr_id and alocated =0";   
 $crsids_q=mysqli_query($conn,$crsids_sql);
 $crs_ids_f=mysqli_fetch_all($crsids_q,MYSQLI_NUM);  // number

 $crs_count_sql="SELECT count(crs_id) FROM coursesofdoctor where dr_id=$dr_id and alocated =0";   
 $crs_count_q=mysqli_query($conn,$crs_count_sql);
 $crs_count_f=mysqli_fetch_all($crs_count_q,MYSQLI_NUM);  //    crs id
 $crs_count=$crs_count_f[0][0];
  $crs_ids=array();               /////////////////////////// array
  for($i=0,$ii=$crs_count;$i<$ii;$i++)
  {
     $crs_ids[$i]=$crs_ids_f[$i][0];
   }
   ////////////////////////////////////////////////////////// courses names
  $coursename_sql="SELECT crs_name,crs_id FROM allcourses where crs_id in(SELECT crs_id FROM coursesofdoctor where dr_id=$dr_id and alocated =0)";
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
 
 $dr_courses_data=dr_courses_data($conn,$dr_id);
 $coursesofdoc=$dr_courses_data['coursesofdoc'];
 $crs_idsofdoc=$dr_courses_data['crs_idsofdoc'];
  //print_r($crs_idsofdoc);
  ?>
 </div>  
   
 <!--       groups id , names , departments for doctor   -->
 <div>
  <?php
 /////////////////////////////////////////////////////////// groups id
  function dr_groups_depts_f($conn,$dr_id)
  {
  $groupsid_sql="SELECT s_group FROM courses_groups where crs_id in(SELECT crs_id FROM coursesofdoctor where dr_id=$dr_id and alocated=0)";   
 $groupsid_q=mysqli_query($conn,$groupsid_sql);
 $groupsid_f= mysqli_fetch_all($groupsid_q,MYSQLI_NUM);
      //count of groups
 $groupscount_sql="SELECT count(s_group) FROM courses_groups where crs_id in(SELECT crs_id FROM coursesofdoctor where dr_id=$dr_id and alocated=0)";   
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
        SELECT s_group FROM courses_groups where crs_id in(
            SELECT crs_id FROM coursesofdoctor where dr_id=$dr_id and alocated =0))";
  $groupsdept_q=mysqli_query($conn,$groupsdept_sql);
  $groupsdept_f=mysqli_fetch_all($groupsdept_q,MYSQLI_NUM);
  
  $groupsname_sql="SELECT st_group FROM s_groups where group_id in(
        SELECT s_group FROM courses_groups where crs_id in(
            SELECT crs_id FROM coursesofdoctor where dr_id=$dr_id and alocated =0))";
  $groupsname_q=mysqli_query($conn,$groupsname_sql);
  $groupsname_f=mysqli_fetch_all($groupsname_q,MYSQLI_NUM);
  
  $groupsofdoc=array(); 
  $deptsofdoc=array();
  for($i=0,$ii=$groupscount;$i<$ii;$i++)
  {
    $groupsofdoc[$i]=$groupsname_f[$i][0];
     $deptsofdoc[$i]=$groupsdept_f[$i][0];
  }
  
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
   //print_r($fullgroupname); 
                                     ////////////////////////////////////////////  
  ?>
 </div>  
  
 <!--                                   get table data -->  
 <div>
 <?php
 ///////////////////////////////////////////////////////////   table first show
  function table_data($conn,$stand)
  {
 $tablefill_sql="SELECT day,lec,S_group,dr_id,crs_id,done FROM showtables where stand='$stand' and S_group!=0 ORDER BY day,lec ";
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
       //$update_show = "UPDATE showtables SET dr_id=$row[3],crs_id=$row[4],done=$row[5],S_group=$row[2] WHERE stand='مدرج1' and day=$row[0] and lec=$row[1]";
         //   $conn->query($update_show);     
        // printf (" day : %s , lec : %s ,group :%s ,doctor :%s , crs: %s ",$row[0],$row[1],$row[2],$row[3],$row[4]);
    $d_c++;
    }
   }
$table_data=array('d_arr'=>$d_arr,'l_arr'=>$l_arr,'v_arr'=>$v_arr,'celldr_arr'=>$celldr_arr,'cellcrs_arr'=>$celldr_arr,'celldone_arr'=>$celldone_arr);
return $table_data;
 }
 $table_data=table_data($conn,$stand);
 $d_arr=$table_data['d_arr'];
 $l_arr=$table_data['l_arr'];
 $v_arr=$table_data['v_arr'];
 $celldr_arr=$table_data['celldr_arr'];
 $cellcrs_arr=$table_data['cellcrs_arr'];
 $celldone_arr=$table_data['celldone_arr'];
 
 
?>
 </div>     
     
<!--                                                  Show data in table     -->
 <div>   
<?php
/////////////////////////////Show data in table

function show_data_intable($conn,$deptsofdoc,$groupsofdoc,$dr_name,$table_data)
{
    $d_arr=$table_data['d_arr'];
 $l_arr=$table_data['l_arr'];
 $v_arr=$table_data['v_arr'];
 $celldr_arr=$table_data['celldr_arr'];
 $cellcrs_arr=$table_data['cellcrs_arr'];
 $celldone_arr=$table_data['celldone_arr'];
 
echo '<script>
           function fill() {
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
     
     $allowedmodi_day[$j_allow_counter]=$d_arr[$i];
     $allowedmodi_lec[$j_allow_counter]=$l_arr[$i];
     $allowedmodi_crs[$j_allow_counter]=$cellcrs_arr[$i];
     $allowedmodi_dr[$j_allow_counter]=$celldr_arr[$i];
     $allowedmodi_done[$j_allow_counter]=$celldone_arr[$i];
     $j_allow_counter++;
     
  }
 }
    echo'
        y.rows['.$d_arr[$i].'].cells['.$l_arr[$i].'].innerHTML="<center>'.$celldept_group."<br />".$cellalldoctors."<br />".$cellallcrs.' </center>";
         ';
  }
  echo '} </script>
            ';
 
  $allowed_modi_data=array('allowedmodi_day'=>$allowedmodi_day,'allowedmodi_lec'=>$allowedmodi_lec,'allowedmodi_crs'=>$allowedmodi_crs,'allowedmodi_dr'=>$allowedmodi_dr,'allowedmodi_done'=>$allowedmodi_done);
   return $allowed_modi_data ;
}

$allowed_modi_data=show_data_intable($conn,$deptsofdoc,$groupsofdoc,$dr_name,$table_data);
$allowedmodi_day=$allowed_modi_data['allowedmodi_day'];
$allowedmodi_lec=$allowed_modi_data['allowedmodi_lec'];
$allowedmodi_crs=$allowed_modi_data['allowedmodi_crs'];
$allowedmodi_dr=$allowed_modi_data['allowedmodi_dr'];
$allowedmodi_done=$allowed_modi_data['allowedmodi_done'];
  ?>
 </div>
<div>    
<?php
  
  /////////////////////////////////////////////////////////////////
  ?>
</div>

</div> 

<!--////////////////// Table Start ///////////////////////////////////////////////////-->
<center><h2 style="color:background; background-color: buttonface; margin-bottom: 1px; border: 1px; border-radius:3px;  width:90%; "><?php echo $stand ;?></h2></center>
<center>
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
      $modi_day=1;$modi_lec=1;
           
       $Days_n=array("السبت","الاحد","الاثنين","الثلاثاء","الاربعاء","الخميس","الجمعة");
        
      for($i=0;$i<7;$i++)
      {
        echo '
        <tr onclick="row(this)">
               <td class="td1"><center> '.$Days_n[$i].' </center></td> ';
       for($j=1;$j<7;$j++)
       {$z=1;
          for($k=0;$k< count($allowedmodi_day);$k++)
          {
              if($i+1==$allowedmodi_day[$k]&&$j==$allowedmodi_lec[$k])   //3&&$j==4)////////////////////modify later        //
              {
                  if($allowedmodi_done[$k]==0||$allowedmodi_done[$k]==$dr_id)
                  {
                   echo '<td  id="activecell" class="active"  onclick="cell(this)" data-toggle="modal" data-target="#myModal"></td>';               
                   $z=0;
                  }
              }
          }
             if($z==1)
             {
               echo '<td> </td>'; 
              }
         
        //echo '<td class="allowed" onclick="cell(this)" data-toggle="modal" data-target="#myModal"> </td>';               
       }
       echo '</tr> ';
      } 
      echo '</table>';
      
     
 ?>
</table>
   
    </form>   
        
        <!--///////////////     Modal      -->
   
   <!--////////////////// Start Modal1/////////////////////////////////////// --> 
<div class="container">
    <div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog">
     <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style="height:10px;">
          <button type="button" class="close" data-dismiss="modal">X</button>
         </div>
        <div class="modal-body" >
         <!-- ///////////////////////////////////////////////////-->
         <form class="login" method="post" action="" enctype="Application/x-www-form-urlencoded" >
	<h2 class="text-center">إختر المادة ثم اضغط حفظ</h2>
        <!--<input  type="text" id="" placeholder="إسم المادة" onfocus="this.value=''" autocomplete="on"/>-->
	<center>
        <div class="select_c">
         <?php 
          
         
         
         //$sel_course=array("التعرف علي الانماط","الحسابات المتنقلة");
         ?>
           <select name="sel_course" id="Course_name_rcv">
              <option selected disabled="disabled" value="" selected>إختر مادتك الخاصة بالفرفة  ...</option>
             <?php
             
             
              for($i=0,$ii= count($coursesofdoc);$i<$ii;$i++)
                {
                  echo " <option name='save_modif' value='$coursesofdoc[$i]'>$coursesofdoc[$i]</option>";
                  
                }
                // $coursesofdoc[$i]=$coursename_f[$i][0];
                    // echo $coursename_f[$i][0].' , ';
             ?>
            
           </select> 
         </form>
        </div>
        <?php
       
        ?>
        <br />
        
        <input type="submit" name="submit" class="btn" value="&nbsp; حفظ &nbsp;" onclick="myFunction(1)"  data-dismiss="modal" style="width: 160px;" />
       <!-- on click="my Function(1),cell update() -->
        &nbsp;
        <input type="reset" class="btn" value="&nbsp; الغاء &nbsp;" onclick="myFunction(2)"  data-dismiss="modal" style="width: 160px;" />
       
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
   
    <input type="submit" name="save_modif" class="btn" style="width: 160px;" value="&nbsp; حفظ التعديل &nbsp;" />
    <input type="submit"  class="btn" style="width: 160px; margin-top: -5px;" name="reset_table" value="حذف التعديلات " />

</form>

     <?php
     
     function update_table_cell($conn,$dr_id,$crs_realnum,$stand,$modified_day,$modified_lec)
      {
          $result="";
          $close_cell_q = "UPDATE coursesofdoctor SET alocated=$dr_id WHERE dr_id=$dr_id and crs_id=$crs_realnum";
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
       function current_cell_group($conn,$stand,$day,$lec)
        {
          $groupsid_sql="SELECT S_group FROM showtables where stand='$stand' and day=$day and lec=$lec";   
           $groupsid_q=mysqli_query($conn,$groupsid_sql);
           $groupsid_f= mysqli_fetch_all($groupsid_q,MYSQLI_NUM);
            $current_cell_group=$groupsid_f[0][0];
              return $current_cell_group;
          }
         
 function current_cell_courses($conn,$current_cell_group)
 {
  $crss_ids_sql="SELECT crs_id FROM courses_groups where s_group=$current_cell_group";   
 $crss_ids_q=mysqli_query($conn,$crss_ids_sql);
 $crss_ids_f= mysqli_fetch_all($crss_ids_q,MYSQLI_NUM);
 //count of groups
 $crss_count_sql="SELECT count(crs_id) FROM courses_groups where s_group=$current_cell_group";   
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

     $modified_day;$modified_lec;$modified_course=0;
        try{
            if(isset($_POST['save_modif']))
           {
             $modified_day=$_POST['rowshow'];
             $modified_lec=$_POST['cellshow'];
             $modified_course=$_POST['lec_name'];
         
                 $crs_realnum=0;
              for($i=0,$ii= count($coursesofdoc);$i<$ii;$i++)
                {
                if($modified_course==$coursesofdoc[$i])
                     {
                       $crs_realnum=$crs_idsofdoc[$i];
                      // echo '$coursesofdoc[$i] : '.$coursesofdoc[$i];
                     }
                 }
                 
           if($modified_day!=null&&$modified_lec!=null&&$crs_realnum!=0)
             {
                 
              $current_cell_group=current_cell_group($conn,$stand,$modified_day,$modified_lec);
              $current_cell_courses=current_cell_courses($conn,$current_cell_group);
              
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
                 $result= update_table_cell($conn,$dr_id,$crs_realnum,$stand,$modified_day,$modified_lec);
                table_data($conn,$stand);
                show_data_intable($conn,$deptsofdoc,$groupsofdoc,$dr_name,$table_data);
                 echo 'تم التعديل بنجاح';
                
                 }
                  else {
                     echo "Sorry this Course doesn't match this group";
                       }
            }
            else {echo 'لم يتم ادخال مواد';}
                 //echo 'allowed'.$br;
                // echo "day:$modified_day       >> lec: $modified_lec       >> crs:  $crs_realnum";
           }
             else {echo 'لم يتم ادخال مواد';}
             $modified_day=null;
             $modified_lec=null;
             $modified_course!=0;
             echo '<script>
                      function reload(){
                     var myWindow = window.open("", "_self");
                     } </script>';
        } 
          catch (Exception $ex)
          {
               echo '.';
          }
             
          function Reset_table($conn,$stand,$dr_id)
          {
              $reset_sh_q = "UPDATE showtables SET dr_id=0,crs_id=0,done=0 WHERE stand='$stand' and dr_id=$dr_id";
              $conn->query($reset_sh_q);
              $reset_cd_q = "UPDATE coursesofdoctor SET alocated=0 where dr_id=$dr_id";
              $conn->query($reset_cd_q);
          }
          if(isset($_POST['reset_table']))
          {
              Reset_table($conn, $stand,$dr_id);
          }
          ?>


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



