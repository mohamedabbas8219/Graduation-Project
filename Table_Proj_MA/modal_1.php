<!DOCTYPE html>
<html lang="en">
<head>
  <!-- re   //////////////////////////////////////////////////////////-->
 <title>Table</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- ////////////////////////////////////////////////////////////////-->
    <link href="css/table.css" rel="stylesheet" type="text/css"/>
    
    <!-- ////////////////////////////////////////////////////////////////-->
   <meta charset="utf-8">
   <title>Login</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   
   
    <style>
                 .allowed{background-image: url("css/backgrounds/blu.png");}
                  .allowed:hover{background:greenyellow;
                   color: green;
                 }
                 .notnow{background-image: url("css/backgrounds/blu.png");}
                  .notnow:hover{background:orange;
                 color: brown;
                 }
                 .notallowed{background-image: url("css/backgrounds/paper.gif");}
                  .notallowed:hover{background:brown;
                 color: white;
                 }
                  .lec_table tr td:hover{
                     background: yellow;
                 }
                 
    </style>
              
    <script>
     $(document).ready(function(){
     $('[data-toggle="modal"]').popover(); 
     $('[data-toggle="modal"]').popover(); 
     
      });
    </script>
 
</head>


<body>
   
    <center>
        <img src="css/backgrounds/t1.jpg" width="70%" height="100px" />
    </center>
    <br />
    
       <div class="log_reg_home" style="top: 8px; right:25px; position:absolute;">
        
          <a href="userAccount.php?logoutSubmit=1" class="logout">Logout</a>
          <b> |  </b>
         <a href="#" data-toggle="modal" data-target="#myModalR"> Register </a>
        </div>
    <div style="background:black;">
    <center><hr></center>
    </div>
    
<div> 
    <center>
    <div class="select">
         <?php $sel_th=array("Theatre1","Theatre2","Theatr3","Theatre4");?>
        
        
        <table class="sel" style="height:50px; width:80%;  font-size: 1.5em; border: none;">
     <tr><td>
        <h2> Theatre :</h2> 
     </td>
     
     <td>
         <select name="sel_th">
         <?php
         
        for($i=0;$i<4;$i++)
        {
            echo "<option>$sel_th[$i]</option>"; 
        }
        ?>
     </select>
   </td> 
   
   <td> . </td><td> . </td><td> . </td>
   <td>    
     <h2> Group :</h2> 
   </td>
   <td>
         <select name="gr_select">
            <option>1st_G</option> 
            <option>2nd_G</option> 
           <option>3rd_IT</option> 
           <option>4th_IT</option>
           <option>3rd_CS</option>
           <option>4th_CS</option>
           <option>3rd_IS</option>
           <option>4th_IS</option>
     </select>
       
    </td>
  </tr>
 </table>
    </div> 
    </center>
  <div>
      
<?php
$Doctor=array("Ali","Maged","Omar","Ziad","Mazen","Hany");

$ps=array(111,222,333,444,555,666);
$pr=array(1,2,2,3,4,5);

$counter_pass=0;
$max_periority= count($Doctor);
$Who_max_periority;
foreach ($Doctor as $d) {
    $password[$d]=$ps[$counter_pass];
    $periority[$d]=$pr[$counter_pass];
    if ($periority[$d]<$max_periority) {
        $max_periority=$periority[$d];
        $Who_max_periority=$d;
    }
    $counter_pass++;
}
//echo '<br /> Omar\'s Password : '.$password["Omar"].'<br />';
//echo '<br /> Omar\'s Periority : '.$periority["Omar"].'<br />';
//echo '<br /> Who has Maximum Periority ( '.$max_periority.' ) : '.$Who_max_periority.'<br />';

///////////////////////////////////////////////
$Departments=array("IT","CS","Is");
foreach ($Departments as $g) {
    $group[$g]=array("3rd","4th");
}
     $group["General"]=array("1st","2nd");
///////////////////////////////////////////////////

          $group["General"]["1st"] =array("Math","L_Algebra","Programming_fundamentals","Database1","Statistics");
          $group["General"]["2nd"] =array("Switching,routing","OOP","OperatingSystem","WebPrograming","Graphics");
          
          $group["IT"]["3rd"] =array("SWE","Network","Graphics","Database2","Statistics2");
          $group["IT"]["4th"] =array("Multimedia","PC","Pattern","Mobile","Bioinformatics");
          
          $group["CS"]["3rd"] =array("SWE2","Graphics2","Android","Analysis","Network_Prog");
          $group["CS"]["4th"] =array("ComputerVision","OOP","OperatingSystem2","java","Pattern");
          
          $group["IS"]["3rd"] =array("Database2","Network","analysis","logic","algorithms");
          $group["IS"]["4th"] =array("Database22","Network2","analysis2","logic2","algorithms2");
    
$first_g=$group["General"]["1st"];
$second_g=$group["General"]["2nd"];
$third_it=$group["IT"]["3rd"];
$third_cs=$group["CS"]["3rd"];
$third_is=$group["IS"]["3rd"];
$forth_it =$group["IT"]["4th"];
$forth_cs =$group["CS"]["4th"];
$forth_is =$group["IS"]["4th"];

///////////////////////////////

$IT_Doctors=array("Ali","Ziad");
$CS_Doctors=array("Hany","Mazen");
$IS_Doctors=array("Maged","Omar");

////////////////////////////////////////////////////
 
     
?>


 
 
 
 
