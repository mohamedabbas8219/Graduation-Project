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
    <div> <center>
            <input class="btn" type="submit" value="مدرج 4 " name="submit4" onclick="window.open('study_table4.php', '_self')" id="selected_table">
            <input class="btn" type="submit" value="مدرج 3 " name="submit3" onclick="window.open('study_table3.php', '_self')">
            <input class="btn" type="submit" value="مدرج 2 " name="stand2" onclick="window.open('study_table2.php', '_self')">
             <input class="btn " type="submit" value="مدرج 1 " name="submit1" onclick="window.open('study_table.php', '_self')">
             <br /></center>
</div>
    
    
    
<div class="php_codes">    
   <!--connection   -->     
   <div>
<?php
 $br='<br />';
$logged_username=$userData['username'];
$Logged_pass=$userData['password'];
//$stand ='stand1';
$stand="مدرج4";
 //echo 'user : $Logged_dr';
 //echo $br.'password = '.$Logged_pass;

// Create connection
$conn = new mysqli("localhost", "root","", "mytables");
// Change character set to utf8
 mysqli_set_charset($conn,"utf8");

   // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
    //echo "<table >
    //<tr><th></th><th>ID</th><th>Name</th></tr>";
    while($row = $result->fetch_assoc()) {
     //  echo "<tr><td></td><td>".$row["dr_id"]."</td><td>".$row["dr_fullname"]."</td></tr>";
        $dr_id=$row["dr_id"];
        $dr_name=$row["dr_fullname"];
    }
   // echo "</table> <br />";
}
//echo '>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>   '.$dr_id.' >>  '.$dr_name.$br;
?>
</div>
 
 <!--       courses id , names     -->
 <div>
 <?php
 $crsids_sql="SELECT crs_id FROM coursesofdoctor where dr_id=$dr_id and alocated =0";   
 $crsids_q=mysqli_query($conn,$crsids_sql);
 $crs_ids_f=mysqli_fetch_all($crsids_q,MYSQLI_NUM);  // number

 $crs_count_sql="SELECT count(crs_id) FROM coursesofdoctor where dr_id=$dr_id and alocated =0";   
 $crs_count_q=mysqli_query($conn,$crs_count_sql);
 $crs_count_f=mysqli_fetch_all($crs_count_q,MYSQLI_NUM);  //    crs id
 $crs_count=$crs_count_f[0][0];

 //$crs = $conn->query($sql2);
  //echo 'Count of courses = '.$crs_count.$br;
 // echo 'Courses ids = ';
  
  $crs_ids=array();               /////////////////////////// array
  for($i=0,$ii=$crs_count;$i<$ii;$i++)
  {
     $crs_ids[$i]=$crs_ids_f[$i][0];
    // echo $crs_ids_f[$i][0].' , ';
  }
  //echo $br;
  //print_r($crs_ids);
  ////////////////////////////////////////////////////////// courses names
  $coursename_sql="SELECT crs_name,crs_id FROM allcourses where crs_id in(SELECT crs_id FROM coursesofdoctor where dr_id=$dr_id and alocated =0)";
  $coursename_q=mysqli_query($conn,$coursename_sql);
  $coursename_f=mysqli_fetch_all($coursename_q,MYSQLI_NUM);
  $coursesofdoc=array();
  
  $realidsofcoursesofdoc_sql="SELECT crs_id FROM allcourses where crs_id in(SELECT crs_id FROM coursesofdoctor where dr_id=$dr_id and alocated =0)";
  $realidsofcoursesofdoc_q=mysqli_query($conn,$realidsofcoursesofdoc_sql);
  $realidsofcoursesofdoc_f=mysqli_fetch_all($realidsofcoursesofdoc_q,MYSQLI_NUM);
  
  $realidsofcoursesofdoc=array();
