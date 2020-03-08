<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MA Start</title>
        <style>
            *{
                margin: 0;
                padding: 0;
            }  
            body{
                padding: 10px;
            }
            table{
                width: 500px;
                border-collapse: collapse;
            }
            table tr td,table tr th{
                border: solid 1px #999;
                padding: 5px;
                text-align: left;
            }
            table tr th{
                background: #666;
                color: #fff;
            }
            
            table tr:nth-child(2n){
                background: #e4e4e4;
            }
            table tr td span.green{
                color: green;
                font-weight: bold;
            } 
            table tr td span.red{
                color: red;
                font-weight: bold;
            }
            table tr td:hover{
                background: yellow;
            }
        </style>    
        
    </head>
    <body>
      
    <center>
        <h1>Show Array in Table</h1>
    
        <table>
            <tr>
                <th>
                    <h1>Employee</h1>
                </th>
                <th>
                    <h1>Salary</h1>
                </th>
            </tr>
             
        
<?php
$emps=array("Ali","Mohamed","Omar","Ziad","Mazen","Maged","Kareem","Yaser","Hesham");
$salaries=array(1200,1400,1200,1800,2000,1900,3200,2500,1950);
$total=0;

for($i=0,$ii= count($salaries);$i<$ii;$i++)
{
    $salaries[$i]+=$salaries[$i]*.1;
    $total+=$salaries[$i];
    //$salaries[$i]*=1.1;  / MA
    echo '
        <tr>
        <td>'.$emps[$i] .'</td>
        <td>'.$salaries[$i]. ' L.E  </td>
        </tr>
         ';
    
}


    echo"
        <tr>
        <th>Total Salaries : </th>
        <th> $total  L.E  </th>
        </tr>
         ";

?>
</table>
    
    </center> 
   
    
    
    
    
</body>
</html>