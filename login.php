<?php

include_once("connect.php");

# 用户名、密码长度控制
if(isset($_POST['user']{3}) && !isset($_POST['user']{10}) && isset($_POST['pwd']{3}) && !isset($_POST['pwd']{10})){
  $user = $_POST['user'];
  $pwd  = $_POST['pwd'];
  $select_pwd = "select pwd from users where user = '$user'";
  if($result = mysqli_query($db, $select_pwd)){                                 # 查询数据库中密码
    $true_pwd = mysqli_fetch_assoc($result)["pwd"];
    mysqli_close($db);
    if ($true_pwd == $pwd) {                                                    # 验证密码
      echo "<script>location.href='board.php'</script>";
      session_start();                                                          # 开始会话
      $_SESSION['name'] = $user;
    }
    else {
      echo "<script>alert('登录失败')</script>";
    }
  }
}
?>

<html>
<head>
  <title>Sign In</title>
  <link href="style/login.css" rel="stylesheet" type="text/css">
</head>

<body>
  <h1>Sign In</h1>
  <form action="login.php" method="post">
    <div> <input type="text" name="user" maxlength="10" placeholder="username"/></div>
    <div> <input type="password" name="pwd" maxlength="10" placeholder="password"/></div>
    <div> <input type="submit" value="sign in"/></div>
    <div> <a href="signup.php">sign up</a></div>
  </form>
</body>
</html>