///////////////////////////
  //echo 'Courses =(';
  for($i=0,$ii=$crs_count;$i<$ii;$i++)
  {
    $coursesofdoc[$i]=$coursename_f[$i][0];
    $realidsofcoursesofdoc[$i]=$realidsofcoursesofdoc_f[$i][0];
    
   // echo $coursename_f[$i][0].' >> '.$realidsofcoursesofdoc_f[$i][0].' , ';
    //echo $br;
    }
  //echo ')';
  //echo $br;
  //print_r($coursesofdoc);
  ?>
 </div>  
   
 <!--       groups id , names , departments for doctor   -->
 <div>
  <?php
 /////////////////////////////////////////////////////////// groups id
  $groupsid_sql="SELECT s_group FROM courses_groups where crs_id in(SELECT crs_id FROM coursesofdoctor where dr_id=$dr_id and alocated=0)";   
 $groupsid_q=mysqli_query($conn,$groupsid_sql);
 $groupsid_f= mysqli_fetch_all($groupsid_q,MYSQLI_NUM);
      //count of groups
 $groupscount_sql="SELECT count(s_group) FROM courses_groups where crs_id in(SELECT crs_id FROM coursesofdoctor where dr_id=$dr_id and alocated=0)";   
 $groupscount_q=mysqli_query($conn,$groupscount_sql);
 $groupscount_f=mysqli_fetch_all($groupscount_q,MYSQLI_NUM);
 $groupscount=$groupscount_f[0][0];
 
 //$crs = $conn->query($sql2);
  //echo $br.'Count of groups = '.$groupscount.$br;
 
  $groupsidsfordoc=array();
  
 // echo 'Groups Ids =(';
  for($i=0,$ii=$groupscount;$i<$ii;$i++)
  {
    $groupsidsfordoc[$i]=$groupsid_f[$i][0];
   // echo $groupsid_f[$i][0].' , ';
  }
  //echo ') .'.$br;
  
 sort($groupsidsfordoc);
 // print_r($groupsidsfordoc);
  
  
  ////////////////////////////////////////////// group names , dept name ,full group name
  $groupsdept_sql="SELECT dept FROM s_groups where group_id  in(
        SELECT s_group FROM courses_groups where crs_id in(
            SELECT crs_id FROM coursesofdoctor where dr_id=$dr_id and alocated =0))";
  $groupsdept_q=mysqli_query($conn,$groupsdept_sql);
  $groupsdept_f=mysqli_fetch_all($groupsdept_q,MYSQLI_NUM);
  
  ////////////////////////////////////////
  
  $groupsname_sql="SELECT st_group FROM s_groups where group_id in(
        SELECT s_group FROM courses_groups where crs_id in(
            SELECT crs_id FROM coursesofdoctor where dr_id=$dr_id and alocated =0))";
  $groupsname_q=mysqli_query($conn,$groupsname_sql);
  $groupsname_f=mysqli_fetch_all($groupsname_q,MYSQLI_NUM);
  
  $groupsofdoc=array(); 
  $deptsofdoc=array();
  $fullgroupname=array();
  //echo 'groups =(';
  for($i=0,$ii=$groupscount;$i<$ii;$i++)
  {
    $groupsofdoc[$i]=$groupsname_f[$i][0];
    //echo $groupsname_f[$i][0].' - ';
    
    $deptsofdoc[$i]=$groupsdept_f[$i][0];
    //echo $groupsdept_f[$i][0].' , ';
    $fullgroupname[$i]=$groupsname_f[$i][0].' - '.$groupsdept_f[$i][0];
  }
  
  //echo ')';
  echo $br;
 // print_r($fullgroupname);
           //print_r($coursesofdoc);   
  ?>
 </div>  
  
 <!--                                   get table data -->  
 <div>
 <?php
 ///////////////////////////////////////////////////////////   table first show
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
    //echo $br;
    }
    //echo $br;
 
}
?>
 </div>     
     
<!--                                                  Show data in table     -->
 <div>   
