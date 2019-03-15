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

      // 定義部分
      $proName=$_POST['name'];
      $proPrice=$_POST['price'];
      $proCode=$_POST['code'];
      $proImageNameOld=$_POST['imageNameOld'];
      $proImageName=$_POST['imageName'];
      
      // セキュリティ対策
      $proName=htmlspecialchars($proName,ENT_QUOTES,'UTF-8');
      $proPrice=htmlspecialchars($proPrice,ENT_QUOTES,'UTF-8');
      $proCode=htmlspecialchars($proCode,ENT_QUOTES,'UTF-8');

      // 接続
      $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
      $user='root';
      $password='';
      $dbh=new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      // 操作
      $sql='UPDATE mst_product SET name=?,price=?,gazou=? WHERE code=?';
      $stmt=$dbh->prepare($sql);
      $data[]=$proName;
      $data[]=$proPrice;
      $data[]=$proCode;
      $data[]=$proImageName;
      $stmt->execute($data);
      // 切断
      $dbh=null;

      if($proImageNameOld!=$proImageName){
        if($proImageNameOld=''){
        unlink('./image/'.$proImageNameOld);
        }
      }
      
      echo '修正しました<br>';

    }catch(Exception $e){

      echo 'ただいま障害により大変ご迷惑をお掛けしております';
      // 強制終了
      exit();

    }
  ?>
  <br>
  <a href="pro_list.php">戻る</a>

</body>
</html>