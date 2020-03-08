<html>

<head>
    <link href="css_admin/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="css_admin/adm.css" rel="stylesheet" type="text/css"/>

    <script lang="text/javascript">
    function red()
        {
            
        document.getElementById('m').style.backgroundColor="#e4e2e2";
             document.getElementById('z').style.backgroundColor="white";
           document.getElementById('n').style.backgroundColor="white";
             document.getElementById('w').style.backgroundColor="white";
           document.getElementById('y').style.backgroundColor="white";   
        }
    function reed()
        {
           document.getElementById('n').style.backgroundColor="#e4e2e2";
            document.getElementById('m').style.backgroundColor="white";
             document.getElementById('z').style.backgroundColor="white";
             document.getElementById('w').style.backgroundColor="white";
           document.getElementById('y').style.backgroundColor="white";   
        }
         function reeed()
        {
            
           document.getElementById('w').style.backgroundColor="#e4e2e2";
              document.getElementById('n').style.backgroundColor="white";
            document.getElementById('m').style.backgroundColor="white";
             document.getElementById('z').style.backgroundColor="white";
           document.getElementById('y').style.backgroundColor="white";  
        }
         function reeeed()
        {
            
           document.getElementById('y').style.backgroundColor="#e4e2e2";
            document.getElementById('w').style.backgroundColor="white";
            document.getElementById('n').style.backgroundColor="white";
            document.getElementById('m').style.backgroundColor="white";
            document.getElementById('z').style.backgroundColor="white";   
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
    <body>
        <a href="left.html" target="left"> <a href="left.php" target="left" class="list-group-item" id="x" class="ma"><h4> إملأ البيانات </h4></a></a>
    
        <a href="left.html" target="left"> <a href="adm_add_all_courses.php" target="left" class="list-group-item" id="m" class="ma" onclick="red();">المواد التي تدرس بالكلية<h4></h4></a></a>
    
        <a href="left.html" target="left"> <a href="adm_insert_groups.php" style="text-align: right;"
                                              target="left" class="list-group-item" id="n" class="ma" onclick="reed();">اضافة فرق الكلية</a></a>
                                                                             
     <a href="left.html" target="left">  <a href="adm_add_drs.php" target="left" class="list-group-item" id="w" class="ma" onclick="reeed();"> تسجيل بيانات الدكتور </a></a>
    <a href="left.html" target="left">   <a href="adm_add_stand.php" target="left" class="list-group-item" id="y" class="ma" onclick="reeeed();"> اضافه المدرجات  </a></a>
    <a href="left.html" target="left"> <a href="adm_insert_gr_in_stand.php" target="left" class="list-group-item" class="ma" id="z" onclick="reeeeed();"> تعبئة الفرق بالمدرجات  </a></a>

      <script src="js/jquery-3.2.1.min.js"> </script>
        <script src="js/bootstrap.min.js"> </script>
         </body>
</html>