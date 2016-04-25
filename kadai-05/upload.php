<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>課題５</title>
</head>
<body>
  ファイルのアップロード<br /><br />
  <form action="./upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="upfile" />
    <input type="submit" value="サブミット！" />
  </form>
  <?php
    
    //サイズの調査結果↓↓
    //upload_max_filesize → 2M（アップロードされるファイルの最大サイズ）
    //post_max_size       → 8M（POSTデータに許可される最大サイズ）
    //memory_limit        → 128M（スクリプトが確保できる最大メモリ）
    
    //初期表示は文言を表示しない
    if(!empty($_FILES)){
      //errorコードが0の場合は成功
      if($_FILES['upfile']['error'] == 0){
        echo "ファイルのサイズ：" . $_FILES['upfile']['size'] . "bytes<br />";
        echo "ファイルのmd5値：" . md5_file($_FILES['upfile']['tmp_name']) . "<br />";
      }
      //errorコードが0以外だとエラー
      else{
        echo "<p style='color:red;'>エラーが起きています。errorコード：" . $_FILES['upfile']['error'] . "</p>";
      }
    }
    
  ?>
  
</body>
</html>