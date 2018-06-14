<?php

$db_info = [
  "ip"   => "127.0.0.1",
  "user" => "root",
  "pwd"  => "",
  "db"   => "message_board"
];

$db = @mysqli_connect($db_info["ip"], $db_info["user"], $db_info["pwd"], $db_info["db"]) or die("Error!");

if(isset($_POST['user']) && isset($_POST['pwd'])){
  $user = $_POST['user'];
  $pwd  = $_POST['pwd'];

  $insert = "insert into users value(null, '$user', '$pwd');";
  if (mysqli_query($db, $insert)) {
    echo "<script>alert('注册成功！');location.href='login.php';</script>";
  }
  else {
    echo "<script>alert('注册失败！')</script>";
  }
  mysqli_close($db);
}

?>

<html>
<head>
  <title>User Login</title>
</head>

<body>
  <h1>Sign UP</h1>
  <form action="./signup.php" method="post">
    <div> username: <input type="text" name="user"/></div>
    <div> password: <input type="password" name="pwd"/></div>
    <input type="submit" value="sign up"/>
  </form>
</body>
</html>
