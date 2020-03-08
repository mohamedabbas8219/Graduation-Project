<?php 
session_start();
require_once 'db.php';
require_once 'courses.php';
require_once 'Doctors.php';
require_once 'coursesofdoctor.php';      



$groupsql="SELECT distinct v_dept FROM allcourses where crs_id>0";
$groupsql1=$conn->query($groupsql);
$results = $groupsql1->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'courses', array('v_dept'));
$results = (is_array($results) && !empty($results)) ? $results : FALSE;

#select all courses from DB

$sql = "select * from allcourses where dr_alocated=0 and v_dept='".$_GET['dept']."'";
$stmt = $conn->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'courses', array('crs_name'));
$result = (is_array($result) && !empty($result)) ? $result : FALSE;


//$dr_name="MA";
$dr_id2 = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
function dr_name($dr_id2)
{
    
 $conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 
  
 $dr_name_sql="SELECT dr_fullname FROM doctors where dr_id=$dr_id2";   
 $dr_name_q=mysqli_query($conn,$dr_name_sql);
 $dr_name_f=mysqli_fetch_all($dr_name_q,MYSQLI_NUM);
 $dr_name=$dr_name_f[0][0];
 return $dr_name;
}
$dr_name=dr_name($dr_id2);

//$sh_tbl_c_sql="SELECT max(doc_c_id) FROM showtables";   
//            $sh_tbl_c_q=mysqli_query($conn,$sh_tbl_c_sql);
//           $sh_tbl_c_f= mysqli_fetch_all($sh_tbl_c_q,MYSQLI_NUM);
//            $sh_tbl_max_id=$sh_tbl_c_f[0][0]; 
            
if (isset($_POST['submit'])) {
      
    #$crs_id=$_POST['idofcourses'];
   #$crs_name=filter_input(INPUT_POST, 'crs_name',FILTER_SANITIZE_STRING);
   $crs_id=filter_input(INPUT_POST, 'idofcourses',FILTER_SANITIZE_NUMBER_INT);

if (isset($_GET['action']) && $_GET['action'] == 'fill' && isset($_GET['id'])) {
 
        $dr_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $param=array(':dr_id'=>$dr_id, ':crs_id'=> $crs_id);
        try{
             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $c_o_d = $conn->prepare("SELECT MAX(c_o_d) FROM coursesofdoctor");
             $c_o_id= $c_o_d->execute();
             $c_o_id=$c_o_d->fetchColumn();
             $cid= intval ($c_o_id)+1;
            
                $sql2 = "INSERT INTO coursesofdoctor (c_o_d,dr_id, crs_id)VALUES ('{$cid}','{$dr_id}', '{$crs_id}')  ";
                $delete_crs_name="UPDATE allcourses SET dr_alocated=1,dr_id=$dr_id WHERE crs_id=$crs_id";       
        //   $sql2 = "insert into coursesofdoctor set dr_id= :dr_id,crs_id= :crs_id  WHERE NOT EXISTS "
       //                 . "(select dr_id,crs_id from coursesofdoctor  WHERE dr_id= :dr_id and crs_id=:crs_id ) ";
       //      $sql2= "    IF NOT EXISTS 
       //    (   select dr_id,crs_id from coursesofdoctor  WHERE dr_id= :dr_id and crs_id=:crs_id
       //    )
       //    BEGIN
       //        insert into coursesofdoctor set dr_id= :dr_id,crs_id= :crs_id
       //    END;";

               $stmt = $conn->prepare($sql2);
               $stmt->execute($param);
               $st = $conn->prepare($delete_crs_name);
               $st->execute($param);
               $_SESSION['message'] = 'تم الحفظ بنجاح ';
              $redirectURL =  $_SERVER['PHP_SELF']."?action=fill&id=".$dr_id."&dept=".$_GET['dept'];
              header("Location:" . $redirectURL);
                session_write_close();
                exit;
                }
     catch (Exception $ex) {
                 
                $_SESSION['message'] = 'المادة مسجلة من قبل ';
                }
       $redirectURL =  $_SERVER['PHP_SELF']."?action=fill&id=".$dr_id;
            header("Location:" . $redirectURL);
}   
} 

$stmt = $conn->prepare("SELECT	allcourses.crs_name , coursesofdoctor.dr_id,coursesofdoctor.crs_id  FROM allcourses 
	INNER JOIN coursesofdoctor   ON allcourses.crs_id=coursesofdoctor.crs_id INNER JOIN doctors ON coursesofdoctor.dr_id=doctors.dr_id  where coursesofdoctor.dr_id='".$_GET['id']."'");
			// Execute The Statement
			$stmt->execute();
			// Assign To Variable 
			$items = $stmt->fetchAll();
//                        echo "<pre>";
//                        var_dump($items);
//                        echo "</pre>";

//                        echo $sqlupdate1 = "UPDATE table SET commodity_quantity=$qty WHERE user='".$rows['user']."' ";

#delete
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])&&isset($_GET['dr_id'])) {
  $crs_id=filter_input(INPUT_GET, 'id',FILTER_SANITIZE_NUMBER_INT);
  $dr_id = filter_input(INPUT_GET, 'dr_id', FILTER_SANITIZE_NUMBER_INT);
  
    if ($crs_id > 0) {
        $sql = "delete from coursesofdoctor where crs_id=$crs_id and dr_id=$dr_id  ";
        $delete_crs_name="UPDATE allcourses SET dr_alocated='0',alocated=0 , dr_id=0 WHERE crs_id=$crs_id";
        $st = $conn->prepare($delete_crs_name);
        $st->execute(array(':crs_id' => $crs_id,':dr_id' => $dr_id));
        
        $delete_cr_name="UPDATE showtables SET crs_id='0' , dr_id='0' ,done=0 WHERE crs_id=$crs_id and dr_id=$dr_id";
        $delete_cr_name1 = $conn->prepare($delete_cr_name);
         $delete_cr_name1->execute(array(':crs_id' => $crs_id,':dr_id' => $dr_id));
        
         
         $delete_cr_g="UPDATE courses_groups SET alocated='0' WHERE crs_id=$crs_id ";
        $delete_cr_g1 = $conn->prepare($delete_cr_g);
         $delete_cr_g1->execute(array(':crs_id' => $crs_id));
        
         
         
         
        $result = $conn->prepare($sql);
        $foundUser = $result->execute(array(':crs_id' => $crs_id,':dr_id' => $dr_id));
        if ($foundUser === true) {
            $_SESSION['message'] = 'تم الحذف بنجاح';
           $redirectURL =  $_SERVER['PHP_SELF']."?action=fill&id=".$dr_id."&dept=".$_GET['dept'];
            header("Location:" . $redirectURL);
            session_write_close();
            exit;
        }

    }
}