<?php
/////////////////////////////Show data in table
echo '<script>
           
           function fill() {
           document.getElementById("logged_Dr").value="'.$dr_name.'";               
           var y =document.getElementById("myTable");
           
        ';
$j_allow_counter=0;
$l_cou_allow_g=0;
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
  for($s=0;$s<$groupscount;$s++)
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
        y.rows['.$d_arr[$i].'].cells['.$l_arr[$i].'].innerHTML="<center>'.$celldept_group.$br.$cellalldoctors.$br.$cellallcrs.' </center>";
         ';
  }
  echo '} </script>
            ';
  ?>
 </div>
 
<!--   ////////////                                           لو قسمين في مدرج      -->
<div>    
<?php
  ////////////////////////////////////// dept name ,full group name  لو قسمين في مدرج
  ///count
  /*$cellgroupscount_sql="SELECT count(dept) FROM s_groups where group_id=2";   
 $cellgroupscount_q=mysqli_query($conn,$cellgroupscount_sql);
 $cellgroupscount_f=mysqli_fetch_all($cellgroupscount_q,MYSQLI_NUM);
 $cellgroupscount=$cellgroupscount_f[0][0];
 echo $br.'cellgroupscount'.$cellgroupscount.$br;
  */
 ///////////////////////////////////////////////

/*$length_days=array();

for($j=0;$j<6;$j++)
{
    $length_days[$j]=0;
for($i=0;$i< count($d_arr);$i++)
{
    if($d_arr[$i]==($j+1))
    {
    $length_days[$j]+=1;
    }

}
} 
echo 'vvvvvvvvv<pre>';
print_r($length_days);
echo '</pre>vvvvvvvv';
*/ 
   
  /////////////////////////////////////////////////////////////////
  ?>
</div>


</div> 

<!--////////////////// Table Start ///////////////////////////////////////////////////-->

<center>
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
                   echo '<td id="activecell" class="active"  onclick="cell(this)" data-toggle="modal" data-target="#myModal"> </td>';               
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
              <option selected disabled="disabled" value="" selected>كورسات الخاصة بالدكتور لتلك الفرق  </option>
             <?php
              for($i=0,$ii=$crs_count;$i<$ii;$i++)
                {
                  echo " <option name='save_modif' value='$coursesofdoc[$i]'>$coursesofdoc[$i]</option>";
                  
                }
                // $coursesofdoc[$i]=$coursename_f[$i][0];
                    // echo $coursename_f[$i][0].' , ';
             ?>
            
           </select> 
        </div>
        
        <br />
        
        <input type="submit" name="submit" class="btn" value="&nbsp; حفظ &nbsp;" onclick="myFunction(1)"  data-dismiss="modal" style="width: 160px;" />
       <!-- on click="my Function(1),cell update() -->
        &nbsp;
        <input type="reset" class="btn" value="&nbsp; الغاء &nbsp;" onclick="myFunction(2)"  data-dismiss="modal" style="width: 160px;" />
        
        <!-- <a h ref="#" data-dismiss="modal" data-toggle="modal" data-target="#myModalR">Register</a></h5>\
        -->
        
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
<form  method="post" action="#here">
    <div id="variables_html" class="variables_html">
    
    <!--<b>Cell ( </b> 
    <b id="rowshow"> </b>
    <a> , </a>
    <b id="cellshow"> </b>
    <b> ) :  </b>
    -->
   
   
    <input type="text" id="rowshow" name="rowshow"  />
    <input type="text" id="cellshow" name="cellshow"  />
    <br />
    <input type="text" id="logged_Dr" name="logged_Dr"  />
    <input type="text" id="lec_name" name="lec_name" style="display:none;" />
    
   <br />
</div>
    
    <input id="here" type="submit" name="save_modif" onclick="reload()" class="btn" value="&nbsp; حفظ التعديل &nbsp;"   data-dismiss="modal" style="width: 160px;" />
