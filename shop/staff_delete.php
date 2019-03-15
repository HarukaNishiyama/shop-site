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
</html>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>ろくまる農園</title>
</head>
<body>
  <?php
    try{
      $staffCode=$_GET['staffcode'];
      // 接続
      $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
      $user='root';
      $password='';
      $dbh=new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      // 操作
      $sql='SELECT name FROM mst_staff WHERE code=?';
      $stmt=$dbh->prepare($sql);
      $data[]=$staffCode;
      $stmt->execute($data);

      $rec=$stmt->fetch(PDO::FETCH_ASSOC);
      $staffName=$rec['name'];

      $dbh=null;

    }catch(Exception $e){

      echo 'ただいま障害により大変ご迷惑をお掛けしております';
      // 強制終了
      exit();

    }
  ?>

  <h2>スタッフ削除</h2>
  <p>スタッフコード</p>
  <?php echo $staffCode; ?>
  <br>
  <p>スタッフ名</p>
  <?php echo $staffName ?><br><br>  
  <p>このスタッフを削除してよろしいですか？</p><br>
  <form method="post" action="staff_delete_done.php">
    <input type="hidden" name="code" value="<?php echo $staffCode ?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
  </form>
</body>
</html>