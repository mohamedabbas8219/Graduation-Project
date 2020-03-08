<html>

<head>
    <link href="css_admin/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="css_admin/adm.css" rel="stylesheet" type="text/css"/>
    <style>
        #m{text-align: right;}
#n{text-align: right;}
#y{text-align: right;}
#z{text-align: right;}
#w{text-align: right;}
    </style>
    
    <script lang="text/javascript">
    function red()
        {
        document.getElementById('m').style.backgroundColor="#e4e2e2";
            // document.getElementById('z').style.backgroundColor="white";
           document.getElementById('n').style.backgroundColor="white";
             document.getElementById('w').style.backgroundColor="white";
           document.getElementById('y').style.backgroundColor="white";   
        }
    function reed()
        {
           document.getElementById('n').style.backgroundColor="#e4e2e2";
            document.getElementById('m').style.backgroundColor="white";
           //  document.getElementById('z').style.backgroundColor="white";
             document.getElementById('w').style.backgroundColor="white";
           document.getElementById('y').style.backgroundColor="white";   
        }
         function reeed()
        {
            
           document.getElementById('w').style.backgroundColor="#e4e2e2";
              document.getElementById('n').style.backgroundColor="white";
            document.getElementById('m').style.backgroundColor="white";
           //  document.getElementById('z').style.backgroundColor="white";
           document.getElementById('y').style.backgroundColor="white";  
        }
         function reeeed()
        {
           document.getElementById('y').style.backgroundColor="#e4e2e2";
            document.getElementById('w').style.backgroundColor="white";
            document.getElementById('n').style.backgroundColor="white";
            document.getElementById('m').style.backgroundColor="white";
       //    document.getElementById('z').style.backgroundColor="white";   
        }
        
         function reeeeed()
        {
           document.getElementById('z').style.backgroundColor="#e4e2e2";
           document.getElementById('y').style.backgroundColor="white";
            document.getElementById('w').style.backgroundColor="white";
            document.getElementById('n').style.backgroundColor="white";
            document.getElementById('m').style.backgroundColor="white";    
        }
    </script>
    
    </head>
    <body >
     <a href="left.html" target="left"> <a href="left.php" target="left" class="list-group-item" id="x"><h4> إملأ البيانات </h4></a></a>
     <a href="left.html" target="left"> <a href="adm_add_all_courses.php" id="m" target="left" class="list-group-item" onclick="red();">المواد التي تدرس بالكلية<h4></h4></a></a>
     <a href="left.html" target="left"> <a href="adm_insert_groups.php" id="n" target="left" class="list-group-item" onclick="reed();">اضافة فرق الكلية</a></a>
     <a href="left.html" target="left">  <a href="adm_add_drs.php" id="w" target="left" class="list-group-item" onclick="reeed();"> تسجيل بيانات الدكتور </a></a>
     <a href="left.html" target="left">   <a href="adm_add_stand.php" id="y" target="left" class="list-group-item" onclick="reeeed();"> اضافه المدرجات  </a></a>
    <!--<a href="left.html" target="left"> <a href="adm_insert_gr_in_stand.php" id="y" target="left" class="list-group-item" onclick="reeeeed();"> تعبئة الفرق بالمدرجات  </a></a>
      -->
      <script src="js/jquery-3.2.1.min.js"> </script>
        <script src="js/bootstrap.min.js"> </script>
  
            
       
    
    </body>
</html>
