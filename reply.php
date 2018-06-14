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
$reply = $_GET['reply'];
$select_target = "select author, title from messages where mid = $reply;";
if ($result = mysqli_query($db, $select_target)) {
  while ($row = mysqli_fetch_assoc($result)) {
    $target = "{$row['author']}";
    $title = "Re:{$row['title']}";
    if(isset($_POST['message']) && !isset($_POST['message']{200})){
      $messages = $_POST['message'];
      $insert = "insert into messages value(NULL, '$author', '$target', '$title', '$messages', now(), '$reply');";
      if (mysqli_query($db, $insert)) {
        echo "<script>alert('留言成功！');location.href='board.php';</script>";
      }
      else {
        echo "<script>alert('留言失败！')</script>";
      }
      mysqli_close($db);
    }
  }
}
?>


<html>
<head>
  <title>Send Message</title>
</head>

<body>
  <h1>Send Message</h1>
  <form action="reply.php?reply=<?php echo "$reply"?>" method="post">
    <table>
      <tr>
        <td>标题:</td>
        <td><?php echo "{$title}"; ?></td>
      </tr>
      <tr>
        <td>收件人:</td>
        <td><?php echo "{$target}"; ?></td>
      </tr>
      <tr>
        <td>正文:</td>
        <td><textarea rows="10" name="message" maxlength="200" placeholder="maxlength is 200"></textarea></td>
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
