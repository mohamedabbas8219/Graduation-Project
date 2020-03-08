<!DOCTYPE html>
<html>
<head>
<!-- re   //////////////////////////////////////////////////////////-->
 <title>&hearts; try cell modification M.A &hearts;</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- ////////////////////////////////////////////////////////////////-->
  <meta charset="utf-8">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   
<!--  Style start  /////////////////////////////////////////////////////-->
<style>
table, td {
    border: 1px solid black;
    width: 50px;
    height: 50px;
}
#variables_html{
    /* display: none;*/
}

</style>

<!--  Script start  /////////////////////////////////////////////////////-->
<script>
function row(x) 
 {
    document.getElementById("rowshow").innerHTML =x.rowIndex;  
    // alert("Row index is: " + x.rowIndex);
 }

function cell(x)
{
    document.getElementById("cellshow").innerHTML = x.cellIndex;
   // alert("Cell index is: " +  x.cellIndex);
}

function myFunction(x) {
    //var name=  prompt("what is your lecture?");
    //name نحط المادةة المختارة من السيلكت في المتغير 
    var name=document.getElementById("Course_name_rcv").value;
    document.getElementById("logged_Dr").innerHTML="د/ أسامة عودة ";
   var Logged_DR=document.getElementById("logged_Dr").innerHTML;//="<br>د/ أسامة عودة ";
    //html نجيب المتغيرين بتوع مكان الخلية من ص ال 
    var lec=  document.getElementById("cellshow").innerHTML;
    var day=  document.getElementById("rowshow").innerHTML;
    ///////////////////////////
    //وضع اسم الجدول بس ف متغير للتسهيل
    var y =document.getElementById("myTable");
    
    /*html هات الاسم من المتغير اللي في ص ال
   // var name2= document.getElementById("lec_name").innerHTML;*/
    ///////////////////////////////////////////////    
    if(x===1)// && name!=null) // لو ضغطت علي   تم
    {
       //html ضع الاسم في المتغير اللي في ص ال
       document.getElementById("lec_name").innerHTML = name+"<br>"+Logged_DR;//+"<br>د/ أسامة عودة "; 
       //   ضع اسم المادة والدكتور في الخلية اللي اختارتها ف الجدول
       y.rows[day].cells[lec].innerHTML="<center>"+name+"<br>"+Logged_DR+"</center>";
       // name=name;//+"<br>د/ أسامة عودة ";
    }
    else     // لو ضغطت علي   إلغاء
    {
      //   ضع فراغ في الخلية اللي اختارتها ف الجدول
     document.getElementById("lec_name").innerHTML =null;        //name+"<br>د/ أسامة عودة ";  
     y.rows[day].cells[lec].innerHTML=null;
    }
     
}

</script>

<!--  ///////////////////////////////////////////////////////////////////-->

</head>
<body>

<center>
        <img src="css/backgrounds/t1.jpg" width="70%" height="100px" />
    </center>
    <br />
    <!--/////////////////////////////////////////////////////////////////////--> 

    <div id="variables_html">
    <b>Cell ( </b> 
    <b id="rowshow"> </b>
    <a> , </a>
    <b id="cellshow"> </b>
    <b> ) :  </b>
    <b id="lec_name"> </b>
    <b id="logged_Dr" style="display: none;">د/ أسامة عودة </b>
</div>
   
 <!--   line   //////////////////////////////////////////////////////////////-->
 
    <div name="line" style="background:black;">
    <center><hr></center>
    </div>
  
 <!--////////////////// Table Start ///////////////////////////////////////////////////-->

<center>
    <table class="lec_table" id="myTable" style="width:90%; height:400px; direction: rtl;">
     <tr class="firsttr">
         <td><center>الايام  </center></td>
    <?php
      for($i=1;$i<7;$i++)
        {
      echo '
        <td class="hhh"><center> المحاضرة  &nbsp;'.($i).'<center></td>
        ';
        }
        ?>
        </tr>
        
       <?php
$Days_n=array("السبت","الاحد","الاثنين","الثلاثاء","الاربعاء","الخميس","الجمعة");
 for($i=0;$i<7;$i++)
        {
    echo '
        <tr onclick="row(this)">
               <td class="td1"><center> '.$Days_n[$i].' </center></td> 
                <td onclick="cell(this)" data-toggle="modal" data-target="#myModal">  </td>
                <td onclick="cell(this)" data-toggle="modal" data-target="#myModal">   </td>
                <td class="allowed" onclick="cell(this)" data-toggle="modal" data-target="#myModal"> </td>
                <td class="notnow" onclick="cell(this)" data-toggle="modal" data-target="#myModal"> </td>
                <td onclick="cell(this)" data-toggle="modal" data-target="#myModal">   </td>
                <td onclick="cell(this)" data-toggle="modal" data-target="#myModal">   </td>
                        
                  ';
         }  
         
        echo '
         </tr>
        
         ';
    

?>
</table>
  
 <?php
 echo '<br />';
 ?>
 </center>

<!--////////////////// End Table /////////////////////////////////////// -->
 <br />
 

 
 
 
 
 
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
         <form class="login" method="post" enctype="Application/x-www-form-urlencoded" >
	<h2 class="text-center">إختر المادة ثم اضغط تم</h2>
        <!--<input  type="text" id="" placeholder="إسم المادة" onfocus="this.value=''" autocomplete="on"/>-->
	<center>
        <div class="select_c">
         <?php 
         
         $sel_course=array("التعرف علي الانماط","الحسابات المتنقلة"); ?>
          
            <select name="sel_course" id="Course_name_rcv">
              <option selected disabled="disabled" value="" selected>كورسات الفرقة الرابعة ع ح </option>
             <?php
              for($i=0,$ii=count($sel_course);$i<$ii;$i++)
              {
                echo "<option>$sel_course[$i]</option>"; 
              }
             ?>
            
           </select> 
        </div>
        
        <br />
        <input type="submit" name="submit" value="Save" onclick="myFunction(1)" data-dismiss="modal" style="width: 160px;" />
       
        &nbsp;
        <input type="submit" onclick="myFunction(2)" data-dismiss="modal" style="width: 160px;" />
        
        <!-- <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#myModalR">Register</a></h5>\
        -->
        
        </center>

        <p class="message"><?php echo $message; ?></p>	
	</form>
         
        </div>
      </div>
    </div>
  </div>
</div>

<!--////////////////// End Modal1/////////////////////////////////////// -->
   

</body>
</html>
