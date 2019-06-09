<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("video_id", $_GET)) {
    $video_id = $_GET["video_id"];
    $query = "select * from video natural join user natural join channel where video_id = $video_id";
    $res = mysqli_query($conn, $query);
    $video = mysqli_fetch_assoc($res);
    if (!$video) {
        msg("해당 영상이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">
		<form name="video_view" action='video_count_up.php' method="get" class="fullwidth">
        <h3>영상 정보 상세 보기</h3>

        <p>
            <label for="video_id">영상 코드</label>
            <input readonly type="text" id="video_id" name="video_id" value="<?= $video['video_id'] ?>"/>
        </p>

        <p>
            <label for="video_name">영상 제목</label>
            <input readonly type="text" id="video_name" name="video_name" value="<?= $video['video_name'] ?>"/>
        </p>
        
        <p>
            <label for="channel_name">채널 이름</label>
            <input readonly type="text" id="channel_name" name="channel_name" value="<?= $video['channel_name'] ?>"/>
        </p>

        <p>
            <label for="user_nickname">닉네임</label>
            <input readonly type="text" id="user_nickname" name="user_nickname" value="<?= $video['user_nickname'] ?>"/>
        </p>

        <p>
            <label for="video_info">영상 설명</label>
            <textarea readonly id="video_info" name="video_info" rows="5"><?= $video['video_info'] ?></textarea>
        </p>

        <p>
            <label for="video_count">조회수</label>
            <input readonly type="number" id="video_count" name="video_count" value="<?= $video['video_count'] ?>"/>
        </p>
        
        <p align="center"><a href='video_count_up.php?video_id={<?$row['video_id']?>}'><button class="button primary large">돌아가기</button></p>
        

    </div>
<? include("footer.php") ?>