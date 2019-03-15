<?php

  // ログイン確認
  // 合言葉確認
  session_start();
  // 毎回合言葉を変える
  session_regenerate_id(true);
  // ログイン確認ができない場合の処理
  if(isset($_SESSION['member_login'])==false){
    echo 'ようこそゲスト様<br>';
    echo '<a href="../staff_login/staff_login.html">会員ログイン</a><br>';
  }else{
    echo 'ようこそ'.$_SESSION['member_name'].'様';
    echo '<a href="member_logout.php">ログアウト</a>';
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
      $proCode=$_GET['procode'];
      // 接続
      $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
      $user='root';
      $password='';
      $dbh=new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      // 操作
      $sql='SELECT name,price,gazou FROM mst_product WHERE code=?';
      $stmt=$dbh->prepare($sql);
      $data[]=$proCode;
      $stmt->execute($data);

      $rec=$stmt->fetch(PDO::FETCH_ASSOC);
      $proName=$rec['name'];
      $proImageName=$rec['gazou'];

      $dbh=null;

      if($proImageName==''){
        $dispImage='';
      }else{
        $dispImage='<img src="../product/image/'.$proImageName.'">';
      }

      echo '<br><a href="shop_cartin.php?procode='.$proCode.'">カートに入れる</a><br>';

    }catch(Exception $e){

      echo 'ただいま障害により大変ご迷惑をお掛けしております';
      // 強制終了
      exit();

    }
  ?>

  <h2>商品情報参照</h2>
  <p>商品コード</p>
  <?php echo $proCode; ?>
  <br>
    <p>商品名</p>
    <?php echo $proName; ?>
    <br>
    <?php echo $dispImage; ?>
    <br><br>
    <form>
      <input type="button" onclick="history.back()" value="戻る">        
  </form>
</body>
</html>