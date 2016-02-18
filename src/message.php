<?php
/*Zadanie 9.  Wiadomości. Czas na wysyłanie wiadomości.
Stwórz tabelę w bazie danych która będzie trzymała wiadomości.
Połącz ją z tabelą użytkowników relacją wiele do 2 (czyli dwie relacje wiele do jednego:
wiadomość ma dwóch użytkowników nadawcę i odbiorcę, a użytkownik ma wiele wiadomości).
W tabeli stwórz pole które będzie trzymało informację czy wiadomość została przeczytana
(np.: 1 – wiadomość nieprzeczytana, 0-wiadomość przeczytana).
Stwórz klas wiadomości wzorując się na poprzednich zadaniach.
Stwórz stronę która wyświetli wszystkie wiadomości które otrzymał/wysłał użytkownik.
Do strony wyświetlającej użytkownika dodaj guzik który przekieruje na stronę z formularzem
do wysłania wiadomości do tego użytkownika (nie powinno się dać wysłać wiadomości do samego siebie!).
Pamiętaj o tym że nowa stworzona wiadomość powinna być oznaczona jako nieprzeczytana.
Dodaj stronę która wyświetli informację wiadomości (jeżeli otwiera ją odbiorca pamiętaj żeby
oznaczyć wiadomości jako przeczytaną).
Jeżeli coś nie jest jasne to nie bój się zapytać prowadzącego zajęcia. */

/*
CREATE TABLE Messages(
    id int AUTO_INCREMENT,
    user_id int,
    text varchar(255),
    post_date date,
    read int(1),
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES Users(id)

 );
*/


class Message{
    static private $connection;

    static public function SetConnection(mysqli $newConnection){//z duzej litery funkcja bo jest statyczna
        Message::$connection = $newConnection;
    }
}