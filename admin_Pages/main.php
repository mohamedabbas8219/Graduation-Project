 
<?php
//require'http://localhost/Table_Proj_MA/userAccount.php';
$admin=filter_input(INPUT_GET, 'admin',  FILTER_SANITIZE_STRING);
echo $admin;
if($admin=="22")
{
?>
<!DOCTYPE html>
<html>
    
<head>
<style>
div.container {
    width: 100%;
    height: 100%;
    
    border: 1px solid gray;
}

header{
    padding: 1em;
    
    clear: left;
    text-align: center;
}

nav {
    float: right;
    max-width: 240px;
    margin: 0;
    padding: 1em;
}


article {
    margin-right: 170px;
    border-right: 1px solid gray;
    padding: 1em;
    overflow: hidden;
}
</style>
</head>
<body style="width: 100%; height: 100%">

<div class="container">

<header>
   <?php include 'header.php'; ?>
</header>
  
<nav>
     <?php include 'right.php'; ?>

</nav>

<article>
       <?php include 'left.php'; ?>

</article>

</div>

</body>
</html>
<?php
}
else {
    header("Location:http://localhost/Table_Proj_MA/index.php");
}