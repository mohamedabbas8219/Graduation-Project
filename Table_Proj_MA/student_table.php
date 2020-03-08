<html>
    <head>
        
        <title> تنظيم الجداول الدراسية طالب</title>  
        
        
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

 <body onpageshow="fill()" >
     <center>
<div class="header">
</div>
    <div class="variables_html">
        <?php 
           include_once 'loginDrName.php';
           ?>
    </div>
         <div class="b" style="height:80px;"> 
          
             <img src="images/logo.png" class="image" align="right" style="height:72px; border:1px; border-radius: 3px;">
          
<center>
    <span class="s">جداول المحاضرات</span>
</center>
   
</div> 
  </div>  
   <div class="log_reg_home" style="color: black; top: 4px; right:25px; position:absolute;">
         
          <b id="dr_name_sh" name="dr_name_sh" style="color:white;">طالب</b>
         
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
 <!--                                   get table data -->  
 <div>
 <?php
 ////////////////////////////////        conn
 
 
 $conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 
 
 ///////////////////////////////////////////////////////////   table first show
  function table_data($conn,$S_group)
  {
 $tablefill_sql="SELECT day,lec,crs_id,stand,dr_id FROM showtables where S_group='$S_group' ORDER BY day,lec ";
 // echo $br.$br.'/////////////////////////////'.$br;
if ($result=mysqli_query($conn,$tablefill_sql))
  {
  // Fetch one and one row
    $d_c=0;
    $d_arr=array();$l_arr=array();$stand_arr=array();$celldr_arr=array();$cellcrs_arr=array();
    while ($row=mysqli_fetch_row($result))
    {
   
      $d_arr[$d_c]=$row[0];
      $l_arr[$d_c]=$row[1];
      $cellcrs_arr[$d_c]=$row[2];
      $stand_arr[$d_c]=$row[3];
      $celldr_arr[$d_c]=$row[4];
        $d_c++;
       
    }
   }
$table_data=array('d_arr'=>$d_arr,'l_arr'=>$l_arr,'stand_arr'=>$stand_arr,'celldr_arr'=>$celldr_arr,'cellcrs_arr'=>$cellcrs_arr);
return $table_data;
 }

 $table_data=table_data($conn,1);
 $d_arr=$table_data['d_arr'];
 $l_arr=$table_data['l_arr'];
 $stand_arr=$table_data['stand_arr'];
 $celldr_arr=$table_data['celldr_arr'];
 $cellcrs_arr=$table_data['cellcrs_arr'];

 ?>
 </div>     
     
<!--                                                  Show data in table     -->
 <div>   
<?php
/////////////////////////////Show data in table

function show_data_intable($conn,$table_data)
{
  $d_arr=$table_data['d_arr'];
 $l_arr=$table_data['l_arr'];
 $stand_arr=$table_data['stand_arr'];
 $celldr_arr=$table_data['celldr_arr'];
 $cellcrs_arr=$table_data['cellcrs_arr'];
 
echo '<script>
           function fill() {
           var y =document.getElementById("myTable");
        ';
for($i=0;$i<count($d_arr);$i++)
 { ///////////////////////////////////////////////////////////////all table groups,depts
   
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
   if($cellcrs_arr[$i]>0){
  echo' y.rows['.$d_arr[$i].'].cells['.$l_arr[$i].'].innerHTML="<center>'.$cellallcrs."<br />".$stand_arr[$i]."<br />  د/ ".$cellalldoctors.'</center>";';
   }
  
  
 }
  echo '} </script>
            ';
 
}



show_data_intable($conn,$table_data);
 ?>
 </div>
</div> 
   
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
   
     function showtable()
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
   showtable();
  
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
