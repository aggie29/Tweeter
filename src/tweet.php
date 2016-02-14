<?php

/*
CREATE TABLE Tweets(
    id int AUTO_INCREMENT,
    user_id int,
    text varchar(255),
    post_date date,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES Users(id)

 );
*/
/*Ma ona implementować następujące funkcjonalności:
 Set i get do wszystkich atrybutów (do id tylko get)
 Konstruktor nastawiający id na -1 a resztę danych zerujący
 Funkcję loadFromDB (wzoruj się na klasie User)   Funkcję create(wzoruj się na register z klasiy User)
 Funkcję update (wzoruj się na klasie User)  Funkcję show(wzoruj się na klasie User)
 Funkcje getAllComments(na razie będzie pusta – jak stworzysz komentarze to ją uzupełnisz)*/




class Tweet
{
    static private $connection;

    static public function SetConnection(mysqli $newConnection)
    {//z duzej litery funkcja bo jest statyczna
        Tweet::$connection = $newConnection;
    }

    static public function CreateTweet($newUserId, $newText, $newDate)
    {

        $sql = "INSERT INTO Tweets(user_id, text, post_date)
                VALUES('$newUserId','$newText','$newDate')";

        $result = self::$connection->query($sql);
        if ($result === TRUE) {
            $newTweet = new Tweet(self::$connection->insert_id, $newUserId, $newText, $newDate);
            return $newTweet;
        }
        return false;

    }

    static public function LoadTweetById($idToLoad)
    {
        $sql = "SELECT * FROM Tweets WHERE id= $idToLoad";

        $result = self::$connection->query($sql);
        if ($result !== FALSE) {
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $tweet = new Tweet($row["id"], $row["user_id"], $row["text"], $row["post_date"]);
                return $tweet;
            }
        }
        return false;

    }

    private $id;
    private $user_id;
    private $text;
    private $post_date;

    //Konstruktor nastawiający id na -1 a resztę danych zerujący

    public function __construct($newId, $newUserId, $newText, $newPostDate)
    {
        $this->id = intval($newId); //zawsze jestesmy pewni ze jest to zmienna liczbowa
        $this->user_id = $newUserId;
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

    public function updateTweet(){
        $sql= "UPDATE Tweets SET text='$this->text' WHERE id= $this->id";

        $result = Tweet::$connection->query($sql);
        if($result === TRUE){
            return TRUE;
        }
        return FALSE;
    }

    static public function GetAllTweets(){
        $ret = [];
        $sql = "SELECT * FROM Tweets";

        $result = self::$connection->query($sql);

        if($result !== FALSE){
            if($result->num_rows>0){
                while($row = $result-> fetch_assoc()){
                    $tweet = new Tweet($row["id"], $row["user_id"], $row["text"], $row["post_date"]);
                    $ret[] = $tweet;
                }
            }
        }

        return $ret;
    }

    public function loadAllComments(){
        $ret = [];
        $sql = "SELECT * FROM Comments WHERE user_id = ($this->id)";
        $result = self::$connection->query($sql);
        if($result !== false) {
            if($result->num_rows>0) {
                while($row = $result->fetch_assoc()){
                    $comment = new Comment($row['id'], $row['tweet_id'], $row['user_id'], $row['text'], $row['postDate']);
                    $ret[] = $comment;
                }
            }
        }
        return $ret;
    }
}
