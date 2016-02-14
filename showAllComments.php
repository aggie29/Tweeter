<?php

<<<<<<< HEAD
require_once("./src/connection.php");

$allComments = Comment::GetAllComments();

foreach($allComments as $commentToShow){
    echo("<h2>{$commentToShow->getText()}</h2><br>");
    echo("<a href='showComment.php?userId={$commentToShow->getId()}'>Show</a><br>");
}


//
=======
>>>>>>> 583ffd871336fe5f854fdaf9991032ff906c77fa
