<?php

include_once("connect.php");

if(isset($_POST['user']{3}) && !isset($_POST['user']{10}) && isset($_POST['pwd']{3}) && !isset($_POST['pwd']{10})){
  $user = $_POST['user'];
  $pwd  = $_POST['pwd'];
  $select_user = "select user from users where user = '$user';";
  if ($result = mysqli_query($db, $select_user)) {
    $row = mysqli_fetch_assoc($result);
    echo "<script>alert('该用户名已被使用')</script>";
  }
  else {
    $insert = "insert into users value(null, '$user', '$pwd');";
    if (mysqli_query($db, $insert)) {
      echo "<script>alert('注册成功！');location.href='login.php';</script>";
    }
    else {
      echo "<script>alert('注册失败！')</script>";
    }
    mysqli_close($db);
  }
}


?>

<html>
<head>
  <title>User Login</title>
  <link href="style/login.css" rel="stylesheet" type="text/css">
</head>

<body>
  <h1>Sign UP</h1>
  <form action="./signup.php" method="post">
    <div> <input type="text" name="user" maxlength="10" placeholder="username"/></div>
    <div> <input type="password" name="pwd" maxlength="10" placeholder="password"/></div>
    <div> <input type="submit" value="sign up"/></div>
    <div> <a href="login.php">sign in</a></div>
  </form>
</body>
</html>
