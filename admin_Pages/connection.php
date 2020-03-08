<?php

 function creategroup($conn,$new_group_name,$new_dept_name,$capacity,$h_periority,$holiday) 
 {
     $result=0;
                 $count_id="SELECT max(group_id) FROM s_groups";
                 $crs_count_q=mysqli_query($conn,$count_id);
                 $crs_count_f=mysqli_fetch_all($crs_count_q,MYSQLI_NUM);
                 $crs_count=$crs_count_f[0][0]+1;
                 $count=$capacity/30;
            if($capacity%30>20){$count+=1;}
                 $q=" INSERT INTO s_groups(group_id,st_group,dept,capacity,h_periority,holiday,count_groups) VALUES ($crs_count,'$new_group_name','$new_dept_name',$capacity,$h_periority,$holiday,$count)";
                if( $conn->query($q))
                {
                    $result=1;
                }
                return $result;
 }

 function update_groups($group,$dept,$id,$capacity_modi,$periority,$holiday)
 {
          $co = new mysqli("localhost", "root","", "mytables");
          mysqli_set_charset($co,"utf8");
          if ($co->connect_error) 
          {
           die("Connection failed: " . $co->connect_error);
            }    
            $count=$capacity_modi/30;
            if($capacity_modi%30>20){$count+=1;}
      $q="UPDATE s_groups SET dept='$dept' ,holiday=$holiday ,count_groups=$count, st_group='$group' ,h_periority=$periority ,capacity=$capacity_modi where group_id =$id";
      $co->query($q);
      }
 function delete_group($co,$id)
 {
     $deletegroup = "DELETE from s_groups WHERE group_id=$id";
        $co->query($deletegroup);
         
         $q="UPDATE showtables SET S_group=0 , crs_id=0 ,dr_id=0 ,done=0 where S_group =$id";
          $co->query($q);
        
       
 }

 
 function check_group($co,$group,$dept,$groupid)
 {
     $result=0;
 $group_sql="SELECT group_id FROM s_groups where st_group='$group' and dept='$dept' and group_id !=$groupid ";   
 $group_q=mysqli_query($co,$group_sql);
 $group_f=mysqli_fetch_all($group_q,MYSQLI_NUM);  //    crs id
 $group_id=$group_f[0][0];
 if(count($group_id)>0)
 {
     $result=1;
 }
 return $result;
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
  
   $capacity_sql="SELECT capacity FROM s_groups";
  $capacity_q=mysqli_query($co,$capacity_sql);
  $capacity_f=mysqli_fetch_all($capacity_q,MYSQLI_NUM);
  $capacity=array();
  for($i=0,$ii=$group_count;$i<$ii;$i++)
  {
    $capacity[$i]=$capacity_f[$i][0];
  }
  
  $periority_sql="SELECT h_periority FROM s_groups";
  $periority_q=mysqli_query($co,$periority_sql);
  $periority_f=mysqli_fetch_all($periority_q,MYSQLI_NUM);
  $periority=array();
  for($i=0,$ii=$group_count;$i<$ii;$i++)
  {
    $periority[$i]=$periority_f[$i][0];
  }
  
  
  $holiday_sql="SELECT holiday FROM s_groups";
  $holiday_q=mysqli_query($co,$holiday_sql);
  $holiday_f=mysqli_fetch_all($holiday_q,MYSQLI_NUM);
  $holiday=array();
  for($i=0,$ii=$group_count;$i<$ii;$i++)
  {
    $holiday[$i]=$holiday_f[$i][0];
  }
     $all_group_data=array('group_ids'=>$group_ids,'all_groups'=>$all_groups,'all_dept'=>$all_dept,'capacity'=>$capacity,'periority'=>$periority,'holiday'=>$holiday);
     return $all_group_data;
     
 }
 
 
