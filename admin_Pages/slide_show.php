<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing:border-box}
body {font-family: Verdana,sans-serif;margin:0}
.mySlides {display:none}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>

<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css_admin/test.css">
	<link rel="stylesheet" href="css_admin/admin.css">
	<link rel="stylesheet" href="css_admin/bootstrap.min.css">
        
        <meta charset="utf-8">
	<title></title>
		 
</head>








<body>
  
<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">مدرج 1</div>
  <center>
   
      <center>
   
<?php
 $br='<br />';
$conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 
   ///////////////////////////////////////////              all groups
  $stand='مدرج1';
  
  echo "
 <div id='h4' style='width:99%; margin-bottom:0px;margin-right:0px;margin-top:5px; border-raduis:15px;'>
    <center> تعبئة  $stand</center></div>
";
  
  function all_groups_f($conn)
{
    $all_groups=array(); 
    $all_depts=array();
    $all_gr_d_ids=array();
    $count_sql="SELECT count(st_group) FROM s_groups where group_id >0";
  $count_q=mysqli_query($conn,$count_sql);
  $count_f=mysqli_fetch_all($count_q,MYSQLI_NUM);
   $count=$count_f[0][0];
    
   
   $c3=0;
 $groupsids_sql="SELECT group_id FROM s_groups where group_id>0";  
  $result = $conn->query($groupsids_sql);
if ($result->num_rows>0) {
     while($row = $result->fetch_assoc()) {
       $all_gr_d_ids[$c3]=$row["group_id"];
       $c3++;
     }
   }
   
  $groupsdept_sql="SELECT dept FROM s_groups where group_id>0";
  $groupsdept_q=mysqli_query($conn,$groupsdept_sql);
  $deptsname_f=mysqli_fetch_all($groupsdept_q,MYSQLI_NUM);
  
  $groupsname_sql="SELECT st_group FROM s_groups where group_id >0";
  $groupsname_q=mysqli_query($conn,$groupsname_sql);
  $groupsname_f=mysqli_fetch_all($groupsname_q,MYSQLI_NUM);
   
   $fullgroupname=array();
  for($i=0,$ii= $count;$i<$ii;$i++)
  {
   // $all_gr_d_ids=$groupsids_f[$i][0];
   $all_depts[$i]= $deptsname_f[$i][0];
   $all_groups[$i]=$groupsname_f[$i][0];
   $fullgroupname[$i]=$all_groups[$i].' - '.$all_depts[$i];
  }
  $all_groups_depts_f=array('all_gr_d_ids'=>$all_gr_d_ids,'all_groups'=>$all_groups,'all_depts'=>$all_depts,'fullgroupname'=>$fullgroupname);
     return $all_groups_depts_f;
}
  
$all_groups_depts=all_groups_f($conn);
$all_gr_d_ids=$all_groups_depts['all_gr_d_ids'];
$all_depts=$all_groups_depts['all_depts'];
$all_groups=$all_groups_depts['all_groups'];
$full_groups_depts=$all_groups_depts['fullgroupname'];

