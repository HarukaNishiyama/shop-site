<?php
  // ログイン確認
  // 合言葉確認
	session_start();
  // 毎回合言葉を変える
	session_regenerate_id(true);
  // ログイン確認ができない場合の処理
	if(isset($_SESSION['member_login'])==false){
		echo 'ようこそゲスト様　';
		echo '<a href="member_login.html">会員ログイン</a><br />';
		echo '<br />';
	}else{
		echo 'ようこそ';
		echo $_SESSION['member_name'];
		echo '様　';
		echo '<a href="member_logout.php">ログアウト</a><br />';
		echo '<br />';
	}
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

			if(isset($_SESSION['cart'])==true){
				// 保管していたカートの中身を戻す
				$cart=$_SESSION['cart'];
				$kazu=$_SESSION['kazu'];
				// 配列内のデータ数をカウント
				$max=count($cart);
			}else{
				// カートの中身が0の場合は0を代入
				$max=0;
			}
		// カートの中身を仮に表示
		// var_dump($cart);
		// exit();
		// 接続
		$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
		$user='root';
		$password='';
		$dbh=new PDO($dsn,$user,$password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				// カートの中身を繰り返し表示
		foreach($cart as $key=>$val){
			$sql='SELECT code,name,price,gazou FROM mst_product WHERE code=?';
			$stmt=$dbh->prepare($sql);
			$data[0]=$val;
			$stmt->execute($data);

			$rec=$stmt->fetch(PDO::FETCH_ASSOC);

			$pro_name[]=$rec['name'];
			$pro_price[]=$rec['price'];
			// 画像がある場合と無い場合
			if($rec['gazou']==''){
				$pro_gazou[]='';
			}else{
				$pro_gazou[]='<img src="../product/image/'.$rec['gazou'].'">';
			}
		}
		// SQl切断
		$dbh=null;
		// デザインしやすくするため下に移動
		// for($i=0;$i<$max;$i++){
		//   echo $proName[$i].'<br>';
		//   echo $proImage[$i].'<br>';
		//   echo $proPrice[$i].'円<br>';
		// }
		}catch(Exception $e){
			echo'ただいま障害により大変ご迷惑をお掛けしております。';
			// 強制終了
			exit();
		}

	?>

カートの中身<br />
<br />
<form method="post" action="kazu_change.php">
	<table border="1">
		<tr>
			<td>商品</td>
			<td>商品画像</td>
			<td>価格</td>
			<td>数量</td>
			<td>小計</td>
			<td>削除</td>
		</tr>
	<?php for($i=0;$i<$max;$i++): ?>
			<tr>
			<td><?php echo $pro_name[$i] ?></td>
			<td><?php echo $pro_gazou[$i] ?></td>
			<td><?php echo $pro_price[$i] ?>円</td>
			<td><input type="text" name="kazu<?php echo $i ?>" value="<?php echo $kazu[$i] ?>"></td>
			<td><?php echo $pro_price[$i]*$kazu[$i] ?>円</td>
			<td><input type="checkbox" name="sakujo<?php echo $i ?>"></td>
		</tr>
	<?php endfor ?>
	</table>
	<input type="hidden" name="max" value="<?php echo $max ?>"><br><br>
	<input type="submit" value="数量変更"><br><br>
	<a href="shop_list.php">商品一覧に戻る</a><br>
</form>
<h3><a href="shop_form.html">購入手続きへ進む</a></h3>
<?php
	if(isset($_SESSION["member_login"])==true){
		echo '<a href="shop_kantan_check.php">会員かんたん注文へ進む</a><br>';
	}
?>
</body>
</html>