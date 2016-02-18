<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
    <link rel="stylesheet" href="CSS/main.css">

</head>

<body>

<ul class="nav nav-pills">
    <li  class"active"><a href="index_main.php">Main</a></li>
    <li  class"active"><a href="editUser.php">Edit</a></li>
    <li  class"active"><a href="sendMessage.php">Send message</a></li>
    <li  class"active"><a href="inbox.php">Inbox</a></li>
    <li  class"active"><a href="logOut.php">Log Out</a></li>
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

        echo("
        <h3>Nowy tweet:</h3>");

        $tweet_text = $_POST["tweet_text"];
        if($tweet_text !== FALSE){
        $tweet1 = Tweet::CreateTweet($userId, $tweet_text, date("Y/m/d"));
        }

        echo("
        <form action='showUser.php' method='post'>
        <input type='text' name='tweet_text'>
        <input type='submit'>
        </form>");



    echo("<h3>Posty uzytkownika:</h3>");
    $tweets = $userToShow->loadAllTweets();
       foreach ($tweets as $tweet) {
        echo("<hr>");
        echo("{$tweet->getText()}<br>");
        echo("<a href='showTweet.php?tweetId={$tweet->getId()}'>Show</a><br>");

    }
}

?>