function stand_g_dpts($conn,$stand)
{
    $stand_groups=array(); 
  $stand_depts=array();
  $stand_groupsids=array();
  $doc_c_ids=array();
  $groupscount_sql="SELECT count(S_group) FROM showtables where stand='$stand'";   
 $groupscount_q=mysqli_query($conn,$groupscount_sql);
 $groupscount_f=mysqli_fetch_all($groupscount_q,MYSQLI_NUM);
 $groupscount=$groupscount_f[0][0];
  
  $doc_c_id_sql="SELECT doc_c_id FROM showtables where stand='$stand'";   
 $doc_c_id_q=mysqli_query($conn,$doc_c_id_sql);
 $doc_c_id_f= mysqli_fetch_all($doc_c_id_q,MYSQLI_NUM);
 
 $groupsid_sql="SELECT S_group FROM showtables where stand='$stand'";   
 $groupsid_q=mysqli_query($conn,$groupsid_sql);
 $groupsid_f= mysqli_fetch_all($groupsid_q,MYSQLI_NUM);
   
  for($i=0,$ii=$groupscount;$i<$ii;$i++)
  {
      $doc_c_ids[$i]=$doc_c_id_f[$i][0];
    $stand_groupsids[$i]=$groupsid_f[$i][0];
   }
  //$inc_d=0;
  for($i=0,$ii= count($stand_groupsids) ;$i<$ii;$i++)
  {
  $groupsdept_sql="SELECT dept FROM s_groups where group_id=$stand_groupsids[$i] ";
  $groupsdept_q=mysqli_query($conn,$groupsdept_sql);
  $groupsdept_f=mysqli_fetch_all($groupsdept_q,MYSQLI_NUM);
  
  $groupsname_sql="SELECT st_group FROM s_groups where group_id =$stand_groupsids[$i]";
  $groupsname_q=mysqli_query($conn,$groupsname_sql);
  $groupsname_f=mysqli_fetch_all($groupsname_q,MYSQLI_NUM);
   
  $stand_groups[$i]=$groupsname_f[0][0];
  $stand_depts[$i]=$groupsdept_f[0][0];
  }
  
   $fullgroupname=array();
  for($i=0,$ii= count($stand_groupsids);$i<$ii;$i++)
  {
   $fullgroupname[$i]=$stand_groups[$i].' - '.$stand_depts[$i];
  }
  $all_groups_depts_f=array('doc_c_ids_stand'=>$doc_c_ids,'stand_groupsids'=>$stand_groupsids,'stand_groups'=>$stand_groups,'stand_depts'=>$stand_depts,'fullgroupname'=>$fullgroupname);
     return $all_groups_depts_f;
  
}
  
  $stand_groups_depts=stand_g_dpts($conn,$stand);
  
  $doc_c_ids_stand=$stand_groups_depts['doc_c_ids_stand'];
 // print_r($doc_c_ids_stand);
  //echo $br;
  
  $stand_groupsids=$stand_groups_depts['stand_groupsids'];
  $stand_groups=$stand_groups_depts['stand_groups'];
  $stand_depts=$stand_groups_depts['stand_depts'];
 $stand_fullgroupname=$stand_groups_depts['fullgroupname'];
  
   ?>

   
    <form method="post" name="table">
    <table style="margin-top: 2px; width:99%; height: 400px; border: groove .5em #8aa5ec;  " id="table">
     <tr class="firsttr">
         <th><center>الايام  </center></th>
    <?php
      for($i=1;$i<7;$i++)
        { echo ' <th class="hhh"><center> المحاضرة  &nbsp;'.($i).'<center></th>';}
        ?>
        </tr>
      
       <?php
        $Days_n=array("السبت","الاحد","الاثنين","الثلاثاء","الاربعاء","الخميس","الجمعة");
        
        $inc2=0;
      for($i=0;$i<6;$i++)
      {
        echo '<th class="hhh" style="width:80px;"><center> '.$Days_n[$i].' </center></th> ';
       for($j=0;$j<6;$j++)
       { 
               echo '<td>';   
               echo "<center> 
              <select name='cell$inc2' id='cell$inc2' style='font-weight:bold;'>
               "; 
                echo " <option name='' value='_' selected>_</option>";
                 for($z=0;$z< count($full_groups_depts);$z++)
                  {
                     if($stand_groups[$inc2]!="_"&&$stand_depts[$inc2]!="_")
                     {
                     if($all_groups[$z]==$stand_groups[$inc2]&&$all_depts[$z]==$stand_depts[$inc2])
                     {
                       echo " <option name='' selected value='$full_groups_depts[$z]'>$full_groups_depts[$z]</option>";
                     }
                  else {
                        echo " <option name='' value='$full_groups_depts[$z]'>$full_groups_depts[$z]</option>";
                       }
                     }
                  else {
                  echo " <option name='' value='$full_groups_depts[$z]'>$full_groups_depts[$z]</option>";
                  }
                  }
                echo ' </select>';
               echo "</center></td> ";
               
            // echo "<td><input type='text' name='cell$inc2' value='' /></td>"; 
           
          $inc2++;
       }
         echo '</tr> ';
       }
       ?>
</table>
 <br />
 <input type='submit' name='delete' id='h4' value='تفريغ الكل' />
 <input type='submit' name='cancel' id='h4' value='إظهار التعديلات ' />
