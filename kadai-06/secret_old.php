<?php
  //$_GETをチェックして分岐
  //strcmpを使う
  //if(empty($_GET) || $_GET['password'] != "SECRETWORD"){
  if(empty($_GET) || strcmp($_GET['password'], "SECRETWORD") !== 0){
    http_response_code(403);
  }
  else{
    http_response_code(200);
  }
  
  //変数初期値
  $v_code = http_response_code();
  $v_title = "";
  $v_output = "HTTPステータスコード：" . $v_code . "<br />";
  
  //HTTPステータスコードが403の場合
  if($v_code == 403){
    $v_title = "アクセス不可";
    $v_output .= "<p style='font-weight:bold;font-size:20pt;'>アクセス不可です！</p>";
  }
  //HTTPステータスコードが200の場合
  elseif($v_code == 200){
    $v_title = "課題６";
    $v_output .= "秘密のページ<br /><br />\n" . 
                 "<img src='./otanoshimi.jpg' width=400 title='銀ちゃん' />";
  }
  
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $v_title; ?></title>
</head>
<body>
  <?php echo $v_output; ?>
</body>
</html>