<?php
// 合言葉確認
session_start();
// 合言葉を空っぽに
$_SESSION=array();

if(isset($_COOKIE['session_name()'])==true){
  // 合言葉をクッキーから削除
  setcookie(session_name(),'',time()-42000,'/');
}
// サーバーとPCの接続を切断
session_destroy();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>ろくまる農園</title>
</head>
<body>
  <p>ログアウトしました</p>
  <a href="shop_list.php">商品一覧に戻る</a>
</body>
</html>