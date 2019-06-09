<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("channel_id", $_GET)) {
    $channel_id = $_GET["channel_id"];
    $query = "select * from channel natural join contents natural join user where channel_id = $channel_id";
    
    $res = mysqli_query($conn, $query);
    $channel = mysqli_fetch_assoc($res);
    if (!$channel) {
        msg("해당 채널이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>채널 정보 상세 보기</h3>

        <p>
            <label for="channel_id">채널 코드</label>
            <input readonly type="number" id="channel_id" name="channel_id" value="<?= $channel['channel_id'] ?>"/>
        </p>

        <p>
            <label for="channel_name">채널 이름</label>
            <input readonly type="text" id="channel_name" name="channel_name" value="<?= $channel['channel_name'] ?>"/>
        </p>

        <p>
            <label for="user_id">회원ID</label>
            <input readonly type="text" id="user_id" name="user_id" value="<?= $channel['user_id'] ?>"/>
        </p>

        <p>
            <label for="user_name">회원명</label>
            <input readonly type="text" id="user_name" name="user_name" value="<?= $channel['user_name'] ?>"/>
        </p>
        
		<p>
            <label for="contents_name">컨텐츠 이름</label>
            <input readonly type="text" id="contents_name" name="contents_name" value="<?= $channel['contents_name'] ?>"/>
        </p>
        
        <p>
            <label for="contents_info">컨텐츠 설명</label>
            <textarea readonly id="contents_info" name="contents_info" rows="3"><?= $channel['contents_info'] ?></textarea>
        </p>
        
        <p>
            <label for="video_name">업로드된 영상</label>
            <?php
            	$channel_id = $channel['channel_id'];
            	$query = "select * from channel natural join contents natural join user natural join video where channel_id = '$channel_id'";
            	$res = mysqli_query($conn, $query);
            	while ($row = mysqli_fetch_array($res)) {
            		echo "<input readonly type = \"text\" id = \"channel_id\" name=\"channel_id\" value=\"{$row['video_name']}\"/>";
            		echo "</br>";
            	}
            ?>
        </p>

        
    </div>
<? include("footer.php") ?>