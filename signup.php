<?php

include_once("connect.php");

# 用户名、密码长度控制
if(isset($_POST['user']{3}) && !isset($_POST['user']{10}) && isset($_POST['pwd']{3}) && !isset($_POST['pwd']{10})){
  $user = $_POST['user'];
  $pwd  = $_POST['pwd'];
  $select_user = "select user from users where user = '$user'";
  if ($result = mysqli_query($db, $select_user)) {                              # 判断是否重名
    $row = mysqli_fetch_assoc($result);
    echo "<script>alert('该用户名已被使用')</script>";
  }
  else {
    $insert = "insert into users value(null, '$user', '$pwd')";                 # 注册用户
    if (mysqli_query($db, $insert)) {
      echo "<script>alert('注册成功！');location.href='login.php'</script>";
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
  <title>Sign Up</title>
  <link href="style/login.css" rel="stylesheet" type="text/css">
</head>

<body>
  <div class="block">
  <h1>Sign Up</h1>
  <form action="./signup.php" method="post">
    <div> <input type="text" name="user" maxlength="10" placeholder="username"/></div>
    <div> <input type="password" name="pwd" maxlength="10" placeholder="password"/></div>
    <div> <button type="submit">sign up</button></div>
    <div> or <a href="login.php">sign in</a></div>
  </form>
</div>
</body>
</html>
