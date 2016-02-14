<?php

/*
CREATE TABLE Users(
    id int AUTO_INCREMENT,
    name varchar(255),
    email varchar(255) UNIQUE,
    password char(60),
    description varchar(255),
    PRIMARY KEY(id)
 );
*/


class User{
    static private $connection;

    static public function SetConnection(mysqli $newConnection){//z duzej litery funkcja bo jest statyczna
        User::$connection = $newConnection;
    }

    static public function RegisterUser($newName, $newEmail, $password1, $password2, $newDescription){
        if($password1 !== $password2){
            return false;
        }

        $options = [
            'cost'=>11,
            'salt'=>mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
        ];
        $hashedPassword = password_hash($password1, PASSWORD_BCRYPT, $options);

        $sql = "INSERT INTO Users(name, email, password, description)
                VALUES('$newName','$newEmail', '$hashedPassword', '$newDescription')";

        $result = self::$connection->query($sql);
        if($result === TRUE) {
            $newUser = new User(self::$connection->insert_id, $newName, $newEmail, $newDescription);
                return $newUser;
            }
            return false;

    }

    static public function LogInUser($email, $password){
        $sql = "SELECT * FROM Users WHERE email like '$email'";
        $result = self::$connection->query($sql);

        if($result !== FALSE){
            if($result->num_rows === 1){
                $row = $result->fetch_assoc();

                $isPasswordOk = password_verify($password, $row["password"]);

                if($isPasswordOk === true){
                    $user = new User($row["id"], $row["name"], $row["email"], $row["description"]);
                    return $user;
                }
            }
        }
        return false;
    }

    static public function GetUserById($idToLoad){
        $sql = "SELECT * FROM Users WHERE id= $idToLoad";

        $result = self::$connection->query($sql);
        if($result !== FALSE) {
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $user = new User($row["id"], $row["name"], $row["email"], $row["description"]);
                return $user;
            }
        }
        return false;

    }

    static public function GetAllUsers(){
        $ret = [];
        $sql = "SELECT * FROM Users";

        $result = self::$connection->query($sql);

        if($result !== FALSE){
            if($result->num_rows>0){
                while($row = $result-> fetch_assoc()){
                    $user = new User($row["id"], $row["name"], $row["email"], $row["description"]);
                    $ret[] = $user;
                }
            }
        }

return $ret;
    }

    private $id;
    private $name;
    private $email;
    private $description;

    public function __construct($newId, $newName, $newEmail, $newDescription){
        $this->id = intval($newId); //zawsze jestesmy pewni ze jest to zmienna liczbowa
        $this->name = $newName;
        $this->email = $newEmail;
        $this->setDescription($newDescription);
    }

    public function getID(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($newDescription){
        if(is_string($newDescription)){
            $this->description = $newDescription;
        }
    }

    public function saveTODB(){
        $sql= "UPDATE Users SET description='$this->description' WHERE id= $this->id";


        $result = User::$connection->query($sql);
        if($result === TRUE){
            return TRUE;
        }
        return FALSE;
    }

    public function loadAllTweets(){
        $ret = [];
        $sql = "SELECT * FROM Tweets WHERE user_id = ($this->id)";
        $result = self::$connection->query($sql);
        if($result !== false) {
            if($result->num_rows>0) {
                while($row = $result->fetch_assoc()){
                    $tweet = new Tweet($row['id'], $row['user_id'], $row['text'], $row['postDate']);
                    $ret[] = $tweet;
                }
            }
        }
        return $ret;
    }


/*Zmodyfikuj stronę główną tak żeby wyświetlała wszystkie wpisy użytkownika
(załaduj je do tabelki za pomocą funkcji loadAllTweets a potem wypisz informację
o każdym tweecie używając funkcji show) i posiadała formularz do stworzenia nowego wpisu
(pamiętaj o obsłużeniu tego formularza na tej samej stronie – ma on tworzyć nowy tweet przypisany
do zalogowanego Usera). Zmodyfikuj stronę użytkownika tak żeby wyświetlała wszystkie jego wpisy.
Stwórz stronę która wyświetli wszystkie informacje o wpisie.*/

    public function loadAllSendMessages(){
        $ret = [];
        //TODO: Finish this function
        //TODO: It should return table of Messages send by this user (date DESC)

        return $ret;
    }

    public function loadAllreceivedMessages(){
        $ret = [];
        //TODO: Finish this function
        //TODO: It should return table of all received Messages(date DESC)

        return $ret;
    }
}
