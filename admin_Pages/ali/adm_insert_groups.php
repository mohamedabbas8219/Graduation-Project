
<?php
include_once "connection.php";
?>



<!DOCTYPE html>
<html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="css_admin/test.css">
     <link href="css_admin/admin.css" rel="stylesheet" type="text/css"/>
     <link rel="stylesheet" href="css_admin/bootstrap.min.css">
      <title>insert groups </title>
        <script>
        $(document).ready(function(){
        $('[data-toggle="popover"]').popover();   
         });
     </script>
     <style>
          .variables_html{display: none;}
     </style>
    </head>
<body>
    <?php 
    
    $conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 
  
  $result="";
  ?>
    <div id="variables_html" class="variables_html">
   <?php
   //st:
        $all_groups2=selectgroups($conn);
       $group_id2=$all_groups2['group_ids'];
  
       
       
       
       if (isset($_POST['saveg']))
     {
    $new_dept_name=filter_input(INPUT_POST,'dept',FILTER_SANITIZE_STRING);
    $new_group_name=filter_input(INPUT_POST,'group',FILTER_SANITIZE_STRING);
    $capacity=filter_input(INPUT_POST,'capacity');
    $h_periority=filter_input(INPUT_POST,'new_periority');

    if(!check_group($conn,$new_group_name,$new_dept_name,0))
      { 
         // $result="هذه الفرقة موجودة بالفعل";  
        if(creategroup($conn,$new_group_name,$new_dept_name,$capacity,$h_periority))
        {
            $result="تم إضافة الفرقة بنجاح";
           
         }
     else {
        $result="عفوا لم يتم حفظ الفرقة ";   
        }
      }
      else {
        $result="هذه الفرقة موجودة بالفعل";   
        }
    } 
       
  for($i=1;$i<count($group_id2);$i++)
  {
     if(isset($_POST["save$i"]))
     {
      $new_group_name=$_POST["groupname$i"] ;
      $new_dept_name=$_POST["deptname$i"];
      $capacity_modi=$_POST["capacity$i"];
      $periority_modi=$_POST["periority$i"];
      $groupid=$group_id2[$i];
      if(!check_group($conn,$new_group_name,$new_dept_name,$groupid))
      {
         if(update_groups($new_group_name,$new_dept_name,$groupid,$capacity_modi,$periority_modi))
         {
         $result="تم التعديل بنجاح";
         }
         else {
            $result="تم التعديل بنجاح";
        //$result="عفوا لم يتم التعديل";  
             }
      } 
     else 
      {
       $result="هذه الفرقة موجودة بالفعل";   
      }
     }
  } 
  
  for($i=1;$i<count($group_id2);$i++)
  {
       if(isset($_POST["delete$i"]))
       {
      $groupid2=$group_id2[$i];
      delete_group($conn,$groupid2);
      
          $result="تم حذف الفرقة بنجاح";
     
      }
    }
  ?>
    </div>   
        
        
   <?php     
   //////////////////////////////////////////////////////////    
  
     $all_groups=selectgroups($conn);
  $group_id=$all_groups['group_ids'];
 $groupname=$all_groups['all_groups'];
 $deptname=$all_groups['all_dept'];
 $capacities=$all_groups['capacity'];
 $periority=$all_groups['periority'];
 //print_r($deptname);
    ?>
    
    <div style=" margin:auto; position: fixed; width: 100%; top:0;   font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">
    <form method="post" enctype="application/x-www-form-urlencoded">
   <center>
   <table  style="margin-top: 0px;width:100%; border:2px #008dde solid;"  id="table">
   <tr>
    <th colspan="6"> اضافة الفرق بالكلية</th>
  </tr>
  <tr>
    <th style="width: 6%;">م</th>
    <th style="width: 20%;">القسم</th>
    <th style="width: 20%;">الفرقة</th>
    <th style="width: 10%;">عدد الطلبة</th>
    <th style="width: 10%;">أولوية التعديل</th>
    <th> </th>
    
    
   
    
  </tr>
 <form method='post'>
  <tr>
      <td style="width: 6%; background-color: #f2f2f2;"><center><b>+</b></center></td>   
 <td style="width: 20%; background-color: #f2f2f2;"> <center> <input required id="h1" type="text" name="dept" placeholder="قسم جديد"
                       data-toggle='popover' data-trigger='hover' data-content='قسم جديد' /></center></td>
<td style="width: 20%; background-color: #f2f2f2;">  <center><input required id="h1" type="text" name="group" placeholder="فرقة جديدة"
                      data-toggle='popover' data-trigger='hover' data-content='فرقة جديدة'/> 
               </center> </td>
