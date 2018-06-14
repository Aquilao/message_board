<?php

$db_info = [
  "ip"   => "127.0.0.1",
  "user" => "root",
  "pwd"  => "",
  "db"   => "message_board"
];

$db = @mysqli_connect($db_info["ip"], $db_info["user"], $db_info["pwd"], $db_info["db"]) or die("Error!");

session_start();
if(@$user = $_SESSION['name']){
  $welcome = "Welcome $user!";
}
else {
  echo "<script>alert('您还未登录！');location.href='login.php';</script>";
}
$num = 0;

if ($result = mysqli_query($db, "select author, target, time, title, message from messages where target = '$user';")) {
  while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
    $id = $num + 1;
    $summary[] = "
      <tr>
        <td>$id</td>
        <td>{$messages[$num]['author']}</td>
        <td>{$messages[$num]['title']}</td>
        <td>{$messages[$num]['time']}</td>
        <td>{$messages[$num]['message']}</td>
        <td>
      </tr>";
    $num++;
  }
  mysqli_close($db);
  @$summarys = implode('',$summary);

  $table = "<table>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td width='150'>发件人</td>
                <td width='150'>标题</td>
                <td width='200'>时间</td>
                <td>正文</td>
              </tr>" . $summarys . "</table>";
}
else {
  echo "Error1!";
}
?>


<html>
<head>
  <title>Message Board</title>
</head>
<body>
  <h1>Your Messages</h1>
  <pre><?php echo "$welcome</br>"; echo "当前您有 $num 条留言";echo "$table";?></pre>
  <a href="./send.php">send message</a>
  <a href="./logout.php">logout</a>
</body>
</html>
