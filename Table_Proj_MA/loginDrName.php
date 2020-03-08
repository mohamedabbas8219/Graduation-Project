         
        <?php 
        session_start();

             $sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}  
               include_once 'user.php';
            $user = new User();
            $conditions['where'] = array(
                'dr_id' => $sessData['userID'],
            );
            $conditions['return_type'] = 'single';
            $userData = $user->getRows($conditions);
         
               
                echo (  $userData['dr_fullname']); ?>