<?php

$db_info = [
  "ip"   => "127.0.0.1",
  "user" => "root",
  "pwd"  => "",
  "db"   => "message_board"
];

$db = @mysqli_connect($db_info["ip"], $db_info["user"], $db_info["pwd"], $db_info["db"]) or die("Error!");

session_start();
if(@$author = $_SESSION['name']){
}
else{
  echo "<script>alert('您还未登录！');location.href='login.php';</script>";
}

if(isset($_POST['title']) && isset($_POST['target']) && isset($_POST['message'])){
  $title    = $_POST['title'];
  $target   = $_POST['target'];
  $messages = $_POST['message'];
  $reply    = "NULL";
  $insert = "insert into messages value(NULL, '$author', '$target', '$title', '$messages', now(), $reply);";
  if (mysqli_query($db, $insert)) {
    echo "<script>alert('留言成功！');location.href='board.php';</script>";
  }
  else {
    echo "<script>alert('留言失败！')</script>";
  }
  mysqli_close($db);
}


?>

<html>
<head>
  <title>Send Message</title>
</head>

<body>
  <h1>Send Message</h1>
  <form action="send.php" method="post">
    <table>
      <tr>
        <td>标题:</td>
        <td><input type="text" name="title"/></td>
      </tr>
      <tr>
        <td>收件人:</td>
        <td>
          <!--<input type="text" name="target"/></td>-->
          <select name="target">
          <?php
          $num = 0;
          $author = $_SESSION['name'];
          $select_target = "select user from users where user != '$author';";
          if ($result = mysqli_query($db, $select_target)) {
            while ($row = mysqli_fetch_assoc($result)) {
              $options[] = $row;
              $target[] = "<option value=\"{$options[$num]['user']}\">{$options[$num]['user']}</option>";
              $num++;
            }
            @$targets = implode('', $target);
            var_dump($targets);
          }
          $select = "<select name='target'>" . $targets . "</select>";
          ?>
        </select>
        </td>
      </tr>
      <tr>
        <td>正文:</td>
        <td><textarea rows="10" name="message"></textarea></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" value="submit"/>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="reset" value="reset"/></td>
      </tr>
    </table>
    <a href="./board.php">message board</a>
    <a href="./logout.php">logout</a>
  </form>
</body>
</html>
