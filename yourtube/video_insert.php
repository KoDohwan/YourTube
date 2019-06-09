<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$video_name = $_POST['video_name'];
$video_info = $_POST['video_info'];
$user_id = $_POST['user_id'];
$channel_id = $_POST['channel_id'];

$query = "select * from user natural join channel where user_id = '$user_id' and channel_id = '$channel_id'";
$res = mysqli_query($conn, $query);
$check = mysqli_fetch_array($res);
if(!$check){
    msg("본인의 채널을 선택하시오");
}

$ret = mysqli_query($conn, "insert into video (video_name, video_info, user_id, channel_id) values('$video_name', '$video_info', '$user_id', '$channel_id')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=video_list.php'>";
}

?>

