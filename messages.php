<?php

/* 
 * Created by Maksim Kostenko 09.11.2016
 */

require_once 'header.php';

if (!$loggedin) die();

if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
else $view = $user;

if (isset($_POST['text']))
{
    $text = sanitizeString($_POST['text']);
    if ($text != "")
    {
        $typeok = substr(sanitizeString($_POST['type']),0,1);
        $time = time();
        queryMysql("INSERT INTO messages VALUES(NULL, '$user',
                   '$view', '$typeok', $time, '$text')");
    }
}

if ($view != "")
{
    if ($view == $user) $name1 = $name2 = "Your"; 
    else
    {
        $name1 = "<a href='members.php?view=$view'>$view</a>'s";
        $name2 = "$view's";
    }
    echo "<div class='main'><h3>$name1 Messages</h3>";

    showProfile($view);
    
echo <<<_END
    <form method='post' action='messages.php?view=$view'>
    Type here to leave a message:<br>
    <textarea name='text' cols='40' rows='3'></textarea><br>
    Public<input type='radio' name='type' value='0' checked='checked'>
    Private<input type='radio' name='type' value='1' />
    <input type='submit' value='Post Message'></form><br>
_END;
 
    if (isset($_GET['erase']))
    {
        $erase = sanitizeString($_GET['erase']);
        queryMysql("DELETE FROM messages WHERE id = $erase ");
    }
    
    $query = "SELECT * FROM messages WHERE recipient='$view' ORDER BY time DESC";
    $result = queryMysql($query);
    $num = $result->num_rows;
    
    for ($j = 0 ; $j < $num ; ++$j)
    {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($row['type'] == 0 || $row['author'] == $user || $row['recipient'] == $user)
        {
            $row1 = $row['author'];
            $row2 = $row['recipient'];
            $row3 = $row['type'];
            $row5 = $row['message'];
            $rowid =$row['id'];          
            echo date('M jS \'y g:ia:', $row['time']);
            
            echo " <a href='members.php?view=$row1'>$row1</a> ";
            if ($row['type'] == 0) 
                {echo "wrote: &quot; $row5 &quot; ";}

            if ($row['type'] == 1)
                {echo "whispered: &quot; $row5 &quot; ";}
            echo " <a href='messages.php?view=$view&erase=$rowid'>Erase</a> <br>";
        }   
    }
}

if (!$num) echo "<br><span class='info'>No messages yet</span><br><br>";

echo "<br><br><a class='button' href='messages.php?view=$view'>Refresh messages</a><br>".
     "<br><a class='button' href='friends.php?view=$view'>View $name2 friends</a><br>";

echo "</div><br>";
