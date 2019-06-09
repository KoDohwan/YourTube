<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>YourTube</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="video_list.php" method="post">
    <div class='navbar fixed'>
        <div class='container'>
        	<a class='pull-left' href='index.php'><img class='icon' src='images/icon.PNG'></a>
            <a class='pull-left title' href="index.php">YourTube</a>
            <ul class='pull-right'>
                <li>
                    <input type="text" name="search_keyword" placeholder="회원검색">
                </li>
                <li><a href='user_list.php'>회원 목록</a></li>
                <li><a href='user_form.php'>회원 등록</a></li>
                <li><a href='channel_list.php'>채널 목록</a></li>
                <li><a href='channel_form.php'>채널 등록</a></li>
                <li><a href='video_list.php'>영상 목록</a></li>
                <li><a href='video_form.php'>영상 등록</a></li>
            </ul>
        </div>
    </div>
</form>