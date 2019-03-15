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
  <meta charset="UTF-8">
  <title>ろくまる農園</title>
</head>
<body>
  <?php require_once('../common/common.php'); ?>
  <p>ダウンロードしたい注文日を選んで下さい</p>
  <form method="post" action="order_download_done.php">
    <?php pulldown_year(); ?>年
    <?php pulldown_month(); ?>月
    <?php pulldown_day(); ?>日<br><br>
    <input type="submit" value="ダウンロードへ">
  </form>
</body>
</html>