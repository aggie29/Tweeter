<html>
<head>
    <link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
    <link rel="stylesheet" href="CSS/main.css">

</head>

<body>

<ul class="nav nav-pills">
    <li  class"active"><a href="register.php">Register</a></li>
    <li  class"active"><a href="editUser.php">Edit</a></li>


</ul>
</body>

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

