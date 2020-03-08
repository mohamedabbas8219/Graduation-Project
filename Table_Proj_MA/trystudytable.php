
<div>    
<?php
/////////////////////////////////////////////////////////////////  
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
   $allowed_modi_groups=allowed_modi_groups($conn,$stand,$allowedmodi_day,$allowedmodi_lec);
  // echo '<br />groups  > >  <br />';
  // print_r($allowed_modi_groups);
  for($i=0;$i<count($allowed_modi_groups);$i++)
  {
    //  echo "$allowed_modi_groups[$i] , ";
      if($i%4==0&&$i>0)
      {
        //  echo '<br />';
      }
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
  
   $crsidsforgroups=array();
   for($i=0;$i< count($allowed_modi_groups);$i++)
  {echo"<br />$allowed_modi_groups[$i] => "; 
    $crsidsforgroups["$allowed_modi_groups[$i]"]=current_c_courses($conn,$allowed_modi_groups[$i]);
     echo "<select name='cell_gr'>";
      foreach ($crsidsforgroups["$allowed_modi_groups[$i]"] as $ii)
   {
         echo "<option>$ii </option> ";   
    }  
    echo '</select>';
    echo '<br />';
     
   }
  
/////////////////////////////////////////////////////////////////
  
  ?>
</div>
