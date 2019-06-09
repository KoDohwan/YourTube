<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "video_insert.php";

if (array_key_exists("video_id", $_GET)) {
    $video_id = $_GET["video_id"];
    $query =  "select * from video where video_id = $video_id";
    $res = mysqli_query($conn, $query);
    $video = mysqli_fetch_array($res);
    if(!$video) {
        msg("해당 영상이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "video_modify.php";
}

$user = array();
$query = "select * from user";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)){
	$user[$row['user_id']] = $row['user_id'];
}

$channel = array();
$query = "select * from channel natural join user";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
	$channel[$row['channel_id']] = $row['channel_name'];
}

?>
    <div class="container">
        <form name="video_form" action="<?=$action?>" method="post" class="fullwidth">
            <h3>영상 정보 <?=$mode?></h3>
            <p>
                <label for="video_name">영상 제목</label>
                <input type="text" placeholder="영상 제목 입력(최대 20자리)" id="video_name" name="video_name" value="<?=$video['video_name']?>"/>
            </p>
            
            <p>
                <label for="user_id">회원ID</label>
                <select name="user_id" id="user_id">
                    <option value="-1">본인의 회원ID를 선택해 주십시오 (회원ID가 없을 경우 회원 등록을 먼저 하십시오)</option>
                    <?
                        foreach($user as $id => $name) {
                            if($id == $user['user_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>        
            
            <p>
                <label for="channel_id">채널 이름</label>
                <select name="channel_id" id="channel_id">
                    <option value="-1">업로드하고 싶은 채널을 선택하시오 (채널이 없을 경우 채널 등록을 먼저 하십시오)</option>
                    <?
                        foreach($channel as $id => $name) {
                            if($id == $channel['channel_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            
            <p>
                <label for="video_info">영상 설명</label>
                <textarea placeholder="영상 설명 입력" id="video_info" name="video_info" rows="5"><?=$video['video_info']?></textarea>
            </p>
            

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("video_name").value == "") {
                        alert ("영상 제목을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("user_id").value == "-1") {
                        alert ("회원ID를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("channel_id").value == "-1") {
                        alert ("채널 이름을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("video_info").value == "") {
                        alert ("영상 설명을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>