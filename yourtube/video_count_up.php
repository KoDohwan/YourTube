<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("video_id", $_GET)) {
    $video_id = $_GET["video_id"];
    $query = "select * from video where video_id = $video_id";
    $res = mysqli_query($conn, $query);
    $video = mysqli_fetch_assoc($res);
    if (!$video) {
        msg("해당 영상이 존재하지 않습니다.");
    }
}

$video_id = $video['video_id'];

$video_count = $video['video_count'];
$video_count = $video_count + 1;
$query = "update video set video_count = $video_count where video_id = $video_id";
$res = mysqli_query($conn, $query);

echo "<meta http-equiv='refresh' content='0;url=user_update.php'>";

?>


