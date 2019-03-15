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

  if(isset($_POST['disp'])==true){
    if(isset($_POST['staffcode'])==false){
      header('Location:staff_ng.php');
      exit();
    }
    $staffCode=$_POST['staffcode'];
    header('Location:staff_disp.php?staffcode='.$staffCode);
    exit();
  }
  
  if(isset($_POST['add'])==true){
  header('Location:staff_add.php');
  exit();
  }
  
  if(isset($_POST['edit'])==true){
    if(isset($_POST['staffcode'])==false){
      header('Location:staff_ng.php');
      exit();
    }
    $staffCode=$_POST['staffcode'];
    header('Location:staff_edit.php?staffcode='.$staffCode);
    exit();
  }

  if(isset($_POST['delete'])==true){
    if(isset($_POST['staffcode'])==false){
      header('Location:staff_ng.php');
      exit();
    }
    $staffCode=$_POST['staffcode'];
    header('Location:staff_delete.php?staffcode='.$staffCode);
    exit();
  }

  ?>
</body>
</html>