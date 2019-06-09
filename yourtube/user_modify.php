<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$user_nickname = $_POST['user_nickname'];

$sel = mysqli_query($conn, "select * from user where user_id = $user_id");
$check = mysqli_fetch_array($sel);
if (!$check['user_id']) {
	msg("기존 회원ID와 다릅니다");
}

$ret = mysqli_query($conn, "update user set user_name = '$user_name', user_nickname = '$user_nickname' where user_id = '$user_id'");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=user_list.php'>";
}
?>