<td style="width: 10%; background-color: #f2f2f2;"><center><input required id="h1" type="number" min="30" max="3000" name="capacity" value="150" />
    </center></td>
   
 <td style="width: 10%; background-color: #f2f2f2;"> <center>
     <select name="new_periority" style='font-size:20px;'  data-toggle='popover' data-trigger='hover' data-content='أعلي أولوية بالقسم' >
     <?php   
     for($j=1;$j<7;$j++)
         {
           if($j==6)   //xx
            {
             echo "<option selected value='$j'>$j</option> ";
            }
             else 
             {
              echo "<option>$j</option> ";
             }
           }
    ?>
   </select>
     </center>
  </td>
          
    <td style="background-color: #f2f2f2;">   
    <center>
    <input type="submit" id="h4" name="saveg" value="إضافة فرقة جديدة"
           data-toggle='popover' data-trigger='hover' data-content='إضافة'/>
   <input type="reset" id="h4" name="" value="إلغاء الاضافة"
               data-toggle='popover' data-trigger='hover' data-content=' إلغاءالاضافة '/>
        
    </center>
    </td>
    
  </tr>
  </form>
   </table>
   </center>
     </form>
   </div> 
  <hr />
    
  <center>
      <table id="table" style="margin:auto; position: fixed; width: 100%; top:121px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">
     <tr>
     <th style="width: 6%;">م</th>
      <th style="width: 20%;">القسم</th>
     <th style="width: 20%;">الفرقة</th>
     <th style="width: 10%;">عدد الطلبة</th>
     <th style="width: 10%;">أولوية التعديل</th>
     <th> 
         <form method="post" action="">
             <input type='submit' style=" margin-bottom: 0px; margin-top: -100px; 
                    color:#ffffff; background-color: #3366ff; font-weight: bold; "
                    value=' تحديث '/> &nbsp;&nbsp;&nbsp;
             <b><?php echo "$result"; ?> </b>
     </form>
     </th>
     </tr>                   
     </table> 
    
  </center>
    
    <!-- /////////////////////////////////////////////////////////////////////-->
    
<center>
    <form name="groups" method="post">
<table style="margin-top: 143px;width:100%;"  id="table">
 
    <form method='post'>
  <?php
  $c_g=0;
   for ($i=count($groupname)-1;$i>0;$i--)
   {
       $c_g++;
        if($i%2!=1)
   {
   echo "<tr style='background-color: #f2f2f2;'>";
   }
   else {echo "<tr>";}
  ?>
         <td style='width: 6%;'>
  	   <center><b name='<?php echo"$group_id[$i]";?>'><?php echo"$group_id[$i]";?></b></center>
  	</td>
  	<td style='width: 20%;'>
        <center><input type='text' required id='h1' style='color:black;' name='<?php echo"deptname$i";?>' 
           data-toggle='popover' data-trigger='hover' data-content='تعديل القسم ' 
           value='<?php echo"$deptname[$i]";?>'></center>
  	</td>
        <td style='width: 20%;'>
        <center><input type='text' required id='h1' style='color:black;' name='<?php echo"groupname$i";?>'
           data-toggle='popover' data-trigger='hover' data-content='تعديل الفرقة '
           value='<?php echo"$groupname[$i]";?>'></center>
  	</td>
        
      <td style='width: 10%;'>
<center>
 <center>
     <input id='h1' style="color:black; font-size:20px; " type='text' name='<?php echo"capacity$i";?>' data-toggle='popover' data-trigger='hover'
            data-content=' تعديل عدد طلبة الفرقة' value="<?php echo"$capacities[$i]";?>"></center>
 </center>
</td>

<td style='width: 10%;'>
<center>
 <select name="<?php echo"periority$i";?>" style='font-size:20px;'  data-toggle='popover' data-trigger='hover' data-content='أعلي أولوية بالقسم' >
     <?php   
     for($j=1;$j<7;$j++)
         {
           if($j==$periority[$i])   //xx
            {
             echo "<option selected value='$j'>$j</option> ";
            }
             else 
             {
              echo "<option>$j</option> ";
             }
           }
    ?>
</select>
</center>
</td>
 
<td>
<center>
  <input type='submit' name='<?php echo"save$i";?>'   id='h4' value='حفظ التعديلات '
      data-toggle='popover' data-trigger='hover' data-content='إضغط لحفظ التعديلات '/>
 
  <!--<input type='submit' name='' id='h4' value='إلغاء' data-toggle='popover' data-trigger='hover' data-content='إضغط لالغاء التعديل ' />  
  -->
<input type='submit' name='<?php echo"delete$i";?>' id='h4' value='حذف' onclick="if (!confirm('هل تريد حذف الفرقة !'))return false;"
         data-toggle='popover' data-trigger='hover' data-content='إضغط لحذف الفرقة ' />

<!--<button id='h4' name='<?php echo"course$i";?>'  data-toggle='popover'
        data-trigger='hover' data-content='إضغط لتعبئة مواد الفرقة' > 
    <a style='color:white;' href='adm_inser_courses_in_group.php'>تعبئه مواد الفرقه </a></button>

    -->
    <button id='h4' value='<?php echo"course$i"; ?>'  data-toggle='popover' 
                           data-trigger='hover' data-content='إضغط لتعبئة مواد الفرقة' > 
        <a style='color:white;' href="adm_inser_courses_in_group.php?action=fill&id=<?php echo $group_id[$i]; ?>">تعبئه مواد الفرقه  </a> </button>

</center>
</td>
  </tr>
  <?php
 }
 ?>
  </form>  
</table>
       
<br />
   
</center>




</body>
</html>
