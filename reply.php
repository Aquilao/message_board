<?php

include_once("connect.php");

session_start();
# 判断是否登录
if(@$author = $_SESSION['name']){
}
else{
  echo "<script>alert('您还未登录！');location.href='login.php'</script>";
}
$reply = $_GET['reply'];
$select_target = "select author, title from messages where mid = $reply";
if ($result = mysqli_query($db, $select_target)) {
  while ($row = mysqli_fetch_assoc($result)) {
    $target = "{$row['author']}";
    $title = "{$row['title']}";
    if ("Re:" == substr($row['title'], 0, 3)) {                                 # 判断是否为二次回复，防止 title 过长
      $title = "reply";
    }
    else {
      $title = "Re:" . $title;
    }
    if(isset($_POST['message']{0}) && !isset($_POST['message']{200})){             # 正文长度控制
      $messages = $_POST['message'];
      $insert = "insert into messages value(NULL, '$author', '$target', '$title', '$messages', now(), '$reply')";
      if (mysqli_query($db, $insert)) {
        echo "<script>alert('留言成功！');location.href='board.php'</script>";
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
  <link href="style/send.css" rel="stylesheet" type="text/css">
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
          <input type="reset" value="reset"/></td>
      </tr>
    </table>
    <a href="./board.php">message board</a>
    <a href="./logout.php">logout</a>
  </form>
</body>
</html>
