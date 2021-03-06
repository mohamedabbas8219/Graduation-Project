<?php
//start session
session_start();
//load and initialize user class
include_once 'user.php';
$user = new User();
if(isset($_POST['signupSubmit'])){
    //check whether user details are empty
    if(!empty($_POST['dr_fullname']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
        //password and confirm password comparison
        if($_POST['password'] !== $_POST['confirm_password']){
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Confirm password must match with the password.'; 
        }else{
            //check whether user exists in the database
            $prevCon['where'] = array('username'=>$_POST['username']);
            $prevCon['return_type'] = 'count';
            $prevUser = $user->getRows($prevCon);
            if($prevUser > 0){
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'UserName already exists, please use another UserName.';
            }else{
                //insert user data in the database
                $userData = array(
                    'dr_fullname' => $_POST['dr_fullname'],
                    'username' => $_POST['username'],
                #    'email' => $_POST['email'],
                    'password' => ($_POST['password']),
                 #   'phone' => $_POST['phone']
                );
                $insert = $user->insert($userData);
                //set status based on data insert
                if($insert){
                    $sessData['status']['type'] = 'success';
                    $sessData['status']['msg'] = 'You have registered successfully, log in with your credentials.';
                }else{
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                }
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'All fields are mandatory, please fill all the fields.'; 
    }
    //store signup status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success')?'index.php':'registration.php';
    //redirect to the home/registration page
    header("Location:".$redirectURL);
}

elseif(isset($_POST['loginSubmit'])){
    //check whether login details are empty
    if(!empty($_POST['username']) && !empty($_POST['password'])){
    	 //get user data from user class
        $conditions['where'] = array(
            'username' => $_POST['username'],'password' => ($_POST['password']));
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);
        
        //set user data and status based on login credentials
        if($userData){
            if ($userData['status']==0)
            {
                $sessData['userLoggedIn'] = FALSE;
                $sessData['userID'] = $userData['dr_id'];
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'Welcome '.$userData['dr_fullname'].'!';
                $_SESSION['sessData'] = $sessData;
            
                header('Location:http://localhost/admin_Pages/Home.php');
                   /* ?action=fill&admin='22'              
                     header("Location:study_table2.php");*/
            }
            else{ 
                $sessData['userLoggedIn'] = TRUE;
               $sessData['userID'] = $userData['dr_id'];
               $sessData['status']['type'] = 'success';
               $sessData['status']['msg'] = 'Welcome '.$userData['dr_fullname'].'!';
               $_SESSION['sessData'] = $sessData;
             
               header("Location:study_table.php");
          //header('Location:http://localhost/admin_Pages/m.php');

            }
           
            # $_SESSION["username"]=$userData['username'];
          
        }
        else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Wrong UserName or password, please try again.'; 
            header("Location:index.php");
        }
    }
  
    else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Enter UserName and password.'; 
        header("Location:index.php");
    }
    //store login status into the session
   // $_SESSION['sessData'] = $sessData;
    //redirect to the home page
     // header("Location:study_table.php");
    
    
}

elseif(isset($_POST['forgotSubmit'])){
    //check whether email is empty
    if(!empty($_POST['email'])){
        //check whether user exists in the database
        $prevCon['where'] = array('email'=>$_POST['email']);
        $prevCon['return_type'] = 'count';
        $prevUser = $user->getRows($prevCon);
        if($prevUser > 0){
            //generat unique string
            $uniqidStr = md5(uniqid(mt_rand()));;
            
            //update data with forgot pass code
            $conditions = array(
                'email' => $_POST['email']
            );
            $data = array(
                'forgot_pass_identity' => $uniqidStr
            );
            $update = $user->update($data, $conditions);
            
            if($update){
                $resetPassLink = 'http://localhost/www/study_tables/resetPassword.php?fp_code='.$uniqidStr;
               
                //get user details
                $con['where'] = array('email'=>$_POST['email']);
                $con['return_type'] = 'single';
                $userDetails = $user->getRows($con);
                
                //send reset password email
                $to = $userDetails['email'];
                $subject = "Password Update Request";
                $mailContent = 'Dear '.$userDetails['first_name'].', 
                <br/>Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.
                <br/>To reset your password, visit the following link: <a href="'.$resetPassLink.'">'.$resetPassLink.'</a>
                <br/><br/>Regards,
                <br/>CodexWorld';
                //set content-type header for sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                //additional headers
                $headers .= 'From: study_tables< $_POST["email"]' . "\r\n";
                //send email
                mail($to,$subject,$mailContent,$headers);
                
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'Please check your e-mail, we have sent a password reset link to your registered email.';
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Some problem occurred, please try again.';
            }
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Given email is not associated with any account.'; 
        }
        
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Enter email to create a new password for your account.'; 
    }
    //store reset password status into the session
    $_SESSION['sessData'] = $sessData;
    //redirect to the forgot pasword page
    header("Location:forgotPassword.php");
}
elseif(isset($_POST['resetSubmit'])){
    $fp_code = '';
    if(!empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['fp_code'])){
        $fp_code = $_POST['fp_code'];
        //password and confirm password comparison
        if($_POST['password'] !== $_POST['confirm_password']){
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Confirm password must match with the password.'; 
        }else{
            //check whether identity code exists in the database
            $prevCon['where'] = array('forgot_pass_identity' => $fp_code);
            $prevCon['return_type'] = 'single';
            $prevUser = $user->getRows($prevCon);
            if(!empty($prevUser)){
                //update data with new password
                $conditions = array(
                    'forgot_pass_identity' => $fp_code
                );
                $data = array(
                    'password' => md5($_POST['password'])
                );
                $update = $user->update($data, $conditions);
                if($update){
                    $sessData['status']['type'] = 'success';
                    $sessData['status']['msg'] = 'Your account password has been reset successfully. Please login with your new password.';
                }else{
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                }
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'You does not authorized to reset new password of this account.';
            }
        }
    }else{
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'All fields are mandatory, please fill all the fields.'; 
    }
    //store reset password status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success')?'index.php':'resetPassword.php?fp_code='.$fp_code;
    //redirect to the login/reset pasword page
    header("Location:".$redirectURL);
}

elseif(!empty($_REQUEST['logoutSubmit'])){
    //remove session data
    unset($_SESSION['sessData']);
    session_destroy();
    //store logout status into the ession
    $sessData['status']['type'] = 'success';
    $sessData['status']['msg'] = 'You have logout successfully from your account.';
    $_SESSION['sessData'] = $sessData;
    //redirect to the home page
    header("Location:index.php");
}else{
    //redirect to the home page
    header("Location:index.php");
}