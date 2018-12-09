<?php

$db_info = [
  "ip"   => "127.0.0.1",
  "user" => "root",
  "pwd"  => "",
  "db"   => "message_board"
];

$db = @mysqli_connect($db_info["ip"], $db_info["user"], $db_info["pwd"], $db_info["db"]) or die("Error!");

?>
