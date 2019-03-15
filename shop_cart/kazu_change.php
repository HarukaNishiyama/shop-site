<?php
  // セッション開始
  session_start();
  session_regenerate_id(true);
  // 関数読み込み
  require_once('../common/common.php');
  // セキュリティ対策
  $post=sanitize($_POST);
  // 商品の種類数を$maxにコピー
  $max=$post['max'];
  // 商品の数だけ繰り返す
  for($i=0;$i<$max;$i++){
    // 整数確認
    if(preg_match("/^[0-9]+$/",$post['kazu'.$i])==0){
      echo '数量に誤りがあります<br>';
      echo '<a href="shop_cartlook.php">カートに戻る</a>';
      exit();
    }
    // 個数制限
    if($post['kazu'.$i]<1||10<$post['kazu'.$i]){
      echo '数量は1個以上、10個までです<br><br>';
      echo '<a href="shop_cartlook.php">カートに戻る</a>';
      exit();
    }
    // 商品数を配列に入れていく
    $kazu[]=$post['kazu'.$i];
  }

  $cart=$_SESSION['cart'];
  // 逆繰り返し処理
  for($i=$max;0<=$i;$i--){
    // 空欄確認
    if(isset($_POST['sakujo'.$i])==true){
      // 配列を削除する関数
      array_splice($cart,$i,1);
      array_splice($kazu,$i,1);
    }
  }

  // 保存する
  $_SESSION['cart']=$cart;
  $_SESSION['kazu']=$kazu;
  // 前のページに戻る
  header('Location:shop_cartlook.php');
  exit();

?>