function reload(){
             var myWindow = window.open("http://localhost/Table_Proj_MA/study_table2.php", "_self");
                 }
function row(x) 
 {
    document.getElementById("rowshow").value =x.rowIndex;  
    // alert("Row index is: " + x.rowIndex);
 }
 
function cell(x)
{
    document.getElementById("cellshow").value =x.cellIndex;
    
    // var day=  document.getElementById("rowshow").value;
    //var lec=  document.getElementById("cellshow").value;
    //alert("day : "+day+",lec : "+lec);
  }
  
 function fill_select_crs()
 {
    document.getElementById("Course_name_rcv").style.displayed=none;
 }
  
  
function filter_select_list()
{
    var count_state=document.getElementById("Course_name_state").options.length;
      var state_crs=document.getElementById("Course_name_state").options;
       var the_all_crs = document.getElementById("Course_name_state");
       ///////////////////////////////////
       var count_selected_op=document.getElementById("Course_name_rcv").options.length;
      var selected_crs=document.getElementById("Course_name_rcv").options;
       var the_all_select = document.getElementById("Course_name_rcv");
      
    // delete all
       for(var i=1;i<count_selected_op;i++)
     {
      // the_all_select.remove(i);
     }
    
    //  reset options
    for(var i=1;i<count_state;i++)
     {
      //selected_crs[i].text===state_crs[i].text;
     // document.getElementById("Course_name_rcv").options[i].disabled=false;
    
       // var option = document.createElement("option");
     //option.text === state_crs[i].text;
      //the_all_select.add(option);
     }
    
    
    //var day=1;
    var day=  document.getElementById("rowshow").value;
    var lec=  document.getElementById("cellshow").value;
    //alert("day : "+day+",lec : "+lec);
    // document.getElementById("cell_gr1_1s").options[2].disabled=true ;
    document.getElementById("current_group").value=day;
    //document.getElementById("current_crs").value=lec ;
        
    var count_selected_op=document.getElementById("Course_name_rcv").options.length;
      var selected_crs=document.getElementById("Course_name_rcv").options;
       var the_all_select = document.getElementById("Course_name_rcv");
        // the_all_select.remove(1);
    ///////////////////////////////////////////////////////
    var group_crs=document.getElementById("cell_gr"+day+"_"+lec+"s").options;
     var count_group_crs=document.getElementById("cell_gr"+day+"_"+lec+"s").options.length;
    
    document.getElementById("current_crs").value=group_crs[0].text ;
    //group_crs.remove(0);  //delete
     for(var i=1;i<count_selected_op;i++)
     {
       document.getElementById("Course_name_rcv").options[i].disabled=false;
     }
     
    for(var i=1;i<count_selected_op;i++)
     { var k=0;
        for(var j=0;j<count_group_crs;j++)
        {
          if(group_crs[j].text===selected_crs[i].text)
          {
              k=1;
             // the_all_select.remove(i);
              // the_all_select.remove(1);
          }
        }
        if(k===0)
        {
            document.getElementById("Course_name_rcv").options[i].disabled=true;
            //the_all_select.remove(i);
        }
    }
}


function myFunction(x) 
{    
    
    var day=  document.getElementById("rowshow").value;
    var lec=  document.getElementById("cellshow").value;
  // var gr_no="";
    var inc=0;
    for (var i = 1; i < 7; i++) {
        if(day===i)
        {
           for (var j = 1; j < 7; j++) {
               gr_no=lec+inc;
           }
           break;
        }
        else
        {
          inc+=5;  
        }
    }
    // document.getElementById("gr_no").value= gr_no+'vvvv';
    
    var dr_name=document.getElementById("logged_Dr").value;
   // alert(document.getElementById("Course_name_rcv").value);
    var crs_name=document.getElementById("Course_name_rcv").value;
    var selected_opt_indx = document.getElementById("Course_name_rcv").selectedIndex;
    var count_selected_op=document.getElementById("Course_name_rcv").options.length;
      //var selected_crs=document.getElementById("Course_name_rcv").options;
     
    ////////////////////////////////////////////////////////
    
    
    var selected_opt=document.getElementById("Course_name_rcv").options[selected_opt_indx];
    //document.getElementById("Course_name_rcv").options[selected_opt_indx].disabled = true;
    
    
    var y =document.getElementById("myTable");
    //var cellgroup=y.rows[day].cells[lec].innerHTML;
    if(x===1 && selected_opt.disabled==false)// && name!=null) // لو ضغطت علي   تم
    {
       document.getElementById("lec_name").value = crs_name; 
       y.rows[day].cells[lec].innerHTML="<center>"+dr_name+"<br>"+crs_name+"</center>";
       selected_opt.disabled=true;
      // cellupdate(day,lec,selected_opt);
    }
    
    if(x===3)    
    {
     y.rows[day].cells[lec].innerHTML="<center> EMPTY </center>";
     document.getElementById("lec_name").innerHTML ="DONE";
     document.getElementById("lec_name").innerHTML =null;
    }
     if(count_selected_op>2)
     {
    // var xxx = document.getElementById("Course_name_rcv");
    // xxx.remove(xxx.selectedIndex);
     }
     
     
}

