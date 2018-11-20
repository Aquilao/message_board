<?php

include_once("connect.php");

session_start();
# 判断是否登录
if(@$user = $_SESSION['name']){
  $welcome = "Welcome $user!";
}
else {
  echo "<script>alert('您还未登录！');location.href='login.php'</script>";
}
$num = 0;                                                                       # 留言条数
$select_message = "select mid, author, target, time, title, message from messages where target = '$user'";

# 查询并逐条显示留言
if ($result = mysqli_query($db, $select_message)) {
  while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
    $id = $num + 1;
    $reply = $messages[$num]['mid'];
    $summary[] = "
      <tr>
        <td>$id</td>
        <td>{$messages[$num]['author']}</td>
        <td>{$messages[$num]['title']}</td>
        <td>{$messages[$num]['time']}</td>
        <td>{$messages[$num]['message']}</td>
        <td><a href=reply.php?reply={$messages[$num]['mid']}>Reply</a></td>
        <td><a href=delete.php?delete={$messages[$num]['mid']}>Delete</a></td>
      </tr>";
    $num++;
  }
  mysqli_close($db);
  @$summarys = implode('',$summary);

  $table = "<table>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td width='150'>From</td>
                <td width='150'>title</td>
                <td width='300'>time</td>
                <td width='200'>text</td>
                <td width=100></td>
                <td></td>
              </tr>" . $summarys . "</table>";
}
else {
  echo "Error1!";
}
?>


<html>
<head>
  <title>Message Board</title>
  <link href="style/board.css" rel="stylesheet" type="text/css">
  <meta http-equiv="refresh" content="5">
</head>
<body>
  <h1>Your Messages</h1>
  <pre><?php echo "$welcome</br>"; echo "You have $num messages.</br>";echo "$table";?></pre>
  <button type="button" name="button"><a href="./send.php" class="button">send message</a></button>
  <button type="button" name="button"><a href="./logout.php" class="button">logout</a></button>
</body>
</html>
