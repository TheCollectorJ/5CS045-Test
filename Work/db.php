<?php
    $mysqli = new mysqli("localhost","2535107","tt5xlg","db2535107");
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
exit();
    }
?>