<?php

/* 
 * Created by Maksim Kostenko 07.11.2016
 */

echo <<<_END
<!DOCTYPE html>
<html>
    <head>
        <title>Настройка базы данных</title>
    </head>
    <body>
        <h3>Setting up...</h3> 
_END;

require_once 'functions.php';

createTable('members','user VARCHAR(16),pass VARCHAR(16),INDEX(user(6))');

createTable('messages',
            'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
             author VARCHAR(16),
             recipient VARCHAR(16),
             type CHAR(1),
             time INT UNSIGNED,
             message VARCHAR(4096),
             INDEX(author(6)),
             INDEX(recipient(6))');

createTable('friends',
            'user VARCHAR(16),
             friend VARCHAR(16),
             INDEX(user(6)),
             INDEX(friend(6))');

createTable('profiles',
            'user VARCHAR(16),
             text VARCHAR(4096),
             INDEX(user(6))');

echo <<<_END
        <br>...done. // ... завершена.
    </body>
</html>
_END;
