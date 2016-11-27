<?php

/* 
 * Created by Maksim Kostenko 09.11.2016
 */

require_once 'header.php';

if (isset($_SESSION['user']))
{
    destroySession();
    echo "<div class='main'>You have been logged out. Please " .
         "<a href='index.php'>click here</a> to refresh the screen.";
}
else echo "<div class='main'><br>" .
          "You cannot log out because you are not logged in";

echo "<br><br></div>";
