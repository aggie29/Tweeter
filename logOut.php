<?php

require_once("./src/connection.php");

unset($_SESSION['userId']);
header("Location: login.php"); //mozna tylko i wylacznie uzyc jezeli nic nie wyswietlilismy na stronie!!!
?>


<form action="logOut.php" method="post">
    <br>
    <input type="submit" value="wyloguj">
</form>






