<?php
 
function refresh_server($conn)
{
     $new_crs_q = "select * from allcourses";
     $conn->query($new_crs_q);
    $conn->close();
    return null;
}



    function max_crs_id()
   { 
         $conn = new mysqli("localhost", "root","", "mytables");
         mysqli_set_charset($conn,"utf8");
        if ($conn->connect_error) 
         {
          die("Connection failed: " . $conn->connect_error);
        } 
     $max_crsid_sql = "SELECT MAX(crs_id)FROM allcourses";
       $max_crsid_q=mysqli_query($conn,$max_crsid_sql);
      $max_crsid_f=mysqli_fetch_all($max_crsid_q,MYSQLI_NUM);
      $max_crsid=$max_crsid_f[0][0];
      $conn->close();
       return $max_crsid;
   }  
     
  
   function new_crs($conn,$new_crs_id,$new_crs_name,$new_dept_name)
   {
       $new_crs_q = "insert into allcourses(crs_id,crs_name,v_dept) values($new_crs_id,'$new_crs_name','$new_dept_name')";
        $conn->query($new_crs_q);
        //$conn->close();
   }

   function update_crs($conn,$new_crs_name,$new_dept_name,$crsid)
   { 
    $upd_crs_q = "UPDATE allcourses SET crs_name='$new_crs_name',v_dept='$new_dept_name' WHERE crs_id=$crsid";
        $conn->query($upd_crs_q);
        
return 1;
   }
   
   function delete_crs($conn,$crsid)
   {
        $upd_crs_g_q = "delete from courses_groups WHERE crs_id=$crsid ";
        $conn->query($upd_crs_g_q);
       
       $dr_id_c_sql="SELECT count(dr_id) FROM allcourses where crs_id=$crsid ";   
       $dr_id_c_q=mysqli_query($conn,$dr_id_c_sql);
       $dr_ids_c_f=mysqli_fetch_all($dr_id_c_q,MYSQLI_NUM);  // number
       $dr_ids_count=$dr_ids_c_f[0][0];
       for($i=0;$i<$dr_ids_count;$i++)
       {
            $upd_sh_t_q = "UPDATE showtables SET crs_id=0 , dr_id=0 ,done=0 WHERE crs_id=$crsid and done>0";
           $conn->query($upd_sh_t_q);
       }
       
    $sql = "DELETE from allcourses WHERE crs_id=$crsid";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
   // echo $stmt->rowCount() . " records UPDATED successfully";
     //$delete_crs_q = "DELETE from allcourses WHERE crs_id=$crsid";
        //$conn->query($delete_crs_q);
       // $conn->close();
   }
   
