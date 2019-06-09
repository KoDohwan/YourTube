<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$channel_id = $_GET['channel_id'];

mysqli_query($conn, "set autocommit = 0");							// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");										// begins a transation

$ret = mysqli_query($conn, "delete from channel where channel_id = '$channel_id'");

if(!$ret)
{
	mysqli_query($conn, "rollback");								//rollback
    msg("먼저 채널에 있는 영상을 모두 삭제하세요");
}
else
{
	mysqli_query($conn, "commit");									//commit
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=channel_list.php'>";
}

?>

