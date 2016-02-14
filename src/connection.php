<?php

session_start();
require_once(dirname(__FILE__)."/config.php");//dirname zawsze sie odwoluje do poprawnego pliku
require_once(dirname(__FILE__)."/user.php");
require_once(dirname(__FILE__)."/tweet.php");
require_once(dirname(__FILE__)."/comment.php");

$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbBaseName );

if($conn->connect_errno){//wypisuje nr bledu
    die("Db connection not initialized properly" . $conn->connect_error);
}
echo("Connection initialized properly");

User::SetConnection($conn);
Tweet::SetConnection($conn);
Comment::SetConnection($conn);

//rejestracja

/*$user1 = User::RegisterUser("Ela23", "ela23@gmail.com", "ela23", "ela23", "Opis Eli23");
var_dump($user1);*/


//login
/*$user1 = User::LogInUser("test3@gmail.com", "1223");
var_dump($user1);

$user2 = User::GetUserById(2);
var_dump($user2);

$user3= User::GetAllUsers();
var_dump($user3);
*/

//$sql= "UPDATE Users SET description='great' WHERE id= 1";

//$result = $conn->query($sql);

//$user1 = User::RegisterUser("Ela30", "ela30@gmail.com", "ela30", "ela30", "Opis Eli30");
//var_dump($user1);
//$user1->setDescription("Nowy opis2");
//$user1->saveTODB();

//var_dump($user1);

//$user1 = User::RegisterUser("Ela26", "ela26@gmail.com", "ela26", "ela26", "Opis Eli26");
//var_dump($user1);

//$user1->setDescription("Nowy opis");
//$user1->saveTODB();

$tweet1 = Tweet::CreateTweet(3, "New tweet", "2016-03-03");
var_dump($tweet1);

/*$tweet2 = Tweet::LoadTweetById(66);
$tweet2->setText("Nowy opis");
var_dump($tweet2);

$tweet2->setText("to dziala??:)");
$tweet2->updateTweet();

$tweet2-> GetAllTweets();
var_dump($tweet2);*/