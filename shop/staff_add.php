<?php

  // ログイン確認
  // 合言葉確認
  session_start();
  // 毎回合言葉を変える
  session_regenerate_id(true);
  // ログイン確認ができない場合の処理
  if(isset($_SESSION['login'])==false){
    echo 'ログインされていません<br>';
    echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
  }else{
    echo $_SESSION['staff_name'].'さんログイン中<br>';
  }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>ろくまる農園</title>
</head>
<body>
  <h2>スタッフ追加</h2>
  <form method="post" action="staff_add_check.php">
    <p>スタッフ名を入力してください</p>
    <input type="text" name="name" style="width:200px">
    <p>パスワードを入力してください</p>
    <input type="password" name="pass" style="width:100px">
    <p>パスワードをもう一度入力してください</p>
    <input type="password" name="pass2" style="width:100px">
    <br><br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
  </form>
</body>
</html>