<?php

include_once('mysql.php');

$sqlCommentsQuery = 'SELECT *, DATE_FORMAT(comments.date, "%d/%m/%Y") AS comment_date FROM comments LIMIT 50';
$commentsStatement = $db->prepare($sqlCommentsQuery);
$commentsStatement->execute();
$comments = $commentsStatement->fetchAll();

?>