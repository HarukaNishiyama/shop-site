<?php

try{
  require_once('../common/common.php');
  $post=sanitize($_POST);
  // セキュリティ対策
  // $staff_code=htmlspecialchars($staff_code,ENT_QUOTES,'UTF-8');
  // $staff_pass=htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');
  $member_email=$post['email'];
  $member_pass=$post['pass'];
  // 暗号化
  $member_pass=md5($member_pass);
  // SQLに接続
  $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
  $user='root';
  $password='';
  $dbh=new PDO($dsn,$user,$password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  // SQLに命令
  $sql='SELECT code,name FROM dat_member WHERE email=? AND password=?';
  $stmt=$dbh->prepare($sql);
  $data[]=$member_email;
  $data[]=$member_pass;
  $stmt->execute($data);
  // SQL切断
  $dbh=null;

  $rec=$stmt->fetch(PDO::FETCH_ASSOC);

  if($rec==false){
    echo 'メールアドレスかパスワードが間違っています<br>';
    echo '<a href="member_login.html">戻る</a>';
  }else{
    // ログイン確認
    session_start();
    $_SESSION['member_login']=1;
    $_SESSION['member_code']=$rec['code'];
    $_SESSION['member_name']=$rec['name'];
    header('Location:shop_list.php');
    exit();
  }

}catch(Exception $e){
  echo 'ただいま障害により大変ご迷惑をお掛けしております';
  exit();
}

?>