<!DOCTYPE html>
<html lang="en">
<head>
  <!-- re   //////////////////////////////////////////////////////////-->
 <title>MY_Functions_MA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- ////////////////////////////////////////////////////////////////-->
    <link href="css/table.css" rel="stylesheet" type="text/css"/>
    
    <!-- ////////////////////////////////////////////////////////////////-->
   <meta charset="utf-8">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   
   
             
</head>
<body>
    <div class="variables_html22">
        
        <?php
        function conn_sqli()
        {
            $conn = new mysqli("localhost", "root","", "mytables");
             mysqli_set_charset($conn,"utf8");
             if ($conn->connect_error) 
              {
                die("Connection failed: " . $conn->connect_error);
                } 
                return $conn;
         }
         
         function get_stand($conn,$dr_id)
         {
         $c_stand_sql="SELECT current_stand FROM doctors where dr_id=$dr_id";   
         $c_stand_q=mysqli_query($conn,$c_stand_sql);
        $c_stand_f=mysqli_fetch_all($c_stand_q,MYSQLI_NUM);
         $c_stand=$c_stand_f[0][0];
          return $c_stand;
          }
     
      function dr_info($conn,$logged_username,$Logged_pass)
    {   
     $sql_drid = "SELECT dr_id, dr_fullname FROM doctors where username='$logged_username' AND password='$Logged_pass'";
     $result = $conn->query($sql_drid);
     if ($result->num_rows>0) {
     while($row = $result->fetch_assoc()) {
       $dr_id=$row["dr_id"];
       $dr_name=$row["dr_fullname"];
      }
      }
      $dr_data=array("id"=>$dr_id,"name"=>$dr_name);
      return $dr_data;
   }          
          
          
     function set_stand($conn)     
     {
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
         }              
          
         
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
 
 
 
   function showtable($dr_id,$allowedmodi_day,$allowedmodi_lec,$allowedmodi_done,$who_modi_cell)
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
            if($z==1)
             {
               if($who_modi_cell[$inc]==4)
               {
                    echo '<td  id="activecell" class="active"  onclick="cell(this)" data-toggle="modal" data-target="#myModal"></td>';               
               }
               else {echo '<td> </td>'; }
               
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

 //////////////////////////////////////////////    isset functions
 
 
 
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
          $result="";
          $close_cell_q = "UPDATE courses_groups SET alocated=0 WHERE crs_id=$crs_realnum and s_group=$current_cell_group";
                 $conn->query($close_cell_q);
                $update_cell_q = "UPDATE showtables SET dr_id=0,crs_id=0,done=0 WHERE stand='$stand' and day=$modified_day and lec=$modified_lec";
              // $conn->query($update_cell_q);
                if ($conn->query($update_cell_q) === TRUE) 
                {
                 //$result= "تم التعديل بنجاح";
                 }
                else {
                 //  $result="خطأ في التعديل : " . $conn->error;
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

          
          
          
 
 
 
 
          
        ?>
    </div> 
</body>
</html>
