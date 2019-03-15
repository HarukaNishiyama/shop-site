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
  $staffCode=$_POST['code'];
  $staffName=$_POST['name'];
  $staffPass=$_POST['pass'];
  $staffPass2=$_POST['pass2'];
  
  // セキュリティ対策
  $staffName=htmlspecialchars($staffName,ENT_QUOTES,'UTF-8');
  $staffPass=htmlspecialchars($staffPass,ENT_QUOTES,'UTF-8');
  $staffPass2=htmlspecialchars($staffPass2,ENT_QUOTES,'UTF-8');

  // 条件分岐

  // スタッフ名が入っているか
  if($staffName==''){
    echo 'スタッフ名が入っていません<br>';
  }else{
    echo 'スタッフ名：'.$staffName.'<br>';
  }
  
  // パスワード確認１
  if($staffPass==''){
    echo 'パスワードが入力されていません<br>';
  }
  // パスワード確認２
  if($staffPass!=$staffPass2){
    echo 'パスワードが一致しません<br>';
  }
  echo '<br>';    
  // 最終確認
  if($staffName==''||$staffPass==''||$staffPass2==''){
    // 空白がある場合
    echo '<form>';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '</form>';
  }else{

    $staffPass=md5($staffPass);
    
    echo '<form method="post" action="staff_edit_done.php">';

    echo '<input type="hidden" name="code" value="'.$staffCode.'">';
    echo '<input type="hidden" name="name" value="'.$staffName.'">';
    echo '<input type="hidden" name="pass" value="'.$staffPass.'">';

    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '<input type="submit"  value="OK">';
    
    echo '</form>';
  }
  ?>
</body>
</html>