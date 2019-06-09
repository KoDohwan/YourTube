<?
include "config.php"; 
include "util.php";

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

mysqli_query($conn, "set autocommit = 0");							// autocommit 해제
mysqli_query($conn, "set transation isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");										// begins a transation

$point = 0;
$query = "select * from user natural join video";
$res = mysqli_query($conn, $query);
$row = mysqli_fetch_array($res);
while($row){
	$user_id = $row['user_id'];
	$point += $row['video_count'];
	$temp = mysqli_fetch_array($res);
	if($row['user_id'] != $temp['user_id']){
		$query = "update user set user_point = $point where user_id = '$user_id'";
		
		$ret = mysqli_query($conn, $query);
		if(!$ret){
			mysqli_query($conn, "rollback");						//rollback
			alert_message("Query Error : " .mysqli_error($conn));
		}
		else{
			mysqli_query($conn, "commit");							//commit
		}
		
		$point = 0;
	}
	$row = $temp;
}

$query = "select * from user";
$user = mysqli_query($conn, $query);
$user_row = mysqli_fetch_array($user);

while($user_row){
	$query = "select * from rank order by point";
	$rank = mysqli_query($conn, $query);
	$rank_row = mysqli_fetch_array($rank);
	while($rank_row){
		if($rank_row['point'] <= $user_row['user_point']){
			$user_id = $user_row['user_id'];
			$class = $rank_row['class'];
			$query = "update user set class = '$class' where user_id = '$user_id'";
			
			$ret = mysqli_query($conn, $query);
			if(!$ret){
				mysqli_query($conn, "rollback");					//rollback
				alert_message("Query Error : " .mysqli_error($conn));
			}
			else{
				mysqli_query($conn, "commit");						//commit
			}
		}
		$rank_row = mysqli_fetch_array($rank);
	}
	$user_row = mysqli_fetch_array($user);
}

echo "<meta http-equiv='refresh' content='0;url=video_list.php'>";

?>