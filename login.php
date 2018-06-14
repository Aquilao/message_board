<?php

$db_info = [
  "ip"   => "127.0.0.1",
  "user" => "root",
  "pwd"  => "",
  "db"   => "message_board"
];



if(isset($_POST['user']) && isset($_POST['pwd'])){
  $user = $_POST['user'];
  $pwd  = $_POST['pwd'];

  $db = @mysqli_connect($db_info["ip"], $db_info["user"], $db_info["pwd"], $db_info["db"]) or die("Error!");

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
    <div> username: <input type="text" name="user"/></div>
    <div> password: <input type="password" name="pwd"/></div>
    <input type="submit" value="sign in"/>
  </br><a href="signup.php">sign up</a>
  </form>
</body>
</html>
