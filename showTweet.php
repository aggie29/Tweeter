<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
    <link rel="stylesheet" href="CSS/main.css">

</head>

<body>

<ul class="nav nav-pills">
    <li  class"active"><a href="ShowUser.php">Go back</a></li>
</ul>

</body>

<?php

require_once("./src/connection.php");


if(isset($_GET["tweetId"])){
    $tweetId = $_GET["tweetId"];
}
else{
    $tweetId = $_SESSION['tweetId'];
}

$tweetToShow = Tweet::LoadTweetById($tweetId);

if($tweetToShow !== FALSE) {
    echo("<h1> Text: {$tweetToShow->getText()}</h1>");
    echo("<h1> Post date:{$tweetToShow->getPostDate()}</h1>");
}


echo("<h3>Comments:</h3>");

$comments = Comment:: GetAllComments();

foreach ($comments as $comment) {
    echo("<hr>");
    echo("{$comment->getText()}<br>");
    echo("{$comment->getPostDate()}<br>");
    // echo("<a href='showComment.php?tweetId={$comment->getId()}'>Show</a><br>");

}

