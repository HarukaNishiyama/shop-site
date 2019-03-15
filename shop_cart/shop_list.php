<?php
  // ログイン確認
  // 合言葉確認
  session_start();
  // 毎回合言葉を変える
  session_regenerate_id(true);
  // ログイン確認ができない場合の処理
  if(isset($_SESSION['member_login'])==false){
    echo 'ようこそゲスト様<br>';
    echo '<a href="member_login.html">会員ログイン</a>';
  }else{
    echo 'ようこそ'.$_SESSION['member_name'].'様　';
    echo '<a href="member_logout.php">ログアウト</a><br>';
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
      $sql='SELECT code,name,price FROM mst_product WHERE 1';
      $stmt=$dbh->prepare($sql);
      $stmt->execute();
      // 切断
      $dbh=null;

      echo '<h2>商品一覧</h2><br>';

      // 商品一覧繰り返し
      while(true){
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false){
          break;
        }
        echo '<a href="shop_product.php?procode='.$rec['code'].'">';
        echo $rec['name'].'---';
        echo $rec['price'].'円';
        echo '</a>';
        echo '<br>';
        echo '<br>';
      } 
    }catch(Exception $e){

      echo 'ただいま障害により大変ご迷惑をお掛けしております';
      // 強制終了
      exit();
    }
    echo '<br><a href="shop_cartlook.php">カートを見る</a>';
  ?>
</body>
</html>