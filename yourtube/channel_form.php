<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "channel_insert.php";

if (array_key_exists("channel_id", $_GET)) {
    $channel_id = $_GET["channel_id"];
    $query =  "select * from channel where channel_id = $channel_id";
    $res = mysqli_query($conn, $query);
    $channel = mysqli_fetch_array($res);
    if(!$channel) {
        msg("해당 채널이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "channel_modify.php";
}


$user = array();
$query = "select * from user";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $user[$row['user_id']] = $row['user_id'];
}

$contents = array();
$query = "select * from contents";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)){
	$contents[$row['contents_name']] = $row['contents_name'];
}
?>
    <div class="container">
        <form name="channel_form" action="<?=$action?>" method="post" class="fullwidth">
            <h3>채널 정보 <?=$mode?></h3>
            <p>
                <label for="channel_name">채널명</label>
                <input type="text" placeholder="채널명 입력" id="channel_name" name="channel_name" value="<?=$channel['channel_name']?>"/>
            </p>
            <p>
                <label for="user_id">회원ID</label>
                <select name="user_id" id="user_id">
                    <option value="-1">본인의 회원ID를 선택해 주십시오 (회원ID가 없을 경우 회원 등록을 먼저 하십시오)</option>
                    <?
                        foreach($user as $id => $name) {
                            if($id == $channel['user_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="contents_name">컨텐츠명</label>
                <select name="contents_name" id="contents_name">
                    <option value="-1">컨텐츠를 선택해 주십시오</option>
                    <?
                        foreach($contents as $id => $name) {
                            if($id == $channel['contents_name']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("channel_name").value == "") {
                        alert ("채널명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("user_id").value == "-1") {
                        alert ("회원ID를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("contents_name").value == "-1") {
                        alert ("컨텐츠명을 선택해 주십시오"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>