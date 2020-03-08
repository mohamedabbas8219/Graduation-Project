<?php

 function creategroup($a,$b) 
 {
      $co = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($co,"utf8");
 if ($co->connect_error) 
  {
   die("Connection failed: " . $co->connect_error);
  } 
                 $x=6;
                 $count_id="SELECT max(group_id) FROM s_groups";
                 $crs_count_q=mysqli_query($co,$count_id);
                 $crs_count_f=mysqli_fetch_all($crs_count_q,MYSQLI_NUM);
                 $crs_count=$crs_count_f[0][0]+1;
                 $q=" INSERT INTO s_groups(group_id, st_group,dept,h_periority) VALUES ($crs_count, '$a', '$b ',$x)";
                 $co->query($q);
                 $co->close();
 }
 function update_groups($ferga,$dept,$id)
 {
          $co = new mysqli("localhost", "root","", "mytables");
          mysqli_set_charset($co,"utf8");
          if ($co->connect_error) 
          {
           die("Connection failed: " . $co->connect_error);
           
            }    
      $q=" UPDATE  s_groups SET dept='$dept' , st_group='$ferga' ,h_periority=6 where group_id =$id";
      $co->query($q);
     
     
 }
 function delete_group($co,$id)
 {
     $deletegroup = "DELETE from s_groups WHERE group_id=$id";
        $co->query($deletegroup);
         
       
 }
 function selectgroups($co)
 { 
  $groupid="SELECT group_id FROM s_groups";   
 $groupid_q=mysqli_query($co,$groupid);
 $group_ids_f=mysqli_fetch_all($groupid_q,MYSQLI_NUM);  // number

 $group_count_sql="SELECT count(group_id) FROM s_groups";   
 $group_count_q=mysqli_query($co,$group_count_sql);
 $group_count_f=mysqli_fetch_all($group_count_q,MYSQLI_NUM);  //    crs id
 $group_count=$group_count_f[0][0];
  $group_ids=array();               /////////////////////////// array
  for($i=0,$ii=$group_count;$i<$ii;$i++)
  {
     $group_ids[$i]=$group_ids_f[$i][0];
   }
   ////////////////////////////////////////////////////////// courses names
  $groupname_sql="SELECT st_group FROM s_groups";
  $groupname_q=mysqli_query($co,$groupname_sql);
  $groupname_f=mysqli_fetch_all($groupname_q,MYSQLI_NUM);
  $all_groups=array();
  for($i=0,$ii=$group_count;$i<$ii;$i++)
  {
    $all_groups[$i]=$groupname_f[$i][0];
  }
  $deptname_sql="SELECT dept FROM s_groups";
  $deptname_q=mysqli_query($co,$deptname_sql);
  $deptname_f=mysqli_fetch_all($deptname_q,MYSQLI_NUM);
  $all_dept=array();
  for($i=0,$ii=$group_count;$i<$ii;$i++)
  {
    $all_dept[$i]=$deptname_f[$i][0];
  }
     $all_group_data=array('group_ids'=>$group_ids,'all_groups'=>$all_groups,'all_dept'=>$all_dept);
     return $all_group_data;
     
 }
 
 
