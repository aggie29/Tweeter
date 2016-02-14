<?php

 require_once("./src/connection.php");

    if(isset($_GET["userId"])){
        $userId = $_GET["userId"];
    }
    else{
        $userId = $_SESSION['userId'];
    }

    $userToEdit = User::GetUserById($userId);


    $userToEdit = User::GetUserById($_SESSION['userID']);
    var_dump($_SESSION['userID']);

if($userToEdit->getID() === $_SESSION['userId']){


        $user->setDescription($_POST['description']);
        $user->saveTODB();

    }else {
        echo("zle dane do zmiany opisu");

}
?>


<form action="editUser.php" method="post">
    <label>
Description:
        <input type="text" name="description">
    </label>
    <input type="submit">
</form>

