<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from channel natural join user";
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>채널명</th>
            <th>닉네임</th>
            <th>컨텐츠명</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='channel_view.php?channel_id={$row['channel_id']}'>{$row['channel_name']}</a></td>";
            echo "<td>{$row['user_nickname']}</td>";
            echo "<td>{$row['contents_name']}</td>";
            echo "<td width='10%'>
                 <button onclick='javascript:deleteConfirm({$row['channel_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(channel_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "channel_delete.php?channel_id=" + channel_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
