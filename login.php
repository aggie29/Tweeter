<?php

require_once("./src/connection.php");

//jezeli uzytkownik jest zalogowany to nie powinien miec dostepu do loginu i rejestracji dolaczyc to
if($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = User::LogInUser($_POST['email'], $_POST['password']);

    if ($user !== False) {

//        session_start();
        $_SESSION['userId'] = $user->getId();
        header("Location: showUser.php");
    }

    else {
        echo('Zle dane logowania');
    }
}

?>


<form action="login.php" method="post">

    <label>
Email:
        <input type="email" name="email">
    </label>
    <br>

    <label>
Password:
        <input type="password" name="password">
    </label>
    <br>
    <input type="submit" value="login">
</form>

