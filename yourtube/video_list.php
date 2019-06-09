<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from video natural join user natural join channel";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where user_name like '%$search_keyword%' or user_nickname like '%$search_keyword%'";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>영상제목</th>
            <th>채널명</th>
            <th>닉네임</th>
            <th>조회수</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='video_view.php?video_id={$row['video_id']}'>{$row['video_name']}</a></td>";
            echo "<td>{$row['channel_name']}</td>";
            echo "<td>{$row['user_nickname']}</td>";
            echo "<td>{$row['video_count']}</td>";
            echo "<td width='10%'>
                 <button onclick='javascript:deleteConfirm({$row['video_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    <script>
        function deleteConfirm(video_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "video_delete.php?video_id=" + video_id;
            }else{   //취소
                return;
            }
        }
    </script>
    </table>
</div>
<? include("footer.php") ?>
