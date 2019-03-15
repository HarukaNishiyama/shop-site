<?php
  // セッション開始
  session_start();
  // 合言葉変更
  session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>ろくまる農園</title>
</head>
<body>
  <?php
   try{

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
    $danjo=$post['danjo'];
    $birth=$post['birth'];

    echo $onamae.'様、<br>ご注文ありがとうございました。<br>';
    echo $email.'に確認のメールをお送りしましたのでご確認ください。<br>';
    echo '商品は以下の住所に発送させていただきます。<br>';
    echo $postal1.'-'.$postal2.'<br>';
    echo $address.'<br>'.$tel;

    // メールの文章
    // 最初は空文
    $honbun='';
    // .=で文章を追加していく
    $honbun.=$onamae."様\n\nこのたびはご注文ありがとうございました。\n";
    $honbun.="\n";
    $honbun.="ご注文商品\n";
    $honbun.="--------------------\n";

    $cart=$_SESSION['cart'];
    $kazu=$_SESSION['kazu'];
    $max=count($cart);

    // SQLに接続
    $dsn='mysql:dbname=shop;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    for($i=0;$i<$max;$i++){
      // SQLに命令
      $sql='SELECT name,price FROM mst_product WHERE code=?';
      $stmt=$dbh->prepare($sql);
      $data[0]=$cart[$i];
      $stmt->execute($data);

      $rec=$stmt->fetch(PDO::FETCH_ASSOC);

      $name=$rec['name'];
      $price=$rec['price'];
      $kakaku[]=$price;
      $suryo=$kazu[$i];
      $shokei=$price*$suryo;

      $honbun.=$name.' ';
      $honbun.=$price.'円×';
      $honbun.=$suryo.'個=';
      $honbun.=$shokei."円\n";
    }
    
    // SQLに命令
    // 自分以外がテーブルを使えないようにロックする
    $sql='LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();

    // 非会員であれば0とする
    $lastmembercode=0;
    if($chumon=='chumontouroku'){
      $sql='INSERT INTO dat_member(password,name,email,postal1,postal2,address,tel,danjo,born)VALUES(?,?,?,?,?,?,?,?,?)';
      $stmt=$dbh->prepare($sql);
      $data=array();
      // 暗号化
      $data[]=md5($pass);
      $data[]=$onamae;
      $data[]=$email;
      $data[]=$postal1;
      $data[]=$postal2;
      $data[]=$address;
      $data[]=$tel;

      if($danjo=='dan'){
        $data[]=1;
      }else{
        $data[]=2;
      }
      $data[]=$birth;
      $stmt->execute($data);

      $sql='SELECT LAST_INSERT_ID()';
      $stmt=$dbh->prepare($sql);
      $stmt->execute();
      $rec=$stmt->fetch(PDO::FETCH_ASSOC);
      $lastmembercode=$rec['LAST_INSERT_ID()'];

    }

    // SQLに命令
    $sql='INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
    $stmt=$dbh->prepare($sql);
    // 配列を消す関数
    $data=array();
    $data[]=$lastmembercode;
    $data[]=$onamae;
    $data[]=$email;
    $data[]=$postal1;
    $data[]=$postal2;
    $data[]=$address;
    $data[]=$tel;
    $stmt->execute($data);

    // SQLに命令
    // 直近に発番された番号を取得するSQL
    $sql='SELECT LAST_INSERT_ID()';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
    $lastcode=$rec['LAST_INSERT_ID()'];

    for($i=0;$i<$max;$i++){
      // SQL
      $sql='INSERT INTO dat_sales_product(code_sales,code_product,price,quantity) VALUES(?,?,?,?)';
      $stmt=$dbh->prepare($sql);
      // 配列を消す関数
      $data=array();  
      $data[]=$lastcode;
      $data[]=$cart[$i];
      $data[]=$kakaku[$i];
      $data[]=$kazu[$i];
      $stmt->execute($data);
    }
    // SQLに命令
    // ロック解除
    $sql='UNLOCK TABLES';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();

    $dbh=null;

    if($chumon=='chumontouroku'){
      echo '<br><br>会員登録が完了いたしました。<br>次回からメールアドレスとパスワードでログインしてください。<br>
      ご注文が簡単にできるようになります。<br>';
    }

    $honbun.="送料は無料です。\n";
    $honbun.="--------------------\n";
    $honbun.="\n";
    $honbun.="代金は以下の口座にお振込みください。\n";
    $honbun.="\nFF銀行 アイテム支店 普通口座 １１４５１４\n\n";
    $honbun.="入金確認が取れ次第、梱包・発送させていただきます。\n";
    $honbun.="\n";

    if($chumon=='chumontouroku'){
      $honbun.="会員登録が完了いたしました。\n次回からメールアドレスとパスワードでログインしてください。\n
      ご注文が簡単にできるようになります。\n";
    }
    $honbun.="□□□□□□□□□□□□□□□\n";
    $honbun.="～あんしん品質のFF屋～";
    $honbun.="\n";
    $honbun.="はじまりの国県王国市 0-00-0\n";
    $honbun.="電話：114-514-1919\n";
    $honbun.="メール：info@ffitem.co.jp\n";
    $honbun.="□□□□□□□□□□□□□□□\n";
    
    // メール表示テスト
    // echo '<br>';
    // echo nl2br($honbun);

    // メール送信プログラム
    $title='ご注文ありがとうございます。';
    $header='From:info@ffitem.co.jp';
    $honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    mb_send_mail($email,$title,$honbun,$header);

  }catch(Exception $e){
    echo 'ただいま障害により大変ご迷惑をお掛けしております';
    // 強制終了
    exit();

  }
  ?>
  <br><a href="shop_list.php">商品画面へ</a>
</body>
</html>