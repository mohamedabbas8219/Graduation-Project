<?php

require_once 'db.php';

class Doctors {

    public  $dr_id;
    public $username;
    public $dr_fullname;
    public $password;
    public  $priority;


    public function __construct($dr_fullname,$username,$password ,$priority) {
        
        $this->dr_fullname=$dr_fullname;
        $this->username=$username;
        $this->password=$password;
        $this->priority=$priority;
        
    }
    
    
//    function insert(){
//		$query = "insert into doctors(dr_fullname,username,password,priority,status) values('$this->dr_fullname',"
//                        . "'$this->username','$this->password','$this->priority','1')";
//		$result = mysqli_query(self::$conn,$query);
//		return mysqli_insert_id(self::$conn);	}
//	
	function is_exist($username){
		$query = "select dr_id from doctors where username=':username'";
		#$result =  mysqli_query(self::$conn,$query);
		#return (mysqli_num_rows($result) > 0) ? True : False ; 
                
                $stmt = $conn->prepare($query);
                $stm->execute(array($username));
                $count=$stm->rowCount();
                return $count;
               #$result = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Doctors', array('dr_fullname', 'username', 'password', 'priority'));
              

	}
//	
//	function check()
//	{
//		$query = "select * from doctors where username=$username and password=$password";
//		$result =  mysqli_query(self::$conn,$query);
//		return (mysqli_num_rows($result) > 0) ? True : False ;  
//
//
//	}
//
    
}
