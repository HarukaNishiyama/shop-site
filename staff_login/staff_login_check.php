<?php

try{
  // 定義
  $staff_code=$_POST['code'];
  $staff_pass=$_POST['pass'];
  // セキュリティ対策
  $staff_code=htmlspecialchars($staff_code,ENT_QUOTES,'UTF-8');
  $staff_pass=htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');

  $staff_pass=md5($staff_pass);
  // SQLに接続
  $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
  $user='root';
  $password='';
  $dbh=new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  // SQLに命令
  $sql='SELECT name FROM mst_staff WHERE code=? AND password=?';
  $stmt=$dbh->prepare($sql);
  $data[]=$staff_code;
  $data[]=$staff_pass;
  $stmt->execute($data);
  // SQL切断
  $dbh=null;

  $rec=$stmt->fetch(PDO::FETCH_ASSOC);

  if($rec==false){
    echo 'スタッフコードかパスワードが間違っています<br>';
    echo '<a href="staff_login.html">戻る</a>';
  }else{
    // ログイン確認
    session_start();
    $_SESSION['login']=1;
    $_SESSION['staff_code']=$staff_code;
    $_SESSION['staff_name']=$rec['name'];
    header('Location:staff_top.php');
    exit();
  }

}catch(Exception $e){
  echo 'ただいま障害により大変ご迷惑をお掛けしております';
  exit();
}

?>