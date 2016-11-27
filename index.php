<?php

/* 
 * Created by Maksim Kostenko 08.11.2016
 */

require_once 'header.php';

echo "<br><span class='main'>Welcome to $appname,";

if ($loggedin) echo " $user, you are logged in.<br><br>";
else echo ' please sign up and/or log in to join in.</span><br><br>';

