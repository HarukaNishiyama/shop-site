<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>ろくまる農園</title>
</head>
<body>
  <?php
    require_once('../common/common.php');

    $post=sanitize($_POST);

    $onamae=$post['onamae'];
    $email=$post['email'];
    $postal1=$post['postal1'];
    $postal2=$post['postal2'];
    $address=$post['address'];
    $tel=$post['tel'];
    $chumon=$post['chumon'];
    $pass=$post['pass'];
    $pass2=$post['pass2'];
    $danjo=$post['danjo'];
    $birth=$post['birth'];

    // フラグ制御
    $okflg=true;

    if($onamae==''){
      echo 'お名前が入力されていません<br>';
      $okflg=false;
    }else{
      echo 'お名前：'.$onamae.'<br>';
    }

    if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$email)==0){
      echo 'メールアドレスを正確に入力してください<br>';
      $okflg=false;
    }else{
      echo 'メールアドレス：'.$email.'<br>';
    }

    if(preg_match('/\A[0-9]+\z/',$postal1)==0){
      echo '郵便番号は半角英数で入力してください<br>';
      $okflg=false;
    }else{
      echo '郵便番号：'.$postal1.'-'.$postal2.'<br>';
    }
    if(preg_match('/\A[0-9]+\z/',$postal2)==0){
      echo '郵便番号は半角英数で入力してください<br>';
      $okflg=false;
    }

    if($address==''){
      echo '住所が入力されていません<br>';
      $okflg=false;
    }else{
      echo '住所：'.$address.'<br>';
    }

    if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/',$tel)==0){
      echo '電話番号を正確に入力してください<br>';
      $okflg=false;
    }else{
      echo '電話番号：'.$tel.'<br><br>';
    }
    // 会員登録をする場合
    if($chumon=='chumontouroku'){

      if($pass==''){
        echo 'パスワードが入力されていません<br>';
        $okflg=false;
      }
      if($pass!=$pass2){
        echo 'パスワードが一致しません<br>';
        $okflg=false;
      }
      echo '性別：';
      if($danjo=='dan'){
        echo '男性';
      }else{
        echo '女性';
      }
      echo '<br>';
      echo '生まれ年：';
      echo $birth;
      echo '年代<br>';

    }
    
    // フラグが全て真ならOKボタンを表示
    if($okflg==true){
      echo '<form method="post" action="shop_form_done.php">';
      echo '<input type="hidden" name="onamae" value="'.$onamae.'">';
      echo '<input type="hidden" name="email" value="'.$email.'">';
      echo '<input type="hidden" name="postal1" value="'.$postal1.'">';
      echo '<input type="hidden" name="postal2" value="'.$postal2.'">';
      echo '<input type="hidden" name="address" value="'.$address.'">';
      echo '<input type="hidden" name="tel" value="'.$tel.'">';
      echo '<input type="hidden" name="chumon" value="'.$chumon.'">';
      echo '<input type="hidden" name="pass" value="'.$pass.'">';
      echo '<input type="hidden" name="danjo" value="'.$danjo.'">';
      echo '<input type="hidden" name="birth" value="'.$birth.'">';
      echo '<input type="button" onclick="history.back()" value="戻る">';
      echo '<input type="submit" value="OK">';
      echo '</form>';  
    }else{
      echo '<form>';
      echo '<input type="button" onclick="history.back()" value="戻る">';
      echo '</form>';        
    }

  ?>
</body>
</html>