</form>

     <?php
     $modified_day;$modified_lec;$modified_course=0;
        try{
            if(isset($_POST['save_modif']))
          {
             
         $modified_day=$_POST['rowshow'];
         $modified_lec=$_POST['cellshow'];
         $modified_course=$_POST['lec_name'];
         
         $crs_realnum=0;
          for($i=0,$ii=$crs_count;$i<$ii;$i++)
                {
                if($modified_course==$coursesofdoc[$i])
                     {
                       $crs_realnum=$realidsofcoursesofdoc[$i];
                     }
                 }
                 
         if($modified_day!=null||$modified_lec!=null||$crs_realnum!=0)
             {
               $close_cell_q = "UPDATE coursesofdoctor SET alocated=$dr_id WHERE dr_id=$dr_id and crs_id=$crs_realnum";
                 $conn->query($close_cell_q);
                $update_cell_q = "UPDATE showtables SET dr_id=$dr_id,crs_id=$crs_realnum,done=$dr_id WHERE stand='$stand' and day=$modified_day and lec=$modified_lec";
                if ($conn->query($update_cell_q) === TRUE) {
                 echo "تم التعديل بنجاح";
                 
                } else {
                   echo "خطأ في التعديل : " . $conn->error;
                }
             
                
             }
             echo '
                      <script>
                      function reload(){
                     var myWindow = window.open("", "_self");
                     
                      }
                       </script>';
                 //echo 'allowed'.$br;
                // echo "day:$modified_day       >> lec: $modified_lec       >> crs:  $crs_realnum";
         }
         
             else {echo 'لم يتم ادخال مواد';}
             $modified_day=null;
             $modified_lec=null;
             $modified_course!=0;
        } 
          catch (Exception $ex)
          {
               echo '.';
          }
             //UPDATE table_name
//SET column1 = value1, column2 = value2, ...
//WHERE condition;
              //  
         
     ?>
     
     
    <!--/////////////////////////////////////////////////////////////////////-->   
     
     
     
    
   
<script>
            function cellupdate(x,y,crs)
            {
                alert("day = "+arguments[0] +", lec="+arguments[1]+" = "+arguments[2]);
                document.getElementById("modifiedcrs").innerHTML=arguments[2];
                
               alert("selected crs1 = "+document.getElementById("modifiedcrs").innerHTML);
               
            <?php
         /*    
            //echo "$modified_course=alert(document.getElementById('modifiedcrs').innerHTML);";
            // echo "bbbbbbbbbbbbbbbbb >> $modified_course";
                for($i=0,$ii=$crs_count;$i<$ii;$i++)
                {
                 echo 'if(arguments[2]==="'.$coursesofdoc[$i].'")
                     {
                      alert("'.$realidsofcoursesofdoc[$i].'");
                     ';               
                       $modified_course=$realidsofcoursesofdoc[$i];
                   echo'break; }
                      ';
                 
                // $coursesofdoc[$i]=$coursename_f[$i][0];
                //$realidsofcoursesofdoc[$i]=$realidsofcoursesofdoc_f[$i][0];
                 }
                 
                 
           // $modified_course =$_POST["modifiedcrs"];
           // echo "alert('$modified_course');";
            // document.getElementById("modifiedcrs").innerHTML;
           */
  ?>
    
  }
   </script>
   
   <?php
    // echo "bbbbbbbbbbbbbbbbbbbbb>> $modified_course";
// $update = "UPDATE showtables SET dr_id=$dr_id ,crs_id=2 , done=$dr_id WHERE stand='$stand' and day=4 and lec=3";
//
//if ($conn->query($update) === TRUE) {
//    echo "Record updated successfully";
//} else {
//    echo "Error updating record: " . $conn->error;
//}

 //echo ">>>>>>>>>>>>>>>.   ".$_POST('modifiedcrs');
 
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

?>
<br />
