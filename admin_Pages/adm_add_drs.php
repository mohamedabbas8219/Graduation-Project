
<!DOCTYPE html>
<html>
    <head>
        <style>

            .aa{
                text-decoration: none;

                color: white;

            }

            p.message {

                margin: 3px 0;
                
                color: #fff;
                font-family: 0.85em Arial ,Helvtice , sans-serif;
                border-radius: 3px;
                padding: 5px;
            }
            p.message.error {
               
            }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css_admin/test.css">
        <link rel="stylesheet" href="css_admin/admin.css">
        <link rel="stylesheet" href="css_admin/bootstrap.min.css">
        <title></title>
    </head>
    <body>
<div id="variables_html" class="variables_html">
        <div>
        <?php
session_start();
require_once 'db.php';
require_once 'Doctors.php';

$result2="";


if (isset($_POST['submit'])) {

    $username= filter_input(INPUT_POST, 'username',FILTER_SANITIZE_STRING);
    $dr_fullname = $_POST['dr_fullname'];
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $priority = $_POST['priority'];

    # $doctor=new Doctors($dr_fullname,$username,$password,$priority);
    $params = array(
        ':dr_fullname' => $dr_fullname,
        ':username' => $username,
        ':password' => $password,
        'priority' => $priority
    );
    #update
    if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
         $dr_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
         try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $sql = "update doctors set dr_fullname= :dr_fullname,username= :username , password= :password,priority = :priority where dr_id=:dr_id ";
              $params[':dr_id'] = $dr_id;
             $stm = $conn->prepare($sql);
             $stm->execute($params);
             $_SESSION['message'] = 'تم الحفظ بنجاح ';
           // $result2='تم الحفظ بنجاح ';
             $redirectURL = 'http://localhost/admin_Pages/adm_add_drs.php';
                header("Location:" . $redirectURL);
                session_write_close();
                exit;
             } catch (Exception $ex) {
                 $error = TRUE;
                $_SESSION['message'] = 'حدث خطأ في الحفظ ' . $dr_fullname;
                //$result2='حدث خطأ في الحفظ ' ;
                }

       
       
    } else {
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $sql = 'insert into doctors set dr_fullname= :dr_fullname,username= :username , password= :password,priority = :priority';
             $stm = $conn->prepare($sql);
             $stm->execute($params);
             
             $_SESSION['message'] = 'تم الحفظ بنجاح ';
             $result2= 'تم الحفظ بنجاح ';
                $redirectURL = 'http://localhost/admin_Pages/adm_add_drs.php';
                header("Location:" . $redirectURL);
                session_write_close();
                exit;
                } catch (Exception $ex) {
                      $error = TRUE;
                $_SESSION['message'] = 'حدث خطأ في الحفظ ' . $dr_fullname;
                $result2= 'حدث خطأ في الحفظ ' ;
                }
    }
//    $stm = $conn->prepare($sql);
//    
//    if ($stm->execute($params) === TRUE) {
//        $_SESSION['message'] = 'تم الحفظ بنجاح ';
//        $redirectURL = 'http://localhost/www/study_tables/adm_add_drs.php';
//        header("Location:" . $redirectURL);
//        session_write_close();
//        exit;
//    } else {
//        $error = TRUE;
//        $_SESSION['message'] = 'حدث خطأ في الحفظ ' . $dr_fullname;
//    }
}

#update
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $dr_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    if ($dr_id > 0) {
        $sql = "select * from doctors where dr_id=$dr_id";
        $result = $conn->prepare($sql);
        $foundUser = $result->execute(array(':dr_id' => $dr_id));
        if ($foundUser === true) {
            $user1 = $result->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Doctors', array('dr_fullname', 'username', 'password', 'priority'));
            $user1 = array_shift($user1);
        }
    }
}
#delete
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $dr_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    if ($dr_id > 0) {
        $sql = "delete from doctors where dr_id=$dr_id";
        $result = $conn->prepare($sql);
        $foundUser = $result->execute(array(':dr_id' => $dr_id));
        if ($foundUser === true) {
            $_SESSION['message'] = 'تم الحذف بنجاح';
            $result2='تم الحذف بنجاح';
            $redirectURL = 'http://localhost/admin_Pages/adm_add_drs.php';
            header("Location:" . $redirectURL);
            session_write_close();
            exit;
        }
    }
}

$sql = "select * from doctors ";
$stmt = $conn->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Doctors', array('dr_fullname', 'username', 'password', 'priority'));
$result = (is_array($result) && !empty($result)) ? $result : FALSE;

#var_dump($result);
?>
        
        
            
  </div> 
    
   
