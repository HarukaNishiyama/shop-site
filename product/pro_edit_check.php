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
  // 定義部分
  $proCode=$_POST['code'];
  $proName=$_POST['name'];
  $proPrice=$_POST['price'];
  $proImageNameOld=$_POST['imageNameOld'];
  $proImage=$_FILES['image'];
  
  // セキュリティ対策
  $proName=htmlspecialchars($proName,ENT_QUOTES,'UTF-8');
  $proPrice=htmlspecialchars($proPrice,ENT_QUOTES,'UTF-8');
  $proCode=htmlspecialchars($proCode,ENT_QUOTES,'UTF-8');

  // 条件分岐

  // 商品名が入っているか
  if($proName==''){
    echo '商品名が入っていません<br>';
  }else{
    echo '商品名：'.$proName.'<br>';
  }
    
  // 半角数字チェック
  if(preg_match('/^[0-9]+$/',$proPrice)==0){
    echo '価格をきちんと入力してください<br>';
  }else{
    echo '価格：'.$proPrice.'円<br>';
  }

  // 画像サイズ確認
  if($proImage['size']>0){
    if($proImage['size']>1000000){
      echo '画像が大きすぎます';
    }else{
      move_uploaded_file($proImage['tmp_name'],'./image/'.$proImage['name']);
      echo '<img src="./image/'.$proImage['name'].'"><br>';
    }
  }

  // 最終確認
  if($proName==''||preg_match('/^[0-9]+$/',$proPrice)==0||$proImage['size']>1000000){
    // 空白がある場合
    echo '<form>';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '</form>';
  }else{
    
    echo '<form method="post" action="pro_edit_done.php">';

    echo '<input type="hidden" name="code" value="'.$proCode.'">';
    echo '<input type="hidden" name="name" value="'.$proName.'">';
    echo '<input type="hidden" name="price" value="'.$proPrice.'">';
    echo '<input type="hidden" name="imageNameOld" value="'.$proImageNameOld.'">';
    echo '<input type="hidden" name="imageName" value="'.$proImage['name'].'">';

    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '<input type="submit"  value="OK">';
    
    echo '</form>';
  }
  ?>
</body>
</html>