<?php

 $conn = new mysqli("localhost", "root","", "mytables");
 mysqli_set_charset($conn,"utf8");
 if ($conn->connect_error) 
  {
   die("Connection failed: " . $conn->connect_error);
  } 

  
function dr_groups_depts($conn,$group_id)
  {
    
    $who_has_group=array();
    $groupsidsfordocs=array();
    $drid=array();
     $drid_sql="SELECT dr_id  FROM doctors  ";   
 $drid_q=mysqli_query($conn,$drid_sql);
 $drid_f= mysqli_fetch_all($drid_q,MYSQLI_NUM);
      //count of groups
 $drcount_sql="SELECT count(dr_id) FROM doctors  ";
 $drcount_q=mysqli_query($conn,$drcount_sql);
 $drcount_f=mysqli_fetch_all($drcount_q,MYSQLI_NUM);
 $drcount=$drcount_f[0][0];
 
  for($i=0,$ii=$drcount;$i<$ii;$i++)
  {
    $drid[$i]=$drid_f[$i][0];
   }
    sort($drid);
   
   $c=0;
    for($d=1;$d<$drcount;$d++)
  {
   $groupsidsfordoc=array();     
  $groupsid_sql="SELECT distinct s_group FROM courses_groups where alocated=0 and crs_id in(SELECT crs_id FROM allcourses where dr_id=$drid[$d] and alocated=0)";   
 $groupsid_q=mysqli_query($conn,$groupsid_sql);
 $groupsid_f= mysqli_fetch_all($groupsid_q,MYSQLI_NUM);
      //count of groups
 $groupscount_sql="SELECT count(distinct s_group) FROM courses_groups where alocated=0 and crs_id in(SELECT crs_id FROM allcourses where dr_id=$drid[$d] and alocated=0)";   
 $groupscount_q=mysqli_query($conn,$groupscount_sql);
 $groupscount_f=mysqli_fetch_all($groupscount_q,MYSQLI_NUM);
 $groupscount=$groupscount_f[0][0];
 $ch=0;
  for($i=0,$ii=$groupscount;$i<$ii;$i++)
  {
    $groupsidsfordoc[$i]=$groupsid_f[$i][0];
    if($groupsidsfordoc[$i]==$group_id)
    {
        $ch=1;
    }
   }
   if($ch==1)
   {
       $who_has_group[$c]=$drid[$d];
       $c++;
   }
   
   
 //sort($groupsidsfordoc);
 $groupsidsfordocs["$drid[$d]"]=$groupsidsfordoc;
    
 }
 $data=array("dr_ids"=>$drid,"groupsidsfordocs"=>$groupsidsfordocs,"who_h_g"=>$who_has_group);
 return $data;
  }
  $dr_groups_depts_f=dr_groups_depts($conn,1);
  $dr_ids=$dr_groups_depts_f["dr_ids"];
  $groupsidsfordoc=$dr_groups_depts_f["groupsidsfordocs"];
  $who_has_group=$dr_groups_depts_f["who_h_g"];
 
   for($d=1;$d<count($dr_ids);$d++)
  {       echo 'dr'.$dr_ids[$d]." : ";
       foreach ($groupsidsfordoc["$dr_ids[$d]"] as $s)
       {
           echo $s ."  ";
       }
       echo '<br />';
       
   }
 
   $periority=array();
   $next_max_periority=0;
    for($d=0;$d<count($who_has_group);$d++)
  { 
   $groups_sql="SELECT priority FROM doctors where dr_id=$who_has_group[$d]";   
 $groups_q=mysqli_query($conn,$groups_sql);
 $groups_f=mysqli_fetch_all($groups_q,MYSQLI_NUM);
 $w_hs_groups=$groups_f[0][0];
 $periority[$d]=$w_hs_groups;
  }
  foreach ($periority as $v) {
    if($v>$next_max_periority)
    {
      $next_max_periority=$v;
    }
}
 echo 'periorities : '.$next_max_periority;
  echo '<br />';
  print_r($who_has_group);
 
 