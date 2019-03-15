<?php

  // ログイン確認
  // 合言葉確認
  session_start();
  // 毎回合言葉を変える
  session_regenerate_id(true);
  // ログイン確認ができない場合の処理
  if(isset($_SESSION['member_login'])==false){
    echo 'ようこそゲスト様<br>';
    echo '<a href="../staff_login/staff_login.html">会員ログイン</a><br><br>';
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
      // 定義
      $proCode=$_GET['procode'];
      // 空欄確認
      if(isset($_SESSION['cart'])==true){
        // 空欄なら最初にコピー
        $cart=$_SESSION['cart'];
        $kazu=$_SESSION['kazu'];
        // 配列の中に要素があるかを確認する関数
        if(in_array($proCode,$cart)==true){
          echo 'その商品はすでにカートに入っています<br>';
          echo '<a href="shop_list.php">商品一覧に戻る</a>';
          exit();
        }
      }
      // コピーにコピーを重ねていく
      $cart[]=$proCode;
      // 初期値
      $kazu[]=1;
      // 保存
      $_SESSION['cart']=$cart;
      $_SESSION['kazu']=$kazu;


    }catch(Exception $e){

      echo 'ただいま障害により大変ご迷惑をお掛けしております';
      // 強制終了
      exit();

    }
  ?>
<p>カートに追加しました</p><br>
<a href="shop_list.php">商品一覧に戻る</a>
    
</body>
</html>