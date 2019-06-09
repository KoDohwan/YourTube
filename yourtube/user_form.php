<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "user_insert.php";

if (array_key_exists("user_id", $_GET)) {
    $user_id = $_GET["user_id"];
    $query =  "select * from user where user_id = $user_id";
    $res = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($res);
    if(!$user) {
        msg("해당 회원이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "user_modify.php";
}

?>
    <div class="container">
        <form name="user_form" action="<?=$action?>" method="post" class="fullwidth">
            <h3>회원 정보 <?=$mode?></h3>
            <p>
                <label for="user_id">회원ID</label>
                <input type="text" placeholder="4자리 숫자로 입력" id="user_id" name="user_id" value="<?=$user['user_id']?>"/>
            </p>
            <p>
                <label for="user_name">회원명</label>
                <input type="text" placeholder="회원이름 입력(최대 10자리)" id="user_name" name="user_name" value="<?=$user['user_name']?>"/>
            </p>
            <p>
                <label for="user_id">닉네임</label>
                <input type="text" placeholder="사용할 닉네임 입력(최대 20자리)" id="user_nickname" name="user_nickname" value="<?=$user['user_nickname']?>"/>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                	var flag = 0;
                	for(var i = 0; i < 4; i++){
                		if(document.getElementById("user_id").value.length != 4){
                			flag = 1;
                		}
                		if(document.getElementById("user_id").value[i] < '0' || document.getElementById("user_id").value[i] > '9'){
                			flag = 1;
                		}
                	}
                    if(document.getElementById("user_id").value == "") {
                        alert ("회원ID를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("user_name").value == "") {
                        alert ("회원명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("user_nickname").value == "") {
                        alert ("닉네임을 입력해 주십시오"); return false;
                    }
                    else if(flag == 1){
                    	alert ("회원ID를 4자리 숫자로 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>
        </form>
    </div>
<? include("footer.php") ?>