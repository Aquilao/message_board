<?php

include_once("connect.php");

if(isset($_POST['user']{3}) && !isset($_POST['user']{10}) && isset($_POST['pwd']{3}) && !isset($_POST['pwd']{10})){
  $user = $_POST['user'];
  $pwd  = $_POST['pwd'];

  if($result = mysqli_query($db, "select pwd from users where user = '$user';")){
    $true_pwd = mysqli_fetch_assoc($result)["pwd"];
    mysqli_close($db);
    if ($true_pwd == $pwd) {
      echo "<script>location.href='board.php';</script>";
      session_start();
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
</head>

<body>
  <h1>Sign In</h1>
  <form action="login.php" method="post">
    <div> username: <input type="text" name="user" maxlength="10" placeholder="username"/></div>
    <div> password: <input type="password" name="pwd" maxlength="10" placeholder="password"/></div>
    <input type="submit" value="sign in"/>
  </br><a href="signup.php">sign up</a>
  </form>
</body>
</html>
