<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>ろくまる農園</title>
</head>
<body>
  <?php
  // ログイン合言葉確認
  session_start();
  // 合言葉を毎回変更
  session_regenerate_id(true);
  // もし合言葉が確認できない場合の処理
  if(isset($_SESSION['login'])==false){
    echo 'ログインされていません';
    echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
  }
  // 参照画面
  if(isset($_POST['disp'])==true){
    if(isset($_POST['procode'])==false){
      header('Location:pro_ng.php');
      exit();
    }
    $proCode=$_POST['procode'];
    header('Location:pro_disp.php?procode='.$proCode);
    exit();
  }

  // 追加画面
  if(isset($_POST['add'])==true){
  header('Location:pro_add.php');
  exit();
  }

  // 修正画面
  if(isset($_POST['edit'])==true){
    if(isset($_POST['procode'])==false){
      header('Location:pro_ng.php');
      exit();
    }
    $proCode=$_POST['procode'];
    header('Location:pro_edit.php?procode='.$proCode);
    exit();
  }

  // 削除画面
  if(isset($_POST['delete'])==true){
    if(isset($_POST['procode'])==false){
      header('Location:pro_ng.php');
      exit();
    }
    $proCode=$_POST['procode'];
    header('Location:pro_delete.php?procode='.$proCode);
    exit();
  }

  ?>
</body>
</html>