</div>
            
        <div>
            <div style=" margin:auto; position: fixed; width: 100%;top:0;   font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">
                <form method="post" enctype="application/x-www-form-urlencoded">
                    <center>
                        <table  style="margin-top: 0px;width:100%; border:2px #008dde solid;"  id="table">
                            <tr >
                                <th colspan="6" style="font-size:13px;">
                            <center ><b style="font-weight: bold;"> إضافة دكتور جديد</b></center></th>
                            </tr>
                            <tr>
                                 <th style="width: 4%;"><center><b style="font-size:15px; color: white;">م</b></center></th>
                                <th  style="width: 20%;"><label for="dr_fullname"> إسم الدكتور </label></th>
                                <th style="width: 18%;"><label for="username">إسم المستخدم </label></th>
                                <th style="width: 15%;"><label for="password">الرقم السري الخاص به</label></th>
                                <th style="width: 8%;"><label for="priority">الاولوية</label></th> 
                                <th></th>
                            </tr>
                            <tr style=" background-color: #e8e5e5;">
                                <td style="width: 4%;"><center><b style="font-size:15px;">م</b></center></td>
                                <td style="width: 20%;">
                            <center><input required type="text" placeholder="إسم الدكتور" autocomplete="off" name="dr_fullname" id="dr_fullname" value="<?= isset($user1) ? $user1->dr_fullname : '' ?>"
                                           style="width: 90%;" ></center>
                            </td>
                            <td style="width: 18%;">
                            <center><input style="width: 90%;" required type="text" placeholder="إسم المستخدم" name="username" id="username" value="<?= isset($user1) ? $user1->username : '' ?>"></center>
                            </td>
                            <td style="width: 15%;">
                            <center><input style="width: 90%;"  required type="text"  placeholder="الرقم السري"
                                            autocomplete="off" name="password" 
                                           id="password" value="<?= isset($user1) ? $user1->password : '' ?>" >
                            </center>
                            </td>
                            <td style="width: 8%;">
                            <center>  <select id="h1" name="priority" required style="width: 90%;" >
                                    <!--<option><?= isset($user1) ? $user1->priority : '1' ?></option>-->
                                    <?php
                                    for($i=1;$i<7;$i++)
                                    {
                                        if($user1->priority==$i)
                                        {
                                        echo "<option selected>$i</option>";
                                        } else {
                                           echo" <option >$i</option>";
                                        }
                                    }
                                    
                                    ?>
                                   
                                </select></center>
                            </td>
                            <td>  <!--style="font-size:13px;"-->
                            <center>
                                <input id="h4" type="submit" name="submit" value=" حفظ البيانات" />
                                <input id="h4" type="reset" name="Reset" value="إلغاء الإضافة" />
                            </center>
                           </td>
                            </tr>
                        </table>
                    </center>
                </form>
            </div> 
            <hr />
            <div>
                <form method="GET" enctype="application/x-www-form-urlencoded">
                    <table id="table" style="margin:auto; position: fixed; width: 100%; top:123px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">
                     <tr> 
                         <th style="width: 4%;"><center><b style="font-size:15px; color: white;">م</b></center></th>
                                <th  style="width: 20%;"> إسم الدكتور  </th>
                                <th style="width: 18%;">إسم المستخدم </th>
                                <th style="width: 15%;">الرقم السري الخاص به</th>
                                <th style="width: 8%;">الاولوية</th> 
                                <th style=""> 
                  <form method="post" action="">
                    <input type='submit' style=" margin-bottom: 0px; margin-top: -100px; color: white;"
                     id="h4" value='  تحديث  '/>
                 </form>
                   
                    <?php if (isset($_SESSION['message'])) { ?>
                                    <b class="message">&nbsp; <?= isset($error) ? 'error' : '' ?><?= $_SESSION['message'] ?></b>
            <?php
            unset($_SESSION['message']);
        }
  ?>       
       
                                    
                                </th> 

                            </tr>
                    </table>    
                    <table  style="margin-top: 142px;width:100%;"  id="table">
                        <thead>
                            
                        </thead>
                        <tbody>
                            <?php
                            if (FALSE != $result ) {
                                foreach ($result as $doctor) {
                                if ($doctor->dr_id!=0){
                                    ?>
                                    <tr>
                                        <td style="width: 4%;" id='h1' style='color:black;'><?php echo $doctor->dr_id; ?></td>
                                        <td style="width: 20%; color:black;" id='h1'><?php echo $doctor->dr_fullname; ?></td>
                                        <td style="width: 18%; color:black;" id='h1'><?php echo $doctor->username; ?></td>
                                        <td style="width: 15%; color:black;" id='h1'><?php echo $doctor->password; ?></td>
                                        <td style="width: 8%;  color:black;" id='h1'><?php echo $doctor->priority; ?></td>
                                        <td>
                                        <center>
                                         <button id="h4" type="submit" value="تعديل"><a class="aa" href="?action=edit&id=<?= $doctor->dr_id ?>">تعديل <i class="fa fa-edit"></i></a></button>
                                         <button id="h4" type="submit" value="حذف" onclick="if (!confirm('هل تريد حذف بيانات الدكتور !'))
                                                        return false;"><a style="color:white;" href="?action=delete&id=<?= $doctor->dr_id ?>">حذف</a></button>
                                          <button id="h4"> <a style="color:white;"  href="http://localhost/admin_Pages/adm_inser_courses_to_dr.php?action=fill&id=<?=$doctor->dr_id ?>&dept=العام">تعبئة  المواد للدكتور</a></button>
                                         </center>
                                        </td>
                                    </tr>

                                    <?php
                                }}
                            } else {
                                ?>
                            <td colspan="5"><p>Sorry no doctors to list</p> </td>
                            <?php
                        }
                        ?>


                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </center>
    <br />
</body>
</html>
