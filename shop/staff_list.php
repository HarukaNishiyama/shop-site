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

  <?php
    try{
      // 接続
      $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
      $user='root';
      $password='';
      $dbh=new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      // 操作
      $sql='SELECT code,name FROM mst_staff WHERE 1';
      $stmt=$dbh->prepare($sql);
      $stmt->execute();
      // 切断
      $dbh=null;

      echo '<h2>スタッフ一覧</h2><br>';

      echo '<form method="post" action="staff_branch.php">';
      while(true){
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false){
          break;
        }

        echo '<input type="radio" name="staffcode" value="'.$rec['code'].'">';
        echo $rec['name'];
        echo '<br>';
        echo '<br>';

      }
        echo '<input type="submit" name="disp" value="参照">';
        echo '<input type="submit" name="add" value="追加">';
        echo '<input type="submit" name="edit" value="修正">';
        echo '<input type="submit" name="delete" value="削除">';
        echo '</form>';
    }catch(Exception $e){

      echo 'ただいま障害により大変ご迷惑をお掛けしております';
      // 強制終了
      exit();

    }
  ?>
  <br>
  <a href="../staff_login/staff_top.php">トップメニューへ</a>
</body>
</html>