<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from user";
    $res = mysqli_query($conn, $query);
    if (!$res) {
         die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>No.</th>
            <th>회원ID</th>
            <th>회원명</th>
            <th>닉네임</th>
            <th>등급</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['user_id']}</td>";
            echo "<td>{$row['user_name']}</td>";
            echo "<td>{$row['user_nickname']}</td>";
            echo "<td>{$row['class']}</td>";
            echo "<td width='10%'>
                <a href='user_form.php?user_id={$row['user_id']}'><button class='button primary small'>수정</button></a>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
</div>
<? include("footer.php") ?>
