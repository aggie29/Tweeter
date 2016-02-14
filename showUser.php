<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
    <link rel="stylesheet" href="CSS/main.css">

</head>

<body>

<ul class="nav nav-pills">
    <li  class"active"><a href="editUser.php">Edit</a></li>
    <li  class"active"><a href="inbox.php">Inbox</a></li>
</ul>

</body>


<?php

require_once("./src/connection.php");

if(isset($_GET["userId"])){
    $userId = $_GET["userId"];
}
else{
    $userId = $_SESSION['userId'];
}

$userToShow = User::GetUserById($userId);

if($userToShow !== FALSE){
    echo("<h1>{$userToShow->getName()}</h1>");

    if($userToShow->getID() === $_SESSION['userId']){
        echo("
        <h3>Nowy tweet:</h3>
        <form action='showUser.php' method='post'>
        <input type='text' name='tweet_text'>
        <input type='submit'>
        </form>");
    }
    else{
        echo("nie ma takiego usera");
    }

    echo("<h3>Posty uzytkownika:</h3>");
    $tweets = $userToShow->loadAllTweets();
    foreach ($tweets as $tweet) {
        echo("<hr>");
        echo("{$tweet->getText()}<br>");
        echo("<a href='showTweet.php?tweetId={$tweet->getId()}'>Show</a><br>");

    }
}

?>

