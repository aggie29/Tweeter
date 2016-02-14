<?php

$options = [
    'cost'=>11,
    'salt'=>mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
];
$hashedPassword = password_hash("blaa", PASSWORD_BCRYPT, $options);

var_dump($hashedPassword);



