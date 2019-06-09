<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$channel_name = $_POST['channel_name'];
$user_id = $_POST['user_id'];
$contents_name = $_POST['contents_name'];

$ret = mysqli_query($conn, "insert into channel (channel_name, user_id, contents_name) values('$channel_name', '$user_id', '$contents_name')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=channel_list.php'>";
}

?>

