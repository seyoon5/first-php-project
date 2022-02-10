<?php
// session_start();
$userId = trim($_POST['userId']);
$userPw= trim($_POST['userPw']);
$idSaveCheck = trim($_POST['idSaveCheck']);
 
// $mysqli = mysqli_connect("127.0.0.1","DB_ID","DB_PW","DB_SID","Port");
// if ($mysqli->connect_errno) {
//     die('Connect Error: '.$mysqli->connect_error);
// }
 
// if ($result = $mysqli->query("select * from LoginInfo where id='".$userId."' and password='".$userPw."'")){
//     while ($row = $result->fetch_object()) {
//                 $Exist = "1";
//     }
// }
 
// if ($Exist ==""){
//     echo "<script>alert('로그인 정보가 다릅니다'); history.back();</script>";
//     session_destroy();
//     exit;
// }
 
if ($idSaveCheck =="on"){
    setcookie('userId',$userId,time()+(86400*30),'/');
}else{
    setcookie('userId',$userId,time()-(86400*30),'/');
    unset($_COOKIE['userId']);
}
 
$_SESSION['userId'] = $userId;
 
?>
<meta http-equiv='refresh' content='0;url=../LoginSuccess.php'>