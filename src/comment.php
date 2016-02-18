<?php

/*
CREATE TABLE Comments(
    id int AUTO_INCREMENT,
    tweet_id int,
    user_id int,
    text varchar(255),
    post_date date,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES Users(id),
    FOREIGN KEY(tweet_id) REFERENCES Tweets(id)
 );


Stwórz klasę Comment. Ma ona zawierać:
 Id: int, private
 Id_usera: int, private
 Id_postu: int, private
 Creation_date: datetime, private
 Text: string, private
Ma ona implementować następujące funkcjonalności:
 Set i get do wszystkich atrybutów (do id tylko get)
 Konstruktor nastawiający id na -1 a resztę danych zerujący
 Funkcję loadFromDB (wzoruj się na klasie User)
 Funkcję create(wzoruj się na register z klasiy User)
 Funkcję update (wzoruj się na klasie User)
 Funkcję show(wzoruj się na klasie User*/


class Comment
{
    static private $connection;

    static public function SetConnection(mysqli $newConnection)
    {//z duzej litery funkcja bo jest statyczna
        Comment::$connection = $newConnection;
    }

    static public function LoadCommentById($idToLoad)
    {
        $sql = "SELECT * FROM Comments WHERE id= $idToLoad";

        $result = self::$connection->query($sql);
        if ($result !== FALSE) {
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $comment = new Comment($row["id"], $row["tweet_id"], $row["user_id"],  $row["text"], $row["post_date"]);
                return $comment;
            }
        }
        return false;

    }

    static public function CreateComment($newTweetId, $newUserId,  $newText, $newDate)
    {

        $sql = "INSERT INTO Comments(tweet_id, user_id, text, post_date)
                VALUES('$newTweetId', '$newUserId','$newText','$newDate')";

        $result = self::$connection->query($sql);
        if ($result === TRUE) {
            $newComment = new Comment(self::$connection->insert_id, $newTweetId, $newUserId, $newText, $newDate);
            return $newComment;
        }
        return false;

    }

    private $id;
    private $user_id;
    private $tweet_id;
    private $text;
    private $post_date;


    public function __construct($newId, $newUserId, $newTweetId, $newText, $newPostDate)
    {
        $this->id = intval($newId); //zawsze jestesmy pewni ze jest to zmienna liczbowa
        $this->user_id = $newUserId;
        $this->tweet_id = $newTweetId;
        $this->setText($newText);
        $this->setPostDate($newPostDate);
    }

    public function getID()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getTweetId()
    {
        return $this->tweet_id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getPostDate()
    {
        return $this->post_date;
    }


    public function setText($newText)
    {
        if (is_string($newText)) {
            $this->text = $newText;
        }
    }

    public function setPostDate($newPostDate)
    {
        if (is_string($newPostDate)) {
            $this->post_date = $newPostDate;
        }
    }

    public function updateComment(){
        $sql= "UPDATE Comments SET text='$this->text' WHERE id= $this->id";

        $result = Comment::$connection->query($sql);
        if($result === TRUE){
            return TRUE;
        }
        return FALSE;
    }

    static public function GetAllComments(){
        $ret = [];
        $sql = "SELECT * FROM Comments";

        $result = self::$connection->query($sql);

        if($result !== FALSE){
            if($result->num_rows>0){
                while($row = $result-> fetch_assoc()){
                    $comment = new Comment($row["id"], $row["tweet_id"] ,$row["user_id"], $row["text"], $row["post_date"]);
                    $ret[] = $comment;
                }
            }
        }

        return $ret;
    }

}