<input type='submit' name='save'   id='h4' value='حفظ التعديلات ' />
</form> 
</center>

     
   <?php   
        function update_group_in_stand($conn,$stand,$doc_c_id_stand,$all_gr_d_id)
           {
                $result="";
                 $upd_table_group_q = "UPDATE showtables SET S_group=$all_gr_d_id , dr_id=0 ,crs_id=0 ,done=0 where stand='$stand' and doc_c_id=$doc_c_id_stand";
                if ($conn->query($upd_table_group_q) === TRUE) 
                {
                 $result= "تم التعديل بنجاح";
                }
                else {
                   $result="خطأ في التعديل : " . $conn->error;
                }
                return $result;
            }
           
            
         function cell_crs_group_data($conn,$stand,$doc_c_id_stand)
         {
           $g_data_sql="SELECT S_group FROM showtables where stand='$stand' and doc_c_id=$doc_c_id_stand";   
           $g_data_q=mysqli_query($conn,$g_data_sql);
           $g_data_f= mysqli_fetch_all($g_data_q,MYSQLI_NUM);
           $g_data=$g_data_f[0][0];
           
           $c_data_sql="SELECT crs_id FROM showtables where stand='$stand' and doc_c_id=$doc_c_id_stand";   
           $c_data_q=mysqli_query($conn,$c_data_sql);
           $c_data_f= mysqli_fetch_all($c_data_q,MYSQLI_NUM);
           $c_data=$c_data_f[0][0];
          $cell_crs_g_data=array('g_data'=>$g_data,'c_data'=>$c_data);
            return $cell_crs_g_data;
           }
            
           function free_crs($conn,$gr,$crs)
           {
                $upd_table_group_q = "UPDATE courses_groups SET alocated=0 where s_group=$gr and crs_id=$crs";
                $conn->query($upd_table_group_q) ;
            }
           
            
     try
       { $modi_groups=array();
           $modi_g_ids=array();
           $result="";
           if(isset($_POST['save']))
           {
              for($i=0;$i<36;$i++)
             {
              $modi_groups[$i]=$_POST["cell$i"];
              }
              
             for($i=0;$i< count($modi_groups);$i++)
             {
                for($f=0;$f< count($full_groups_depts);$f++)
                {
                 if($modi_groups[$i]==$full_groups_depts[$f])
                 {
                    if(update_group_in_stand($conn,$stand,$doc_c_ids_stand[$i],$all_gr_d_ids[$f]))
                    {
                       $result="تم التعديل بنجاح ";  
                    }
                 }
                }
                 if($modi_groups[$i]=="_")
                 {
                     $cell_crs_group_data=cell_crs_group_data($conn,$stand,$doc_c_ids_stand[$i]);
                    $c_data=$cell_crs_group_data['c_data'];
                    $g_data=$cell_crs_group_data['g_data'];
                       //echo 'id : '.$doc_c_ids_stand[$i].'  >>  ';
                      //  echo 'cro : '.$c_data.'  >>  ';
                       // echo 'grs : '.$g_data.$br;
                    if($c_data!=0)
                    {
                    if(free_crs($conn,$g_data,$c_data))
                    {
                        $result="تم التعديل بنجاح ";
                    }
                      else {$result="عفوا لم يتم الحذف ";}
                    }
                   if( update_group_in_stand($conn,$stand,$doc_c_ids_stand[$i],0))
                   {
                     $result="تم التعديل بنجاح ";
                   }
                 }
             }
         }
       } 
       catch (Exception $ex)
       {
         echo 'Sorry , Something go wrong in Your prcess';
       }
     ?> 
    <center><h2 style="color:green; margin-top: -10px;"><?php echo $result; ?></h2></center>

   
      
      
      
      
      
      
      
      
  </center>
  <div class="text">مدرج 1</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">مدرج 2</div>
   <center>
    <br /><br /><br /><br /><br /><br />
                 <table style="width:50%; height:50%;">
                <tr>
                    <td>pen</td><td>pen</td><td>pen</td><td>pen</td>
                </tr>
                <tr>
                    <td>pen</td><td>pen</td><td>pen</td><td>pen</td>
                </tr>
                <tr>
                    <td>pen</td><td>pen</td><td>pen</td><td>pen</td>
                </tr>
                 <tr>
                    <td>pen</td><td>pen</td><td>pen</td><td>pen</td>
                </tr>
                 <tr>
                    <td>pen</td><td>pen</td><td>pen</td><td>pen</td>
                </tr>
            </table>
            </center>
  <div class="text">مدرج2</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">مدرج3</div>
  <img src="img_mountains_wide.jpg" style="width:100%">
  <div class="text">مدرج3</div>
</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = slides.length}    
  
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>

</body>
</html> 