?>




﻿<!DOCTYPE html>
<html>
<head>
     
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style>
/* The Modal (background) */
.aa{
                text-decoration: none;
                
                color: white;

            }

            .aa:hover{
                text-decoration: none;
                
                color: white;

            }
            
</style>
 
   <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css_admin/test.css">
        <link rel="stylesheet" href="css_admin/admin.css">
        <link rel="stylesheet" href="css_admin/bootstrap.min.css">
        <title></title>
</head>   
<body onpageshow="start_filter()">
<center>   
<form class="form-horizontal" method="post">
<table  style="position: fixed; top: 0px; width:100%; border:2px #008dde solid;"  id="table">
<tr>
<!--<th>الفرقة</th>-->
    <th  colspan="3" style=' font-size:17px;'>تعبئة مواد الدكتور <?php echo "<b style='color:brown; font-size:17px;'>>></b> ". "<b style=' font-size:17px;'>  $dr_name    </b>"; ?></th>

</tr>
<tr>
<!--<th>الفرقة</th>-->
<th> الاقسام</th>
<th>المواد </th>
<th
</th>
</tr>
        <tr>
            <?php //try{ ?>
            <td>
                
                <select required style="margin-right: 10px" id="h1" 
                        name="sortfilter" onchange="location = this.options[this.selectedIndex].value;">                  
                   <!-- <option selected disabled="disabled">إختر القسم </option> -->
                    <option><?php echo $_GET['dept'];?></option>  <?php
             if (FALSE != $results) {
                               
              foreach ($results as $depts) {
                           ?>
                    <option  value="adm_inser_courses_to_dr.php?action=fill&id=<?=$dr_id2?>&dept=<?=$depts->v_dept ?>"  >  <?php echo $depts->v_dept; ?></option>
                    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
var code = {};
$("select[name='sortfilter'] > option").each(function () {
    if(code[this.text]) {
        $(this).remove();
    } else {
        code[this.text] = this.value;
    }
});
</script>
       <?php
                                }
                            }
            else { echo '<option  disabled="disabled">لا توجد مواد متاحة </option> ';}
                            ?>
              </select></td>
    
            <td style="width : 340px">
                <select required style="margin-right: 10px" id="h1" name="idofcourses"  >  
                     <option selected disabled="disabled">إختر المادة  </option> 
                   <?php
                            if (FALSE != $result) {
                                foreach ($result as $course) {
                                    ?>
         <option  value="<?php echo $course->crs_id ?>"  selected > <?php echo $course->crs_name; ?></option>
       <?php
                                }
                            } 
        else { echo '<option disabled="disabled">لا توجد مواد متاحة </option> ';}
 
     
                            
                            ?>
    </select>
    </td>
    
            <td>
        <center>
            <input id="h4" type="submit" name="submit" value="إضافة المادة  للدكتور">
            <input id="h4" type="submit" name="Reset" value="الغاء التعديل"> 
        </center>
    </td> 
            <?php 
            
            
            ?>
</tr>
</table>
</form>
</center>

</div>

<form class="form-horizontal" method="GET">
<center>
    <table  id="table" style=" position: fixed; width: 100%; top:118px;">
    
    <tr> <th>م</th>
    <th>المواد المخصصة للدكتور</th>
    <th>
       
    
         <?php if (isset($_SESSION['message'])) { ?>
 <p> <?= isset($error) ? 'error' : '' ?><?= $_SESSION['message'] ?>
     <?php
            unset($_SESSION['message']);
        }
        ?>
        </p>
    </th></tr>
    
   <?php
                         $j=1;  
      foreach ($items as $coursename) {
                                   ?>
       <tr> 
           <td><?php echo $j; ?> </td>
     <td>
       <center><b style='color:#003333; font-size:19px;'> <?php echo $coursename['crs_name']; ?>
           </b></center></td>
     <td>
         <center>
         <button id="h4"type="submit" value="حذف" onclick="if (!confirm('هل تريد حذف المادة من جدول الدكتور'))
         return false;"><a class="aa" href="?action=delete&id=<?= $coursename['crs_id'] ?>&dr_id=<?= $coursename['dr_id'] ?>&dept=<?= $_GET['dept']?>">حذف هذه المادة من الجدول </a></button>
 </center>
     </td>
</tr>
<?php $j++; }?>

     
</table>
   
</center>
</form>

 <button id="h4" name="back" style="position: fixed; top:3px; left: 2px;">
     <a href="adm_add_drs.php?action=fill&id=0" style="color: white;" > عودة لصفحة الدكاترة </a></button>
  
  
</body>
</html>