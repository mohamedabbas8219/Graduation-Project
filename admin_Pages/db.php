<?php

$conn=null;
try {
    
    $conn=new PDO('mysql://hostname=localhost;dbname=mytables','root','',
    array(
    PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8',
    PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION
    ));
} catch (PDOException $e) {
    
}

