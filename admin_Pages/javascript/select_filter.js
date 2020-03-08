
      function start_filter()
        {
          var count_depts=document.getElementById("depts_list").options.length;
           var state_depts=document.getElementById("depts_list").options;
         for(var i=0;i<count_depts;i++)
            {
             document.getElementById(""+state_depts[i].text+"").style.display='none';
           }
           if(count_depts>0)
           {
            document.getElementById(""+state_depts[0].text+"").style.display='';
            
            document.getElementById('select_name_ma').value=state_depts[0].text;
            document.getElementById('select_name_ma').style.display='none';
            
            }
        } 
        function filter(a)
        {
             document.getElementById('select_name_ma').value=a;
            // document.getElementById(""+a+"").style.color='blue';
             document.getElementById(""+a+"").style.size='42px';
       ///////////////////////////////////
       var count_depts=document.getElementById("depts_list").options.length;
      var state_depts=document.getElementById("depts_list").options;
       //var the_all_depts = document.getElementById("depts_list");
       ///////////////////////////////////
       var count_selected_op=document.getElementById(""+a+"").options.length;
        for(var i=0;i<count_depts;i++)
          {
           document.getElementById(""+state_depts[i].text+"").style.display='none';
            }
        document.getElementById(""+a+"").style.display='';
  }           
       