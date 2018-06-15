<?php

include_once("connect.php");

session_start();
# 判断是否登录
if(@$user = $_SESSION['name']){
}
else{
  echo "<script>alert('您还未登录！');location.href='login.php'</script>";
}

$delete = $_GET['delete'];
$delete_message = "delete from messages where mid = '$delete'";

if (mysqli_query($db, $delete_message)) {
  echo "<script>alert('删除成功！');location.href='board.php'</script>";
}
else {
  echo "<script>alert('删除失败！')</script>";
}
mysqli_close($db);
?>
