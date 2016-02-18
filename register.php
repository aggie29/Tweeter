<?php

require_once("./src/connection.php");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $user = User::RegisterUser($_POST['name'], $_POST['email'],
        $_POST['password1'], $_POST['password2'], $_POST['description']);

    if($user !== False){
      //  session_start();
        $_SESSION['userId']= $user->getId();
        header("Location: showUser.php");
    }
    else{
        echo('Wrong data');
    }
}

?>

<html>
<head>
    <link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
    <link rel="stylesheet" href="CSS/main.css">

</head>

<body>

<ul class="nav nav-pills">
    <li  class"active"><a href="index_main.php">Main</a></li>
</ul>

</body>


<form action="register.php" method="post">
    <label>
        Email:
        <input type="email" name="email">
    </label>
    <br>
    <label>
        Name:
        <input type="text" name="name">
    </label>
    <br>
    <label>
        Password:
        <input type="password" name="password1">
    </label>
    <br>
    <label>
        Repeat password:
        <input type="password" name="password2">
    </label>
    <br>
    <label>
        Description:
        <input type="text" name="description">
    </label>
    <input type="submit" name="submit">
</form>

