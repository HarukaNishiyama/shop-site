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
  <h2>ショップ管理トップメニュー</h2>
  <a href="../shop/staff_list.php">スタッフ管理</a><br>
  <a href="../product/pro_list.php">商品管理</a><br>
  <a href="../order/order_download.php">注文ダウンロード</a><br>
  <a href="staff_logout.php">ログアウト</a>
</body>
</html>