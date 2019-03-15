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
  <h2>商品追加</h2>
  <form method="post" action="pro_add_check.php" enctype="multipart/form-data">
    <p>商品名を入力してください</p>
    <input type="text" name="name" style="width:200px">
    <p>価格を入力してください</p>
    <input type="text" name="price" style="width:50px">
    <p>画像を選んでください</p>
    <input type="file" name="image" style="width:400px">
    <br><br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
  </form>
</body>
</html>