<center>
    <table class="lec_table">
     <tr class="firsttr">
         <th>Days</th>
         <th>Lec 1</th>
         <th>Lec 2</th>
         <th>Lec 3</th>
         <th>Lec 4</th>
         <th>Lec 5</th>
         <th>Lec 6</th>
        </tr>
             
        
<?php

$lec_value="Empty";
$lec=array("Lec1"=>$lec_value,"Lec2"=>$lec_value,"Lec3"=>$lec_value,"Lec4"=>$lec_value,"Lec5"=>$lec_value,"Lec6"=>$lec_value);
$Days=array("Satarday"=>$lec,"Sunday"=>$lec,"Monday"=>$lec,"Tuesday"=>$lec,"Wednesday"=>$lec,"Thursday"=>$lec,"Friday"=>$lec);
$Days_n=array("Satarday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday");
 $Theatres=array("Theatre1"=>$Days,"Theatre2"=>$Days,"Theatre3"=>$Days,"Theatre4"=>$Days);
 /*/////////////////////////////////////////////////////////////////////*/
 
 $Days[$Days_n[1]]["Lec3"]="Multimedia";
 $allocated_th=2;   // used inside for to  select allowed cells 
 
 /*/////////////////////////////////////////////////////////////////////*/

 for($i=0;$i<7;$i++)
        {
    echo '
        <tr>
        ';
       
        echo ' 
             <td class="td1">'.$Days_n[$i].'</td>
            ';
         echo '
              <td> '.$Days[$Days_n[$i]]["Lec1"]. '  </td>
              <td> '.$Days[$Days_n[$i]]["Lec2"]. '  </td>
                  ';
         //style=" background-image: url("css/backgrounds/paper.gif");
         if($i==$allocated_th)
         {
             echo '
                 
               <td class="allowed"> 
               <a href="#myModal" data-trigger="hover" data-content="Click to Edit" data-toggle="modal" data-placement="right"  data-target="#myModal" style=" font-size: 20px;">'.$Days[$Days_n[$i]]["Lec3"]. '</a>  
                   </td>
                
               <td class="notnow" > 
                <a href="#myModal" data-trigger="hover" data-content="Edition not allowed now" data-toggle="modal" data-target="#myModal"  style=" font-size: 20px;">'.$Days[$Days_n[$i]]["Lec4"]. '</a>  
                    </td>
                ';
         }
    else {
         echo '
              <td class=""> '.$Days[$Days_n[$i]]["Lec3"]. '  </td>
              <td class="">'.$Days[$Days_n[$i]]["Lec4"]. '  </td>';
            }
             echo '
              
              <td> '.$Days[$Days_n[$i]]["Lec5"]. '  </td>
              <td> '.$Days[$Days_n[$i]]["Lec6"]. '  </td>
                                      
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
    
<div class="container">
 <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Login</button>
  -->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
     <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style="height:10px;">
          <button type="button" class="close" data-dismiss="modal">X</button>
         </div>
        <div class="modal-body" >
         <!-- ///////////////////////////////////////////////////-->
        <form class="login">
	<h2 class="text-center">login</h2>
        <input class="form-control input-lg" type="text" name="user" placeholder="Username" autocomplete="on"/>
	<input class="form-control input-lg" type="password" name="pass" placeholder="Password" autocomplete="off"/>
	<input class="btn btn-primary btn-block input-lg" type="submit" name="login"data-toggle="modal" data-target="#myModal">
        
        <h5 class="text-center"><a href="register.html">Forget password?</a></h5>
	<h5 class="text-center">Don't have an account?
            <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#myModalR">Register</a></h5>

		
	</form>
        </div>
      </div>
    </div>
  </div>
</div>

<!--////////////////// End Table /////////////////////////////////////// -->
    <div class="container">
  
  <!-- Trigger the modal with a button 
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalR">Register</button>
-->
  <!-- Modal -->
  <div class="modal fade" id="myModalR" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content      &times;-->
      <div class="modal-content">
          <div class="modal-header" style="height:10px;">
              <button type="button" class="close" data-dismiss="modal">X</button>
        </div>
        <div class="modal-body" >
         <!-- ///////////////////////////////////////////////////-->
         <form class="modal2" >
	<h2 class="text-center">Create New Account</h2>
	<input class="form-control input-lg" type="text" name="first" placeholder="First Name" autocomplete="off"/>
	<br />
        <input class="form-control input-lg" type="text" name="last" placeholder="Last Name" autocomplete="off"/>
	<br />
        <input class="form-control input-lg" type="email"  name="email" placeholder="Email" autocomplete="off">
	<br />
        <input class="form-control input-lg" type="password" name="pass" placeholder="Password" autocomplete="off"/>
	<br />
        <input class="form-control input-lg" type="password" name="cpass" placeholder="Confirm Password" autocomplete="off"/>
	<br />
        <input class="btn btn-primary btn-block input-lg" type="submit"  data-dismiss="modal"  name="login" data-toggle="modal" data-target="#myModal">
         </form>
             
        </div>
      </div>
     </div>
  </div>
</div>

         

</div>

        <div>  
        </div>        
        
        
    <!-- ####################################################################################################### -->
<div class="footer">
  <center><b>WE HOPE TO HELP YOU TO FIND YOU To make a Suite TABLE</b> 
  <br />Table Project<br /><br />
  </center>
</div>
 <!--####################################################################################################### -->

    
    
    </body>
</html>
